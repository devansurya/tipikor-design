<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class TipikorApiService
{
    protected string $baseUrl;
    protected string $email;
    protected string $password;
    protected string $siteId;

    public function __construct()
    {
        $this->baseUrl  = rtrim(config('tipikor.api.base_url'), '/');
        $this->email    = config('tipikor.api.email');
        $this->password = config('tipikor.api.password');
        $this->siteId   = config('tipikor.api.site_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    /**
     * Retrieve a valid bearer token, cached until 5 minutes before expiry.
     */
    public function getToken(): string
    {
        return Cache::get('tipikor_api_token') ?? $this->authenticateAndCache();
    }

    /**
     * Hit the authenticate endpoint, cache the token with a proper TTL,
     * and return the token string.
     */
    protected function authenticateAndCache(): string
    {
        
        $response = Http::asForm()->post("{$this->baseUrl}/api/authenticate", [
            'email'    => $this->email,
            'password' => $this->password,
            'siteId'   => $this->siteId,
        ]);

        $response->throw();

        $data       = $response->json();
        $token      = $data['token'];
        $validUntil = $data['valid_until'] ?? null;
        $issuedAt   = $data['issued_at']   ?? null;

        // Cache for the token's lifetime minus a 5-minute safety buffer
        $ttl = ($validUntil && $issuedAt)
            ? max(($validUntil - $issuedAt) - 300, 60)
            : 7200;

        Cache::put('tipikor_api_token', $token, $ttl);

        return $token;
    }

    /**
     * Force-refresh the cached token (e.g. after a 401).
     */
    public function refreshToken(): string
    {
        Cache::forget('tipikor_api_token');
        return $this->authenticateAndCache();
    }

    /*
    |--------------------------------------------------------------------------
    | Generic HTTP helpers (auto-attach bearer token)
    |--------------------------------------------------------------------------
    */

    /**
     * Perform an authenticated GET request.
     */
    public function get(string $endpoint, array $query = []): array
    {
        return $this->request('get', $endpoint, ['query' => $query]);
    }

    /**
     * Perform an authenticated POST request (x-www-form-urlencoded).
     */
    public function post(string $endpoint, array $data = []): array
    {
        return $this->request('post', $endpoint, ['form' => $data]);
    }

    /**
     * Perform an authenticated POST request with multipart/form-data (file uploads).
     */
    public function postMultipart(string $endpoint, array $multipart = []): array
    {
        $response = Http::withToken($this->getToken())
            ->asMultipart()
            ->post("{$this->baseUrl}/{$endpoint}", $multipart);

        if ($response->status() === 401) {
            $this->refreshToken();
            $response = Http::withToken($this->getToken())
                ->asMultipart()
                ->post("{$this->baseUrl}/{$endpoint}", $multipart);
        }

        $response->throw();

        return $response->json() ?? [];
    }

    /**
     * Central request handler with automatic token retry on 401.
     */
    protected function request(string $method, string $endpoint, array $options = []): array
    {
        $url = "{$this->baseUrl}/{$endpoint}";
        $optKey = $this->optionKey($method, $options);
        $payload = $options[$optKey] ?? [];

        $http = Http::withToken($this->getToken());
        if ($optKey === 'form') {
            $http = $http->asForm();
        }

        $response = $http->{$method}($url, $payload);
    
        // Retry once with a fresh token when we get a 401
        if ($response->status() === 401) {
            $this->refreshToken();
            $http = Http::withToken($this->getToken());
            if ($optKey === 'form') {
                $http = $http->asForm();
            }
            $response = $http->{$method}($url, $payload);
        }

        $response->throw();

        $json = $response->json() ?? [];
        
        // Extract 'data' key if present (common API response wrapper)
        return $json['data'] ?? $json;
    }

    /**
     * Map HTTP method to the Http facade option key.
     */
    private function optionKey(string $method, array $options = []): string
    {
        // If caller explicitly passed 'form', use that
        if (isset($options['form'])) {
            return 'form';
        }

        return match ($method) {
            'get'  => 'query',
            default => 'json',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Domain-specific endpoints
    |--------------------------------------------------------------------------
    */

    /**
     * Fetch the list of provinces / locations for the dropdown.
     */
    public function getLokasiKejadian(): array
    {
        return $this->get('api/region');
    }

    /**
     * Fetch the list of "jenis dugaan" for the multi-select.
     */
    public function getJenisDugaan(): array
    {
        return $this->get('api/category');
    }

    /**
     * Submit the pengaduan form payload.
     */
    public function submitPengaduan(array $data): array
    {
        return $this->post('api/ticket/create', $data);
    }

    /**
     * Submit pengaduan with file attachments (multipart).
     */
    public function submitPengaduanWithFiles(array $fields, array $files = []): array
    {
        $multipart = [];

        // Append regular fields
        foreach ($fields as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $multipart[] = ['name' => "{$key}[]", 'contents' => $v];
                }
            } else {
                $multipart[] = ['name' => $key, 'contents' => $value ?? ''];
            }
        }

        // Append files
        foreach ($files as $file) {
            $multipart[] = [
                'name'     => 'bukti[]',
                'contents' => fopen($file->getPathname(), 'r'),
                'filename' => $file->getClientOriginalName(),
            ];
        }

        return $this->postMultipart('api/ticket/create', $multipart);
    }
}
