<div>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-2">Prestasi Peserta Didik</h1>
            <p class="text-blue-100">Pencapaian dan prestasi yang membanggakan dari peserta didik kami</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-16">
        @if($prestasis->isEmpty())
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-trophy"></i>
                </div>
                <p class="text-gray-500 text-lg">Belum ada prestasi yang dipublikasikan</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($prestasis as $prestasi)
                    @php
                        $award = getAwardIcon($prestasi->category);
                    @endphp
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 h-full flex flex-col">
                        <!-- Badge Section -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 px-8 py-10 flex items-center justify-center flex-shrink-0">
                            <div class="w-28 h-28 bg-gradient-to-br {{ $award['bgColor'] }} rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <span class="text-7xl">{{ $award['emoji'] }}</span>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6 flex flex-col flex-1">
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight">{{ $prestasi->title }}</h3>

                            <!-- Category -->
                            @if($prestasi->category)
                                <div class="{{ $award['textColor'] }} font-semibold text-sm uppercase tracking-wide mb-3 line-clamp-1">
                                    {{ $prestasi->category }}
                                </div>
                            @endif

                            <!-- Description -->
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-1 line-clamp-3">
                                {{ $prestasi->description }}
                            </p>

                            <!-- Date -->
                            @if($prestasi->achievement_date)
                                <div class="flex items-center text-gray-500 text-xs mb-4">
                                    <span class="mr-2">📅</span>
                                    {{ $prestasi->achievement_date->format('d M Y') }}
                                </div>
                            @endif

                            <!-- Divider -->
                            <div class="border-t border-gray-200 mt-auto pt-4"></div>

                            <!-- Read More Link -->
                            <a href="{{ route('prestasi.detail', $prestasi->slug) }}" class="inline-block {{ $award['textColor'] }} hover:opacity-80 font-semibold text-sm group/link transition-colors mt-4">
                                Read More <i class="fas fa-arrow-right ml-2 group-hover/link:translate-x-1 transition-transform"></i>
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
