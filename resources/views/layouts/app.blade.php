<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TIPIDKOR - Sistem Pengaduan Tindak Pidana Korupsi')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1152d4",
                        "background-light": "#f6f6f8",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        .section-card {
            @apply bg-white border border-slate-200/60 rounded-xl p-5 mb-4 shadow-sm;
        }
        .form-label-tw {
            @apply block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5;
        }
        .input-field {
            @apply w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm outline-none;
        }
        .input-field-select {
            @apply w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm outline-none appearance-none;
        }
        .input-error {
            @apply !border-red-400 !ring-2 !ring-red-200;
        }
        /* Select2 Custom Styling */
        .select2-container--default .select2-selection--multiple {
            background-color: rgb(248 250 252);
            border: 1px solid rgb(226 232 240);
            border-radius: 0.5rem;
            padding: 6px 8px;
            min-height: 42px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 4px;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #1152d4;
            box-shadow: 0 0 0 2px rgba(17, 82, 212, 0.15);
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 5px;
            padding: 0;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(17, 82, 212, 0.08);
            color: #1152d4;
            border: 1px solid rgba(17, 82, 212, 0.2);
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            padding: 3px 10px 3px 24px;
            margin: 0;
            position: relative;
            line-height: 1.5;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: rgba(17, 82, 212, 0.5);
            position: absolute;
            left: 7px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            margin: 0;
            padding: 0;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #1152d4;
            background: transparent;
        }
        .select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field {
            margin: 0;
            padding: 0;
            font-size: 13px;
            line-height: 1.5;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            margin-top: 0;
            margin-right: 4px;
            font-size: 18px;
            font-weight: 400;
            color: rgb(148 163 184);
            position: relative;
            top: 0;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__clear:hover {
            color: rgb(100 116 139);
        }
        .select2-dropdown {
            border: 1px solid rgb(226 232 240);
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            margin-top: 4px;
        }
        .select2-results__option {
            font-size: 13px;
            padding: 8px 12px;
        }
        .select2-results__option--highlighted[aria-selected] {
            background-color: #1152d4 !important;
        }
        .select2-search--dropdown .select2-search__field {
            border: 1px solid rgb(226 232 240);
            border-radius: 6px;
            font-size: 13px;
            padding: 6px 10px;
            outline: none;
        }
        @yield('styles')
    </style>
</head>
<body class="bg-background-light font-display text-slate-800 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="bg-white border-b border-primary/10 py-3 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-primary p-1.5 rounded-lg">
                    <span class="material-icons text-white text-xl">gavel</span>
                </div>
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-bold tracking-tight text-primary leading-none hover:text-primary/80 transition-colors">
                        DUMAS TIPIDKOR
                    </a>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest leading-none mt-1">Sistem Pengaduan Tindak Pidana Korupsi</p>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <nav class="hidden md:flex items-center space-x-1">
                    <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->is('/') ? 'text-primary bg-primary/5' : 'text-slate-500 hover:text-primary hover:bg-primary/5' }}">
                        <span class="material-icons text-[16px] align-middle mr-1">home</span>Beranda
                    </a>
                    <a href="{{ url('/pengaduan') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->is('pengaduan') ? 'text-primary bg-primary/5' : 'text-slate-500 hover:text-primary hover:bg-primary/5' }}">
                        <span class="material-icons text-[16px] align-middle mr-1">edit_note</span>Pengaduan
                    </a>
                </nav>
                <div class="hidden md:flex flex-col items-end">
                    <span class="text-xs font-semibold text-emerald-600 flex items-center">
                        <span class="material-icons text-[14px] mr-1">verified_user</span>
                        Koneksi Aman
                    </span>
                    <span class="text-[10px] text-slate-400">Data Terenkripsi</span>
                </div>
                <div class="h-8 w-px bg-slate-200 hidden md:block"></div>
                <a href="#" class="text-slate-500 hover:text-primary transition-colors flex items-center text-sm font-medium">
                    <span class="material-icons mr-1">help_outline</span>
                    Panduan
                </a>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-12 py-8 text-center border-t border-slate-200">
        <p class="text-xs text-slate-400">&copy; {{ date('Y') }} TIPIDKOR &mdash; Sistem Pengaduan Tindak Pidana Korupsi. Seluruh hak dilindungi.</p>
        <div class="mt-2 flex justify-center space-x-4">
            <a class="text-[11px] text-primary hover:underline font-medium" href="#">Kebijakan Privasi</a>
            <a class="text-[11px] text-primary hover:underline font-medium" href="#">Syarat &amp; Ketentuan</a>
            <a class="text-[11px] text-primary hover:underline font-medium" href="#">Standar Keamanan</a>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
