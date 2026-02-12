<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TIPIKOR - Single Page Reporting Portal</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1152d4",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style type="text/tailwindcss">
        .section-card {
            @apply bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800 rounded-xl p-5 mb-4 shadow-sm;
        }
        .form-label {
            @apply block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5;
        }
        .input-field {
            @apply w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm outline-none;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200 min-h-screen">
<header class="bg-white dark:bg-slate-900 border-b border-primary/10 py-3 sticky top-0 z-50">
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
<div class="flex items-center space-x-3">
<div class="bg-primary p-1.5 rounded-lg">
<span class="material-icons text-white text-xl">gavel</span>
</div>
<div>
<h1 class="text-lg font-bold tracking-tight text-primary leading-none">TIPIKOR <span class="text-slate-500 font-normal">| Portal</span></h1>
<p class="text-[10px] text-slate-400 uppercase tracking-widest leading-none mt-1">Anti-Corruption Reporting System</p>
</div>
</div>
<div class="flex items-center space-x-6">
<div class="hidden md:flex flex-col items-end">
<span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 flex items-center">
<span class="material-icons text-[14px] mr-1">verified_user</span>
                    Secure Connection
                </span>
<span class="text-[10px] text-slate-400">256-bit AES Encryption</span>
</div>
<div class="h-8 w-px bg-slate-200 dark:bg-slate-800"></div>
<button class="text-slate-500 hover:text-primary transition-colors flex items-center text-sm font-medium">
<span class="material-icons mr-1">help_outline</span>
                Panduan
            </button>
</div>
</div>
</header>
<main class="max-w-6xl mx-auto px-4 py-6">
<div class="flex flex-col lg:flex-row gap-6">
<div class="flex-grow lg:w-2/3">
<div class="mb-6">
<h2 class="text-2xl font-bold text-slate-900 dark:text-white">Formulir Laporan Pelanggaran</h2>
<p class="text-slate-500 text-sm">Mohon isi informasi di bawah ini dengan lengkap dan jujur. Kerahasiaan Anda terjamin.</p>
</div>
<form id="reporting-form">
<div class="section-card">
<div class="flex items-center space-x-2 mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">
<span class="material-icons text-primary text-xl">event_note</span>
<h3 class="font-bold text-slate-900 dark:text-white">1. Informasi Kejadian</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="space-y-1">
<label class="form-label">Tanggal Kejadian <span class="text-red-500">*</span></label>
<input class="input-field" required="" type="date"/>
</div>
<div class="space-y-1">
<label class="form-label">Kategori Pelanggaran <span class="text-red-500">*</span></label>
<select class="input-field" required="">
<option value="">Pilih Kategori</option>
<option value="bribery">Suap &amp; Gratifikasi</option>
<option value="embezzlement">Penggelapan Dana</option>
<option value="abuse">Penyalahgunaan Wewenang</option>
<option value="conflict">Konflik Kepentingan</option>
<option value="other">Lainnya</option>
</select>
</div>
<div class="md:col-span-2 space-y-1">
<label class="form-label">Deskripsi Detail <span class="text-red-500">*</span></label>
<textarea class="input-field resize-none" placeholder="Ceritakan kronologi kejadian secara mendalam (siapa, apa, di mana, bagaimana)..." required="" rows="3"></textarea>
</div>
</div>
</div>
<div class="section-card">
<div class="flex items-center space-x-2 mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">
<span class="material-icons text-primary text-xl">person_search</span>
<h3 class="font-bold text-slate-900 dark:text-white">2. Pihak Terlapor</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="space-y-1">
<label class="form-label">Nama Lengkap Terlapor</label>
<input class="input-field" placeholder="Nama atau Inisial" type="text"/>
</div>
<div class="space-y-1">
<label class="form-label">Jabatan / Instansi</label>
<input class="input-field" placeholder="Contoh: Manajer Operasional - PT X" type="text"/>
</div>
</div>
</div>
<div class="section-card">
<div class="flex items-center space-x-2 mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">
<span class="material-icons text-primary text-xl">cloud_upload</span>
<h3 class="font-bold text-slate-900 dark:text-white">3. Bukti Pendukung</h3>
</div>
<div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-6 text-center hover:border-primary transition-colors group cursor-pointer">
<span class="material-icons text-3xl text-slate-300 group-hover:text-primary mb-2">upload_file</span>
<p class="text-sm font-medium text-slate-600 dark:text-slate-400">Klik untuk unggah atau seret file ke sini</p>
<p class="text-[11px] text-slate-400 mt-1">PDF, JPG, PNG, atau MP4 (Maks. 25MB)</p>
<input class="hidden" multiple="" type="file"/>
</div>
</div>
<div class="section-card">
<div class="flex items-center justify-between mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">
<div class="flex items-center space-x-2">
<span class="material-icons text-primary text-xl">fingerprint</span>
<h3 class="font-bold text-slate-900 dark:text-white">4. Identitas Pelapor</h3>
</div>
<label class="inline-flex items-center cursor-pointer">
<span class="mr-2 text-xs font-bold text-slate-500 uppercase">Anonim</span>
<div class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
</div>
</label>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="space-y-1">
<label class="form-label">Nama (Opsional)</label>
<input class="input-field" placeholder="Kosongkan jika ingin anonim" type="text"/>
</div>
<div class="space-y-1">
<label class="form-label">Kontak / Email (Opsional)</label>
<input class="input-field" placeholder="Untuk update status laporan" type="email"/>
</div>
</div>
<div class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800 flex items-start space-x-3">
<span class="material-icons text-blue-500 text-sm mt-0.5">info</span>
<p class="text-[11px] text-blue-700 dark:text-blue-300 leading-normal italic">
                            Meskipun anonim, kami menyarankan memberikan email terenkripsi untuk koordinasi investigasi lebih lanjut.
                        </p>
</div>
</div>
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8 pt-6 border-t border-slate-200 dark:border-slate-800">
<div class="flex items-center space-x-2">
<input class="rounded text-primary focus:ring-primary border-slate-300" id="terms" type="checkbox"/>
<label class="text-xs text-slate-500" for="terms">Saya menyatakan bahwa informasi ini benar dan dapat dipertanggungjawabkan.</label>
</div>
<button class="w-full sm:w-auto px-10 py-3 bg-primary hover:bg-primary/90 text-white rounded-lg font-bold text-base flex items-center justify-center shadow-lg shadow-primary/25 transition-all" type="submit">
                        Kirim Laporan
                        <span class="material-icons ml-2">send</span>
</button>
</div>
</form>
</div>
<div class="lg:w-1/3 space-y-4">
<div class="p-5 bg-white dark:bg-slate-900 border border-emerald-100 dark:border-emerald-900/30 rounded-xl shadow-sm">
<div class="flex items-center space-x-3 mb-3">
<div class="bg-emerald-100 dark:bg-emerald-900/50 p-2 rounded-lg">
<span class="material-icons text-emerald-600 dark:text-emerald-400">verified</span>
</div>
<h4 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">Perlindungan Hukum</h4>
</div>
<p class="text-xs text-slate-500 leading-relaxed mb-3">
                    Identitas Anda dilindungi oleh <strong>UU No. 31/1999</strong> tentang Pemberantasan Tindak Pidana Korupsi dan program perlindungan saksi LPSK.
                </p>
<div class="flex items-center text-[11px] font-bold text-emerald-600 uppercase">
<span class="material-icons text-[14px] mr-1">check_circle</span>
                    Whistleblower Protection Active
                </div>
</div>
<div class="p-5 bg-white dark:bg-slate-900 border border-blue-100 dark:border-blue-900/30 rounded-xl shadow-sm">
<div class="flex items-center space-x-3 mb-3">
<div class="bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg">
<span class="material-symbols-outlined text-blue-600 dark:text-blue-400">shield_lock</span>
</div>
<h4 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">Enkripsi Militer</h4>
</div>
<p class="text-xs text-slate-500 leading-relaxed">
                    Data dikirimkan melalui jalur aman SSL/TLS dan dienkripsi sebelum disimpan di server kami yang terisolasi.
                </p>
</div>
<div class="p-5 bg-slate-900 text-white rounded-xl shadow-sm overflow-hidden relative">
<div class="relative z-10">
<h4 class="font-bold text-sm uppercase tracking-wider mb-2">Butuh Bantuan?</h4>
<p class="text-xs text-slate-400 mb-4 leading-relaxed">Konsultasi anonim melalui hotline kami jika Anda ragu untuk melapor.</p>
<div class="flex items-center space-x-2 text-primary-light">
<span class="material-icons text-sm">phone</span>
<span class="text-sm font-bold">1-800-TIP-IKOR</span>
</div>
</div>
<span class="material-icons absolute -bottom-4 -right-4 text-7xl text-white/5 rotate-12">support_agent</span>
</div>
<div class="p-4 border border-slate-200 dark:border-slate-800 rounded-xl">
<h5 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Dokumen yang diperlukan:</h5>
<ul class="space-y-2">
<li class="flex items-start space-x-2">
<span class="material-icons text-primary text-[14px] mt-0.5">check</span>
<span class="text-[11px] text-slate-500">Kwitansi/Bukti Transfer</span>
</li>
<li class="flex items-start space-x-2">
<span class="material-icons text-primary text-[14px] mt-0.5">check</span>
<span class="text-[11px] text-slate-500">Rekaman Suara/Video (Jika ada)</span>
</li>
<li class="flex items-start space-x-2">
<span class="material-icons text-primary text-[14px] mt-0.5">check</span>
<span class="text-[11px] text-slate-500">Surat Keputusan/Dokumen Dinas</span>
</li>
</ul>
</div>
</div>
</div>
</main>
<footer class="mt-12 py-8 text-center border-t border-slate-200 dark:border-slate-800">
<p class="text-xs text-slate-400">© 2024 TIPIKOR Whistleblower Protection Portal. All rights reserved.</p>
<div class="mt-2 flex justify-center space-x-4">
<a class="text-[11px] text-primary hover:underline font-medium" href="#">Kebijakan Privasi</a>
<a class="text-[11px] text-primary hover:underline font-medium" href="#">Syarat &amp; Ketentuan</a>
<a class="text-[11px] text-primary hover:underline font-medium" href="#">Standar Keamanan</a>
</div>
</footer>

</body></html>