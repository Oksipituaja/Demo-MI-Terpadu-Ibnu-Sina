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
                                <span class="text-6xl">{{ $award['emoji'] }}</span>
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
                                    <span class="mr-2">📅</span>
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
