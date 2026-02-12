@extends('layouts.app')

@section('title', 'Buat Pengaduan - TIPIDKOR')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- ==================== MAIN FORM (2/3) ==================== --}}
        <div class="flex-grow lg:w-2/3">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Formulir Pengaduan Tindak Pidana Korupsi</h2>
                <p class="text-slate-500 text-sm">Mohon isi informasi di bawah ini dengan lengkap dan jujur. Kerahasiaan Anda terjamin.</p>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data" id="formPengaduan">
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
                            <input type="text" class="input-field" id="nama" name="nama" placeholder="Kosongkan jika ingin anonim">
                        </div>
                        <div class="space-y-1">
                            <label class="form-label-tw">Kontak / Email <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                            <input type="text" class="input-field" id="kontak" name="kontak" placeholder="Untuk update status laporan">
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
                            <label class="form-label-tw">Ringkasan Pengaduan <span class="text-red-500">*</span> <span class="font-normal normal-case text-slate-400">(maks. 150 karakter)</span></label>
                            <textarea class="input-field resize-none" id="ringkasan" name="ringkasan" rows="2" maxlength="150" placeholder="Jelaskan secara singkat dugaan tindak pidana korupsi..."></textarea>
                            <div class="text-right text-[10px] text-slate-400"><span id="charCount">0</span> / 150</div>
                        </div>

                        {{-- Waktu & Jumlah Pihak --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="form-label-tw">Tanggal Kejadian <span class="text-red-500">*</span></label>
                                <input type="date" class="input-field" id="waktu_kejadian" name="waktu_kejadian">
                            </div>
                            <div class="space-y-1">
                                <label class="form-label-tw">Jumlah Pihak Terlibat</label>
                                <select class="input-field-select" id="jumlah_pihak" name="jumlah_pihak">
                                    <option value="" selected disabled>Pilih jumlah...</option>
                                    <option value="1">1 orang</option>
                                    <option value="2-5">2-5 orang</option>
                                    <option value="6-10">6-10 orang</option>
                                    <option value=">10">Lebih dari 10 orang</option>
                                    <option value="tidak_tahu">Tidak tahu</option>
                                </select>
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
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="form-label-tw">Detail Lokasi <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                <input type="text" class="input-field" id="detail_lokasi" name="detail_lokasi" placeholder="Alamat / detail lokasi">
                            </div>
                        </div>

                        {{-- Instansi & Jabatan --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="form-label-tw">Instansi / Nama Terlapor <span class="text-red-500">*</span></label>
                                <input type="text" class="input-field" id="instansi" name="instansi" placeholder="Nama instansi / individu">
                            </div>
                            <div class="space-y-1">
                                <label class="form-label-tw">Jabatan Terlapor <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                <input type="text" class="input-field" id="jabatan_terlapor" name="jabatan_terlapor" placeholder="Jabatan terlapor">
                            </div>
                        </div>

                        {{-- Media Sosial Terlapor --}}
                        <div>
                            <label class="form-label-tw">Media Sosial Terlapor <span class="font-normal normal-case text-slate-400">(Opsional — untuk membantu identifikasi)</span></label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-1">
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 bg-slate-100 border border-r-0 border-slate-200 rounded-l-lg">
                                        <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </span>
                                    <input type="text" class="input-field !rounded-l-none" id="sosmed_instagram" name="sosmed_instagram" placeholder="@username">
                                </div>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 bg-slate-100 border border-r-0 border-slate-200 rounded-l-lg">
                                        <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </span>
                                    <input type="text" class="input-field !rounded-l-none" id="sosmed_facebook" name="sosmed_facebook" placeholder="Nama profil / URL">
                                </div>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 bg-slate-100 border border-r-0 border-slate-200 rounded-l-lg">
                                        <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </span>
                                    <input type="text" class="input-field !rounded-l-none" id="sosmed_x" name="sosmed_x" placeholder="@username">
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
                                <option value="gratifikasi">Gratifikasi</option>
                                <option value="mark-up">Mark-up</option>
                                <option value="sunset-fee">Sunset Fee</option>
                                <option value="konflik-interest">Conflict of Interest</option>
                                <option value="penggelapan">Penggelapan</option>
                                <option value="penyalahgunaan-wewenang">Penyalahgunaan Wewenang</option>
                                <option value="pencucian-uang">Pencucian Uang</option>
                                <option value="pemerasan">Pemerasan</option>
                                <option value="nepotisme">Nepotisme</option>
                            </select>
                        </div>

                        {{-- Anggaran & Sumber Dana --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="form-label-tw">Terkait Anggaran?</label>
                                <div class="flex gap-4 mt-1">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="terkait_anggaran" value="ya" checked class="rounded-full text-primary focus:ring-primary border-slate-300">
                                        <span class="ml-2 text-sm text-slate-600">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="terkait_anggaran" value="tidak" class="rounded-full text-primary focus:ring-primary border-slate-300">
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
                        <div id="anggaranFields">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="form-label-tw">Proyek / Kegiatan <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                    <input type="text" class="input-field" id="proyek" name="proyek" placeholder="Nama proyek / kegiatan">
                                </div>
                                <div class="space-y-1">
                                    <label class="form-label-tw">Bendahara / Pengelola <span class="font-normal normal-case text-slate-400">(Opsional)</span></label>
                                    <input type="text" class="input-field" id="nama_trejer" name="nama_trejer" placeholder="Nama pengelola anggaran">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div class="space-y-1">
                                    <label class="form-label-tw">Anggaran / Nilai <span class="font-normal normal-case text-slate-400">(Estimasi)</span></label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 bg-slate-100 border border-r-0 border-slate-200 rounded-l-lg text-sm font-medium text-slate-500">IDR</span>
                                        <input type="text" class="input-field !rounded-l-none" id="anggaran" name="anggaran" placeholder="0">
                                    </div>
                                </div>
                                <div class="space-y-1" id="sumberLainnyaField" style="display:none;">
                                    <label class="form-label-tw">Sumber Dana Lainnya</label>
                                    <input type="text" class="input-field" id="sumber_dana_lainnya" name="sumber_dana_lainnya" placeholder="Sebutkan sumber dana">
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
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-primary focus:ring-primary border-slate-300" id="terms">
                        <label class="text-xs text-slate-500" for="terms">Saya menyatakan bahwa informasi ini benar dan dapat dipertanggungjawabkan.</label>
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
</script>
@endsection
