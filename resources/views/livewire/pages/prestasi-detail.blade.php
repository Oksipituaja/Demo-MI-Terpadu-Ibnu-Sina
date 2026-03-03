<div>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
        <div class="container mx-auto px-4">
            <a href="{{ route('prestasi.index') }}" class="text-blue-100 hover:text-white transition mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Prestasi
            </a>
            <h1 class="text-4xl font-bold">{{ $prestasi->title }}</h1>
            <div class="flex flex-wrap gap-4 mt-4">
                @if($prestasi->category)
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">{{ $prestasi->category }}</span>
                @endif
                @if($prestasi->achievement_date)
                    <span class="text-blue-100">
                        <i class="fas fa-calendar mr-2"></i> {{ $prestasi->achievement_date->format('d F Y') }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Featured Image -->
                @if($prestasi->image)
                    <div class="w-full rounded-lg overflow-hidden shadow-lg mb-8">
                        <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" class="w-full h-auto object-cover">
                    </div>
                @endif

                <!-- Description -->
                <div class="prose prose-lg max-w-none">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $prestasi->description }}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-blue-50 rounded-lg p-6 sticky top-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Informasi Prestasi</h3>
                    
                    <!-- Category -->
                    @if($prestasi->category)
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 font-semibold mb-2">Kategori</p>
                            <p class="text-gray-900">{{ $prestasi->category }}</p>
                        </div>
                    @endif

                    <!-- Date -->
                    @if($prestasi->achievement_date)
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 font-semibold mb-2">Tanggal Pencapaian</p>
                            <p class="text-gray-900">{{ $prestasi->achievement_date->format('d F Y') }}</p>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <a href="{{ route('prestasi.index') }}" class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                        <i class="fas fa-list mr-2"></i> Lihat Semua Prestasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
