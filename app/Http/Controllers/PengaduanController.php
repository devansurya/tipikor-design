<?php

namespace App\Http\Controllers;

use App\Services\TipikorApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengaduanController extends Controller
{
    public function __construct(
        protected TipikorApiService $api,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Show Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        try {
            // $lokasi      = $this->api->getLokasiKejadian();
            // $jenisDugaan = $this->api->getJenisDugaan();
            $lokasi      = [];
            $jenisDugaan = [];
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data dari API Tipikor', [
                'error' => $e->getMessage(),
            ]);

            $lokasi      = [];
            $jenisDugaan = [];
        } 

        return view('pengaduan', compact('lokasi', 'jenisDugaan'));
    }

    /*
    |--------------------------------------------------------------------------
    | Submit Form
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identitas pelapor
            'jenis_identitas'    => 'required|in:anonim,rahasia,terbuka',
            'nama'               => 'nullable|string|max:255',
            'kontak'             => 'nullable|string|max:255',

            // Data pengaduan
            'ringkasan'          => 'required|string|max:250',
            'uraian_lengkap'     => 'required|string',
            'waktu_kejadian'     => 'required|date',
            'jumlah_pihak'       => 'nullable|in:ya,tidak,tidak_tahu',
            'lokasi'             => 'nullable|string',
            'detail_lokasi'      => 'nullable|string|max:500',

            // Terlapor
            'nama_terlapor'      => 'nullable|string|max:255',
            'instansi_terlapor'  => 'required|string|max:255',
            'jabatan_terlapor'   => 'nullable|string|max:255',

            // Sosmed terlapor
            'sosmed_instagram'   => 'nullable|string|max:255',
            'sosmed_facebook'    => 'nullable|string|max:255',
            'sosmed_x'           => 'nullable|string|max:255',

            'pernah_dilaporkan'  => 'nullable|in:ya,tidak,tidak_tahu',

            // Objek dugaan
            'jenis_dugaan'       => 'required|string|min:1',
            'jenis_dugaan.*'     => 'string',
            'terkait_anggaran'   => 'nullable|in:ya,tidak',
            'sumber_dana'        => 'nullable|in:apbn,bumn_bumd,lainnya',
            'sumber_dana_lainnya'=> 'nullable|string|max:255',
            'proyek'             => 'nullable|string|max:255',
            'nama_trejer'        => 'nullable|string|max:255',
            'anggaran'           => 'nullable|string|max:100',

            // Bukti
            'bukti'              => 'nullable|array',
            'bukti.*'            => 'file|max:10240|mimes:pdf,jpg,jpeg,png,mp4,m4a,doc,docx,xls,xlsx',
            'deskripsi_bukti'    => 'nullable|array',
            'deskripsi_bukti.*'  => 'nullable|string|max:500',
        ]);

        try {
            // Build content from multiple fields
            $contentParts = [];
            if (!empty($validated['waktu_kejadian'])) {
                $contentParts[] = "Tanggal Kejadian: {$validated['waktu_kejadian']}";
            }
            if (!empty($validated['uraian_lengkap'])) {
                $contentParts[] = "Uraian:\n{$validated['uraian_lengkap']}";
            }
            if (!empty($validated['detail_lokasi'])) {
                $contentParts[] = "Lokasi: {$validated['detail_lokasi']}";
            }
            if (!empty($validated['nama_terlapor'])) {
                $contentParts[] = "Nama Terlapor: {$validated['nama_terlapor']}";
            }
            if (!empty($validated['instansi_terlapor'])) {
                $contentParts[] = "Instansi Terlapor: {$validated['instansi_terlapor']}";
            }
            if (!empty($validated['jabatan_terlapor'])) {
                $contentParts[] = "Jabatan Terlapor: {$validated['jabatan_terlapor']}";
            }

            // Map to API fields
            $payload = [
                'fullname' => $validated['nama'] ?? '',
                'contact'  => $validated['kontak'] ?? '',
                'subject'  => $validated['ringkasan'],
                'content'  => implode("\n\n", $contentParts),
            ];

            $result = $this->api->submitPengaduan($payload);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengaduan berhasil dikirim. Terima kasih atas laporan Anda.',
                    'data'    => $result,
                ]);
            }

            return redirect()
                ->route('pengaduan.create')
                ->with('success', 'Pengaduan berhasil dikirim. Terima kasih atas laporan Anda.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e; // Let Laravel handle validation JSON response automatically
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim pengaduan ke API', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengirim pengaduan. Silakan coba lagi.',
                ], 500);
            }

            return redirect()
                ->route('pengaduan.create')
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim pengaduan. Silakan coba lagi.');
        }
    }
}
