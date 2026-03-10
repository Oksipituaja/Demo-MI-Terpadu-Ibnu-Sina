<div>
<!-- Breadcrumb -->
<div class="pt-8 pb-8 bg-linear-to-r from-blue-700 to-blue-600">
    <div class="container mx-auto px-6">
        <nav class="flex items-center space-x-2 text-white text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <span>/</span>
            <span>Fasilitas</span>
        </nav>
        <h1 class="font-display text-4xl font-bold text-white">Fasilitas Unggulan</h1>
        <p class="text-white/90 mt-2">Prasarana modern dan lengkap untuk mendukung pembelajaran optimal</p>
    </div>
</div>

<!-- Facilities Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($facilities as $facility)
                <a href="{{ route('facility.detail', $facility->slug) }}" class="facility-card group block rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100">
                    {{-- Image / Icon Area --}}
                    <div class="relative h-56 bg-linear-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden">
                        @if($facility->image)
                            <img src="{{ asset('storage/' . $facility->image) }}"
                                alt="{{ $facility->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            {{-- ✅ Pakai icon dari database, fallback ke fa-building jika kosong --}}
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="w-20 h-20 rounded-full bg-blue-600/10 flex items-center justify-center group-hover:bg-blue-600/20 transition">
                                    <i class="{{ $facility->icon ?? 'fas fa-building' }} text-4xl text-blue-600 group-hover:scale-110 transition-transform duration-300"></i>
                                </div>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 bg-white group-hover:bg-blue-50 transition">
                        {{-- Icon + Name --}}
                        <div class="flex items-center gap-3 mb-3">
                            @if($facility->icon)
                                <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                                    <i class="{{ $facility->icon }} text-blue-600 text-sm"></i>
                                </span>
                            @endif
                            <h3 class="font-display text-xl font-bold text-gray-900 group-hover:text-blue-700 transition">
                                {{ $facility->name }}
                            </h3>
                        </div>

                        <p class="text-gray-600 leading-relaxed text-sm mb-4">
                            {{ Str::limit($facility->description, 120) }}
                        </p>

                        {{-- Kondisi badge --}}
                        @if($facility->kondisi)
                            @php
                                $kondisiMap = [
                                    'tersedia'  => ['bg-green-100 text-green-700',  'fas fa-check-circle', 'Tersedia'],
                                    'perbaikan' => ['bg-yellow-100 text-yellow-700', 'fas fa-tools',        'Perbaikan'],
                                    'belum_ada' => ['bg-red-100 text-red-700',       'fas fa-times-circle', 'Belum Ada'],
                                    'akan_ada'  => ['bg-blue-100 text-blue-700',     'fas fa-clock',        'Akan Ada'],
                                ];
                                $k = $kondisiMap[$facility->kondisi] ?? ['bg-gray-100 text-gray-600', 'fas fa-info-circle', $facility->kondisi];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $k[0] }} mb-4">
                                <i class="{{ $k[1] }}"></i> {{ $k[2] }}
                            </span>
                        @endif

                        <div class="flex items-center text-blue-600 font-semibold text-sm group-hover:translate-x-1 transition-transform">
                            Lihat Detail
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full bg-linear-to-br from-blue-50 to-blue-100 p-12 rounded-2xl text-center">
                    <i class="fas fa-building text-5xl text-blue-300 mb-4"></i>
                    <p class="text-gray-600 text-lg font-semibold">Belum ada fasilitas yang ditambahkan</p>
                    <p class="text-gray-500 text-sm mt-2">Data fasilitas sedang dalam proses pembaruan</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-linear-to-r from-blue-700 to-blue-600 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="font-display text-4xl font-bold mb-6">Kunjungi Sekolah Kami</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
            Lihat langsung semua fasilitas modern kami dan bagaimana kami menciptakan lingkungan belajar yang inspiratif.
        </p>
        <a href="https://wa.me/628123456789"
            class="inline-block bg-yellow-300 hover:bg-yellow-400 text-gray-900 font-bold py-4 px-8 rounded-xl shadow-lg transition-all hover:-translate-y-1">
            Hubungi Kami
            <span class="ml-2">→</span>
        </a>
    </div>
</section>
</div>