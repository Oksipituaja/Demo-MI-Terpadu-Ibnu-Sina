<div class="relative w-full md:max-w-md mx-auto">
    <div class="absolute -inset-4 bg-gradient-to-r from-blue-600/20 to-yellow-300/20 rounded-3xl blur-2xl"></div>

    @if ($heroImage && $heroImage->image)
        <img src="{{ asset('storage/' . $heroImage->image) }}" alt="{{ config('app.name') }}"
            /* Ganti ke aspect-[4/5] */
            class="relative rounded-3xl shadow-2xl w-full h-auto object-cover aspect-[4/5]"
            onerror="this.style.display='none'; document.querySelector('[data-fallback]').style.display='flex'">
    @else
        <img src="{{ asset('hero_image.png') }}" alt="{{ config('app.name') }}"
            class="relative rounded-3xl shadow-2xl w-full h-auto object-cover aspect-[4/5]"
            onerror="this.style.display='none'; document.querySelector('[data-fallback]').style.display='flex'">
    @endif

    <div data-fallback class="hidden relative rounded-3xl shadow-2xl w-full bg-gray-300 aspect-[4/5] flex items-center justify-center overflow-hidden">
        <i class="fas fa-school text-7xl text-gray-500 opacity-30 absolute"></i>
        <div class="text-gray-700 text-center z-10 px-6">
            <h3 class="font-display text-2xl font-bold mb-2">{{ config('app.name') }}</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Institusi Pendidikan dengan Fasilitas Modern & Tenaga Profesional</p>
        </div>
    </div>

    <div class="absolute -bottom-4 -right-4 md:-bottom-6 md:-right-6 bg-white p-3 md:p-4 rounded-2xl shadow-xl scale-90 md:scale-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 md:w-12 md:h-12 bg-green-500 rounded-full flex items-center justify-center">
                <span class="text-xl md:text-2xl text-white">✓</span>
            </div>
            <div>
                <div class="font-bold text-gray-900 text-sm md:text-base">Terakreditasi A</div>
                <div class="text-xs md:text-sm text-gray-600">Kualitas Terjamin</div>
            </div>
        </div>
    </div>
</div>