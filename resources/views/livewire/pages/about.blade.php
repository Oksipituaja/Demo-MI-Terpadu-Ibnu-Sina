<div class="min-h-screen bg-white">
    <!-- Hero Image -->
    @php
        $heroImagePath = $heroImage?->image ? asset('storage/' . $heroImage->image) : null;
    @endphp

    @if($heroImagePath)
        <div class="relative h-96 overflow-hidden bg-linear-to-br from-blue-600 to-blue-800">
            <img src="{{ $heroImagePath }}"
                 alt="{{ config('app.name') }}"
                 class="w-full h-full object-cover"
                 onerror="this.style.display='none'">
            <div class="absolute inset-0 bg-linear-to-t from-blue-900 via-transparent to-transparent"></div>
        </div>
    @else
        <div class="bg-linear-to-br from-blue-600 to-blue-800 h-96 flex items-center justify-center">
            <div class="text-center text-white">
                <i class="fas fa-school text-6xl opacity-40 mb-4"></i>
            </div>
        </div>
    @endif

    <!-- Content -->
    <div class="max-w-6xl mx-auto py-16 px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-12">Tentang Kami</h1>

        <!-- ===== SAMBUTAN KEPALA SEKOLAH ===== -->
        @if($principalGreeting)
            <div id="sambutan" class="relative py-16 my-12 bg-linear-to-br from-blue-50 via-white to-indigo-50 rounded-xl overflow-hidden scroll-mt-32">
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-96 h-96 bg-yellow-300 rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 px-8">
                    <div class="text-center mb-6">
                        <span class="text-sm font-semibold tracking-widest uppercase text-blue-700">Sambutan</span>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900">
                        {{ $principalGreeting->title ?? 'Sambutan Kepala Sekolah' }}
                    </h2>

                    <div class="grid lg:grid-cols-2 gap-12 items-center max-w-5xl mx-auto">
                        <div class="space-y-6 order-2 lg:order-1">
                            <div class="text-gray-700 leading-relaxed text-base">
                                {!! $principalGreeting->content !!}
                            </div>
                        </div>

                        <div class="flex justify-center order-1 lg:order-2">
                            <div class="relative w-64 h-64 md:w-80 md:h-80">
                                <div class="absolute inset-0 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
                                    @if($principalGreeting->image)
                                        <img src="{{ asset('storage/' . $principalGreeting->image) }}"
                                             alt="{{ $principalGreeting->title ?? 'Kepala Sekolah' }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="flex flex-col items-center justify-center text-center">
                                            <i class="fas fa-user-tie text-7xl text-gray-400 opacity-60"></i>
                                            <p class="text-gray-500 text-sm mt-4">Foto tidak tersedia</p>
                                        </div>
                                    @endif
                                </div>

                                @if($principalGreeting->principal_name)
                                    <div class="absolute z-20 -bottom-2 left-1/2 -translate-x-1/2 bg-blue-600 text-white px-6 py-2 rounded-full shadow-lg border-2 border-white whitespace-nowrap">
                                        <p class="text-sm md:text-base font-bold uppercase tracking-wide">
                                            {{ $principalGreeting->principal_name }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tombol Pelajari Lebih Lanjut -->
        @if(!$expanded && $principalGreeting)
            <div class="text-center my-12">
                <a href="{{ request()->fullUrlWithQuery(['expanded' => '1']) }}"
                   class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transition-all hover:shadow-xl">
                    <i class="fas fa-book mr-3"></i>
                    Pelajari Lebih Lanjut
                    <i class="fas fa-chevron-down ml-2"></i>
                </a>
            </div>
        @endif

        <!-- ===== EXPANDED CONTENT ===== -->
        @if($expanded)

            <!-- Profil Sekolah -->
            @if($schoolProfile)
                <div id="tentang" class="mb-16 pt-12 border-t scroll-mt-32">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $schoolProfile->title }}</h2>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! $schoolProfile->content !!}
                    </div>
                </div>
            @endif

            <!-- Visi & Misi -->
            @if($vision || $mission)
                <div id="visi-misi" class="grid md:grid-cols-2 gap-12 my-16 pt-12 border-t scroll-mt-32">
                    @if($vision)
                        <div class="bg-linear-to-br from-blue-50 to-blue-100 p-8 rounded-lg">
                            <h3 class="text-2xl font-bold text-blue-900 mb-4">{{ $vision->title }}</h3>
                            <div class="text-gray-700 leading-relaxed">{!! $vision->content !!}</div>
                        </div>
                    @endif

                    @if($mission)
                        <div class="bg-linear-to-br from-green-50 to-green-100 p-8 rounded-lg">
                            <h3 class="text-2xl font-bold text-green-900 mb-4">{{ $mission->title }}</h3>
                            <div class="text-gray-700 leading-relaxed">{!! $mission->content !!}</div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Other Sections -->
            @forelse($aboutSections as $section)
                @if(!in_array($section->key, ['school_profile', 'vision', 'mission', 'hero_image', 'principal_greeting']))
                    <div class="mb-12 border-t pt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $section->title }}</h2>
                        @if($section->image)
                            <div class="mb-6 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $section->image) }}"
                                     alt="{{ $section->title }}"
                                     class="w-full h-96 object-cover">
                            </div>
                        @endif
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! $section->content !!}
                        </div>
                    </div>
                @endif
            @empty
            @endforelse

            <!-- Collapse Button -->
            <div class="text-center my-12 pt-12 border-t">
                <a href="{{ route('about') }}"
                   onclick="window.location.href='{{ route('about') }}'; return false;"
                   class="inline-flex items-center px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition-all">
                    <i class="fas fa-chevron-up mr-2"></i>
                    Sembunyikan Detail
                </a>
            </div>
        @endif
    </div>

    {{-- Auto-scroll via URL parameter --}}
    @if(request()->has('section'))
        <script>
            // Tunggu sampai seluruh halaman selesai render lalu scroll
            window.addEventListener('load', function () {
                const section = @js(request('section'));
                const tryScroll = (attempts) => {
                    const el = document.getElementById(section);
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else if (attempts > 0) {
                        setTimeout(() => tryScroll(attempts - 1), 200);
                    }
                };
                setTimeout(() => tryScroll(10), 400);
            });
        </script>
    @endif
</div>