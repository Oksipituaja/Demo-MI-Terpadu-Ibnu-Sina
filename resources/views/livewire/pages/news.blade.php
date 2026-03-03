<div>
<!-- Breadcrumb -->
<div class="pt-8 pb-8 bg-linear-to-r from-blue-700 to-blue-600">
    <div class="container px-6 mx-auto">
        <nav class="flex items-center mb-4 space-x-2 text-sm text-white">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <span>/</span>
            <span>Berita & Pengumuman</span>
        </nav>
        <h1 class="text-4xl font-bold text-white font-display">Berita & Pengumuman Sekolah</h1>
        <p class="mt-2 text-white/90">Informasi terkini tentang kegiatan dan pengumuman penting sekolah</p>
    </div>
</div>

<!-- News Section -->
<section class="py-20 bg-white">
    <div class="container px-6 mx-auto">
        <!-- Search -->
        <div class="mb-12">
            <input type="text" 
                   wire:model.live="search" 
                   placeholder="🔍 Cari berita..." 
                   class="w-full px-6 py-3 transition border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 bg-gray-50">
        </div>

        <!-- News Grid -->
        <div class="grid gap-8 mb-12 md:grid-cols-2 lg:grid-cols-3">
            @forelse($news as $item)
                <div class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl group">
                    <!-- Image -->
                    <div class="relative flex items-center justify-center h-56 overflow-hidden transition bg-linear-to-br from-blue-100 to-blue-50 group-hover:from-blue-150 group-hover:to-blue-100">
                        @if($item->featured_image)
                            <img src="{{ asset('storage/' . $item->featured_image) }}" 
                                 alt="{{ $item->title }}" 
                                 loading="lazy"
                                 class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="flex flex-col items-center justify-center w-full h-full p-4 text-white bg-linear-to-br from-indigo-400 to-blue-500">
                                <span class="mb-2 text-6xl font-bold opacity-80">{{ strtoupper(substr($item->title, 0, 1)) }}</span>
                                <p class="max-w-xs text-xs text-center line-clamp-2">{{ substr($item->title, 0, 40) }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="flex flex-col flex-1 p-6">
                        <!-- Date Badge -->
                        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full w-fit mb-4">
                            {{ $item->published_at?->format('d M Y') ?? 'Terbaru' }}
                        </span>
                        
                        <!-- Title -->
                        <h3 class="mb-4 text-base font-bold leading-tight text-gray-900 transition font-display line-clamp-2 group-hover:text-blue-700">
                            {{ $item->title }}
                        </h3>
                        
                        <!-- Excerpt -->
                        <p class="flex-1 mb-6 text-sm leading-relaxed text-gray-600 line-clamp-3">
                            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 100) }}
                        </p>
                        
                        <!-- Divider -->
                        <div class="mb-4 border-t border-gray-100"></div>
                        
                        <!-- Read More Link -->
                        <a href="{{ route('news.detail', $item->slug) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 transition-all group/link hover:text-blue-800">
                            Baca Selengkapnya
                            <i class="ml-2 transition-transform fas fa-arrow-right group-hover/link:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center col-span-full bg-linear-to-br from-blue-50 to-blue-100 rounded-2xl">
                    <svg class="w-16 h-16 mx-auto mb-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg font-semibold text-gray-600">Tidak ada berita yang ditemukan</p>
                    <p class="mt-2 text-sm text-gray-500">Coba ubah kata kunci pencarian atau lihat kategori lain</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <div class="space-x-2">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</section>
</div>
