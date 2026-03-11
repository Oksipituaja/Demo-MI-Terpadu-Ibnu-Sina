<div class="min-h-screen bg-white">
    <!-- Hero Image -->
    @php
        $heroImagePath = $heroImage?->image ? asset('storage/' . $heroImage->image) : null;
    @endphp

    @if($heroImagePath)
        <div class="relative overflow-hidden h-96 bg-linear-to-br from-blue-600 to-blue-800">
            <img src="{{ $heroImagePath }}"
                 alt="{{ config('app.name') }}"
                 class="object-cover w-full h-full"
                 onerror="this.style.display='none'">
            <div class="absolute inset-0 bg-linear-to-t from-blue-900 via-transparent to-transparent"></div>
        </div>
    @else
        <div class="flex items-center justify-center bg-linear-to-br from-blue-600 to-blue-800 h-96">
            <div class="text-center text-white">
                <i class="mb-4 text-6xl fas fa-school opacity-40"></i>
            </div>
        </div>
    @endif

    <!-- Content -->
    <div class="max-w-6xl px-4 py-16 mx-auto">
        <h1 class="mb-12 text-4xl font-bold text-gray-900">Tentang Kami</h1>

        <!-- ===== SAMBUTAN KEPALA SEKOLAH ===== -->
        @if($principalGreeting)
            <div id="sambutan" class="relative py-16 my-12 overflow-hidden bg-linear-to-br from-blue-50 via-white to-indigo-50 rounded-xl scroll-mt-32">
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute top-0 left-0 bg-blue-400 rounded-full w-96 h-96 blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 bg-yellow-300 rounded-full w-96 h-96 blur-3xl"></div>
                </div>

                <div class="relative z-10 px-8">
                    <div class="mb-6 text-center">
                        <span class="text-sm font-semibold tracking-widest text-blue-700 uppercase">Sambutan</span>
                    </div>

                    <h2 class="mb-12 text-3xl font-bold text-center text-gray-900 md:text-4xl">
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
                                    <div class="absolute z-20 px-6 py-2 text-white -translate-x-1/2 bg-blue-600 border-2 border-white rounded-full shadow-lg -bottom-2 left-1/2 whitespace-nowrap">
                                        <p class="text-sm font-bold tracking-wide uppercase md:text-base">
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
            <div class="my-12 text-center">
                <a href="{{ request()->fullUrlWithQuery(['expanded' => '1']) }}"
                   class="inline-flex items-center px-8 py-4 font-bold text-white transition-all bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl">
                    <i class="mr-3 fas fa-book"></i>
                    Pelajari Lebih Lanjut
                    <i class="ml-2 fas fa-chevron-down"></i>
                </a>
            </div>
        @endif

        <!-- ===== EXPANDED CONTENT ===== -->
        @if($expanded)

            <!-- Profil Sekolah -->
            @if($schoolProfile)
                <div id="tentang" class="pt-12 mb-16 border-t scroll-mt-32">
                    <h2 class="mb-6 text-3xl font-bold text-gray-900">{{ $schoolProfile->title }}</h2>
                    <div class="leading-relaxed prose prose-lg text-gray-700 max-w-none">
                        {!! $schoolProfile->content !!}
                    </div>
                </div>
            @endif

            <!-- Visi & Misi -->
            @if($vision || $mission)
                <div id="visi-misi" class="grid gap-12 pt-12 my-16 border-t md:grid-cols-2 scroll-mt-32">
                    @if($vision)
                        <div class="p-8 rounded-lg bg-linear-to-br from-blue-50 to-blue-100">
                            <h3 class="mb-4 text-2xl font-bold text-blue-900">{{ $vision->title }}</h3>
                            <div class="leading-relaxed text-gray-700">{!! $vision->content !!}</div>
                        </div>
                    @endif

                    @if($mission)
                        <div class="p-8 rounded-lg bg-linear-to-br from-green-50 to-green-100">
                            <h3 class="mb-4 text-2xl font-bold text-green-900">{{ $mission->title }}</h3>
                            <div class="leading-relaxed text-gray-700">{!! $mission->content !!}</div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Other Sections -->
            @forelse($aboutSections as $section)
                @if(!in_array($section->key, ['school_profile', 'vision', 'mission', 'hero_image', 'principal_greeting']))
                    <div class="pt-12 mb-12 border-t">

                        @if($section->key === 'school_info')
                            {{-- ===== TABEL INFORMASI SEKOLAH ===== --}}
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

                            <h2 class="mb-6 text-2xl font-bold text-gray-900">
                                Informasi Lengkap {{ $info['nama_sekolah'] ?? config('app.name') }}
                            </h2>

                            <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                                <table class="w-full text-sm">
                                    <tbody>
                                        @foreach($rows as $i => $row)
                                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-100 last:border-0">
                                                <td class="w-48 px-5 py-3 font-semibold text-gray-700 align-top">
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
                            {{-- ===== SECTION BIASA ===== --}}
                            <h2 class="mb-6 text-2xl font-bold text-gray-900">{{ $section->title }}</h2>
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

            <!-- Collapse Button -->
            <div class="pt-12 my-12 text-center border-t">
                <a href="{{ route('about') }}"
                   onclick="window.location.href='{{ route('about') }}'; return false;"
                   class="inline-flex items-center px-8 py-3 font-semibold text-white transition-all bg-gray-600 rounded-lg hover:bg-gray-700">
                    <i class="mr-2 fas fa-chevron-up"></i>
                    Sembunyikan Detail
                </a>
            </div>
        @endif
    </div>

    {{-- Auto-scroll via URL parameter --}}
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