<div>
    <!-- Breadcrumb -->
    <div class="pt-8 pb-8 bg-gradient-to-r from-blue-700 to-blue-600">
        <div class="container mx-auto px-6">
            <nav class="flex items-center space-x-2 text-white text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
                <span>/</span>
                <span>Galeri Sekolah</span>
            </nav>
            <h1 class="font-display text-4xl font-bold text-white">Galeri Sekolah</h1>
            <p class="text-white/90 mt-2">Koleksi dokumentasi aktivitas dan kegiatan sekolah</p>
        </div>
    </div>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-6">

            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-16">
                <button wire:click="$set('category', '')"
                    class="px-6 py-2 rounded-full font-semibold transition-all
                        {{ $category === '' ? 'bg-blue-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-blue-700 hover:text-white' }}">
                    Semua
                </button>
                @foreach ($categories as $cat)
                    <button wire:click="$set('category', @js($cat))"
                        class="px-6 py-2 rounded-full font-semibold transition-all
                            {{ $category === $cat ? 'bg-blue-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-blue-700 hover:text-white' }}">
                        {{ ucfirst($cat) }}
                    </button>
                @endforeach
            </div>

            <!-- Gallery Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12"
                wire:loading.class="opacity-50 transition-opacity">
                @forelse($galleries as $item)
                    <a href="{{ route('gallery.detail', $item->slug) }}"
                        class="gallery-item group cursor-pointer block">
                        <div
                            class="relative overflow-hidden rounded-xl h-64 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy">
                            @else
                                <div
                                    class="flex flex-col items-center justify-center gap-2 w-full h-full bg-gradient-to-br from-blue-100 to-blue-50 group-hover:from-blue-200 group-hover:to-blue-100 transition">
                                    <i
                                        class="fas fa-images text-5xl text-blue-300 group-hover:text-blue-400 transition"></i>
                                    <span class="text-blue-400 text-xs font-medium uppercase tracking-widest">Foto
                                        Segera Hadir</span>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300 flex items-end justify-start p-4">
                                <span
                                    class="text-white opacity-0 group-hover:opacity-100 transition-opacity text-sm font-semibold line-clamp-2">
                                    {{ $item->title }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h3 class="font-bold text-gray-900 group-hover:text-blue-700 transition line-clamp-1">
                                {{ $item->title }}</h3>
                            <span
                                class="inline-block mt-1 text-xs font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">
                                {{ ucfirst($item->category) }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full bg-gradient-to-br from-blue-50 to-blue-100 p-12 rounded-xl text-center">
                        <i class="fas fa-images text-5xl text-blue-300 mb-4"></i>
                        <p class="text-gray-600 text-lg font-semibold">Tidak ada galeri untuk kategori ini</p>
                        <p class="text-gray-500 text-sm mt-2">Silakan pilih kategori lain</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-700 to-blue-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="font-display text-4xl font-bold mb-6">Tertarik Bergabung?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
                Jadilah bagian dari komunitas {{ config('app.name') }} dan rasakan pengalaman belajar yang luar biasa.
            </p>
            <a href="{{ route('ppdb') }}"
                class="inline-block bg-yellow-300 hover:bg-yellow-400 text-gray-900 font-bold py-4 px-8 rounded-xl shadow-lg transition-all hover:-translate-y-1 active:scale-95">
                Daftar PPDB 2026/2027 <span class="ml-2">→</span>
            </a>
        </div>
    </section>
</div>
