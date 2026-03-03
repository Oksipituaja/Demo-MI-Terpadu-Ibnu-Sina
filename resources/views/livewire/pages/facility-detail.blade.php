<div class="min-h-screen bg-white">
    <!-- Header -->
    <div class="bg-blue-600 text-white py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('facilities') }}" class="text-blue-100 hover:text-white mb-4 inline-block">← Kembali ke Fasilitas</a>
            <h1 class="text-4xl font-bold">{{ $facility->name }}</h1>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto py-16 px-4">
        <!-- Main Image -->
        <div class="h-96 rounded-lg mb-8 overflow-hidden flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-50">
            @if($facility->image)
                <img src="{{ asset('storage/' . $facility->image) }}" 
                     alt="{{ $facility->name }}" 
                     class="w-full h-full object-cover">
            @else
                <svg class="w-32 h-32 text-blue-300 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4l2-3h2l2 3h4a2 2 0 012 2v14a2 2 0 01-2 2zM9 9h6m-6 4h6"></path>
                </svg>
            @endif
        </div>

        <!-- Description -->
        <div class="prose max-w-none mb-12">
            <div class="text-gray-800 leading-relaxed text-lg">
                {!! nl2br($facility->description) !!}
            </div>
        </div>

        <!-- Additional Info -->
        <div class="bg-blue-50 rounded-lg p-6 mb-12">
            <h3 class="font-bold text-lg text-gray-900 mb-4">Informasi Fasilitas</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Nama Fasilitas</p>
                    <p class="font-semibold text-gray-900">{{ $facility->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm mb-1">Status</p>
                    @if($facility->kondisi === 'tersedia')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">Tersedia</span>
                    @elseif($facility->kondisi === 'perbaikan')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">Perbaikan</span>
                    @elseif($facility->kondisi === 'belum_ada')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800">Belum Ada</span>
                    @elseif($facility->kondisi === 'akan_ada')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">Akan Ada</span>
                    @else
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">-</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Facilities -->
        @if($otherFacilities->count() > 0)
            <div class="mt-16 pt-8 border-t border-gray-200">
                <h3 class="font-bold text-2xl text-gray-900 mb-8">Fasilitas Lainnya</h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($otherFacilities as $other)
                        <a href="{{ route('facility.detail', $other->slug) }}" class="group">
                            <div class="overflow-hidden rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 h-48 flex items-center justify-center group-hover:from-blue-150 group-hover:to-blue-100 transition relative">
                                @if($other->image)
                                    <img src="{{ asset('storage/' . $other->image) }}" alt="{{ $other->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <svg class="w-16 h-16 text-blue-300 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4l2-3h2l2 3h4a2 2 0 012 2v14a2 2 0 01-2 2z"></path>
                                    </svg>
                                @endif
                            </div>
                            <h4 class="font-bold text-gray-900 mt-3 group-hover:text-blue-700 transition">{{ $other->name }}</h4>
                            <p class="text-gray-600 text-sm mt-1">{{ Str::limit($other->description, 80) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back Link -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <a href="{{ route('facilities') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                ← Kembali ke Fasilitas
            </a>
        </div>
    </div>
</div>
