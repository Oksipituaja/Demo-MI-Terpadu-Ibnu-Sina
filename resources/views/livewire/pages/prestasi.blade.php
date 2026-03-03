<div>
    <!-- Hero Section -->
    <div class="py-16 text-white bg-linear-to-r from-blue-600 to-blue-800">
        <div class="container px-4 mx-auto">
            <h1 class="mb-2 text-4xl font-bold">Prestasi Peserta Didik</h1>
            <p class="text-blue-100">Pencapaian dan prestasi yang membanggakan dari peserta didik kami</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container px-4 py-16 mx-auto">
        @if($prestasis->isEmpty())
            <div class="py-12 text-center">
                <div class="mb-4 text-6xl text-gray-400">
                    <i class="fas fa-trophy"></i>
                </div>
                <p class="text-lg text-gray-500">Belum ada prestasi yang dipublikasikan</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($prestasis as $prestasi)
                    @php
                        $award = getAwardIcon($prestasi->category);
                    @endphp
                    <div class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-lg rounded-2xl hover:shadow-2xl group">
                        <!-- Badge Section -->
                        <div class="flex items-center justify-center px-8 py-10 shrink-0 bg-linear-to-br from-gray-50 to-gray-100">
                            <div class="w-28 h-28 bg-linear-to-br {{ $award['bgColor'] }} rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <i class="{{ $award['icon'] }} text-white text-5xl"></i>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="flex flex-col flex-1 p-6">
                            <!-- Title -->
                            <h3 class="mb-3 text-xl font-bold leading-tight text-gray-900">{{ $prestasi->title }}</h3>

                            <!-- Category -->
                            @if($prestasi->category)
                                <div class="{{ $award['textColor'] }} font-semibold text-sm uppercase tracking-wide mb-3 line-clamp-1">
                                    {{ $prestasi->category }}
                                </div>
                            @endif

                            <!-- Description -->
                            <p class="flex-1 mb-4 text-sm leading-relaxed text-gray-600 line-clamp-3">
                                {{ $prestasi->description }}
                            </p>

                            <!-- Date -->
                            @if($prestasi->achievement_date)
                                <div class="flex items-center mb-4 text-xs text-gray-500">
                                    <i class="mr-2 fas fa-calendar"></i>
                                    {{ $prestasi->achievement_date->format('d M Y') }}
                                </div>
                            @endif

                            <!-- Divider -->
                            <div class="pt-4 mt-auto border-t border-gray-200"></div>

                            <!-- Read More Link -->
                            <a href="{{ route('prestasi.detail', $prestasi->slug) }}" class="inline-block {{ $award['textColor'] }} hover:opacity-80 font-semibold text-sm group/link transition-colors mt-4">
                                Read More <i class="ml-2 transition-transform fas fa-arrow-right group-hover/link:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $prestasis->links() }}
            </div>
        @endif
    </div>
</div>
