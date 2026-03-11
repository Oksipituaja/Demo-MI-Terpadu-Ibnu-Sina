<div>
    <section class="relative pt-12 pb-20 overflow-hidden bg-linear-to-br from-blue-50/50 via-white to-yellow-50/20">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute bg-blue-600 rounded-full top-20 left-20 w-72 h-72 blur-3xl"></div>
            <div class="absolute bg-yellow-300 rounded-full bottom-20 right-20 w-96 h-96 blur-3xl"></div>
        </div>

        <div class="container relative z-10 px-6 mx-auto">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="space-y-6 animate-fade-in">
                    <div class="inline-block px-4 py-2 rounded-full bg-blue-700/10">
                        <span class="text-sm font-semibold text-blue-700">🏆 Akreditasi A</span>
                    </div>
                    <h1 class="text-5xl font-bold leading-tight text-gray-900 font-display lg:text-6xl">
                        Membentuk Generasi
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-700 to-blue-500">Unggul &
                            Berkarakter</span>
                    </h1>
                    <p class="text-lg leading-relaxed text-gray-600">
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
                            <div class="mt-1 text-sm text-gray-600">Siswa Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-700">35+</div>
                            <div class="mt-1 text-sm text-gray-600">Guru Profesional</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-700">25+</div>
                            <div class="mt-1 text-sm text-gray-600">Tahun Berpengalaman</div>
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center justify-center p-4">
                    <div
                        class="absolute w-full h-full -translate-x-1/2 -translate-y-1/2 rounded-full top-1/2 left-1/2 bg-linear-to-tr from-blue-500/10 to-yellow-500/10 blur-3xl">
                    </div>

                    <div class="relative w-full max-w-lg">
                        <div
                            class="relative overflow-hidden rounded-4xl shadow-2xl group transition-transform duration-500 hover:scale-[1.02]">
                            @if ($heroImage && $heroImage->image)
                                <img src="{{ asset('storage/' . $heroImage->image) }}" alt="{{ config('app.name') }}"
                                    class="object-cover w-full h-auto aspect-4/5 md:aspect-square"
                                    onerror="this.style.display='none'; document.getElementById('fallback-hero').classList.remove('hidden')">
                            @else
                                <img src="{{ asset('hero_image.png') }}"
                                    class="object-cover w-full h-auto aspect-4/5 md:aspect-square">
                            @endif

                            <div class="absolute inset-0 bg-linear-to-t from-blue-900/20 to-transparent"></div>
                        </div>

                        <div
                            class="absolute flex items-center p-4 space-x-4 border shadow-2xl -bottom-4 -right-4 md:-right-8 bg-white/90 backdrop-blur-sm rounded-2xl border-slate-100 animate-bounce-slow">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-full shadow-lg shrink-0 shadow-green-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-gray-500 font-bold">Status Resmi</p>
                                <p class="text-lg font-bold leading-tight text-gray-900">Terakreditasi B</p>
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

    {{-- ===== SAMBUTAN: hanya render jika konten tersedia ===== --}}
    @if ($principalGreeting?->title)
    <section id="sambutan" class="relative py-24 overflow-hidden bg-slate-50">
        <div
            class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 bg-blue-100 rounded-full opacity-50 w-96 h-96 blur-3xl">
        </div>

        <div class="container relative z-10 px-6 mx-auto">
            <div class="max-w-6xl mx-auto">
                <div class="grid items-center gap-16 lg:grid-cols-12">

                    <div class="flex justify-center order-1 lg:col-span-5">
                        <div class="relative group">
                            <div
                                class="absolute transition-transform duration-500 border-2 border-blue-200 border-dashed -inset-4 rounded-4xl rotate-3 group-hover:rotate-0">
                            </div>

                            <div
                                class="relative w-72 h-96 md:w-80 md:h-112.5 bg-slate-200 rounded-4xl overflow-hidden shadow-2xl border-8 border-white">
                                @if ($principalGreeting?->image)
                                    <img src="{{ asset('storage/' . $principalGreeting->image) }}"
                                        alt="{{ $principalGreeting->principal_name ?? 'Kepala Sekolah' }}"
                                        class="object-cover w-full h-full">
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center w-full h-full bg-linear-to-br from-slate-100 to-slate-200">
                                        <i class="fas fa-user-tie text-7xl text-slate-300"></i>
                                        <p class="mt-4 text-xs tracking-widest uppercase text-slate-400">Photo
                                            Placeholder</p>
                                    </div>
                                @endif

                                <div
                                    class="absolute inset-x-0 bottom-0 p-6 pt-12 bg-linear-to-t from-blue-900/90 to-transparent">
                                    <p class="mb-0 text-xl font-bold text-white">
                                        {{ $principalGreeting?->principal_name ?? 'Kepala Sekolah' }}</p>
                                    <p class="text-sm italic text-blue-200">Kepala Sekolah {{ config('app.name') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-2 space-y-6 lg:col-span-7">
                        <div>
                            <span
                                class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-4">
                                Sambutan Kepala Sekolah
                            </span>
                            <h2 class="text-3xl font-extrabold leading-tight md:text-5xl text-slate-900">
                                {{ $principalGreeting?->title }}
                            </h2>
                        </div>

                        <div class="relative">
                            <i class="absolute text-5xl fas fa-quote-left text-blue-500/10 -top-4 -left-6"></i>

                            <div class="relative z-10 text-lg italic leading-relaxed text-slate-600">
                                "{!! Str::limit(strip_tags($principalGreeting?->content ?? ''), 450) !!}"
                            </div>
                        </div>

                        <div class="pt-4">
                            <a href="{{ route('about') }}"
                                class="inline-flex items-center group px-8 py-4 bg-blue-600 text-white font-bold rounded-xl transition-all duration-300 shadow-[0_10px_20px_rgba(37,99,235,0.3)] hover:bg-blue-700 hover:-translate-y-1">
                                Pelajari Lebih Lanjut
                                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="guru" class="py-20 bg-white">
        <div class="container px-6 mx-auto">
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <span class="text-sm font-semibold tracking-wider text-blue-700 uppercase">Tim Kami</span>
                <h2 class="mt-4 mb-6 text-4xl font-bold text-gray-900 font-display">Tenaga Pendidik & Pengajar</h2>
                <p class="leading-relaxed text-gray-600">Guru berpengalaman dan berdedikasi tinggi siap membimbing
                    potensi siswa.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($teachers as $teacher)
                    <div class="text-center teacher-card">
                        <div
                            class="flex items-center justify-center w-32 h-32 mx-auto mb-4 overflow-hidden text-5xl transition-transform duration-300 rounded-full bg-linear-to-br from-blue-600 to-blue-400 hover:scale-105">
                            @if ($teacher->image)
                                <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->name }}"
                                    class="object-cover w-full h-full">
                            @else
                                <i class="text-5xl text-white fas fa-chalkboard-user"></i>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 font-display">{{ $teacher->name ?? 'Guru' }}</h3>
                        <p class="mb-2 font-semibold text-blue-700">{{ $teacher->subject ?? 'Pendidik' }}</p>
                    </div>
                @empty
                    <div class="py-10 text-center col-span-full">
                        <p class="text-gray-500">Profil guru sedang dipersiapkan</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-12 text-center">
                <a href="{{ route('teachers') }}"
                    class="inline-flex items-center px-8 py-3 font-semibold text-white transition-all duration-300 bg-blue-600 shadow-lg hover:bg-blue-700 rounded-xl hover:shadow-xl hover:-translate-y-1">
                    Lihat Semua Guru
                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section id="berita" class="py-20 bg-white border-t border-gray-50">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center justify-between gap-8 mb-12 md:flex-row">
                <div>
                    <span class="text-sm font-semibold tracking-wider text-blue-700 uppercase">Berita Terkini</span>
                    <h2 class="mt-2 text-4xl font-bold text-gray-900 font-display">Berita & Pengumuman</h2>
                </div>
                <a href="{{ route('news') }}"
                    class="flex items-center font-semibold text-blue-700 transition-colors hover:text-blue-800">
                    Lihat Semua <span class="ml-2">→</span>
                </a>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($latestNews as $news)
                    <div
                        class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl group">
                        <div class="relative h-56 overflow-hidden">
                            @if ($news->featured_image)
                                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}"
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                            @else
                                <div
                                    class="flex items-center justify-center w-full h-full text-4xl font-bold text-white bg-blue-600">
                                    {{ strtoupper(substr($news->title, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col flex-1 p-6">
                            <span
                                class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full w-fit mb-4">
                                {{ $news->published_at?->format('d M Y') ?? 'Terbaru' }}
                            </span>
                            <h3
                                class="mb-4 text-base font-bold leading-tight text-gray-900 transition font-display line-clamp-2 group-hover:text-blue-700">
                                {{ $news->title }}
                            </h3>
                            <p class="flex-1 mb-6 text-sm leading-relaxed text-gray-600 line-clamp-3">
                                {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 100) }}
                            </p>
                            <div class="mb-4 border-t border-gray-100"></div>
                            <a href="{{ route('news.detail', $news->slug) }}"
                                class="inline-flex items-center text-sm font-semibold text-blue-600 group/link">
                                Baca Selengkapnya <i
                                    class="ml-2 transition-transform fas fa-arrow-right group-hover/link:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center col-span-full">
                        <p class="text-gray-500">Belum ada berita terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== PRESTASI ===== --}}
    <div class="py-20 bg-linear-to-b from-white to-blue-50">
        <div class="container px-6 mx-auto">
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <span class="text-sm font-semibold tracking-wider text-blue-700 uppercase">Pencapaian Sekolah</span>
                {{-- FIX: Nama sekolah diambil dari config, bukan hardcode SMK --}}
                <h2 class="mt-4 mb-6 text-4xl font-bold text-gray-900 font-display">Prestasi Terbaru {{ config('app.name') }}</h2>
            </div>

            <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2 lg:grid-cols-3">
                @if ($prestasis->isEmpty())
                    <div class="col-span-1 py-12 text-center md:col-span-2 lg:col-span-3">
                        <p class="text-lg text-gray-500">Belum ada prestasi yang dipublikasikan</p>
                    </div>
                @else
                    @foreach ($prestasis as $prestasi)
                        @php
                            $award = getAwardIcon($prestasi->category);
                        @endphp
                        <div
                            class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border border-gray-200 shadow-lg rounded-2xl hover:shadow-2xl group">
                            <div
                                class="flex items-center justify-center px-6 py-8 bg-linear-to-br from-gray-50 to-gray-100 shrink-0">
                                <div
                                    class="w-24 h-24 bg-linear-to-br {{ $award['bgColor'] }} rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="{{ $award['icon'] }} text-white text-5xl"></i>
                                </div>
                            </div>

                            <div class="flex flex-col flex-1 p-6">
                                <h3 class="mb-2 text-lg font-bold leading-snug text-gray-900 line-clamp-2">
                                    {{ $prestasi->title }}</h3>

                                @if ($prestasi->category)
                                    <div
                                        class="{{ $award['textColor'] }} font-semibold text-xs uppercase tracking-wide mb-3 line-clamp-1">
                                        {{ $prestasi->category }}
                                    </div>
                                @endif

                                <p class="flex-1 mb-3 text-sm leading-relaxed text-gray-600 line-clamp-2">
                                    {{ $prestasi->description }}
                                </p>

                                @if ($prestasi->achievement_date)
                                    <div class="flex items-center mb-4 text-xs text-gray-500">
                                        <i class="mr-2 fas fa-calendar"></i>
                                        {{ $prestasi->achievement_date->format('d M Y') }}
                                    </div>
                                @endif

                                <div class="pt-3 mt-auto border-t border-gray-200"></div>

                                {{-- FIX: "Read More" → "Baca Selengkapnya" --}}
                                <a href="{{ route('prestasi.detail', $prestasi->slug) }}"
                                    class="inline-block {{ $award['textColor'] }} hover:opacity-80 font-semibold text-sm group/link transition-colors mt-3">
                                    Baca Selengkapnya <i
                                        class="ml-2 transition-transform fas fa-arrow-right group-hover/link:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            @if ($prestasis->isNotEmpty())
                <div class="text-center">
                    <a href="{{ route('prestasi.index') }}"
                        class="inline-block px-8 py-3 font-semibold text-white transition-all duration-300 bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl">
                        Lihat Semua Prestasi <i class="ml-2 fas fa-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <section id="agenda" class="pt-20 pb-8 bg-gradient-to-br from-blue-50 to-white">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center justify-between gap-8 mb-12 md:flex-row">
                <div>
                    <span class="text-sm font-semibold tracking-wider text-blue-700 uppercase">Jadwal Kegiatan</span>
                    <h2 class="mt-2 text-4xl font-bold text-gray-900 font-display">Agenda Kegiatan</h2>
                </div>
                <a href="{{ route('agenda') }}"
                    class="flex items-center font-semibold text-blue-700 transition-colors hover:text-blue-800">
                    Lihat Semua <span class="ml-2">→</span>
                </a>
            </div>

            <div class="space-y-4">
                @forelse($agendas as $agenda)
                    @php
                        $statusClasses = [
                            'upcoming'  => 'bg-blue-100 text-blue-800',
                            'completed' => 'bg-gray-100 text-gray-800',
                        ];
                        $statusLabels = [
                            'upcoming'  => 'Mendatang',
                            'completed' => 'Selesai',
                        ];
                        $showTime = $agenda->formatted_time && $agenda->formatted_time !== '00:00';
                    @endphp
                    <div class="p-6 transition-shadow duration-300 bg-white border-l-4 border-blue-600 shadow-md rounded-xl hover:shadow-lg">
                        <div class="flex flex-col items-start justify-between gap-4 sm:flex-row">
                            <div class="flex-1">
                                <h3 class="mb-2 text-lg font-bold text-gray-900 font-display">
                                    {{ $agenda->title }}
                                </h3>

                                @if($agenda->description)
                                    <p class="mb-3 text-sm leading-relaxed text-gray-600">
                                        {{ Str::limit($agenda->description, 150) }}
                                    </p>
                                @endif

                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                    <span class="flex items-center gap-2">
                                        <i class="text-blue-600 fas fa-calendar"></i>
                                        {{ $agenda->event_date->format('d M Y') }}
                                    </span>

                                    @if($showTime)
                                        <span class="flex items-center gap-2">
                                            <i class="text-blue-600 fas fa-clock"></i>
                                            {{ $agenda->formatted_time }} WIB
                                        </span>
                                    @endif

                                    @if($agenda->location)
                                        <span class="flex items-center gap-2">
                                            <i class="text-red-500 fas fa-map-marker-alt"></i>
                                            {{ $agenda->location }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <span class="shrink-0 inline-block px-4 py-2 text-sm rounded-full font-bold whitespace-nowrap
                                {{ $statusClasses[$agenda->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $statusLabels[$agenda->status] ?? $agenda->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center bg-white shadow-sm rounded-xl">
                        <i class="mb-3 text-3xl text-gray-300 fas fa-calendar-times"></i>
                        <p class="font-medium text-gray-500">Tidak ada agenda aktif saat ini</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- FIX: Hapus CTA PPDB section tengah (sudah ada di Hero & Footer strip) --}}
    {{-- Diganti dengan section ringan tanpa full-bleed background --}}
    <section class="pt-4 pb-12 bg-white border-t border-gray-100">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center justify-between max-w-3xl gap-6 px-8 py-6 mx-auto sm:flex-row bg-blue-50 rounded-2xl">
                <div>
                    <p class="text-lg font-bold leading-tight text-gray-900">Pendaftaran PPDB 2026/2027 Masih Dibuka</p>
                    <p class="mt-1 text-sm text-gray-500">Segera daftarkan putra-putri Anda sebelum kuota penuh.</p>
                </div>
                <a href="{{ route('ppdb') }}"
                    class="shrink-0 inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-7 rounded-xl text-sm shadow-md shadow-blue-200 transition-all hover:-translate-y-0.5 whitespace-nowrap">
                    <i class="fas fa-graduation-cap"></i>
                    Daftar Sekarang →
                </a>
            </div>
        </div>
    </section>
</div>