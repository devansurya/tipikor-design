@extends('layouts.app')

@section('title', 'Buat Pengaduan - TIPIDKOR')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- ==================== MAIN FORM (2/3) ==================== --}}
        <div class="flex-grow lg:w-2/3">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start space-x-3">
                    <span class="material-icons text-green-600 mt-0.5">check_circle</span>
                    <div>
                        <p class="text-sm font-semibold text-green-800">Berhasil!</p>
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start space-x-3">
                    <span class="material-icons text-red-600 mt-0.5">error</span>
                    <div>
                        <p class="text-sm font-semibold text-red-800">Gagal!</p>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm font-semibold text-red-800 mb-2">Mohon perbaiki kesalahan berikut:</p>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Formulir Pengaduan Tindak Pidana Korupsi</h2>
                <p class="text-slate-500 text-sm">Mohon isi informasi di bawah ini dengan lengkap dan jujur. Kerahasiaan Anda terjamin.</p>
                <div class="mt-4 p-4 bg-primary/5 border-l-4 border-primary rounded-r-lg">
                    <p class="text-sm font-medium text-slate-700">🛡️ Laporkan dugaan korupsi dengan aman. Identitas Anda dapat dirahasiakan.</p>
                </div>
            </div>

            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" id="formPengaduan">
                @csrf

                {{-- 1. Identitas Pelapor --}}
                <div class="section-card">
                    <div class="flex items-center space-x-2 mb-4 border-b border-slate-100 pb-3">
                        <span class="material-icons text-primary text-xl">fingerprint</span>
                        <h3 class="font-bold text-slate-900">1. Identitas Pelapor</h3>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-tw">Jenis Identitas</label>
                        <div class="flex flex-wrap gap-4 mt-1">
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="jenis_identitas" value="anonim" checked class="rounded-full text-primary focus:ring-primary border-slate-300">
                                <span class="ml-2 text-sm font-medium text-slate-600 group-hover:text-primary">
                                    <span class="material-icons text-[14px] align-middle mr-0.5">visibility_off</span>Anonim
                                </span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="jenis_identitas" value="rahasia" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                <span class="ml-2 text-sm font-medium text-slate-600 group-hover:text-primary">Rahasia</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="jenis_identitas" value="terbuka" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                <span class="ml-2 text-sm font-medium text-slate-600 group-hover:text-primary">Terbuka</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="identitasFields">
                        <div class="space-y-1">
                            <label class="form-label-tw">Nama <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                            <input type="text" class="input-field" id="nama" name="nama" placeholder="Masukkan nama Anda" value="{{ old('nama') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="form-label-tw">Kontak / Email <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                            <input type="text" class="input-field" id="kontak" name="kontak" placeholder="Untuk update status laporan" value="{{ old('kontak') }}">
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100 flex items-start space-x-3">
                        <span class="material-icons text-blue-500 text-sm mt-0.5">info</span>
                        <p class="text-[11px] text-blue-700 leading-normal italic">
                            Identitas Anda aman &bull; Kontak hanya digunakan untuk koordinasi tindak lanjut investigasi.
                        </p>
                    </div>
                </div>

                {{-- 2. Data Pengaduan --}}
                <div class="section-card">
                    <div class="flex items-center space-x-2 mb-4 border-b border-slate-100 pb-3">
                        <span class="material-icons text-primary text-xl">event_note</span>
                        <h3 class="font-bold text-slate-900">2. Data Pengaduan</h3>
                    </div>

                    <div class="space-y-4">
                        {{-- Ringkasan --}}
                        <div class="space-y-1">
                            <label class="form-label-tw">Judul Pengaduan <span class="text-red-500">*</span> </label>
                            <input type="text" class="input-field resize-none" id="ringkasan" name="ringkasan" maxlength="250" placeholder="Tuliskan judul pengaduan" value="{{ old('ringkasan') }}">
                        </div>

                        {{-- Uraian Lengkap --}}
                        <div class="space-y-1">
                            <label class="form-label-tw">Uraian Lengkap <span class="text-red-500">*</span> <span class="font-normal normal-case text-slate-400">(Jelaskan kronologi, siapa, kapan, bagaimana)</span></label>
                            <textarea class="input-field resize-none" id="uraian_lengkap" name="uraian_lengkap" rows="6" placeholder="Tuliskan detail kejadian secara lengkap, termasuk kronologi, pelaku yang terlibat, cara kejadian berlangsung, dan informasi lain yang relevan...">{{ old('uraian_lengkap') }}</textarea>
                        </div>

                        {{-- Waktu & Jumlah Pihak --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="form-label-tw">Tanggal Kejadian <span class="text-red-500">*</span></label>
                                <input type="date" class="input-field" id="waktu_kejadian" name="waktu_kejadian" value="{{ old('waktu_kejadian') }}">
                            </div>
                            <div class="space-y-1">
                                <label class="form-label-tw">Apakah melibatkan lebih dari satu orang?</label>
                                <div class="flex flex-wrap gap-4 mt-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="jumlah_pihak" value="ya" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="jumlah_pihak" value="tidak" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Tidak</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="jumlah_pihak" value="tidak_tahu" checked class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Tidak Tahu</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="form-label-tw">Lokasi Kejadian <span class="text-red-500">*</span></label>
                                <select class="input-field-select" id="lokasi" name="lokasi">
                                    <option value="" selected disabled>Pilih Provinsi...</option>
                                    <option value="aceh">Aceh</option>
                                    <option value="sumut">Sumatera Utara</option>
                                    <option value="sumbar">Sumatera Barat</option>
                                    <option value="riau">Riau</option>
                                    <option value="jambi">Jambi</option>
                                    <option value="sumsel">Sumatera Selatan</option>
                                    <option value="bengkulu">Bengkulu</option>
                                    <option value="lampung">Lampung</option>
                                    <option value="babel">Bangka Belitung</option>
                                    <option value="kepri">Kepulauan Riau</option>
                                    <option value="dki">DKI Jakarta</option>
                                    <option value="jabar">Jawa Barat</option>
                                    <option value="jateng">Jawa Tengah</option>
                                    <option value="diy">DI Yogyakarta</option>
                                    <option value="jatim">Jawa Timur</option>
                                    <option value="banten">Banten</option>
                                    <option value="bali">Bali</option>
                                    <option value="ntb">Nusa Tenggara Barat</option>
                                    <option value="ntt">Nusa Tenggara Timur</option>
                                    <option value="kalbar">Kalimantan Barat</option>
                                    <option value="kalteng">Kalimantan Tengah</option>
                                    <option value="kalsel">Kalimantan Selatan</option>
                                    <option value="kaltim">Kalimantan Timur</option>
                                    <option value="kaltara">Kalimantan Utara</option>
                                    <option value="sulut">Sulawesi Utara</option>
                                    <option value="sulteng">Sulawesi Tengah</option>
                                    <option value="sulsel">Sulawesi Selatan</option>
                                    <option value="sultra">Sulawesi Tenggara</option>
                                    <option value="gorontalo">Gorontalo</option>
                                    <option value="sulbar">Sulawesi Barat</option>
                                    <option value="maluku">Maluku</option>
                                    <option value="malut">Maluku Utara</option>
                                    <option value="papuabarat">Papua Barat</option>
                                    <option value="papua">Papua</option>
                                    {{-- <option value="" selected disabled>Pilih Lokasi...</option>
                                    @forelse($lokasi as $item)
                                        <option value="{{ $item['Id'] ?? '' }}" @selected(old('lokasi') == ($item['Id'] ?? ''))>
                                            {{ $item['Value'] ?? $item['Description'] ?? '' }}
                                        </option>
                                    @empty
                                        <option value="" disabled>Data lokasi tidak tersedia</option>
                                    @endforelse --}}
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="form-label-tw">Detail Lokasi <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                <input type="text" class="input-field" id="detail_lokasi" name="detail_lokasi" placeholder="Alamat / detail lokasi" value="{{ old('detail_lokasi') }}">
                            </div>
                        </div>

                        {{-- Nama & Instansi Terlapor --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="form-label-tw">Nama Terlapor <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                <input type="text" class="input-field" id="nama_terlapor" name="nama_terlapor" placeholder="Nama individu terlapor" value="{{ old('nama_terlapor') }}">
                            </div>
                            <div class="space-y-1">
                                <label class="form-label-tw">Instansi Terlapor <span class="text-red-500">*</span></label>
                                <input type="text" class="input-field" id="instansi_terlapor" name="instansi_terlapor" placeholder="Nama instansi/lembaga terlapor" value="{{ old('instansi_terlapor') }}">
                            </div>
                            <div class="space-y-1">
                                <label class="form-label-tw">Jabatan Terlapor <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                <input type="text" class="input-field" id="jabatan_terlapor" name="jabatan_terlapor" placeholder="Jabatan terlapor" value="{{ old('jabatan_terlapor') }}">
                            </div>
                        </div>

                        {{-- Media Sosial Terlapor (Collapsible) --}}
                        <div>
                            <button type="button" class="flex items-center text-sm text-slate-600 hover:text-primary transition-colors" onclick="document.getElementById('sosmedFields').classList.toggle('hidden'); this.querySelector('.material-icons').textContent = this.querySelector('.material-icons').textContent === 'expand_more' ? 'expand_less' : 'expand_more';">
                                <span class="material-icons text-[18px] mr-1">expand_more</span>
                                <span class="font-medium">Tambahkan informasi media sosial terlapor</span>
                                <span class="ml-2 text-[11px] text-slate-400">(Opsional)</span>
                            </button>
                            <div id="sosmedFields" class="hidden mt-3 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <label class="form-label-tw mb-3">Media Sosial Terlapor <span class="font-normal normal-case text-slate-400">(untuk membantu identifikasi)</span></label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 bg-white border border-r-0 border-slate-200 rounded-l-lg">
                                            <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                        </span>
                                        <input type="text" class="input-field !rounded-l-none !bg-white" id="sosmed_instagram" name="sosmed_instagram" placeholder="@username" value="{{ old('sosmed_instagram') }}">
                                    </div>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 bg-white border border-r-0 border-slate-200 rounded-l-lg">
                                            <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                        </span>
                                        <input type="text" class="input-field !rounded-l-none !bg-white" id="sosmed_facebook" name="sosmed_facebook" placeholder="Nama profil / URL" value="{{ old('sosmed_facebook') }}">
                                    </div>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 bg-white border border-r-0 border-slate-200 rounded-l-lg">
                                            <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                        </span>
                                        <input type="text" class="input-field !rounded-l-none !bg-white" id="sosmed_x" name="sosmed_x" placeholder="@username" value="{{ old('sosmed_x') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pernah Dilaporkan --}}
                        <div>
                            <label class="form-label-tw">Pernah Dilaporkan Sebelumnya?</label>
                            <div class="flex flex-wrap gap-4 mt-1">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="pernah_dilaporkan" value="ya" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                    <span class="ml-2 text-sm text-slate-600">Ya</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="pernah_dilaporkan" value="tidak" checked class="rounded-full text-primary focus:ring-primary border-slate-300">
                                    <span class="ml-2 text-sm text-slate-600">Tidak</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="pernah_dilaporkan" value="tidak_tahu" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                    <span class="ml-2 text-sm text-slate-600">Tidak Tahu</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. Objek Dugaan Korupsi --}}
                <div class="section-card">
                    <div class="flex items-center space-x-2 mb-4 border-b border-slate-100 pb-3">
                        <span class="material-icons text-primary text-xl">policy</span>
                        <h3 class="font-bold text-slate-900">3. Objek Dugaan Korupsi</h3>
                    </div>

                    <div class="space-y-4">
                        {{-- Jenis Dugaan (Select2 Multiple) --}}
                        <div>
                            <label class="form-label-tw">Jenis Dugaan <span class="text-red-500">*</span></label>
                            <select class="w-full" id="jenisDugaan" name="jenis_dugaan[]" multiple="multiple">
                                <option value="suap">Suap</option>
                                <option value="gratifikasi" data-tooltip="Pemberian hadiah terkait jabatan">Gratifikasi</option>
                                <option value="mark-up" data-tooltip="Menaikkan harga/nilai proyek">Mark-up</option>
                                <option value="sunset-fee" data-tooltip="Imbalan setelah proyek selesai">Sunset Fee</option>
                                <option value="konflik-interest" data-tooltip="Kepentingan pribadi dalam keputusan jabatan">Conflict of Interest</option>
                                <option value="penggelapan">Penggelapan</option>
                                <option value="penyalahgunaan-wewenang">Penyalahgunaan Wewenang</option>
                                <option value="pencucian-uang">Pencucian Uang</option>
                                <option value="pemerasan">Pemerasan</option>
                                <option value="nepotisme" data-tooltip="Mengutamakan keluarga/kerabat dalam jabatan">Nepotisme</option>
                                {{-- @forelse($jenisDugaan as $dugaan)
                                    <option value="{{ $dugaan['Id'] ?? '' }}"
                                        @if(!empty($dugaan['Description'] ?? '')) data-tooltip="{{ $dugaan['Description'] ?? '' }}" @endif
                                        @if(is_array(old('jenis_dugaan')) && in_array($dugaan['Id'] ?? '', old('jenis_dugaan'))) selected @endif>
                                        {{ $dugaan['Value'] ?? $dugaan['Description'] ?? '' }}
                                    </option>
                                @empty
                                    <option value="" disabled>Data jenis dugaan tidak tersedia</option>
                                @endforelse --}}
                            </select>
                            <div class="mt-2 text-[11px] text-slate-500 bg-blue-50 p-2 rounded border border-blue-100">
                                <span class="font-semibold">💡 Penjelasan singkat:</span>
                                <span class="font-medium text-blue-700">Gratifikasi</span> = Hadiah terkait jabatan,
                                <span class="font-medium text-blue-700">Mark-up</span> = Menaikkan harga proyek,
                                <span class="font-medium text-blue-700">Sunset Fee</span> = Imbalan setelah proyek selesai,
                                <span class="font-medium text-blue-700">Conflict of Interest</span> = Kepentingan pribadi dalam keputusan,
                                <span class="font-medium text-blue-700">Nepotisme</span> = Mengutamakan keluarga/kerabat
                            </div>
                        </div>

                        {{-- Anggaran & Sumber Dana --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="form-label-tw">Terkait Anggaran?</label>
                                <div class="flex gap-4 mt-1">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="terkait_anggaran" value="ya" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="terkait_anggaran" value="tidak" checked class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Tidak</span>
                                    </label>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label-tw">Sumber Dana</label>
                                <div class="flex flex-wrap gap-4 mt-1">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="sumber_dana" value="apbn" checked class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">APBN</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="sumber_dana" value="bumn_bumd" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">BUMN/BUMD</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="sumber_dana" value="lainnya" class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Lainnya</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Anggaran --}}
                        <div id="anggaranFields" style="display:none;">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="form-label-tw">Proyek / Kegiatan <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                    <input type="text" class="input-field" id="proyek" name="proyek" placeholder="Nama proyek / kegiatan" value="{{ old('proyek') }}">
                                </div>
                                <div class="space-y-1">
                                    <label class="form-label-tw">Bendahara / Pengelola <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                    <input type="text" class="input-field" id="nama_trejer" name="nama_trejer" placeholder="Nama pengelola anggaran" value="{{ old('nama_trejer') }}">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div class="space-y-1">
                                    <label class="form-label-tw">Anggaran / Nilai <span class="font-normal normal-case text-slate-400">(Estimasi)</span></label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 bg-slate-100 border border-r-0 border-slate-200 rounded-l-lg text-sm font-medium text-slate-500">IDR</span>
                                        <input type="text" class="input-field !rounded-l-none" id="anggaran" name="anggaran" placeholder="0" value="{{ old('anggaran') }}">
                                    </div>
                                </div>
                                <div class="space-y-1" id="sumberLainnyaField" style="display:none;">
                                    <label class="form-label-tw">Sumber Dana Lainnya</label>
                                    <input type="text" class="input-field" id="sumber_dana_lainnya" name="sumber_dana_lainnya" placeholder="Sebutkan sumber dana" value="{{ old('sumber_dana_lainnya') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4. Bukti Pendukung --}}
                <div class="section-card">
                    <div class="flex items-center space-x-2 mb-4 border-b border-slate-100 pb-3">
                        <span class="material-icons text-primary text-xl">cloud_upload</span>
                        <h3 class="font-bold text-slate-900">4. Bukti Pendukung</h3>
                    </div>

                    <div class="mb-3 p-3 bg-green-50 rounded-lg border border-green-200 flex items-start space-x-2">
                        <span class="material-icons text-green-600 text-[18px] mt-0.5">check_circle</span>
                        <p class="text-[12px] text-green-700">
                            <strong>Jika tidak memiliki bukti, Anda tetap dapat mengirim laporan.</strong> Bukti pendukung akan memperkuat investigasi, namun tidak wajib.
                        </p>
                    </div>

                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-primary transition-colors group cursor-pointer" id="uploadArea">
                        <span class="material-icons text-3xl text-slate-300 group-hover:text-primary mb-2">upload_file</span>
                        <p class="text-sm font-medium text-slate-600">Klik untuk unggah atau seret file ke sini</p>
                        <p class="text-[11px] text-slate-400 mt-1">PDF, JPG, PNG, MP4, M4A, DOC, XLS (Maks. 10MB per file)</p>
                        <input type="file" class="hidden" id="fileInput" name="bukti[]" multiple accept=".pdf,.jpg,.jpeg,.png,.mp4,.m4a,.doc,.docx,.xls,.xlsx">
                    </div>

                    <div id="fileList" class="mt-3 space-y-2"></div>
                </div>

                {{-- Submit --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-2 pt-6 border-t border-slate-200">
                    <div class="flex items-start space-x-2">
                        <input type="checkbox" class="rounded text-primary focus:ring-primary border-slate-300 mt-0.5" id="terms">
                        <label class="text-xs text-slate-500" for="terms">
                            Saya menyatakan bahwa informasi ini benar dan dapat dipertanggungjawabkan. 
                            <a href="#" onclick="event.preventDefault(); showProtectionPolicy();" class="text-primary hover:underline font-medium">Baca kebijakan perlindungan pelapor</a>
                        </label>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" class="px-6 py-2.5 border border-slate-300 text-slate-600 rounded-lg font-medium text-sm hover:bg-slate-50 transition-colors" onclick="document.getElementById('formPengaduan').reset();">
                            Batal
                        </button>
                        <button type="submit" class="px-10 py-2.5 bg-primary hover:bg-primary/90 text-white rounded-lg font-bold text-sm flex items-center justify-center shadow-lg shadow-primary/25 transition-all">
                            Kirim
                            <span class="material-icons ml-2 text-[18px]">send</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- ==================== SIDEBAR (1/3) ==================== --}}
        <div class="lg:w-1/3 space-y-4">

            {{-- Perlindungan Hukum --}}
            <div class="p-5 bg-white border border-emerald-100 rounded-xl shadow-sm">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="bg-emerald-100 p-2 rounded-lg">
                        <span class="material-icons text-emerald-600">verified</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Perlindungan Hukum</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-3">
                    Identitas Anda dilindungi oleh <strong>UU No. 31/1999</strong> tentang Pemberantasan Tindak Pidana Korupsi dan program perlindungan saksi LPSK.
                </p>
                <div class="flex items-center text-[11px] font-bold text-emerald-600 uppercase">
                    <span class="material-icons text-[14px] mr-1">check_circle</span>
                    Whistleblower Protection Active
                </div>
            </div>

            {{-- Keamanan Data --}}
            <div class="p-5 bg-white border border-blue-100 rounded-xl shadow-sm">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <span class="material-symbols-outlined text-blue-600">shield_lock</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Keamanan Data</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Data dikirimkan melalui jalur aman SSL/TLS dan dienkripsi sebelum disimpan di server yang terisolasi dan terlindungi.
                </p>
            </div>

            {{-- Butuh Bantuan --}}
            <div class="p-5 bg-slate-900 text-white rounded-xl shadow-sm overflow-hidden relative">
                <div class="relative z-10">
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-2">Butuh Bantuan?</h4>
                    <p class="text-xs text-slate-400 mb-4 leading-relaxed">Konsultasi anonim melalui hotline kami jika Anda ragu untuk melapor.</p>
                    <div class="flex items-center space-x-2">
                        <span class="material-icons text-sm">phone</span>
                        <span class="text-sm font-bold">1-800-TIP-IKOR</span>
                    </div>
                </div>
                <span class="material-icons absolute -bottom-4 -right-4 text-7xl text-white/5 rotate-12">support_agent</span>
            </div>

            {{-- Dokumen yang diperlukan --}}
            <div class="p-4 border border-slate-200 rounded-xl bg-white">
                <h5 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Dokumen yang diperlukan:</h5>
                <ul class="space-y-2">
                    <li class="flex items-start space-x-2">
                        <span class="material-icons text-primary text-[14px] mt-0.5">check</span>
                        <span class="text-[11px] text-slate-500">Kwitansi / Bukti Transfer</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="material-icons text-primary text-[14px] mt-0.5">check</span>
                        <span class="text-[11px] text-slate-500">Rekaman Suara / Video (Jika ada)</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="material-icons text-primary text-[14px] mt-0.5">check</span>
                        <span class="text-[11px] text-slate-500">Surat Keputusan / Dokumen Dinas</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="material-icons text-primary text-[14px] mt-0.5">check</span>
                        <span class="text-[11px] text-slate-500">Foto / Tangkapan Layar terkait</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="material-icons text-primary text-[14px] mt-0.5">check</span>
                        <span class="text-[11px] text-slate-500">Dokumen Kontrak / Perjanjian</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    // Character counter for ringkasan
    const ringkasan = document.getElementById('ringkasan');
    const charCount = document.getElementById('charCount');
    ringkasan.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });

    // Toggle identitas fields berdasarkan jenis identitas
    document.querySelectorAll('input[name="jenis_identitas"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const identitasFields = document.getElementById('identitasFields');
            const namaInput = document.getElementById('nama');
            const kontakInput = document.getElementById('kontak');
            
            if (this.value === 'anonim') {
                identitasFields.style.display = 'none';
                namaInput.removeAttribute('required');
                kontakInput.removeAttribute('required');
            } else {
                identitasFields.style.display = 'grid';
                if (this.value === 'terbuka') {
                    namaInput.setAttribute('required', 'required');
                    kontakInput.setAttribute('required', 'required');
                }
            }
        });
    });

    // Set initial state - hide fields if anonim is checked
    document.addEventListener('DOMContentLoaded', function() {
        const anonimRadio = document.querySelector('input[name="jenis_identitas"][value="anonim"]');
        if (anonimRadio && anonimRadio.checked) {
            document.getElementById('identitasFields').style.display = 'none';
        }
    });

    // Toggle anggaran fields
    document.querySelectorAll('input[name="terkait_anggaran"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.getElementById('anggaranFields').style.display = this.value === 'ya' ? 'block' : 'none';
        });
    });

    // Toggle sumber dana lainnya
    document.querySelectorAll('input[name="sumber_dana"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.getElementById('sumberLainnyaField').style.display = this.value === 'lainnya' ? 'block' : 'none';
        });
    });

    // Modal untuk kebijakan perlindungan
    function showProtectionPolicy() {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-xl max-w-2xl w-full max-h-[80vh] overflow-y-auto shadow-2xl">
                <div class="sticky top-0 bg-white border-b border-slate-200 p-6 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-900">Kebijakan Perlindungan Pelapor</h3>
                    <button onclick="this.closest('.fixed').remove()" class="text-slate-400 hover:text-slate-600">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="p-6 space-y-4 text-sm text-slate-600 leading-relaxed">
                    <div>
                        <h4 class="font-bold text-slate-900 mb-2">🛡️ Perlindungan Hukum</h4>
                        <p>Identitas Anda dilindungi berdasarkan <strong>UU No. 31 Tahun 1999</strong> tentang Pemberantasan Tindak Pidana Korupsi dan program perlindungan saksi dan pelapor (whistleblower) dari Lembaga Perlindungan Saksi dan Korban (LPSK).</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-2">🔒 Kerahasiaan Data</h4>
                        <p>Semua data yang Anda kirimkan dienkripsi menggunakan teknologi SSL/TLS dan disimpan dalam server yang aman dan terisolasi. Akses data hanya diberikan kepada tim investigator yang berwenang.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-2">✅ Hak Pelapor</h4>
                        <ul class="list-disc list-inside space-y-1 ml-2">
                            <li>Mendapat perlindungan hukum dari ancaman, kekerasan, atau intimidasi</li>
                            <li>Kerahasiaan identitas dijamin jika memilih anonim atau rahasia</li>
                            <li>Mendapat update status investigasi (jika memberikan kontak)</li>
                            <li>Bebas dari tuntutan hukum atas laporan yang dibuat dengan itikad baik</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-2">⚠️ Tanggung Jawab Pelapor</h4>
                        <p>Laporan yang dibuat harus berdasarkan fakta dan dapat dipertanggungjawabkan. Laporan palsu atau fitnah dapat dikenakan sanksi hukum sesuai peraturan yang berlaku.</p>
                    </div>
                    <div class="bg-primary/5 p-4 rounded-lg border border-primary/20">
                        <p class="text-primary font-medium">Dengan mengirim laporan, Anda menyetujui bahwa informasi yang diberikan adalah benar dan dapat digunakan untuk keperluan investigasi sesuai dengan ketentuan hukum yang berlaku.</p>
                    </div>
                </div>
                <div class="sticky bottom-0 bg-slate-50 p-4 border-t border-slate-200">
                    <button onclick="this.closest('.fixed').remove()" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3 rounded-lg transition-colors">
                        Saya Mengerti
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.remove();
        });
    }

    // File upload
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    uploadArea.addEventListener('click', function() { fileInput.click(); });
    uploadArea.addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('border-primary'); });
    uploadArea.addEventListener('dragleave', function(e) { e.preventDefault(); this.classList.remove('border-primary'); });
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-primary');
        handleFiles(e.dataTransfer.files);
    });
    fileInput.addEventListener('change', function() { handleFiles(this.files); });

    function handleFiles(files) {
        for (let file of files) {
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            const sizeLabel = sizeMB > 1 ? sizeMB + ' MB' : (file.size / 1024).toFixed(0) + ' KB';
            let icon = 'description';
            if (file.type.includes('pdf')) icon = 'picture_as_pdf';
            else if (file.type.includes('image')) icon = 'image';
            else if (file.type.includes('audio')) icon = 'audio_file';
            else if (file.type.includes('video')) icon = 'video_file';

            const idx = fileList.children.length;
            const item = document.createElement('div');
            item.className = 'bg-slate-50 border border-slate-200 rounded-lg p-3';
            item.innerHTML = `
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2 min-w-0">
                        <span class="material-icons text-primary text-[20px] flex-shrink-0">${icon}</span>
                        <span class="text-sm font-medium text-slate-700 truncate">${file.name}</span>
                        <span class="text-[11px] text-slate-400 flex-shrink-0">${sizeLabel}</span>
                    </div>
                    <button type="button" class="text-red-400 hover:text-red-600 transition-colors flex-shrink-0 ml-2" onclick="this.closest('.bg-slate-50').remove()">
                        <span class="material-icons text-[18px]">close</span>
                    </button>
                </div>
                <input type="text" name="deskripsi_bukti[${idx}]" class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-md text-xs text-slate-600 outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all" placeholder="Jelaskan isi/maksud file ini, contoh: Bukti transfer dana proyek...">
            `;
            fileList.appendChild(item);
        }
    }

    // Number formatting for anggaran
    document.getElementById('anggaran').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        this.value = value ? new Intl.NumberFormat('id-ID').format(value) : '';
    });

    // Select2 for Jenis Dugaan
    $(document).ready(function() {
        $('#jenisDugaan').select2({
            placeholder: 'Pilih jenis dugaan korupsi...',
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });
    });

    // AJAX Form Submit
    $('#formPengaduan').on('submit', function(e) {
        e.preventDefault();

        // Clear previous messages
        $('#ajaxAlert').remove();
        $('.input-error').removeClass('input-error');
        $('.field-error').remove();

        const $form = $(this);
        const $submitBtn = $form.find('button[type="submit"]');
        const originalBtnHtml = $submitBtn.html();

        // Disable button & show loading
        $submitBtn.prop('disabled', true).html(
            '<svg class="animate-spin h-5 w-5 mr-2 inline" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>Mengirim...'
        );

        // Build FormData (supports file uploads)
        const formData = new FormData(this);

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            success: function(response) {
                // Show success message
                showAlert('success', response.message || 'Pengaduan berhasil dikirim.');

                // Reset form
                $form[0].reset();
                $('#jenisDugaan').val(null).trigger('change');
                $('#fileList').empty();
                $('#identitasFields').hide();
                $('#anggaranFields').hide();
                $('#sosmedFields').addClass('hidden');

                // Scroll to top
                $('html, body').animate({ scrollTop: $form.offset().top - 100 }, 400);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON?.errors || {};
                    let errorMessages = [];
                    $.each(errors, function(field, messages) {
                        errorMessages = errorMessages.concat(messages);
                        // Highlight field
                        const $field = $('[name="' + field + '"], [name="' + field + '[]"]');
                        $field.addClass('input-error');
                        $field.closest('.space-y-1, div').find('.field-error').remove();
                        $field.after('<p class="field-error text-xs text-red-500 mt-1">' + messages[0] + '</p>');
                    });
                    showAlert('validation', errorMessages);
                } else {
                    const msg = xhr.responseJSON?.message || 'Terjadi kesalahan. Silakan coba lagi.';
                    showAlert('error', msg);
                }
                $('html, body').animate({ scrollTop: $form.offset().top - 100 }, 400);
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html(originalBtnHtml);
            }
        });
    });

    function showAlert(type, message) {
        $('#ajaxAlert').remove();

        let html = '';
        if (type === 'success') {
            html = `
                <div id="ajaxAlert" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start space-x-3">
                    <span class="material-icons text-green-600 mt-0.5">check_circle</span>
                    <div>
                        <p class="text-sm font-semibold text-green-800">Berhasil!</p>
                        <p class="text-sm text-green-700">${message}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-600">
                        <span class="material-icons text-[18px]">close</span>
                    </button>
                </div>`;
        } else if (type === 'validation') {
            const items = Array.isArray(message) ? message.map(m => `<li>${m}</li>`).join('') : `<li>${message}</li>`;
            html = `
                <div id="ajaxAlert" class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-start justify-between">
                        <p class="text-sm font-semibold text-red-800 mb-2">Mohon perbaiki kesalahan berikut:</p>
                        <button type="button" onclick="this.closest('#ajaxAlert').remove()" class="text-red-400 hover:text-red-600">
                            <span class="material-icons text-[18px]">close</span>
                        </button>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">${items}</ul>
                </div>`;
        } else {
            html = `
                <div id="ajaxAlert" class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start space-x-3">
                    <span class="material-icons text-red-600 mt-0.5">error</span>
                    <div>
                        <p class="text-sm font-semibold text-red-800">Gagal!</p>
                        <p class="text-sm text-red-700">${message}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600">
                        <span class="material-icons text-[18px]">close</span>
                    </button>
                </div>`;
        }

        $(html).insertBefore('#formPengaduan');
    }
</script>
@endsection
