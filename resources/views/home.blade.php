@extends('layouts.app')

@section('title', 'TIPIDKOR - Sistem Pengaduan Tindak Pidana Korupsi')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-primary to-blue-800 text-white py-16 md:py-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="text-[11px] font-bold uppercase tracking-widest text-blue-200 mb-3">
                    <span class="material-icons text-[14px] align-middle mr-1">gavel</span>
                    Sistem Pengaduan Resmi
                </p>
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">
                    Sistem Pengaduan<br>Tindak Pidana Korupsi
                </h1>
                <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8">
                    Laporkan dugaan tindak pidana korupsi secara aman dan terlindungi. Identitas pelapor dijamin kerahasiaannya sesuai peraturan perundang-undangan yang berlaku.
                </p>
                <a href="{{ url('/pengaduan') }}" class="inline-flex items-center px-8 py-3 bg-white text-primary rounded-lg font-bold text-sm shadow-lg shadow-black/10 hover:bg-blue-50 transition-colors">
                    <span class="material-icons mr-2 text-[18px]">edit_note</span>
                    Buat Pengaduan
                </a>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-12 md:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold text-slate-900 text-center mb-2">Mengapa Melapor Melalui Sistem Ini?</h2>
            <p class="text-sm text-slate-500 text-center mb-10">Sistem dirancang untuk melindungi pelapor dan memastikan setiap aduan ditindaklanjuti.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white border border-slate-200/60 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary/10 p-2.5 rounded-lg flex-shrink-0">
                            <span class="material-icons text-primary">lock</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 mb-1">Kerahasiaan Terjamin</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Identitas pelapor dilindungi dan dapat memilih opsi pelaporan anonim, rahasia, atau terbuka.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/60 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary/10 p-2.5 rounded-lg flex-shrink-0">
                            <span class="material-icons text-primary">fact_check</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 mb-1">Tercatat &amp; Terdokumentasi</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Setiap laporan tercatat dalam sistem dan dapat ditelusuri untuk proses tindak lanjut.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/60 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary/10 p-2.5 rounded-lg flex-shrink-0">
                            <span class="material-icons text-primary">monitor</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 mb-1">Proses Transparan</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Laporan ditangani secara profesional sesuai prosedur penanganan tindak pidana korupsi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Steps --}}
    <section class="pb-12 md:pb-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold text-slate-900 text-center mb-2">Langkah Pelaporan</h2>
            <p class="text-sm text-slate-500 text-center mb-10">Proses sederhana dalam 3 langkah untuk melaporkan dugaan korupsi.</p>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="bg-white border border-slate-200/60 rounded-xl p-5 shadow-sm flex items-center space-x-4">
                    <div class="bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">1</div>
                    <div>
                        <h3 class="font-bold text-slate-900">Isi Formulir Pengaduan</h3>
                        <p class="text-sm text-slate-500">Lengkapi data identitas, uraian kejadian, objek dugaan, dan lampirkan bukti pendukung.</p>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/60 rounded-xl p-5 shadow-sm flex items-center space-x-4">
                    <div class="bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">2</div>
                    <div>
                        <h3 class="font-bold text-slate-900">Verifikasi &amp; Pencatatan</h3>
                        <p class="text-sm text-slate-500">Laporan akan diverifikasi kelengkapannya dan dicatat dalam sistem secara resmi.</p>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/60 rounded-xl p-5 shadow-sm flex items-center space-x-4">
                    <div class="bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">3</div>
                    <div>
                        <h3 class="font-bold text-slate-900">Tindak Lanjut</h3>
                        <p class="text-sm text-slate-500">Tim penyidik akan menindaklanjuti laporan sesuai ketentuan hukum yang berlaku.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="{{ url('/pengaduan') }}" class="inline-flex items-center px-10 py-3 bg-primary hover:bg-primary/90 text-white rounded-lg font-bold text-sm shadow-lg shadow-primary/25 transition-all">
                    <span class="material-icons mr-2 text-[18px]">edit_note</span>
                    Buat Pengaduan Sekarang
                </a>
            </div>
        </div>
    </section>
@endsection
