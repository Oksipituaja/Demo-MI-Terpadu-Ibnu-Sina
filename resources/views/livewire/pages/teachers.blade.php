<div>
<!-- Breadcrumb -->
<div class="pt-8 pb-8 bg-gradient-to-r from-blue-700 to-blue-600">
    <div class="container mx-auto px-6">
        <nav class="flex items-center space-x-2 text-white text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <span>/</span>
            <span>Guru & Staf</span>
        </nav>
        <h1 class="font-display text-4xl font-bold text-white">Tim Pendidik Kami</h1>
        <p class="text-white/90 mt-2">Guru-guru profesional yang berdedikasi memberikan pendidikan berkualitas</p>
    </div>
</div>

<!-- Teachers Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-blue-700 font-semibold text-sm uppercase tracking-wider">Tim Profesional Kami</span>
            <h2 class="font-display text-4xl font-bold text-gray-900 mt-4 mb-6">Tenaga Pendidik & Pengajar Berpengalaman</h2>
            <p class="text-gray-600 leading-relaxed">
                Guru-guru berpengalaman dan berdedikasi yang siap membimbing setiap siswa mencapai potensi maksimal mereka.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($teachers as $teacher)
                <div class="teacher-card text-center group">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-600 to-blue-400 rounded-full mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg overflow-hidden">
                        @if($teacher->image)
                            <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-chalkboard-user text-5xl text-white"></i>
                        @endif
                    </div>
                    <h3 class="font-display text-xl font-bold text-gray-900 group-hover:text-blue-700 transition">{{ $teacher->name }}</h3>
                    <p class="text-blue-700 font-semibold mb-3 text-lg">{{ $teacher->subject }}</p>
                </div>
            @empty
                <div class="col-span-full bg-gradient-to-br from-blue-50 to-blue-100 p-12 rounded-2xl text-center">
                    <svg class="w-16 h-16 text-blue-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 8.048M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"></path>
                    </svg>
                    <p class="text-gray-600 text-lg font-semibold">Belum ada data guru yang ditambahkan</p>
                    <p class="text-gray-500 text-sm mt-2">Data guru sedang dalam proses pembaruan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            {{ $teachers->links() }}
        </div>
    </div>
</section>
</div>
