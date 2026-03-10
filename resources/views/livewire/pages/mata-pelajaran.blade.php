<div class="min-h-screen bg-white">

    {{-- Hero --}}
    <div class="relative bg-linear-to-br from-blue-700 via-blue-600 to-indigo-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-300 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-300 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="relative max-w-6xl mx-auto px-6 py-14 md:py-20">
            <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-white font-medium">Mata Pelajaran</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-3">Mata Pelajaran</h1>
            <p class="text-blue-100 text-base md:text-lg max-w-xl">
                Kurikulum Merdeka dengan pendekatan <span class="font-semibold text-yellow-300 italic">Deep Learning</span>
                untuk generasi unggul berkarakter.
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-14 space-y-14">

        {{-- Kurikulum --}}
        <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-center bg-blue-50 border border-blue-100 rounded-2xl p-6">
            <div class="shrink-0 w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center shadow">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>
            <div>
                <span class="text-xs font-bold tracking-widest uppercase text-blue-500 block mb-1">Kurikulum yang Digunakan</span>
                <h2 class="text-xl font-bold text-gray-900 mb-1">Kurikulum Merdeka</h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    SD Bangsri menerapkan <span class="font-semibold text-blue-700">Kurikulum Merdeka</span> dengan pendekatan
                    <span class="font-semibold text-indigo-700 italic">Deep Learning</span> — mendorong siswa berpikir kritis,
                    kreatif, dan kolaboratif.
                </p>
            </div>
        </div>

        {{-- Daftar Mapel --}}
        <div>
            <div class="text-center mb-10">
                <span class="text-xs font-bold tracking-widest uppercase text-blue-500 mb-2 block">Daftar Mata Pelajaran</span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Mata Pelajaran di SD Bangsri</h2>
                <div class="w-12 h-1 bg-yellow-400 mx-auto mt-3 rounded-full"></div>
            </div>

            {{-- Mapel Wajib --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-5">
                <div class="bg-blue-600 px-6 py-4 flex items-center gap-3">
                    <i class="fas fa-book text-white text-sm"></i>
                    <div>
                        <h3 class="text-white font-bold text-sm">Mata Pelajaran Wajib</h3>
                        <p class="text-blue-100 text-xs">Semua jenjang kelas</p>
                    </div>
                </div>
                @php
                    $mapelWajib = [
                        'Pendidikan Agama dan Budi Pekerti',
                        'Pendidikan Pancasila',
                        'Bahasa Indonesia',
                        'Matematika',
                        'IPAS',
                        'PJOK',
                        'Seni Budaya dan Prakarya',
                        'Muatan Lokal',
                    ];
                @endphp
                <div class="px-6 py-1">
                    @foreach($mapelWajib as $i => $nama)
                        <div class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <span class="text-blue-600 font-bold text-xs w-5 shrink-0 tabular-nums">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="w-px h-3.5 bg-gray-200 shrink-0"></span>
                            <span class="text-gray-800 text-sm font-medium">{{ $nama }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-2.5 bg-gray-50 border-t border-gray-100">
                    <p class="text-xs text-gray-400">Total <span class="font-semibold text-gray-600">{{ count($mapelWajib) }}</span> mata pelajaran wajib</p>
                </div>
            </div>

            {{-- Mapel Pilihan + P5 --}}
            <div class="grid md:grid-cols-2 gap-5">

                {{-- Mapel Pilihan --}}
                <div class="bg-white rounded-2xl border border-indigo-200 shadow-sm overflow-hidden">
                    <div class="bg-indigo-600 px-6 py-4 flex items-center gap-3">
                        <i class="fas fa-star text-white text-sm"></i>
                        <div>
                            <h3 class="text-white font-bold text-sm">Mata Pelajaran Pilihan</h3>
                            <p class="text-indigo-100 text-xs">Pengembangan kompetensi abad 21</p>
                        </div>
                    </div>
                    <div class="px-6 py-5">
                        <div class="flex items-center gap-4 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-code text-white text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 text-sm">Koding & Kecerdasan Artifisial</p>
                                <p class="text-xs text-gray-500 mt-0.5">Pemrograman dasar & pengenalan AI</p>
                            </div>
                            <span class="px-2.5 py-1 bg-indigo-600 text-white text-xs font-bold rounded-full shrink-0">Baru</span>
                        </div>
                    </div>
                </div>

                {{-- P5 --}}
                <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden">
                    <div class="bg-amber-500 px-6 py-4 flex items-center gap-3">
                        <i class="fas fa-leaf text-white text-sm"></i>
                        <div>
                            <h3 class="text-white font-bold text-sm">Projek P5</h3>
                            <p class="text-amber-100 text-xs">Penguatan Profil Pelajar Pancasila</p>
                        </div>
                    </div>
                    <div class="px-6 py-5">
                        <p class="text-sm text-gray-600 leading-relaxed mb-4">
                            Kegiatan berbasis projek untuk membentuk karakter siswa sesuai nilai-nilai Pancasila melalui
                            pengalaman nyata di lingkungan sekolah dan masyarakat.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Beriman & Bertakwa', 'Berkebinekaan Global', 'Bergotong Royong', 'Kreatif', 'Bernalar Kritis', 'Mandiri'] as $profil)
                                <span class="px-2.5 py-1 bg-amber-50 text-amber-800 text-xs font-medium rounded-full border border-amber-200">{{ $profil }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kegiatan Pembelajaran --}}
        <div>
            <div class="text-center mb-10">
                <span class="text-xs font-bold tracking-widest uppercase text-blue-500 mb-2 block">Proses Belajar</span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Kegiatan Pembelajaran</h2>
                <div class="w-12 h-1 bg-yellow-400 mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-5 mb-6">
                @php
                    $alur = [
                        [
                            'step'    => '01',
                            'icon'    => 'fa-play-circle',
                            'judul'   => 'Pendahuluan',
                            'desc'    => 'Guru membuka pembelajaran dengan apersepsi, motivasi, dan penyampaian tujuan belajar untuk mempersiapkan siswa.',
                            'bar'     => 'bg-blue-600',
                            'iconbg'  => 'bg-blue-600',
                            'border'  => 'border-blue-100',
                            'numcol'  => 'text-blue-400',
                        ],
                        [
                            'step'    => '02',
                            'icon'    => 'fa-brain',
                            'judul'   => 'Kegiatan Inti',
                            'desc'    => 'Siswa terlibat aktif melalui eksplorasi, diskusi, eksperimen, dan kolaborasi dengan pendekatan Deep Learning.',
                            'bar'     => 'bg-indigo-600',
                            'iconbg'  => 'bg-indigo-600',
                            'border'  => 'border-indigo-100',
                            'numcol'  => 'text-indigo-400',
                        ],
                        [
                            'step'    => '03',
                            'icon'    => 'fa-check-circle',
                            'judul'   => 'Penutup & Refleksi',
                            'desc'    => 'Pembelajaran diakhiri dengan refleksi bersama, penguatan materi, dan penilaian formatif untuk mengukur pemahaman siswa.',
                            'bar'     => 'bg-green-600',
                            'iconbg'  => 'bg-green-600',
                            'border'  => 'border-green-100',
                            'numcol'  => 'text-green-400',
                        ],
                    ];
                @endphp
                @foreach($alur as $item)
                    <div class="bg-white rounded-2xl border {{ $item['border'] }} shadow-sm overflow-hidden">
                        <div class="h-1 {{ $item['bar'] }}"></div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-10 h-10 {{ $item['iconbg'] }} rounded-xl flex items-center justify-center">
                                    <i class="fas {{ $item['icon'] }} text-white text-sm"></i>
                                </div>
                                <span class="text-2xl font-black {{ $item['numcol'] }} opacity-60">{{ $item['step'] }}</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-2">{{ $item['judul'] }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Banner --}}
            <div class="bg-blue-600 rounded-2xl p-7 flex flex-col sm:flex-row gap-5 items-start">
                <div class="shrink-0 w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-base mb-1.5">Pembelajaran Aktif & Berpusat pada Siswa</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">
                        Kegiatan pembelajaran Kurikulum Merdeka dilaksanakan dengan melibatkan siswa secara aktif.
                        Selain pembelajaran di kelas, sekolah juga melaksanakan
                        <span class="font-semibold text-yellow-300">Projek Penguatan Profil Pelajar Pancasila (P5)</span>
                        untuk membentuk karakter siswa melalui pengalaman belajar yang bermakna dan kontekstual.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>