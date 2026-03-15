<div>
    <section class="relative pt-12 pb-20 overflow-hidden"
        style="background: linear-gradient(to bottom right, #F0F4ED, #F0F4ED, #15803d0d)">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute rounded-full top-20 left-20 w-72 h-72 blur-3xl" style="background: #15803d"></div>
            <div class="absolute rounded-full bottom-20 right-20 w-96 h-96 blur-3xl" style="background: #EAB308"></div>
        </div>

        <div class="container relative z-10 px-6 mx-auto">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="space-y-6 animate-fade-in">
                    <div class="inline-block px-4 py-2 rounded-full" style="background: #15803d1a">
                        <span class="text-sm font-semibold" style="color: #15803d">🏆 Akreditasi B</span>
                    </div>
                    <h1 class="text-5xl font-bold leading-tight text-gray-900 font-display lg:text-6xl">
                        Membentuk Generasi
                        <span class="text-transparent bg-clip-text"
                            style="background-image: linear-gradient(to right, #15803d, #22c55e); -webkit-background-clip: text; background-clip: text;">Unggul
                            &
                            Berkarakter</span>
                    </h1>
                    <p class="text-lg leading-relaxed text-gray-600">
                        {{ config('app.name') }} berkomitmen memberikan pendidikan berkualitas dengan fasilitas modern
                        dan tenaga pendidik profesional untuk mengembangkan potensi anak Indonesia.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('ppdb') }}"
                            class="inline-flex items-center px-6 py-3 font-bold rounded-xl transition-all duration-300 hover:-translate-y-0.5"
                            style="background: #EAB308; color: #14532d; box-shadow: 0 10px 20px #EAB30833;">
                            Daftar Sekarang
                            <span class="ml-2">→</span>
                        </a>
                        <a href="{{ route('about') }}"
                            class="inline-flex items-center px-6 py-3 font-bold rounded-xl border-2 transition-all duration-300 hover:-translate-y-0.5"
                            style="color: #15803d; border-color: #15803d; background: #F0F4ED;">
                            Pelajari Lebih Lanjut
                            <span class="ml-2">→</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                        <div class="text-center">
                            <div class="text-3xl font-bold" style="color: #15803d">357+</div>
                            <div class="mt-1 text-sm text-gray-600">Siswa Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold" style="color: #15803d">35+</div>
                            <div class="mt-1 text-sm text-gray-600">Guru Profesional</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold" style="color: #15803d">19+</div>
                            <div class="mt-1 text-sm text-gray-600">Tahun Berpengalaman</div>
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center justify-center p-4">
                    <div class="absolute w-full h-full -translate-x-1/2 -translate-y-1/2 rounded-full top-1/2 left-1/2 blur-3xl"
                        style="background: linear-gradient(to top right, #15803d1a, #EAB3081a)"></div>

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
                            <div class="absolute inset-0"
                                style="background: linear-gradient(to top, #14532d33, transparent)"></div>
                        </div>

                        <div class="absolute flex items-center p-4 space-x-4 border shadow-2xl -bottom-4 -right-4 md:-right-8 rounded-2xl animate-bounce-slow"
                            style="background: #F0F4EDF0; backdrop-filter: blur(4px); border-color: #d1fae5;">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full shadow-lg shrink-0"
                                style="background: #15803d; box-shadow: 0 4px 12px #15803d4d;">
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

                        <div class="absolute -top-4 -left-4 font-bold py-2 px-4 rounded-lg shadow-lg rotate-[-5deg]"
                            style="background: #EAB308; color: #14532d;">
                            Unggul & Berkarakter
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SAMBUTAN ===== --}}
    @if ($principalGreeting?->title)
        <section id="sambutan" class="relative py-24 overflow-hidden" style="background: #F0F4ED">
            <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 rounded-full opacity-40 w-96 h-96 blur-3xl"
                style="background: #15803d1a"></div>

            <div class="container relative z-10 px-6 mx-auto">
                <div class="max-w-6xl mx-auto">
                    <div class="grid items-center gap-16 lg:grid-cols-12">

                        <div class="flex justify-center order-1 lg:col-span-5">
                            <div class="relative group">
                                <div class="absolute transition-transform duration-500 border-2 border-dashed -inset-4 rounded-4xl rotate-3 group-hover:rotate-0"
                                    style="border-color: #15803d33"></div>

                                <div class="relative w-72 h-96 md:w-80 md:h-112.5 rounded-4xl overflow-hidden shadow-2xl border-8"
                                    style="background: #d1fae5; border-color: #F0F4ED;">
                                    @if ($principalGreeting?->image)
                                        <img src="{{ asset('storage/' . $principalGreeting->image) }}"
                                            alt="{{ $principalGreeting->principal_name ?? 'Kepala Sekolah' }}"
                                            class="object-cover w-full h-full">
                                    @else
                                        <div class="flex flex-col items-center justify-center w-full h-full"
                                            style="background: linear-gradient(to bottom right, #dcfce7, #bbf7d0)">
                                            <i class="fas fa-user-tie text-7xl" style="color: #86efac"></i>
                                            <p class="mt-4 text-xs tracking-widest uppercase" style="color: #4ade80">
                                                Photo Placeholder</p>
                                        </div>
                                    @endif

                                    <div class="absolute inset-x-0 bottom-0 p-6 pt-12"
                                        style="background: linear-gradient(to top, #14532de6, transparent)">
                                        <p class="mb-0 text-xl font-bold text-white">
                                            {{ $principalGreeting?->principal_name ?? 'Kepala Sekolah' }}</p>
                                        <p class="text-sm italic" style="color: #86efac">Kepala Sekolah
                                            {{ config('app.name') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-2 space-y-6 lg:col-span-7">
                            <div>
                                <span
                                    class="inline-block px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-4"
                                    style="background: #15803d1a; color: #15803d">
                                    Sambutan Kepala Sekolah
                                </span>
                                <h2 class="text-3xl font-extrabold leading-tight md:text-5xl" style="color: #14532d">
                                    {{ $principalGreeting?->title }}
                                </h2>
                            </div>

                            <div class="relative">
                                <i class="absolute text-5xl fas fa-quote-left -top-4 -left-6"
                                    style="color: #15803d1a"></i>
                                <div class="relative z-10 text-lg italic leading-relaxed text-gray-600">
                                    "{!! Str::limit(strip_tags($principalGreeting?->content ?? ''), 450) !!}"
                                </div>
                            </div>

                            <div class="pt-4">
                                <a href="{{ route('about') }}"
                                    class="inline-flex items-center px-8 py-4 font-bold text-white transition-all duration-300 group rounded-xl hover:-translate-y-1"
                                    style="background: #15803d; box-shadow: 0 10px 20px #15803d4d;">
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

    {{-- ===== GURU ===== --}}
    <section id="guru" class="py-20" style="background: #fefefe">
        <div class="container px-6 mx-auto">
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <span class="text-sm font-semibold tracking-wider uppercase" style="color: #15803d">Tim Kami</span>
                <h2 class="mt-4 mb-6 text-4xl font-bold font-display" style="color: #14532d">Tenaga Pendidik &
                    Pengajar</h2>
                <p class="leading-relaxed text-gray-600">Guru berpengalaman dan berdedikasi tinggi siap membimbing
                    potensi siswa.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($teachers as $teacher)
                    <div class="text-center teacher-card">
                        <div class="flex items-center justify-center w-32 h-32 mx-auto mb-4 overflow-hidden transition-transform duration-300 rounded-full hover:scale-105"
                            style="background: linear-gradient(to bottom right, #15803d, #22c55e)">
                            @if ($teacher->image)
                                <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->name }}"
                                    class="object-cover w-full h-full">
                            @else
                                <i class="text-5xl text-white fas fa-chalkboard-user"></i>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold font-display" style="color: #14532d">
                            {{ $teacher->name ?? 'Guru' }}</h3>
                        <p class="mb-2 font-semibold" style="color: #15803d">{{ $teacher->subject ?? 'Pendidik' }}
                        </p>
                    </div>
                @empty
                    <div class="py-10 text-center col-span-full">
                        <p class="text-gray-500">Profil guru sedang dipersiapkan</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('teachers') }}"
                    class="inline-flex items-center px-8 py-3 font-semibold text-white transition-all duration-300 rounded-xl hover:-translate-y-1"
                    style="background: #15803d; box-shadow: 0 4px 16px #15803d33;">
                    Lihat Semua Guru
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== BERITA ===== --}}
    <section id="berita" class="py-20 border-t" style="background: #F0F4ED; border-color: #d1fae5">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center justify-between gap-8 mb-12 md:flex-row">
                <div>
                    <span class="text-sm font-semibold tracking-wider uppercase" style="color: #15803d">Berita
                        Terkini</span>
                    <h2 class="mt-2 text-4xl font-bold font-display" style="color: #14532d">Berita & Pengumuman</h2>
                </div>
                <a href="{{ route('news') }}?tab=agenda" class="flex items-center font-semibold transition-colors"
                    style="color: #15803d">
                    Lihat Semua <span class="ml-2">→</span>
                </a>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($latestNews as $news)
                    <div class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border shadow-md rounded-xl hover:shadow-xl group"
                        style="border-color: #d1fae5">
                        <div class="relative h-56 overflow-hidden">
                            @if ($news->featured_image)
                                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}"
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-4xl font-bold text-white"
                                    style="background: #15803d">
                                    {{ strtoupper(substr($news->title, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col flex-1 p-6" style="background: #fefefe">
                            <span class="text-xs font-semibold px-3 py-1.5 rounded-full w-fit mb-4"
                                style="color: #15803d; background: #15803d1a">
                                {{ $news->published_at?->format('d M Y') ?? 'Terbaru' }}
                            </span>
                            <h3 class="mb-4 text-base font-bold leading-tight text-gray-900 transition font-display line-clamp-2"
                                style="transition: color 0.2s">
                                {{ $news->title }}
                            </h3>
                            <p class="flex-1 mb-6 text-sm leading-relaxed text-gray-600 line-clamp-3">
                                {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 100) }}
                            </p>
                            <div class="mb-4 border-t" style="border-color: #d1fae5"></div>
                            <a href="{{ route('news.detail', $news->slug) }}"
                                class="inline-flex items-center text-sm font-semibold group/link"
                                style="color: #15803d">
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
    <div class="py-20" style="background: linear-gradient(to bottom, #fefefe, #F0F4ED)">
        <div class="container px-6 mx-auto">
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <span class="text-sm font-semibold tracking-wider uppercase" style="color: #15803d">Pencapaian
                    Sekolah</span>
                <h2 class="mt-4 mb-6 text-4xl font-bold font-display" style="color: #14532d">Prestasi Terbaru
                    {{ config('app.name') }}</h2>
            </div>

            <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2 lg:grid-cols-3">
                @if ($prestasis->isEmpty())
                    <div class="col-span-1 py-12 text-center md:col-span-2 lg:col-span-3">
                        <p class="text-lg text-gray-500">Belum ada prestasi yang dipublikasikan</p>
                    </div>
                @else
                    @foreach ($prestasis as $prestasi)
                        @php $award = getAwardIcon($prestasi->category); @endphp
                        <div
                            class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border border-gray-200 shadow-lg rounded-2xl hover:shadow-2xl group">
                            <div class="flex items-center justify-center px-6 py-8 shrink-0"
                                style="background: linear-gradient(to bottom right, #f8fafc, #f1f5f9)">
                                <div class="flex items-center justify-center w-24 h-24 transition-transform duration-300 transform rounded-full shadow-lg group-hover:scale-110"
                                    style="{{ $award['bgStyle'] }}">
                                    <i class="{{ $award['icon'] }} text-white text-5xl"></i>
                                </div>
                            </div>

                            <div class="flex flex-col flex-1 p-6">
                                <h3 class="mb-2 text-lg font-bold leading-snug text-gray-900 line-clamp-2">
                                    {{ $prestasi->title }}</h3>

                                @if ($prestasi->category)
                                    <div class="mb-3 text-xs font-semibold tracking-wide uppercase line-clamp-1"
                                        style="{{ $award['textStyle'] }}">
                                        {{ $prestasi->category }}
                                    </div>
                                @endif

                                <p class="flex-1 mb-3 text-sm leading-relaxed text-gray-600 line-clamp-2">
                                    {{ $prestasi->description }}</p>

                                @if ($prestasi->achievement_date)
                                    <div class="flex items-center mb-4 text-xs text-gray-500">
                                        <i class="mr-2 fas fa-calendar"></i>
                                        {{ $prestasi->achievement_date->format('d M Y') }}
                                    </div>
                                @endif

                                <div class="pt-3 mt-auto border-t border-gray-200"></div>
                                <a href="{{ route('prestasi.detail', $prestasi->slug) }}"
                                    class="inline-block mt-3 text-sm font-semibold transition-opacity hover:opacity-80 group/link"
                                    style="{{ $award['textStyle'] }}">
                                    Baca Selengkapnya
                                    <i
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
                        class="inline-block px-8 py-3 font-semibold text-white transition-all duration-300 rounded-lg shadow-lg hover:-translate-y-1"
                        style="background: #15803d; box-shadow: 0 4px 16px #15803d33;">
                        Lihat Semua Prestasi <i class="ml-2 fas fa-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>

</div>
