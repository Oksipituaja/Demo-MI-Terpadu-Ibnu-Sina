<div class="min-h-screen bg-white">

    {{-- Hero --}}
    <div class="relative bg-linear-to-br from-red-700 via-red-600 to-orange-600 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-300 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-red-300 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="relative max-w-6xl mx-auto px-6 py-14 md:py-20">
            <div class="flex items-center gap-2 text-red-200 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-white font-medium">Peraturan Sekolah</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-3">Peraturan Sekolah</h1>
            <p class="text-red-100 text-base md:text-lg max-w-xl">
                Tata tertib dan peraturan yang berlaku di <span class="font-semibold text-yellow-300">SD Bangsri</span>
                untuk menciptakan lingkungan belajar yang tertib, aman, dan kondusif.
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-14 space-y-14">

        {{-- Intro --}}
        <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-center bg-red-50 border border-red-100 rounded-2xl p-6">
            <div class="shrink-0 w-14 h-14 bg-red-600 rounded-xl flex items-center justify-center shadow">
                <i class="fas fa-gavel text-white text-xl"></i>
            </div>
            <div>
                <span class="text-xs font-bold tracking-widest uppercase text-red-500 block mb-1">Tata Tertib Sekolah</span>
                <h2 class="text-xl font-bold text-gray-900 mb-1">Peraturan SD Bangsri</h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Peraturan ini berlaku bagi seluruh warga sekolah. Kepatuhan terhadap tata tertib merupakan
                    wujud tanggung jawab dan kedisiplinan sebagai bagian dari <span class="font-semibold text-red-700">Profil Pelajar Pancasila</span>.
                </p>
            </div>
        </div>

        {{-- Grid Peraturan --}}
        @php
            $sections = [
                [
                    'icon'    => 'fa-clock',
                    'color'   => 'blue',
                    'judul'   => 'Kehadiran & Waktu',
                    'subtitle'=> 'Ketepatan waktu dan kehadiran',
                    'items'   => [
                        'Siswa wajib hadir di sekolah paling lambat pukul 07.00 WIB.',
                        'Siswa yang terlambat lebih dari 15 menit wajib melapor ke guru piket.',
                        'Ketidakhadiran harus disertai surat keterangan dari orang tua/wali atau dokter.',
                        'Izin tidak masuk sekolah paling banyak 3 hari berturut-turut tanpa surat keterangan dokter.',
                        'Siswa wajib mengikuti kegiatan belajar mengajar hingga jam pelajaran berakhir.',
                    ],
                ],
                [
                    'icon'    => 'fa-tshirt',
                    'color'   => 'indigo',
                    'judul'   => 'Pakaian & Penampilan',
                    'subtitle'=> 'Seragam dan kerapian',
                    'items'   => [
                        'Senin–Selasa: seragam putih-merah lengkap dengan atribut sekolah.',
                        'Rabu–Kamis: seragam batik identitas sekolah.',
                        'Jumat: seragam pramuka atau pakaian olahraga sesuai jadwal.',
                        'Pakaian harus bersih, rapi, dan dimasukkan ke dalam celana/rok.',
                        'Siswa tidak diperkenankan memakai aksesori berlebihan atau perhiasan mewah.',
                        'Rambut siswa putra harus pendek, rapi, dan tidak diwarnai.',
                    ],
                ],
                [
                    'icon'    => 'fa-users',
                    'color'   => 'green',
                    'judul'   => 'Perilaku & Etika',
                    'subtitle'=> 'Sikap dan tata krama',
                    'items'   => [
                        'Siswa wajib bersikap sopan dan santun kepada guru, staf, dan sesama siswa.',
                        'Dilarang menggunakan kata-kata kasar, menghina, atau melakukan bullying.',
                        'Siswa wajib menjaga kebersihan kelas dan lingkungan sekolah.',
                        'Dilarang membawa dan mengonsumsi makanan/minuman yang tidak sehat di lingkungan sekolah.',
                        'Siswa wajib menjaga fasilitas dan inventaris sekolah dengan baik.',
                        'Dilarang membawa benda berbahaya, senjata tajam, atau bahan terlarang.',
                    ],
                ],
                [
                    'icon'    => 'fa-mobile-alt',
                    'color'   => 'amber',
                    'judul'   => 'Penggunaan Perangkat',
                    'subtitle'=> 'HP, gadget, dan elektronik',
                    'items'   => [
                        'Siswa dilarang membawa dan menggunakan HP/gadget selama jam pelajaran.',
                        'Perangkat elektronik hanya diperbolehkan digunakan jika diminta oleh guru untuk keperluan pembelajaran.',
                        'Sekolah tidak bertanggung jawab atas kehilangan atau kerusakan perangkat pribadi.',
                        'Pelanggaran penggunaan HP akan dikenai sanksi berupa penyitaan sementara.',
                    ],
                ],
                [
                    'icon'    => 'fa-book-open',
                    'color'   => 'purple',
                    'judul'   => 'Akademik & Tugas',
                    'subtitle'=> 'Kewajiban belajar',
                    'items'   => [
                        'Siswa wajib mengerjakan dan mengumpulkan tugas tepat waktu.',
                        'Dilarang melakukan tindakan tidak jujur seperti menyontek atau plagiarisme.',
                        'Siswa wajib membawa perlengkapan belajar sesuai jadwal pelajaran.',
                        'Siswa wajib mengikuti ujian dan penilaian yang telah dijadwalkan.',
                        'Siswa yang tidak mengikuti ujian tanpa alasan yang sah dinyatakan tidak lulus ujian tersebut.',
                    ],
                ],
                [
                    'icon'    => 'fa-exclamation-triangle',
                    'color'   => 'red',
                    'judul'   => 'Sanksi & Konsekuensi',
                    'subtitle'=> 'Tindakan atas pelanggaran',
                    'items'   => [
                        'Pelanggaran ringan: teguran lisan dan pencatatan dalam buku pelanggaran.',
                        'Pelanggaran sedang: pemanggilan orang tua/wali dan pemberian tugas tambahan.',
                        'Pelanggaran berat: skorsing sementara dan pemberitahuan resmi kepada orang tua.',
                        'Pelanggaran sangat berat (kekerasan fisik, narkoba): dikeluarkan dari sekolah.',
                        'Setiap kerusakan fasilitas akibat kelalaian wajib diganti oleh siswa/orang tua.',
                    ],
                ],
            ];

            $colorMap = [
                'blue'   => ['bg' => 'bg-blue-600',   'border' => 'border-blue-100',   'badge' => 'bg-blue-50 text-blue-700',   'dot' => 'bg-blue-500'],
                'indigo' => ['bg' => 'bg-indigo-600', 'border' => 'border-indigo-100', 'badge' => 'bg-indigo-50 text-indigo-700', 'dot' => 'bg-indigo-500'],
                'green'  => ['bg' => 'bg-green-600',  'border' => 'border-green-100',  'badge' => 'bg-green-50 text-green-700',  'dot' => 'bg-green-500'],
                'amber'  => ['bg' => 'bg-amber-500',  'border' => 'border-amber-100',  'badge' => 'bg-amber-50 text-amber-700',  'dot' => 'bg-amber-500'],
                'purple' => ['bg' => 'bg-purple-600', 'border' => 'border-purple-100', 'badge' => 'bg-purple-50 text-purple-700', 'dot' => 'bg-purple-500'],
                'red'    => ['bg' => 'bg-red-600',    'border' => 'border-red-100',    'badge' => 'bg-red-50 text-red-700',    'dot' => 'bg-red-500'],
            ];
        @endphp

        <div>
            <div class="text-center mb-10">
                <span class="text-xs font-bold tracking-widest uppercase text-red-500 mb-2 block">Tata Tertib</span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Ketentuan yang Berlaku</h2>
                <div class="w-12 h-1 bg-yellow-400 mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                @foreach($sections as $section)
                    @php $c = $colorMap[$section['color']]; @endphp
                    <div class="bg-white rounded-2xl border {{ $c['border'] }} shadow-sm overflow-hidden">
                        <div class="{{ $c['bg'] }} px-6 py-4 flex items-center gap-3">
                            <i class="fas {{ $section['icon'] }} text-white text-sm"></i>
                            <div>
                                <h3 class="text-white font-bold text-sm">{{ $section['judul'] }}</h3>
                                <p class="text-white/70 text-xs">{{ $section['subtitle'] }}</p>
                            </div>
                        </div>
                        <div class="px-6 py-5">
                            <ul class="space-y-3">
                                @foreach($section['items'] as $item)
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full {{ $c['dot'] }} shrink-0"></span>
                                        <span class="text-gray-700 text-sm leading-relaxed">{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Banner Penutup --}}
        <div class="bg-linear-to-br from-red-600 to-orange-600 rounded-2xl p-7 flex flex-col sm:flex-row gap-5 items-start">
            <div class="shrink-0 w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-heart text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-white font-bold text-base mb-1.5">Disiplin adalah Kunci Kesuksesan</h3>
                <p class="text-red-100 text-sm leading-relaxed">
                    Peraturan sekolah bukan sekadar kewajiban, melainkan sarana membentuk karakter siswa yang
                    <span class="font-semibold text-yellow-300">bertanggung jawab, disiplin, dan berintegritas</span>.
                    Dengan mematuhi tata tertib, kita bersama menciptakan lingkungan belajar yang nyaman dan kondusif
                    bagi seluruh warga sekolah.
                </p>
            </div>
        </div>

    </div>
</div>