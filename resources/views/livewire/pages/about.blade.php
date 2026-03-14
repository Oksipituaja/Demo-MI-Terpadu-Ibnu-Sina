<div class="min-h-screen" style="background: #F0F4ED">
    @php
        $heroImagePath = $heroImage?->image ? asset('storage/' . $heroImage->image) : null;
    @endphp

    @if($heroImagePath)
        <div class="relative overflow-hidden h-96" style="background: linear-gradient(to bottom right, #15803d, #14532d)">
            <img src="{{ $heroImagePath }}"
                 alt="{{ config('app.name') }}"
                 class="object-cover w-full h-full"
                 onerror="this.style.display='none'">
            <div class="absolute inset-0" style="background: linear-gradient(to top, #14532d, transparent, transparent)"></div>
        </div>
    @else
        <div class="flex items-center justify-center h-96" style="background: linear-gradient(to bottom right, #15803d, #14532d)">
            <div class="text-center text-white">
                <i class="mb-4 text-6xl fas fa-school opacity-40"></i>
            </div>
        </div>
    @endif

    <div class="max-w-6xl px-4 py-16 mx-auto">
        <h1 class="mb-12 text-4xl font-bold" style="color: #14532d">Tentang Kami</h1>

        @if($principalGreeting)
            <div id="sambutan" class="relative py-16 my-12 overflow-hidden rounded-xl scroll-mt-32" style="background: linear-gradient(to bottom right, #F0F4ED, #dcfce7, #F0F4ED)">
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute top-0 left-0 rounded-full w-96 h-96 blur-3xl" style="background: #15803d"></div>
                    <div class="absolute bottom-0 right-0 rounded-full w-96 h-96 blur-3xl" style="background: #EAB308"></div>
                </div>

                <div class="relative z-10 px-8">
                    <div class="mb-6 text-center">
                        <span class="text-sm font-semibold tracking-widest uppercase" style="color: #15803d">Sambutan</span>
                    </div>

                    <h2 class="mb-12 text-3xl font-bold text-center md:text-4xl" style="color: #14532d">
                        {{ $principalGreeting->title ?? 'Sambutan Kepala Sekolah' }}
                    </h2>

                    <div class="grid items-center max-w-5xl gap-12 mx-auto lg:grid-cols-2">
                        <div class="order-2 space-y-6 lg:order-1">
                            <div class="text-base leading-relaxed text-gray-700">
                                {!! $principalGreeting->content !!}
                            </div>
                        </div>

                        <div class="flex justify-center order-1 lg:order-2">
                            <div class="relative w-64 h-64 md:w-80 md:h-80">
                                <div class="absolute inset-0 flex items-center justify-center overflow-hidden bg-gray-200 rounded-full">
                                    @if($principalGreeting->image)
                                        <img src="{{ asset('storage/' . $principalGreeting->image) }}"
                                             alt="{{ $principalGreeting->title ?? 'Kepala Sekolah' }}"
                                             class="object-cover w-full h-full">
                                    @else
                                        <div class="flex flex-col items-center justify-center text-center">
                                            <i class="text-gray-400 fas fa-user-tie text-7xl opacity-60"></i>
                                            <p class="mt-4 text-sm text-gray-500">Foto tidak tersedia</p>
                                        </div>
                                    @endif
                                </div>

                                @if($principalGreeting->principal_name)
                                    <div class="absolute z-20 px-6 py-2 text-white -translate-x-1/2 border-2 border-white rounded-full shadow-lg -bottom-2 left-1/2 whitespace-nowrap" style="background: #15803d">
                                        <p class="text-sm font-bold tracking-wide md:text-base">
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

        @if(!$expanded && $principalGreeting)
            <div class="my-12 text-center">
                <a href="{{ request()->fullUrlWithQuery(['expanded' => '1']) }}"
                   class="inline-flex items-center px-8 py-4 font-bold text-white transition-all rounded-lg shadow-lg hover:-translate-y-0.5"
                   style="background: #15803d; box-shadow: 0 4px 16px #15803d33;">
                    <i class="mr-3 fas fa-book"></i>
                    Pelajari Lebih Lanjut
                    <i class="ml-2 fas fa-chevron-down"></i>
                </a>
            </div>
        @endif

        @if($expanded)
            @if($schoolProfile)
                <div id="tentang" class="pt-12 mb-16 border-t scroll-mt-32" style="border-color: #15803d26">
                    <h2 class="mb-6 text-3xl font-bold" style="color: #14532d">{{ $schoolProfile->title }}</h2>
                    <div class="leading-relaxed prose prose-lg text-gray-700 max-w-none">
                        {!! $schoolProfile->content !!}
                    </div>
                </div>
            @endif

            @if($vision || $mission)
                <div id="visi-misi" class="grid gap-12 pt-12 my-16 border-t md:grid-cols-2 scroll-mt-32" style="border-color: #15803d26">
                    @if($vision)
                        <div class="p-8 rounded-lg" style="background: linear-gradient(to bottom right, #dcfce7, #bbf7d0)">
                            <h3 class="mb-4 text-2xl font-bold" style="color: #14532d">{{ $vision->title }}</h3>
                            <div class="leading-relaxed prose-sm prose text-gray-700 max-w-none">{!! $vision->content !!}</div>
                        </div>
                    @endif

                    @if($mission)
                    <div class="p-8 rounded-lg" style="background: linear-gradient(to bottom right, #fef9c3, #fef08a)">
                        <h3 class="mb-4 text-2xl font-bold" style="color: #713f12">{{ $mission->title }}</h3>
                        <div class="leading-relaxed prose-sm prose text-gray-700 max-w-none">{!! $mission->content !!}</div>    
                        </div>
                    @endif
                </div>
            @endif

            @forelse($aboutSections as $section)
                @if(!in_array($section->key, ['school_profile', 'vision', 'mission', 'hero_image', 'principal_greeting']))
                    <div class="pt-12 mb-12 border-t" style="border-color: #15803d26">

                        @if($section->key === 'school_info')
                            @php
                                $info = json_decode($section->content, true) ?? [];
                                $rows = [
                                    ['label' => 'NPSN',                 'value' => $info['npsn'] ?? '-'],
                                    ['label' => 'Nama Sekolah',         'value' => $info['nama_sekolah'] ?? '-'],
                                    ['label' => 'Naungan',              'value' => $info['naungan'] ?? '-'],
                                    ['label' => 'Tanggal Berdiri',      'value' => $info['tanggal_berdiri'] ?? '-'],
                                    ['label' => 'No. SK Pendirian',     'value' => $info['sk_pendirian'] ?? '-'],
                                    ['label' => 'Tanggal Operasional',  'value' => $info['tanggal_operasional'] ?? '-'],
                                    ['label' => 'No. SK Operasional',   'value' => $info['sk_operasional'] ?? '-'],
                                    ['label' => 'Jenjang Pendidikan',   'value' => $info['jenjang'] ?? '-'],
                                    ['label' => 'Status Sekolah',       'value' => $info['status'] ?? '-'],
                                    ['label' => 'Alamat',               'value' => $info['alamat'] ?? '-'],
                                ];
                            @endphp

                            <h2 class="mb-6 text-2xl font-bold" style="color: #14532d">
                                Informasi Lengkap {{ $info['nama_sekolah'] ?? config('app.name') }}
                            </h2>

                            <div class="overflow-hidden border rounded-lg shadow-sm" style="border-color: #15803d26">
                                <table class="w-full text-sm">
                                    <tbody>
                                        @foreach($rows as $i => $row)
                                            <tr class="border-b last:border-0" style="{{ $i % 2 === 0 ? 'background: #fefefe' : 'background: #F0F4ED' }}; border-color: #15803d0d">
                                                <td class="w-48 px-5 py-3 font-semibold align-top" style="color: #15803d">
                                                    {{ $row['label'] }}
                                                </td>
                                                <td class="w-4 px-2 py-3 text-gray-500 align-top">:</td>
                                                <td class="px-4 py-3 text-gray-800 align-top">
                                                    {{ $row['value'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @else
                            <h2 class="mb-6 text-2xl font-bold" style="color: #14532d">{{ $section->title }}</h2>
                            @if($section->image)
                                <div class="mb-6 overflow-hidden rounded-lg">
                                    <img src="{{ asset('storage/' . $section->image) }}"
                                         alt="{{ $section->title }}"
                                         class="object-cover w-full h-96">
                                </div>
                            @endif
                            <div class="leading-relaxed prose prose-lg text-gray-700 max-w-none">
                                {!! $section->content !!}
                            </div>
                        @endif

                    </div>
                @endif
            @empty
            @endforelse

            <div class="pt-12 my-12 text-center border-t" style="border-color: #15803d26">
                <a href="{{ route('about') }}"
                   onclick="window.location.href='{{ route('about') }}'; return false;"
                   class="inline-flex items-center px-8 py-3 font-semibold text-white transition-all rounded-lg"
                   style="background: #6b7280;">
                    <i class="mr-2 fas fa-chevron-up"></i>
                    Sembunyikan Detail
                </a>
            </div>
        @endif
    </div>

    @if(request()->has('section'))
        <script>
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