<div class="min-h-screen" style="background: #F0F4ED">
    <div class="relative overflow-hidden" style="background: linear-gradient(to bottom right, #15803d, #166534, #14532d)">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 rounded-full w-96 h-96 blur-3xl" style="background: #EAB308"></div>
            <div class="absolute bottom-0 left-0 -translate-x-1/2 translate-y-1/2 rounded-full w-72 h-72 blur-3xl" style="background: #86efac"></div>
        </div>
        <div class="relative max-w-6xl px-6 mx-auto py-14 md:py-20">
            <div class="flex items-center gap-2 mb-4 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Beranda</a>
                <i class="text-xs fas fa-chevron-right"></i>
                <span class="font-medium text-white">Mata Pelajaran</span>
            </div>
            <h1 class="mb-3 text-3xl font-bold text-white md:text-5xl">Mata Pelajaran</h1>
            <p class="max-w-xl text-base md:text-lg" style="color: #bbf7d0">
                Kurikulum terintegrasi antara <span class="font-semibold" style="color: #EAB308">Pendidikan Nasional</span>
                dan <span class="font-semibold" style="color: #EAB308">Kementerian Agama</span> untuk generasi muslim yang unggul.
            </p>
        </div>
    </div>

    <div class="max-w-6xl px-6 mx-auto py-14 space-y-14">

        <div class="flex flex-col items-start gap-5 p-6 border sm:flex-row sm:items-center rounded-2xl"
            style="background: #dcfce7; border-color: #15803d26">
            <div class="flex items-center justify-center shadow w-14 h-14 rounded-xl shrink-0"
                style="background: #15803d; box-shadow: 0 4px 12px #15803d33">
                <i class="text-xl text-white fas fa-graduation-cap"></i>
            </div>
            <div>
                <span class="block mb-1 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Kurikulum yang Digunakan</span>
                <h2 class="mb-1 text-xl font-bold" style="color: #14532d">Kurikulum Terintegrasi</h2>
                <p class="text-sm leading-relaxed text-gray-600">
                    MI Terpadu Ibnu Sina menerapkan <span class="font-semibold" style="color: #15803d">Kurikulum Pendidikan Nasional</span>
                    yang dipadukan dengan <span class="font-semibold" style="color: #15803d">Kurikulum Kementerian Agama</span>
                    dan <span class="font-semibold text-indigo-700">Muatan Lokal</span> —
                    membentuk generasi yang berilmu, beriman, dan berkarya.
                </p>
            </div>
        </div>

        <div>
            <div class="mb-10 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Daftar Mata Pelajaran</span>
                <h2 class="text-2xl font-bold md:text-3xl" style="color: #14532d">Mata Pelajaran MI Terpadu Ibnu Sina</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308"></div>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div class="overflow-hidden bg-white border shadow-sm rounded-2xl" style="border-color: #15803d26">
                    <div class="flex items-center gap-3 px-6 py-4" style="background: #15803d">
                        <i class="text-sm text-white fas fa-flag"></i>
                        <div>
                            <h3 class="text-sm font-bold text-white">Kurikulum Pendidikan Nasional</h3>
                            <p class="text-xs" style="color: #bbf7d0">Mata pelajaran umum semua jenjang</p>
                        </div>
                    </div>
                    @php
                        $mapelNasional = [
                            'Pendidikan Pancasila & Kewarganegaraan',
                            'Bahasa Indonesia',
                            'Matematika',
                            'Ilmu Pengetahuan Alam & Sosial (IPAS)',
                            'Pendidikan Jasmani & Olahraga (PJOK)',
                            'Seni Budaya dan Prakarya',
                        ];
                    @endphp
                    <div class="px-6 py-1">
                        @foreach($mapelNasional as $i => $nama)
                            <div class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                <span class="w-5 text-xs font-bold tabular-nums shrink-0" style="color: #15803d">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="w-px bg-gray-200 h-3.5 shrink-0"></span>
                                <span class="text-sm font-medium text-gray-800">{{ $nama }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="px-6 border-t border-gray-100 py-2.5" style="background: #F0F4ED">
                        <p class="text-xs text-gray-400">Total <span class="font-semibold text-gray-600">{{ count($mapelNasional) }}</span> mata pelajaran</p>
                    </div>
                </div>

                <div class="overflow-hidden bg-white border shadow-sm rounded-2xl" style="border-color: #15803d26">
                    <div class="flex items-center gap-3 px-6 py-4" style="background: #166534">
                        <i class="text-sm text-white fas fa-mosque"></i>
                        <div>
                            <h3 class="text-sm font-bold text-white">Kurikulum Kementerian Agama</h3>
                            <p class="text-xs" style="color: #bbf7d0">Pendidikan Islam terpadu</p>
                        </div>
                    </div>
                    @php
                        $mapelAgama = [
                            'Al-Qur\'an Hadits',
                            'Aqidah Akhlaq',
                            'Fiqih',
                            'Sejarah Kebudayaan Islam (SKI)',
                            'Bahasa Arab',
                        ];
                    @endphp
                    <div class="px-6 py-1">
                        @foreach($mapelAgama as $i => $nama)
                            <div class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                <span class="w-5 text-xs font-bold tabular-nums shrink-0" style="color: #15803d">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="w-px bg-gray-200 h-3.5 shrink-0"></span>
                                <span class="text-sm font-medium text-gray-800">{{ $nama }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="px-6 border-t border-gray-100 py-2.5" style="background: #F0F4ED">
                        <p class="text-xs text-gray-400">Total <span class="font-semibold text-gray-600">{{ count($mapelAgama) }}</span> mata pelajaran</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-5 mt-5 md:grid-cols-2">
                <div class="overflow-hidden bg-white border shadow-sm border-amber-200 rounded-2xl">
                    <div class="flex items-center gap-3 px-6 py-4 bg-amber-500">
                        <i class="text-sm text-white fas fa-map-marker-alt"></i>
                        <div>
                            <h3 class="text-sm font-bold text-white">Muatan Lokal</h3>
                            <p class="text-xs text-amber-100">Kearifan lokal & bahasa internasional</p>
                        </div>
                    </div>
                    <div class="px-6 py-5 space-y-3">
                        @foreach(['Bahasa Jawa', 'Bahasa Inggris'] as $i => $nama)
                            <div class="flex items-center gap-4 p-3 border rounded-xl bg-amber-50 border-amber-100">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-500 shrink-0">
                                    <i class="text-xs text-white fas {{ $i === 0 ? 'fa-language' : 'fa-globe' }}"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-800">{{ $nama }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="overflow-hidden bg-white border border-indigo-200 shadow-sm rounded-2xl">
                    <div class="flex items-center gap-3 px-6 py-4 bg-indigo-600">
                        <i class="text-sm text-white fas fa-book-open"></i>
                        <div>
                            <h3 class="text-sm font-bold text-white">Pembelajaran Al-Qur'an</h3>
                            <p class="text-xs text-indigo-100">Target 3 Juz hafalan</p>
                        </div>
                    </div>
                    <div class="px-6 py-5 space-y-3">
                        <div class="flex items-start gap-4 p-3 border border-indigo-100 rounded-xl bg-indigo-50">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600 shrink-0 mt-0.5">
                                <i class="text-xs text-white fas fa-spell-check"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Baca Tulis & Tahsin</p>
                                <p class="text-xs text-gray-500 mt-0.5">Menggunakan <span class="font-semibold text-indigo-700">Metode UMMI</span></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-3 border border-indigo-100 rounded-xl bg-indigo-50">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600 shrink-0 mt-0.5">
                                <i class="text-xs text-white fas fa-star"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Hafalan Al-Qur'an (Tahfidz)</p>
                                <p class="text-xs text-gray-500 mt-0.5">Metode <span class="font-semibold text-indigo-700">Al Qosimi</span> & Tastmur — target <span class="font-bold text-green-600">3 Juz</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="mb-10 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Yang Membedakan Kami</span>
                <h2 class="text-2xl font-bold md:text-3xl" style="color: #14532d">Keunggulan Madrasah</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308"></div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $keunggulan = [
                        ['icon' => 'fa-heart',      'color' => 'bg-red-500',    'label' => 'Pembinaan Akhlak',      'desc' => 'Penanaman nilai-nilai karakter islami sejak dini dalam setiap kegiatan belajar.'],
                        ['icon' => 'fa-pray',       'color' => 'bg-green-600',  'label' => 'Praktik Ibadah Harian', 'desc' => 'Dzikir harian, Sholat Dhuha, dan Sholat berjamaah sebagai pembiasaan rutin.'],
                        ['icon' => 'fa-piggy-bank', 'color' => 'bg-amber-500',  'label' => 'Pendidikan Finansial',  'desc' => 'Melatih kebiasaan infaq dan menabung untuk membentuk jiwa sosial siswa.'],
                        ['icon' => 'fa-comments',   'color' => 'bg-blue-600',   'label' => 'Komunikasi Orang Tua',  'desc' => 'Buku Komunikasi interaktif antara orang tua dan wali kelas.'],
                        ['icon' => 'fa-quran',      'color' => 'bg-indigo-600', 'label' => 'Target Tahfidz 3 Juz',  'desc' => 'Program hafalan Al-Qur\'an terstruktur menggunakan Metode Al Qosimi.'],
                        ['icon' => 'fa-sun',        'color' => 'bg-orange-500', 'label' => 'Full Day School',       'desc' => 'Konsep sekolah sehari penuh dengan keseimbangan akademik dan pembentukan karakter.'],
                    ];
                @endphp
                @foreach($keunggulan as $item)
                    <div class="flex items-start gap-4 p-5 bg-white border shadow-sm rounded-2xl" style="border-color: #15803d1a">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl {{ $item['color'] }} shrink-0">
                            <i class="text-sm text-white fas {{ $item['icon'] }}"></i>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-bold" style="color: #14532d">{{ $item['label'] }}</p>
                            <p class="text-xs leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <div class="mb-10 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Kegiatan Tambahan</span>
                <h2 class="text-2xl font-bold md:text-3xl" style="color: #14532d">Program Unggulan & Ekstrakurikuler</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308"></div>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div class="overflow-hidden bg-white border shadow-sm rounded-2xl" style="border-color: #15803d26">
                    <div class="flex items-center gap-3 px-6 py-4" style="background: #15803d">
                        <i class="text-sm text-white fas fa-star"></i>
                        <div>
                            <h3 class="text-sm font-bold text-white">Program Penunjang</h3>
                            <p class="text-xs" style="color: #bbf7d0">Kegiatan pembentukan karakter</p>
                        </div>
                    </div>
                    @php
                        $programPenunjang = [
                            ['icon' => 'fa-moon',          'nama' => 'MABIT',             'desc' => 'Malam Bina Iman dan Taqwa'],
                            ['icon' => 'fa-route',         'nama' => 'Around Field Trip', 'desc' => 'Kunjungan edukatif & wisata belajar'],
                            ['icon' => 'fa-swimming-pool', 'nama' => 'Berenang',          'desc' => 'Olahraga air & ketangkasan'],
                            ['icon' => 'fa-horse',         'nama' => 'Latihan Berkurban', 'desc' => 'Pendidikan ibadah qurban'],
                            ['icon' => 'fa-scroll',        'nama' => 'Wisuda Tahfidz',    'desc' => 'Perayaan capaian hafalan Al-Qur\'an'],
                            ['icon' => 'fa-flask',         'nama' => 'Kelas SAINS',       'desc' => 'Pembelajaran sains eksperimental'],
                        ];
                    @endphp
                    <div class="px-6 py-1">
                        @foreach($programPenunjang as $prog)
                            <div class="flex items-center gap-4 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg shrink-0" style="background: #dcfce7">
                                    <i class="text-xs fas {{ $prog['icon'] }}" style="color: #15803d"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold" style="color: #14532d">{{ $prog['nama'] }}</p>
                                    <p class="text-xs text-gray-400">{{ $prog['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="overflow-hidden bg-white border border-green-200 shadow-sm rounded-2xl">
                    <div class="flex items-center gap-3 px-6 py-4 bg-green-600">
                        <i class="text-sm text-white fas fa-trophy"></i>
                        <div>
                            <h3 class="text-sm font-bold text-white">Pengembangan Diri</h3>
                            <p class="text-xs text-green-100">Ekstrakurikuler</p>
                        </div>
                    </div>
                    <div class="px-6 py-5 space-y-3">
                        <div class="flex items-center gap-4 p-4 border border-green-100 rounded-xl bg-green-50">
                            <div class="flex items-center justify-center w-10 h-10 bg-green-600 rounded-xl shrink-0">
                                <i class="text-sm text-white fas fa-campground"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Kepramukaan</p>
                                <p class="text-xs text-gray-500 mt-0.5">Membentuk karakter disiplin, mandiri, dan gotong royong</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 border border-green-100 rounded-xl bg-green-50">
                            <div class="flex items-center justify-center w-10 h-10 bg-green-600 rounded-xl shrink-0">
                                <i class="text-sm text-white fas fa-fist-raised"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Bela Diri (Silat)</p>
                                <p class="text-xs text-gray-500 mt-0.5">Seni bela diri tradisional untuk fisik dan mental</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 pb-5">
                        <div class="p-4 border border-indigo-100 rounded-xl bg-indigo-50">
                            <div class="flex items-start gap-3">
                                <i class="mt-1 text-sm text-indigo-400 fas fa-quote-left shrink-0"></i>
                                <p class="text-xs italic leading-relaxed text-gray-600">
                                    "Mendidik itu seperti menanam pohon. Kami suburkan dengan cinta, doa, dan teladan.
                                    Setiap anak terlahir unik, maka kami menangani mereka dengan cara yang berbeda agar tumbuh menjadi warna-warni dunia."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col items-start gap-5 p-7 sm:flex-row rounded-2xl" style="background: #15803d">
            <div class="flex items-center justify-center rounded-xl w-11 h-11 shrink-0" style="background: rgba(255,255,255,0.2)">
                <i class="text-lg text-white fas fa-users"></i>
            </div>
            <div class="flex-1">
                <h3 class="mb-1.5 text-base font-bold text-white">Tertarik Mendaftarkan Putra/Putri Anda?</h3>
                <p class="text-sm leading-relaxed" style="color: #bbf7d0">
                    MI Terpadu Ibnu Sina membuka pendaftaran peserta didik baru setiap tahun ajaran.
                    Jadikan anak Anda bagian dari generasi muslim yang berilmu, berkarya, dan berakhlaqul karimah.
                </p>
            </div>
            <a href="{{ route('ppdb') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 font-bold text-sm rounded-xl transition-all shrink-0 hover:-translate-y-0.5"
               style="background: #EAB308; color: #14532d;">
                <i class="fas fa-graduation-cap"></i> Daftar Sekarang
            </a>
        </div>

    </div>
</div>