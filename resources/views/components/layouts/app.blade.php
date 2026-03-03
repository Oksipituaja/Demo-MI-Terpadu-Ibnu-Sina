<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SD Bangsri School') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-bxu3zjQQ.css') }}">
    <script type="module" src="{{ asset('build/assets/app-CKl8NZMC.js') }}" defer></script>
    <style>
        .font-display {
            font-family: 'Inter', sans-serif;
        }
        .font-body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="font-body antialiased bg-white">
    <!-- Header -->
    <header class="w-full fixed top-0 z-50 shadow-lg transition-transform duration-300">
        <!-- Top Bar -->
        <div class="bg-blue-700 text-white py-2 hidden md:block">
            <div class="container mx-auto px-6 flex justify-between items-center text-xs font-medium">
                <div class="flex items-center space-x-6">
                    <div class="flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Sekolah Buka (Tutup 14:00)
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="https://wa.me/628123456789" class="flex items-center hover:text-yellow-300 transition-colors duration-300">
                        <span class="mr-2">📞</span> Chat Admin: 0812-3456-7890
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="bg-white/90 backdrop-blur-md border-b border-gray-100/50">
            <div class="container mx-auto px-6 h-20 flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <div class="w-12 h-12 bg-linear-to-br from-blue-700 to-blue-500 rounded-full flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-bold text-xl">SD</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-display font-bold text-blue-700 text-xl leading-none">{{ config('app.name', 'SD BANGSRI') }}</h1>
                        <span class="text-[10px] text-gray-500 font-medium tracking-widest uppercase mt-1">Unggul & Berkarakter</span>
                    </div>
                </a>

                <ul class="hidden lg:flex items-center space-x-8">
                    <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link">Tentang</a></li>
                    <li><a href="{{ route('teachers') }}" class="nav-link">Guru</a></li>
                    <li><a href="{{ route('facilities') }}" class="nav-link">Fasilitas</a></li>
                    <li><a href="{{ route('news') }}" class="nav-link">Berita</a></li>
                    <li><a href="{{ route('gallery') }}" class="nav-link">Galeri</a></li>
                    <li><a href="{{ route('home') }}#agenda" class="nav-link">Agenda</a></li>
                    <li><a href="{{ route('home') }}#kontak" class="nav-link">Kontak</a></li>
                </ul>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('ppdb') }}" class="hidden sm:flex items-center bg-linear-to-r from-yellow-400 to-yellow-300 hover:from-yellow-300 hover:to-yellow-400 text-gray-900 font-bold py-3 px-6 rounded-xl shadow-lg shadow-yellow-400/30 transition-all hover:-translate-y-1 active:scale-95">
                        Daftar PPDB
                        <span class="ml-2">→</span>
                    </a>
                    <button id="mobileMenuButton" class="lg:hidden text-blue-700 text-3xl hover:scale-110 transition-transform">☰</button>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="lg:hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-opacity duration-300">
            <div id="mobileMenuPanel" class="fixed right-0 top-0 h-full w-80 bg-white shadow-2xl transform translate-x-full transition-transform duration-300">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="font-display font-bold text-blue-700 text-xl">Menu</h3>
                        <button id="closeMobileMenu" class="text-gray-500 hover:text-blue-700 text-3xl">×</button>
                    </div>
                    <nav class="space-y-4">
                        <a href="{{ route('home') }}" class="mobile-nav-link">Beranda</a>
                        <a href="{{ route('about') }}" class="mobile-nav-link">Tentang</a>
                        <a href="{{ route('teachers') }}" class="mobile-nav-link">Guru</a>
                        <a href="{{ route('facilities') }}" class="mobile-nav-link">Fasilitas</a>
                        <a href="{{ route('news') }}" class="mobile-nav-link">Berita</a>
                        <a href="{{ route('gallery') }}" class="mobile-nav-link">Galeri</a>
                        <a href="{{ route('home') }}#agenda" class="mobile-nav-link">Agenda</a>
                        <a href="{{ route('home') }}#kontak" class="mobile-nav-link">Kontak</a>
                        <div class="pt-4 border-t border-gray-200">
                            <a href="{{ route('ppdb') }}" class="block bg-linear-to-r from-yellow-400 to-yellow-300 text-gray-900 font-bold py-3 px-6 rounded-xl text-center shadow-lg">
                                Daftar PPDB →
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <!-- Google Maps Section -->
            <div class="mb-12">
                <h3 class="font-bold text-white text-xl mb-4">Lokasi Sekolah</h3>
                <div class="rounded-lg overflow-hidden shadow-lg h-80">
                    <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.825671156556!2d110.40635561111111!3d-7.055677022222222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708d4d4d4d4d4d%3A0x1234567890abcdef!2sSD%20Bangsri!5e0!3m2!1sid!2sid!4v1234567890" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border:0;"></iframe>
                </div>
                <p class="text-sm text-gray-400 mt-4">📍 Jl. Pendidikan No. 123, Kota, Provinsi 12345</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <!-- School Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-linear-to-br from-blue-500 to-blue-400 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold">SD</span>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-white">{{ config('app.name') }}</h3>
                            <p class="text-xs text-gray-500">Unggul & Berkarakter</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Sekolah yang berkomitmen memberikan pendidikan berkualitas dengan fasilitas modern dan tenaga pendidik profesional.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('news') }}" class="hover:text-blue-400 transition-colors">Berita</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-blue-400 transition-colors">Galeri</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-bold text-white mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="mr-2">📞</span>
                            <span>0812-3456-7890</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">✉️</span>
                            <span>info@sdbangsri.sch.id</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">📍</span>
                            <span>Jl. Pendidikan No. 123<br>Kota, Provinsi 12345</span>
                        </li>
                    </ul>
                </div>

                <!-- Hours -->
                <div>
                    <h4 class="font-bold text-white mb-4">Jam Operasional</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between">
                            <span>Senin - Jumat:</span>
                            <span class="font-semibold">07:00 - 14:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu:</span>
                            <span class="font-semibold">07:00 - 12:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Minggu:</span>
                            <span class="font-semibold">Libur</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-500 mb-4 md:mb-0">
                        © 2026 {{ config('app.name') }}. Semua hak dilindungi.
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('privacy') }}" class="text-sm hover:text-blue-400 transition-colors">Kebijakan Privasi</a>
                        <a href="{{ route('terms') }}" class="text-sm hover:text-blue-400 transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        const closeMobileMenu = document.getElementById('closeMobileMenu');

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
                mobileMenuPanel.classList.remove('translate-x-full');
            });
        }

        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', () => {
                mobileMenu.classList.add('opacity-0', 'pointer-events-none');
                mobileMenuPanel.classList.add('translate-x-full');
            });
        }

        if (mobileMenu) {
            mobileMenu.addEventListener('click', (e) => {
                if (e.target === mobileMenu) {
                    mobileMenu.classList.add('opacity-0', 'pointer-events-none');
                    mobileMenuPanel.classList.add('translate-x-full');
                }
            });
        }
    </script>
</body>
</html>
