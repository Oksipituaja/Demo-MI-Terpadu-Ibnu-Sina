<div>
    <section class="relative pt-12 pb-20 bg-linear-to-br from-blue-50/50 via-white to-yellow-50/20 overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 left-20 w-72 h-72 bg-blue-600 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-yellow-300 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 animate-fade-in">
                    <div class="inline-block px-4 py-2 bg-blue-700/10 rounded-full">
                        <span class="text-blue-700 font-semibold text-sm">🏆 Akreditasi A</span>
                    </div>
                    <h1 class="font-display text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Membentuk Generasi
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-700 to-blue-500">Unggul &
                            Berkarakter</span>
                    </h1>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        {{ config('app.name') }} berkomitmen memberikan pendidikan berkualitas dengan fasilitas modern
                        dan tenaga pendidik profesional untuk mengembangkan potensi anak Indonesia.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('ppdb') }}" class="btn-primary">
                            Daftar Sekarang
                            <span class="ml-2">→</span>
                        </a>
                        <a href="{{ route('about') }}" class="btn-secondary">
                            Pelajari Lebih Lanjut
                            <span class="ml-2">→</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-700">450+</div>
                            <div class="text-sm text-gray-600 mt-1">Siswa Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-700">35+</div>
                            <div class="text-sm text-gray-600 mt-1">Guru Profesional</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-700">25+</div>
                            <div class="text-sm text-gray-600 mt-1">Tahun Berpengalaman</div>
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center justify-center p-4">
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-linear-to-tr from-blue-500/10 to-yellow-500/10 rounded-full blur-3xl">
                    </div>

                    <div class="relative w-full max-w-lg">
                        <div
                            class="relative overflow-hidden rounded-4xl shadow-2xl group transition-transform duration-500 hover:scale-[1.02]">
                            @if ($heroImage && $heroImage->image)
                                <img src="{{ asset('storage/' . $heroImage->image) }}" alt="{{ config('app.name') }}"
                                    class="w-full h-auto object-cover aspect-4/5 md:aspect-square"
                                    onerror="this.style.display='none'; document.getElementById('fallback-hero').classList.remove('hidden')">
                            @else
                                <img src="{{ asset('hero_image.png') }}"
                                    class="w-full h-auto object-cover aspect-4/5 md:aspect-square">
                            @endif

                            <div class="absolute inset-0 bg-linear-to-t from-blue-900/20 to-transparent"></div>
                        </div>

                        <div
                            class="absolute -bottom-4 -right-4 md:-right-8 bg-white/90 backdrop-blur-sm p-4 rounded-2xl shadow-2xl border border-slate-100 flex items-center space-x-4 animate-bounce-slow">
                            <div
                                class="shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-lg shadow-green-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-gray-500 font-bold">Status Resmi</p>
                                <p class="font-bold text-gray-900 text-lg leading-tight">Terakreditasi A</p>
                            </div>
                        </div>

                        <div
                            class="absolute -top-4 -left-4 bg-yellow-400 text-blue-900 font-bold py-2 px-4 rounded-lg shadow-lg rotate-[-5deg]">
                            Unggul & Berkarakter
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sambutan" class="py-24 bg-slate-50 relative overflow-hidden">
        <div
            class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            @if ($principalGreeting && !empty($principalGreeting->title))
                <div class="max-w-6xl mx-auto">
                    <div class="grid lg:grid-cols-12 gap-16 items-center">

                        <div class="lg:col-span-5 flex justify-center order-1">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-4 border-2 border-dashed border-blue-200 rounded-4xl rotate-3 group-hover:rotate-0 transition-transform duration-500">
                                </div>

                                <div
                                    class="relative w-72 h-96 md:w-80 md:h-112.5 bg-slate-200 rounded-4xl overflow-hidden shadow-2xl border-8 border-white">
                                    @if (!empty($principalGreeting->image))
                                        <img src="{{ asset('storage/' . $principalGreeting->image) }}"
                                            alt="{{ $principalGreeting->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full bg-linear-to-br from-slate-100 to-slate-200 flex flex-col items-center justify-center">
                                            <i class="fas fa-user-tie text-7xl text-slate-300"></i>
                                            <p class="text-slate-400 text-xs mt-4 uppercase tracking-widest">Photo
                                                Placeholder</p>
                                        </div>
                                    @endif

                                    <div
                                        class="absolute bottom-0 inset-x-0 bg-linear-to-t from-blue-900/90 to-transparent p-6 pt-12">
                                        <p class="text-white font-bold text-xl mb-0">
                                            {{ $principalGreeting->principal_name ?? 'Kepala Sekolah' }}</p>
                                        <p class="text-blue-200 text-sm italic">Kepala Sekolah SD Bangsri</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-7 space-y-6 order-2">
                            <div>
                                <span
                                    class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-4">
                                    Message from Principal
                                </span>
                                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                                    {{ $principalGreeting->title }}
                                </h2>
                            </div>

                            <div class="relative">
                                <i class="fas fa-quote-left text-5xl text-blue-500/10 absolute -top-4 -left-6"></i>

                                <div class="text-slate-600 leading-relaxed text-lg italic relative z-10">
                                    "{!! Str::limit(strip_tags($principalGreeting->content), 450) !!}"
                                </div>
                            </div>

                            <div class="pt-4">
                                <a href="{{ route('about') }}"
                                    class="inline-flex items-center group px-8 py-4 bg-blue-600 text-white font-bold rounded-xl transition-all duration-300 shadow-[0_10px_20px_rgba(37,99,235,0.3)] hover:bg-blue-700 hover:-translate-y-1">
                                    Pelajari Lebih Lanjut
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="guru" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-700 font-semibold text-sm uppercase tracking-wider">Tim Kami</span>
                <h2 class="font-display text-4xl font-bold text-gray-900 mt-4 mb-6">Tenaga Pendidik & Pengajar</h2>
                <p class="text-gray-600 leading-relaxed">Guru berpengalaman dan berdedikasi tinggi siap membimbing
                    potensi siswa.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($teachers as $teacher)
                    <div class="teacher-card text-center">
                        <div
                            class="w-32 h-32 bg-linear-to-br from-blue-600 to-blue-400 rounded-full mx-auto mb-4 flex items-center justify-center text-5xl hover:scale-105 transition-transform duration-300 overflow-hidden">
                            @if ($teacher->image)
                                <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="text-white text-4xl">👨‍🏫</span>
                            @endif
                        </div>
                        <h3 class="font-display text-xl font-bold text-gray-900">{{ $teacher->name ?? 'Guru' }}</h3>
                        <p class="text-blue-700 font-semibold mb-2">{{ $teacher->subject ?? 'Pendidik' }}</p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500">Profil guru sedang dipersiapkan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="berita" class="py-20 bg-white border-t border-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center mb-12 flex-col md:flex-row gap-8">
                <div>
                    <span class="text-blue-700 font-semibold text-sm uppercase tracking-wider">Berita Terkini</span>
                    <h2 class="font-display text-4xl font-bold text-gray-900 mt-2">Berita & Pengumuman</h2>
                </div>
                <a href="{{ route('news') }}"
                    class="text-blue-700 hover:text-blue-800 font-semibold flex items-center transition-colors">
                    Lihat Semua <span class="ml-2">→</span>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($latestNews as $news)
                    <div
                        class="h-full rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 bg-white flex flex-col group border border-gray-100">
                        <div class="h-56 overflow-hidden relative">
                            @if ($news->featured_image)
                                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-blue-600 text-white text-4xl font-bold">
                                    {{ strtoupper(substr($news->title, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <span
                                class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full w-fit mb-4">
                                {{ $news->published_at?->format('d M Y') ?? 'Terbaru' }}
                            </span>
                            <h3
                                class="font-display text-base font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-blue-700 transition leading-tight">
                                {{ $news->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-6 flex-1 line-clamp-3 leading-relaxed">
                                {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 100) }}
                            </p>
                            <div class="border-t border-gray-100 mb-4"></div>
                            <a href="{{ route('news.detail', $news->slug) }}"
                                class="inline-flex items-center text-blue-600 font-semibold text-sm group/link">
                                Baca Selengkapnya <i
                                    class="fas fa-arrow-right ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500">Belum ada berita terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Prestasi Section -->
    <div class="py-20 bg-linear-to-b from-white to-blue-50">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-700 font-semibold text-sm uppercase tracking-wider">Pencapaian Sekolah</span>
                <h2 class="font-display text-4xl font-bold text-gray-900 mt-4 mb-6">Prestasi Siswa SMK Negeri 1 Bangsri terbaru di bawah ini</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @if($prestasis->isEmpty())
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada prestasi yang dipublikasikan</p>
                    </div>
                @else
                    @foreach($prestasis as $prestasi)
                        @php
                            $award = getAwardIcon($prestasi->category);
                        @endphp
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group border border-gray-200 h-full flex flex-col">
                            <!-- Badge Section -->
                            <div class="bg-linear-to-br from-gray-50 to-gray-100 px-6 py-8 flex items-center justify-center shrink-0">
                                <div class="w-24 h-24 bg-linear-to-br {{ $award['bgColor'] }} rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="{{ $award['icon'] }} text-white text-5xl"></i>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-6 flex flex-col flex-1">
                                <!-- Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug line-clamp-2">{{ $prestasi->title }}</h3>

                                <!-- Category -->
                                @if($prestasi->category)
                                    <div class="{{ $award['textColor'] }} font-semibold text-xs uppercase tracking-wide mb-3 line-clamp-1">
                                        {{ $prestasi->category }}
                                    </div>
                                @endif

                                <!-- Description -->
                                <p class="text-gray-600 text-sm leading-relaxed mb-3 flex-1 line-clamp-2">
                                    {{ $prestasi->description }}
                                </p>

                                <!-- Date -->
                                @if($prestasi->achievement_date)
                                    <div class="flex items-center text-gray-500 text-xs mb-4">
                                        <i class="fas fa-calendar mr-2"></i>
                                        {{ $prestasi->achievement_date->format('d M Y') }}
                                    </div>
                                @endif

                                <!-- Divider -->
                                <div class="border-t border-gray-200 mt-auto pt-3"></div>

                                <!-- Read More Link -->
                                <a href="{{ route('prestasi.detail', $prestasi->slug) }}" class="inline-block {{ $award['textColor'] }} hover:opacity-80 font-semibold text-sm group/link transition-colors mt-3">
                                    Read More <i class="fas fa-arrow-right ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            @if($prestasis->isNotEmpty())
                <div class="text-center">
                    <a href="{{ route('prestasi.index') }}" class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                        Lihat Semua Prestasi <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <section id="agenda" class="py-20 bg-linear-to-br from-blue-50 to-white">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center mb-12 flex-col md:flex-row gap-8">
                <div>
                    <span class="text-blue-700 font-semibold text-sm uppercase tracking-wider">Jadwal Kegiatan</span>
                    <h2 class="font-display text-4xl font-bold text-gray-900 mt-2">Agenda Kegiatan</h2>
                </div>
                <a href="{{ route('agenda') }}"
                    class="text-blue-700 hover:text-blue-800 font-semibold flex items-center transition-colors">
                    Lihat Semua <span class="ml-2">→</span>
                </a>
            </div>

            <div class="space-y-4">
                @forelse($agendas as $agenda)
                    <div
                        class="bg-white p-6 rounded-xl border-l-4 border-blue-600 shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-between items-start gap-4 flex-col sm:flex-row">
                            <div class="flex-1">
                                <h3 class="font-display text-lg font-bold text-gray-900 mb-2">{{ $agenda->title }}
                                </h3>
                                <p class="text-gray-600 mb-3">
                                    {{ Str::limit($agenda->description, 150) ?? 'Kegiatan penting di sekolah' }}</p>

                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                    <span class="flex items-center gap-2">
                                        <i class="fas fa-calendar text-blue-600"></i>
                                        {{ \Carbon\Carbon::parse($agenda->event_date)->format('d M Y') }}
                                    </span>

                                    {{-- PERBAIKAN: Menampilkan Jam dari database --}}
                                    @if ($agenda->event_time)
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-clock text-blue-600"></i>
                                            {{ \Carbon\Carbon::parse($agenda->event_time)->format('H:i') }} WIB
                                        </span>
                                    @endif

                                    @if ($agenda->location)
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-map-marker-alt text-red-500"></i>
                                            {{ $agenda->location }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- PERBAIKAN: Badge Status sesuai ENUM --}}
                            @php
                                $statusClasses = [
                                    'upcoming' => 'bg-blue-100 text-blue-800',
                                    'ongoing' => 'bg-yellow-100 text-yellow-800',
                                    'completed' => 'bg-gray-100 text-gray-800',
                                ];
                                $statusLabels = [
                                    'upcoming' => 'Mendatang',
                                    'ongoing' => 'Berlangsung',
                                    'completed' => 'Selesai',
                                ];
                            @endphp
                            <span
                                class="inline-block px-4 py-2 text-sm rounded-full font-bold whitespace-nowrap {{ $statusClasses[$agenda->status] ?? 'bg-gray-100' }}">
                                {{ $statusLabels[$agenda->status] ?? $agenda->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-xl text-center shadow-sm">
                        <p class="text-gray-500 font-medium">Tidak ada agenda aktif saat ini</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="galeri" class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto mb-16">
                <span class="text-blue-700 font-semibold text-sm uppercase tracking-wider">Galeri Sekolah</span>
                <h2 class="font-display text-4xl font-bold text-gray-900 mt-4 mb-6">Dokumentasi Aktivitas</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach ($galleries as $gallery)
                    <a href="{{ route('gallery.detail', $gallery->slug) }}"
                        class="group block relative overflow-hidden rounded-xl aspect-video bg-gray-100">
                        @if ($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @endif
                        <div
                            class="absolute inset-0 bg-linear-to-t from-black/70 via-transparent to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white font-bold text-lg text-left">{{ $gallery->title }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <a href="{{ route('gallery') }}" class="btn-primary">Lihat Semua Galeri</a>
        </div>
    </section>

    <section class="py-20 bg-linear-to-r from-blue-700 to-blue-600 text-white text-center relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="font-display text-4xl font-bold mb-6">Daftarkan Anak Anda Sekarang!</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
                Bergabunglah dengan {{ config('app.name') }} untuk masa depan anak Anda yang lebih cerah.
            </p>
            <a href="{{ route('ppdb') }}"
                class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-4 px-10 rounded-xl shadow-lg transition-transform hover:-translate-y-1">
                Daftar PPDB 2026/2027 →
            </a>
        </div>
    </section>
</div>
