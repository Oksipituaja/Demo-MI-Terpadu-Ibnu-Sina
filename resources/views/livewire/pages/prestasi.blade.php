<div style="background: #F0F4ED; min-height: 100vh">

    <div class="text-white py-14" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="container px-6 mx-auto">
            <nav class="flex items-center mb-4 space-x-2 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Prestasi</span>
            </nav>
            <h1 class="mb-2 text-4xl font-bold text-white font-display">Prestasi Peserta Didik</h1>
            <p style="color: #bbf7d0">Pencapaian dan prestasi yang membanggakan dari peserta didik kami</p>
        </div>
    </div>

    <div class="container px-6 py-16 mx-auto">
        @if($prestasis->isEmpty())
            <div class="py-16 text-center rounded-2xl" style="background: #dcfce7">
                <i class="mb-4 text-6xl fas fa-trophy" style="color: #15803d40"></i>
                <p class="text-lg text-gray-500">Belum ada prestasi yang dipublikasikan</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($prestasis as $prestasi)
                    @php $award = getAwardIcon($prestasi->category); @endphp
                    <div class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border shadow-lg rounded-2xl hover:shadow-2xl group"
                        style="border-color: #15803d1a">

                        <div class="flex items-center justify-center px-8 py-10 shrink-0"
                            style="background: linear-gradient(to bottom right, #f8fafc, #f1f5f9)">
                            <div class="flex items-center justify-center transition-transform duration-300 transform rounded-full shadow-lg w-28 h-28 group-hover:scale-110"
                                style="{{ $award['bgStyle'] }}">
                                <i class="{{ $award['icon'] }} text-white text-5xl"></i>
                            </div>
                        </div>

                        <div class="flex flex-col flex-1 p-6">
                            <h3 class="mb-3 text-xl font-bold leading-tight text-gray-900">{{ $prestasi->title }}</h3>

                            @if($prestasi->category)
                                <div class="mb-3 text-sm font-semibold tracking-wide uppercase line-clamp-1"
                                    style="{{ $award['textStyle'] }}">
                                    {{ $prestasi->category }}
                                </div>
                            @endif

                            <p class="flex-1 mb-4 text-sm leading-relaxed text-gray-600 line-clamp-3">
                                {{ $prestasi->description }}
                            </p>

                            @if($prestasi->achievement_date)
                                <div class="flex items-center mb-4 text-xs text-gray-500">
                                    <i class="mr-2 fas fa-calendar"></i>
                                    {{ $prestasi->achievement_date->format('d M Y') }}
                                </div>
                            @endif

                            <div class="pt-4 mt-auto border-t border-gray-200"></div>

                            <a href="{{ route('prestasi.detail', $prestasi->slug) }}"
                                class="inline-block mt-4 text-sm font-semibold transition-opacity hover:opacity-80 group/link"
                                style="{{ $award['textStyle'] }}">
                                Baca Selengkapnya
                                <i class="ml-2 transition-transform fas fa-arrow-right group-hover/link:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $prestasis->links() }}
            </div>
        @endif
    </div>
</div>