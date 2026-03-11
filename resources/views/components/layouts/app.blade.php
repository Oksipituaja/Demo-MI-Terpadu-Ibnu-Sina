<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MI Terpadu Ibnu Sina') }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}"
        type="image/x-icon" alt="Logo">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Dropdown */
        .has-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%);
            min-width: 200px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.06);
            opacity: 0;
            visibility: hidden;
            transform: translateX(-50%) translateY(-8px);
            transition: all 0.2s ease;
            z-index: 100;
            padding: 6px;
        }

        .has-dropdown:hover .dropdown-menu,
        .has-dropdown:focus-within .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 12px;
            height: 12px;
            background: white;
            border-left: 1px solid rgba(0, 0, 0, 0.06);
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            transform: translateX(-50%) rotate(45deg);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.15s;
            white-space: nowrap;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background: #EFF6FF;
            color: #1D4ED8;
        }

        .dropdown-item i {
            width: 16px;
            color: #6B7280;
            font-size: 13px;
        }

        .dropdown-item:hover i {
            color: #1D4ED8;
        }

        /* Nav link */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            padding: 6px 4px;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1D4ED8;
            border-bottom-color: #1D4ED8;
        }

        .nav-link .chevron {
            font-size: 10px;
            transition: transform 0.2s;
        }

        .has-dropdown:hover .nav-link .chevron {
            transform: rotate(180deg);
        }

        /* Mobile nav */
        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #374151;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.15s;
        }

        .mobile-nav-link:hover {
            background: #EFF6FF;
            color: #1D4ED8;
        }

        .mobile-section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #9CA3AF;
            padding: 8px 16px 4px;
        }

        /* Mobile accordion */
        .mobile-accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .mobile-accordion-content.open {
            max-height: 500px;
        }

        .mobile-accordion-btn {
            cursor: pointer;
        }

        .mobile-accordion-btn .acc-chevron {
            transition: transform 0.2s;
        }

        .mobile-accordion-btn.open .acc-chevron {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="antialiased bg-white">

    <!-- ===== HEADER ===== -->
    <header class="fixed top-0 z-50 w-full">

        <!-- Top Bar -->
        <div class="hidden py-2 text-white bg-blue-700 md:block">
            <div class="container flex items-center justify-between px-6 mx-auto text-xs font-medium">
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-2">
                        <i class="text-blue-300 fas fa-map-marker-alt"></i>
                        Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457
                    </span>
                </div>
                <div class="flex items-center gap-5">
                    <a href="tel:0225947234" class="flex items-center gap-2 transition-colors hover:text-yellow-300">
                        <i class="fas fa-phone"></i> (123) 4567-8901
                    </a>
                    <span class="flex items-center gap-2"><i class="fas fa-envelope"></i>
                        info&#64;miterpaduibnusina.sch.id</span>
                    <div class="flex items-center gap-3 pl-3 ml-2 border-l border-blue-600">
                        <a href="https://www.facebook.com/mitiskembangjepara/" class="transition-colors hover:text-yellow-300"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/mi_terpadu_ibnu_sina" class="transition-colors hover:text-yellow-300"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@mitismedia5043" class="transition-colors hover:text-yellow-300"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Nav -->
        <nav class="bg-white border-b border-gray-100 shadow-md">
            <div class="container flex items-center justify-between gap-6 px-6 mx-auto h-18" style="height:72px">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                    {{-- <div class="flex items-center justify-center rounded-full shadow-md w-11 h-11 bg-gradient-to-br from-blue-700 to-blue-500 shadow-blue-200"> --}}
                    <div class="flex items-center justify-center rounded-full w-11 h-11 bg-gradient-to-b">
                        {{-- <span class="text-base font-bold text-white">SD</span> --}}
                        <img src="{{ asset('storage/MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" alt="Logo">
                    </div>
                    <div>
                        <div class="text-lg font-bold leading-tight text-blue-700">
                            {{ config('app.name', 'MI Terpadu Ibnu Sina') }}</div>
                        <div class="text-[10px] text-gray-400 font-semibold tracking-widest uppercase">Madrasah
                            Ibtidaiyah</div>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <ul class="items-center hidden gap-1 lg:flex">

                    <li>
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="text-xs fas fa-home"></i> Beranda
                        </a>
                    </li>

                    <!-- Profil Dropdown -->
                    <li class="has-dropdown">
                        <a href="#" class="nav-link">
                            <i class="text-xs fas fa-user-circle"></i> Profil
                            <i class="fas fa-chevron-down chevron"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('about') }}?section=sambutan" class="dropdown-item">
                                <i class="fas fa-user-tie"></i> Sambutan Kepala Sekolah
                            </a>
                            <a href="{{ route('about') }}?section=visi-misi&expanded=1" class="dropdown-item">
                                <i class="fas fa-bullseye"></i> Visi & Misi
                            </a>
                            <a href="{{ route('about') }}?section=tentang&expanded=1" class="dropdown-item">
                                <i class="fas fa-info-circle"></i> Tentang Kami
                            </a>
                            <a href="{{ route('teachers') }}" class="dropdown-item">
                                <i class="fas fa-chalkboard-teacher"></i> Tenaga Pendidik
                            </a>
                        </div>
                    </li>

                    <!-- Akademik Dropdown -->
                    <li class="has-dropdown">
                        <a href="#" class="nav-link">
                            <i class="text-xs fas fa-book-open"></i> Akademik
                            <i class="fas fa-chevron-down chevron"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('mata-pelajaran') }}" class="dropdown-item">
                                <i class="fas fa-book"></i> Mata Pelajaran
                            </a>
                            <a href="{{ route('peraturan') }}" class="dropdown-item">
                                <i class="fas fa-gavel"></i> Peraturan Sekolah
                            </a>
                            <a href="{{ route('news') }}" class="dropdown-item">
                                <i class="fas fa-newspaper"></i> Berita
                            </a>
                            <a href="{{ route('prestasi.index') }}" class="dropdown-item">
                                <i class="fas fa-trophy"></i> Prestasi
                            </a>
                            <a href="{{ route('facilities') }}" class="dropdown-item">
                                <i class="fas fa-building"></i> Fasilitas
                            </a>
                        </div>
                    </li>

                    <!-- Kegiatan Dropdown -->
                    <li class="has-dropdown">
                        <a href="#" class="nav-link">
                            <i class="text-xs fas fa-calendar-alt"></i> Kegiatan
                            <i class="fas fa-chevron-down chevron"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('home') }}#agenda" class="dropdown-item">
                                <i class="fas fa-calendar-check"></i> Agenda
                            </a>
                            <a href="{{ route('gallery') }}" class="dropdown-item">
                                <i class="fas fa-images"></i> Galeri
                            </a>
                        </div>
                    </li>

                </ul>

                <!-- CTA Buttons -->
                <div class="items-center hidden gap-3 lg:flex shrink-0">
                    <a href="{{ route('ppdb') }}"
                        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-blue-200 transition-all hover:-translate-y-0.5">
                        <i class="fas fa-graduation-cap"></i> SPMB
                    </a>
                    <a href="{{ route('home') }}#kontak"
                        class="flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2.5 px-5 rounded-xl text-sm shadow-md shadow-yellow-200 transition-all hover:-translate-y-0.5">
                        <i class="fas fa-envelope"></i> Hubungi
                    </a>
                </div>

                <!-- Mobile Burger -->
                <button id="mobileMenuBtn"
                    class="lg:hidden flex flex-col gap-1.5 p-2 rounded-lg hover:bg-gray-100 transition">
                    <span class="w-6 h-0.5 bg-gray-700 rounded transition-all" id="bar1"></span>
                    <span class="w-6 h-0.5 bg-gray-700 rounded transition-all" id="bar2"></span>
                    <span class="w-6 h-0.5 bg-gray-700 rounded transition-all" id="bar3"></span>
                </button>

            </div>
        </nav>

        <!-- Mobile Menu Overlay -->
        <div id="mobileOverlay"
            class="fixed inset-0 z-40 transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden bg-black/40 backdrop-blur-sm">
        </div>

        <!-- Mobile Drawer -->
        <div id="mobileDrawer"
            class="fixed top-0 right-0 z-50 h-full overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white shadow-2xl lg:hidden w-80">
            <div class="p-5">
                <!-- Drawer Header -->
                <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex items-center justify-center rounded-full w-9 h-9 bg-gradient-to-br from-blue-700 to-blue-500">
                            <span class="text-sm font-bold text-white">MI</span>
                        </div>
                        <span class="font-bold text-blue-700">{{ config('app.name') }}</span>
                    </div>
                    <button id="closeMobileMenu"
                        class="flex items-center justify-center w-8 h-8 text-xl text-gray-500 transition rounded-lg hover:bg-gray-100">×</button>
                </div>

                <!-- Menu Items -->
                <nav class="space-y-1">
                    <a href="{{ route('home') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-home"></i> Beranda
                    </a>

                    <div class="mobile-section-title">Profil</div>
                    <a href="{{ route('about') }}?section=sambutan" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-user-tie"></i> Sambutan Kepala Sekolah
                    </a>
                    <a href="{{ route('about') }}?section=visi-misi&expanded=1" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-bullseye"></i> Visi & Misi
                    </a>
                    <a href="{{ route('about') }}?section=tentang&expanded=1" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-info-circle"></i> Tentang Kami
                    </a>
                    <a href="{{ route('teachers') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-chalkboard-teacher"></i> Tenaga Pendidik
                    </a>

                    <div class="mobile-section-title">Akademik</div>
                    <a href="{{ route('mata-pelajaran') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-book"></i> Mata Pelajaran
                    </a>
                    <a href="{{ route('peraturan') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-gavel"></i> Peraturan Sekolah
                    </a>
                    <a href="{{ route('news') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-newspaper"></i> Berita
                    </a>
                    <a href="{{ route('prestasi.index') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-trophy"></i> Prestasi
                    </a>
                    <a href="{{ route('facilities') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-building"></i> Fasilitas
                    </a>

                    <div class="mobile-section-title">Kegiatan</div>
                    <a href="{{ route('home') }}#agenda" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-calendar-check"></i> Agenda
                    </a>
                    <a href="{{ route('gallery') }}" class="mobile-nav-link">
                        <i class="w-5 text-blue-500 fas fa-images"></i> Galeri
                    </a>

                    <div class="flex flex-col gap-3 pt-4 mt-4 border-t border-gray-100">
                        <a href="{{ route('ppdb') }}"
                            class="flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl">
                            <i class="fas fa-graduation-cap"></i> SPMB / PPDB
                        </a>
                        <a href="{{ route('home') }}#kontak"
                            class="flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-gray-900 transition bg-yellow-400 hover:bg-yellow-500 rounded-xl">
                            <i class="fas fa-envelope"></i> Hubungi Kami
                        </a>
                    </div>
                </nav>
            </div>
        </div>

    </header>

    <!-- Main Content -->
    <main class="pt-[104px] md:pt-[112px]">
        {{ $slot }}
    </main>

    <!-- ===== FOOTER ===== -->
    <footer id="kontak" class="text-gray-400 bg-gray-950">

        {{-- Grid Info Utama — map dipindah inline dengan kontak --}}
        <div class="max-w-6xl px-6 pb-10 mx-auto pt-14">

            {{-- Grid 4 Kolom --}}
            <div class="grid grid-cols-1 gap-10 pb-12 border-b sm:grid-cols-2 lg:grid-cols-4 border-white/5">

                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-5">
                        <div
                            class="flex items-center justify-center shadow-lg w-11 h-11 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-blue-900/40">
                            <span class="text-sm font-black tracking-tight text-white">MI</span>
                        </div>
                        <div>
                            <div class="text-sm font-bold leading-tight text-white">{{ config('app.name') }}</div>
                            <div class="text-xs font-medium text-blue-400">Sekolah Dasar Negeri</div>
                        </div>
                    </div>
                    <p class="mb-6 text-sm leading-relaxed text-gray-500">
                        Sekolah Dasar Negeri yang berkomitmen mencetak generasi unggul, berkarakter, dan berdaya saing
                        global melalui Kurikulum Merdeka.
                    </p>
                    {{-- Social Media --}}
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/mitiskembangjepara/" title="Facebook"
                            class="w-9 h-9 bg-gray-800 hover:bg-blue-600 text-gray-400 hover:text-white rounded-xl flex items-center justify-center transition-all hover:-translate-y-0.5">
                            <i class="text-xs fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/mi_terpadu_ibnu_sina" title="Instagram"
                            class="w-9 h-9 bg-gray-800 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 text-gray-400 hover:text-white rounded-xl flex items-center justify-center transition-all hover:-translate-y-0.5">
                            <i class="text-xs fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@mitismedia5043" title="YouTube"
                            class="w-9 h-9 bg-gray-800 hover:bg-red-600 text-gray-400 hover:text-white rounded-xl flex items-center justify-center transition-all hover:-translate-y-0.5">
                            <i class="text-xs fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest text-gray-500 uppercase">Halaman</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Beranda</a>
                        </li>
                        <li><a href="{{ route('about') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Tentang
                                Kami</a></li>
                        <li><a href="{{ route('teachers') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Tenaga
                                Pendidik</a></li>
                        <li><a href="{{ route('mata-pelajaran') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Mata
                                Pelajaran</a></li>
                        <li><a href="{{ route('peraturan') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Peraturan
                                Sekolah</a></li>
                        <li><a href="{{ route('prestasi.index') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Prestasi</a>
                        </li>
                        <li><a href="{{ route('facilities') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Fasilitas</a>
                        </li>
                        <li><a href="{{ route('gallery') }}"
                                class="flex items-center gap-2 text-gray-400 transition-colors hover:text-white group"><i
                                    class="text-xs text-gray-700 transition-colors fas fa-chevron-right group-hover:text-blue-400"></i>Galeri</a>
                        </li>
                    </ul>
                </div>

                {{-- Kontak + Map mini (FIX: gabung, hapus duplikasi alamat) --}}
                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest text-gray-500 uppercase">Kontak</h4>
                    <ul class="mb-5 space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 bg-blue-600/15 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <i class="text-xs text-blue-400 fas fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 mb-0.5">Telepon</p>
                                <a href="tel:02259471234"
                                    class="font-medium text-gray-300 transition-colors hover:text-white">(022)
                                    5947-1234</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 bg-blue-600/15 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <i class="text-xs text-blue-400 fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 mb-0.5">Email</p>
                                <a href="mailto:info&#64;miterpaduibnusina.sch.id"
                                    class="font-medium text-gray-300 transition-colors hover:text-white">info&#64;miterpaduibnusina.sch.id</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 bg-blue-600/15 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <i class="text-xs text-blue-400 fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 mb-0.5">Alamat</p>
                                <span class="leading-relaxed text-gray-300"> Jl. Raya Bangsri - Keling KM.4, Dukuh
                                    Segawe, <br>Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457</span>
                            </div>
                        </li>
                    </ul>

                    {{-- FIX: Map diperkecil, dipindah ke dalam kolom Kontak --}}
                    <div class="h-32 overflow-hidden rounded-xl ring-1 ring-white/5">
                        <iframe class="w-full h-full"
                            src="https://maps.google.com/maps?q=-6.507694,110.794806&hl=id&z=16&output=embed"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            style="border:0;"></iframe>
                    </div>
                    <a href="https://maps.app.goo.gl/D3CUGH9acTNJZzaH7" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-1.5 text-xs text-blue-400 hover:text-blue-300 mt-2 transition-colors">
                        <i class="fas fa-external-link-alt text-[10px]"></i> Buka di Google Maps
                    </a>
                </div>

                {{-- Jam Operasional --}}
                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest text-gray-500 uppercase">Jam Operasional</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center justify-between py-2.5 border-b border-white/5">
                            <span class="text-xs text-gray-500">Senin – Jumat</span>
                            <span
                                class="font-semibold text-white text-xs bg-blue-600/20 text-blue-300 px-2.5 py-1 rounded-full">07:00
                                – 14:00</span>
                        </li>
                        <li class="flex items-center justify-between py-2.5 border-b border-white/5">
                            <span class="text-xs text-gray-500">Sabtu</span>
                            <span
                                class="font-semibold text-xs bg-blue-600/20 text-blue-300 px-2.5 py-1 rounded-full">07:00
                                – 12:00</span>
                        </li>
                        <li class="flex items-center justify-between py-2.5">
                            <span class="text-xs text-gray-500">Minggu</span>
                            <span
                                class="font-semibold text-xs bg-red-600/20 text-red-400 px-2.5 py-1 rounded-full">Libur</span>
                        </li>
                    </ul>

                    <div class="p-4 mt-6 border bg-yellow-400/5 border-yellow-400/10 rounded-xl">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="text-xs text-yellow-400 fas fa-info-circle"></i>
                            <span class="text-xs font-semibold text-yellow-400">Info SPMB</span>
                        </div>
                        <p class="text-xs leading-relaxed text-gray-500">Pendaftaran peserta didik baru dibuka setiap
                            awal tahun ajaran.</p>
                        <a href="{{ route('ppdb') }}"
                            class="text-xs text-yellow-400 hover:text-yellow-300 font-semibold mt-1.5 inline-flex items-center gap-1 transition-colors">
                            Lihat info SPMB <i class="text-xs fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>

            {{-- Copyright Bar --}}
            <div class="flex flex-col items-center justify-between gap-3 pt-8 md:flex-row">
                <p class="text-xs text-gray-600">
                    © {{ date('Y') }} <span class="font-medium text-gray-500">{{ config('app.name') }}</span>.
                    Semua hak dilindungi.
                </p>
                <div class="flex items-center gap-1 text-xs text-gray-600">
                    <a href="{{ route('privacy') }}"
                        class="px-3 py-1 transition-colors rounded-lg hover:text-gray-400 hover:bg-white/5">Kebijakan
                        Privasi</a>
                    <span class="text-gray-800">·</span>
                    <a href="{{ route('terms') }}"
                        class="px-3 py-1 transition-colors rounded-lg hover:text-gray-400 hover:bg-white/5">Syarat &
                        Ketentuan</a>
                </div>
            </div>
        </div>

    </footer>

    <script>
        const btn = document.getElementById('mobileMenuBtn');
        const drawer = document.getElementById('mobileDrawer');
        const overlay = document.getElementById('mobileOverlay');
        const closeBtn = document.getElementById('closeMobileMenu');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');

        function openMenu() {
            drawer.classList.remove('translate-x-full');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            bar1.style.transform = 'translateY(8px) rotate(45deg)';
            bar2.style.opacity = '0';
            bar3.style.transform = 'translateY(-8px) rotate(-45deg)';
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            drawer.classList.add('translate-x-full');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            bar1.style.transform = '';
            bar2.style.opacity = '';
            bar3.style.transform = '';
            document.body.style.overflow = '';
        }

        btn.addEventListener('click', openMenu);
        closeBtn.addEventListener('click', closeMenu);
        overlay.addEventListener('click', closeMenu);
    </script>
</body>

</html>
