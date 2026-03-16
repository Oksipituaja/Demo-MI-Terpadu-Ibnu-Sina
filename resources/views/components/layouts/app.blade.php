<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MI Terpadu Ibnu Sina') }}</title>
    <link rel="shortcut icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}"
        type="image/x-icon" alt="Logo">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .has-dropdown { position: relative; }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%);
            min-width: 200px;
            background: #F0F4ED;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(21,128,61,0.12), 0 2px 8px rgba(21,128,61,0.08);
            border: 1px solid rgba(21,128,61,0.1);
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
            width: 12px;
            height: 12px;
            background: #F0F4ED;
            border-left: 1px solid rgba(21,128,61,0.1);
            border-top: 1px solid rgba(21,128,61,0.1);
            transform: translateX(-50%) rotate(45deg);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            color: #14532d;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.15s;
            white-space: nowrap;
            text-decoration: none;
        }

        .dropdown-item:hover { background: #15803d1a; color: #15803d; }
        .dropdown-item i { width: 16px; color: #15803d99; font-size: 13px; }
        .dropdown-item:hover i { color: #15803d; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
            font-weight: 600;
            color: #14532d;
            padding: 6px 4px;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-link:hover, .nav-link.active {
            color: #15803d;
            border-bottom-color: #EAB308;
        }

        .nav-link .chevron { font-size: 10px; transition: transform 0.2s; }
        .has-dropdown:hover .nav-link .chevron { transform: rotate(180deg); }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #14532d;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.15s;
        }

        .mobile-nav-link:hover { background: #15803d1a; color: #15803d; }

        .mobile-section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #15803d99;
            padding: 8px 16px 4px;
        }

        .mobile-accordion-content { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .mobile-accordion-content.open { max-height: 500px; }
        .mobile-accordion-btn { cursor: pointer; }
        .mobile-accordion-btn .acc-chevron { transition: transform 0.2s; }
        .mobile-accordion-btn.open .acc-chevron { transform: rotate(180deg); }
    </style>
</head>

<body class="antialiased" style="background: #F0F4ED">

    <header class="fixed top-0 z-50 w-full">

        <!-- Top Bar -->
        <div class="hidden py-2 text-white md:block" style="background: #15803d">
            <div class="container flex items-center justify-between px-6 mx-auto text-xs font-medium">
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt" style="color: #86efac"></i>
                        Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457
                    </span>
                </div>
                <div class="flex items-center gap-5">
                    <a href="tel:0225947234" class="flex items-center gap-2 transition-colors hover:text-yellow-300">
                        <i class="fas fa-phone"></i> (123) 4567-8901
                    </a>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-envelope"></i> info&#64;miterpaduibnusina.sch.id
                    </span>
                    <div class="flex items-center gap-3 pl-3 ml-2 border-l" style="border-color: #15803d80">
                        <a href="https://www.facebook.com/mitiskembangjepara/" class="transition-colors hover:text-yellow-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/mi_terpadu_ibnu_sina" class="transition-colors hover:text-yellow-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@mitismedia5043" class="transition-colors hover:text-yellow-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Nav -->
        <nav class="border-b shadow-md" style="background: #F0F4ED; border-color: #15803d26">
            <div class="container flex items-center justify-between gap-6 px-6 mx-auto" style="height:72px">

                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                    <div class="flex items-center justify-center rounded-full w-11 h-11">
                        <img src="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" alt="Logo">
                    </div>
                    <div>
                        <div class="text-lg font-bold leading-tight" style="color: #15803d">
                            {{ config('app.name', 'MI Terpadu Ibnu Sina') }}</div>
                        <div class="text-[10px] font-semibold tracking-widest uppercase" style="color: #15803d80">Madrasah Ibtidaiyah</div>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <ul class="items-center hidden gap-1 lg:flex">
                    <li>
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="text-xs fas fa-home"></i> Beranda
                        </a>
                    </li>

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
                                <i class="fas fa-newspaper"></i> Berita & Pengumuman
                            </a>
                            <a href="{{ route('prestasi.index') }}" class="dropdown-item">
                                <i class="fas fa-trophy"></i> Prestasi
                            </a>
                            <a href="{{ route('facilities') }}" class="dropdown-item">
                                <i class="fas fa-building"></i> Fasilitas
                            </a>
                        </div>
                    </li>

                    <li class="has-dropdown">
                        <a href="#" class="nav-link">
                            <i class="text-xs fas fa-calendar-alt"></i> Kegiatan
                            <i class="fas fa-chevron-down chevron"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('news') }}?tab=agenda" class="dropdown-item">
                                <i class="fas fa-calendar-check"></i> Agenda Kegiatan
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
                        class="flex items-center gap-2 text-white font-bold py-2.5 px-5 rounded-xl text-sm transition-all hover:-translate-y-0.5"
                        style="background: #15803d; box-shadow: 0 4px 12px #15803d33;">
                        <i class="fas fa-graduation-cap"></i> SPMB
                    </a>
                    <a href="{{ route('home') }}#kontak"
                        class="flex items-center gap-2 font-bold py-2.5 px-5 rounded-xl text-sm transition-all hover:-translate-y-0.5"
                        style="background: #EAB308; color: #14532d; box-shadow: 0 4px 12px #EAB30833;">
                        <i class="fas fa-envelope"></i> Hubungi
                    </a>
                </div>

                <!-- Mobile Burger -->
                <button id="mobileMenuBtn" class="lg:hidden flex flex-col gap-1.5 p-2 rounded-lg transition">
                    <span class="w-6 h-0.5 rounded transition-all" id="bar1" style="background: #15803d"></span>
                    <span class="w-6 h-0.5 rounded transition-all" id="bar2" style="background: #15803d"></span>
                    <span class="w-6 h-0.5 rounded transition-all" id="bar3" style="background: #15803d"></span>
                </button>
            </div>
        </nav>

        <!-- Mobile Overlay -->
        <div id="mobileOverlay"
            class="fixed inset-0 z-40 transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden bg-black/40 backdrop-blur-sm">
        </div>

        <!-- Mobile Drawer -->
        <div id="mobileDrawer"
            class="fixed top-0 right-0 z-50 h-full overflow-y-auto transition-transform duration-300 transform translate-x-full shadow-2xl lg:hidden w-80"
            style="background: #F0F4ED">
            <div class="p-5">
                <div class="flex items-center justify-between pb-4 mb-6 border-b" style="border-color: #15803d26">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center rounded-full w-9 h-9"
                            style="background: linear-gradient(to bottom right, #15803d, #22c55e)">
                            <span class="text-sm font-bold text-white">MI</span>
                        </div>
                        <span class="font-bold" style="color: #15803d">{{ config('app.name') }}</span>
                    </div>
                    <button id="closeMobileMenu"
                        class="flex items-center justify-center w-8 h-8 text-xl transition rounded-lg"
                        style="color: #15803d">×</button>
                </div>

                <nav class="space-y-1">
                    <a href="{{ route('home') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-home" style="color: #15803d"></i> Beranda
                    </a>

                    <div class="mobile-section-title">Profil</div>
                    <a href="{{ route('about') }}?section=sambutan" class="mobile-nav-link">
                        <i class="w-5 fas fa-user-tie" style="color: #15803d"></i> Sambutan Kepala Sekolah
                    </a>
                    <a href="{{ route('about') }}?section=visi-misi&expanded=1" class="mobile-nav-link">
                        <i class="w-5 fas fa-bullseye" style="color: #15803d"></i> Visi & Misi
                    </a>
                    <a href="{{ route('about') }}?section=tentang&expanded=1" class="mobile-nav-link">
                        <i class="w-5 fas fa-info-circle" style="color: #15803d"></i> Tentang Kami
                    </a>
                    <a href="{{ route('teachers') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-chalkboard-teacher" style="color: #15803d"></i> Tenaga Pendidik
                    </a>

                    <div class="mobile-section-title">Akademik</div>
                    <a href="{{ route('mata-pelajaran') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-book" style="color: #15803d"></i> Mata Pelajaran
                    </a>
                    <a href="{{ route('peraturan') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-gavel" style="color: #15803d"></i> Peraturan Sekolah
                    </a>
                    <a href="{{ route('news') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-newspaper" style="color: #15803d"></i> Berita & Pengumuman
                    </a>
                    <a href="{{ route('prestasi.index') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-trophy" style="color: #15803d"></i> Prestasi
                    </a>
                    <a href="{{ route('facilities') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-building" style="color: #15803d"></i> Fasilitas
                    </a>

                    <div class="mobile-section-title">Kegiatan</div>
                    <a href="{{ route('news') }}?tab=agenda" class="mobile-nav-link">
                        <i class="w-5 fas fa-calendar-check" style="color: #15803d"></i> Agenda Kegiatan
                    </a>
                    <a href="{{ route('gallery') }}" class="mobile-nav-link">
                        <i class="w-5 fas fa-images" style="color: #15803d"></i> Galeri
                    </a>

                    <div class="flex flex-col gap-3 pt-4 mt-4 border-t" style="border-color: #15803d26">
                        <a href="{{ route('ppdb') }}"
                            class="flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white transition rounded-xl"
                            style="background: #15803d">
                            <i class="fas fa-graduation-cap"></i> SPMB / PPDB
                        </a>
                        <a href="{{ route('home') }}#kontak"
                            class="flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold transition rounded-xl"
                            style="background: #EAB308; color: #14532d">
                            <i class="fas fa-envelope"></i> Hubungi Kami
                        </a>
                    </div>
                </nav>
            </div>
        </div>

    </header>

    <main class="pt-[104px] md:pt-[112px]">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer id="kontak" style="background: #0f2d1a; color: #9ca3af">
        <div class="max-w-6xl px-6 pb-10 mx-auto pt-14">
            <div class="grid grid-cols-1 gap-10 pb-12 border-b sm:grid-cols-2 lg:grid-cols-4" style="border-color: #ffffff0d">

                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center shadow-lg w-11 h-11 rounded-xl"
                            style="background: linear-gradient(to bottom right, #15803d, #22c55e); box-shadow: 0 4px 12px #15803d66">
                            <span class="text-sm font-black tracking-tight text-white">MI</span>
                        </div>
                        <div>
                            <div class="text-sm font-bold leading-tight text-white">{{ config('app.name') }}</div>
                            <div class="text-xs font-medium" style="color: #4ade80">Madrasah Ibtidaiyah</div>
                        </div>
                    </div>
                    <p class="mb-6 text-sm leading-relaxed" style="color: #6b7280">
                        Madrasah Ibtidaiyah yang berkomitmen mencetak generasi unggul, berakhlak mulia, dan berdaya saing melalui pendidikan Islami yang berkualitas.
                    </p>
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/mitiskembangjepara/" title="Facebook"
                            class="w-9 h-9 rounded-xl flex items-center justify-center transition-all hover:-translate-y-0.5"
                            style="background: #15803d26; color: #4ade80">
                            <i class="text-xs fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/mi_terpadu_ibnu_sina" title="Instagram"
                            class="w-9 h-9 rounded-xl flex items-center justify-center transition-all hover:-translate-y-0.5"
                            style="background: #15803d26; color: #4ade80">
                            <i class="text-xs fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@mitismedia5043" title="YouTube"
                            class="w-9 h-9 rounded-xl flex items-center justify-center transition-all hover:-translate-y-0.5"
                            style="background: #15803d26; color: #4ade80">
                            <i class="text-xs fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest uppercase" style="color: #4ade8080">Halaman</h4>
                    <ul class="space-y-3 text-sm">
                        @foreach ([
                            ['route' => 'home',           'label' => 'Beranda'],
                            ['route' => 'about',          'label' => 'Tentang Kami'],
                            ['route' => 'teachers',       'label' => 'Tenaga Pendidik'],
                            ['route' => 'mata-pelajaran', 'label' => 'Mata Pelajaran'],
                            ['route' => 'peraturan',      'label' => 'Peraturan Sekolah'],
                            ['route' => 'prestasi.index', 'label' => 'Prestasi'],
                            ['route' => 'facilities',     'label' => 'Fasilitas'],
                            ['route' => 'gallery',        'label' => 'Galeri'],
                        ] as $item)
                        <li>
                            <a href="{{ route($item['route']) }}"
                                class="flex items-center gap-2 transition-colors hover:text-white group"
                                style="color: #9ca3af">
                                <i class="text-xs transition-colors fas fa-chevron-right group-hover:text-yellow-400" style="color: #15803d80"></i>
                                {{ $item['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest uppercase" style="color: #4ade8080">Kontak</h4>
                    <ul class="mb-5 space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5" style="background: #15803d26">
                                <i class="text-xs fas fa-phone" style="color: #4ade80"></i>
                            </div>
                            <div>
                                <p class="text-xs mb-0.5" style="color: #6b7280">Telepon</p>
                                <a href="tel:02259471234" class="font-medium transition-colors hover:text-white" style="color: #d1d5db">(022) 5947-1234</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5" style="background: #15803d26">
                                <i class="text-xs fas fa-envelope" style="color: #4ade80"></i>
                            </div>
                            <div>
                                <p class="text-xs mb-0.5" style="color: #6b7280">Email</p>
                                <a href="mailto:info&#64;miterpaduibnusina.sch.id" class="font-medium transition-colors hover:text-white" style="color: #d1d5db">info&#64;miterpaduibnusina.sch.id</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5" style="background: #15803d26">
                                <i class="text-xs fas fa-map-marker-alt" style="color: #4ade80"></i>
                            </div>
                            <div>
                                <p class="text-xs mb-0.5" style="color: #6b7280">Alamat</p>
                                <span class="leading-relaxed" style="color: #d1d5db">Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe,<br>Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457</span>
                            </div>
                        </li>
                    </ul>
                    <div class="h-32 overflow-hidden rounded-xl" style="outline: 1px solid #15803d26">
                        <iframe class="w-full h-full"
                            src="https://maps.google.com/maps?q=-6.507694,110.794806&hl=id&z=16&output=embed"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            style="border:0;"></iframe>
                    </div>
                    <a href="https://maps.app.goo.gl/D3CUGH9acTNJZzaH7" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-1.5 text-xs mt-2 transition-colors hover:text-green-300"
                        style="color: #4ade80">
                        <i class="fas fa-external-link-alt text-[10px]"></i> Buka di Google Maps
                    </a>
                </div>

                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest uppercase" style="color: #4ade8080">Jam Operasional</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center justify-between py-2.5 border-b" style="border-color: #ffffff0d">
                            <span class="text-xs" style="color: #6b7280">Senin – Jumat</span>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="background: #15803d26; color: #4ade80">07:00 – 14:00</span>
                        </li>
                        <li class="flex items-center justify-between py-2.5 border-b" style="border-color: #ffffff0d">
                            <span class="text-xs" style="color: #6b7280">Sabtu</span>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="background: #15803d26; color: #4ade80">07:00 – 12:00</span>
                        </li>
                        <li class="flex items-center justify-between py-2.5">
                            <span class="text-xs" style="color: #6b7280">Minggu</span>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="background: #7f1d1d26; color: #f87171">Libur</span>
                        </li>
                    </ul>
                    <div class="p-4 mt-6 border rounded-xl" style="background: #EAB3080d; border-color: #EAB30826">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="text-xs fas fa-info-circle" style="color: #EAB308"></i>
                            <span class="text-xs font-semibold" style="color: #EAB308">Info SPMB</span>
                        </div>
                        <p class="text-xs leading-relaxed" style="color: #6b7280">Pendaftaran peserta didik baru dibuka setiap awal tahun ajaran.</p>
                        <a href="{{ route('ppdb') }}"
                            class="text-xs font-semibold mt-1.5 inline-flex items-center gap-1 transition-colors hover:text-yellow-300"
                            style="color: #EAB308">
                            Lihat info SPMB <i class="text-xs fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>

            <div class="flex flex-col items-center justify-between gap-3 pt-8 md:flex-row">
                <p class="text-xs" style="color: #4b5563">
                    © {{ date('Y') }} <span class="font-medium" style="color: #6b7280">{{ config('app.name') }}</span>. Semua hak dilindungi.
                </p>
                <div class="flex items-center gap-1 text-xs" style="color: #4b5563">
                    <a href="{{ route('privacy') }}" class="px-3 py-1 transition-colors rounded-lg hover:text-gray-300">Kebijakan Privasi</a>
                    <span style="color: #374151">·</span>
                    <a href="{{ route('terms') }}" class="px-3 py-1 transition-colors rounded-lg hover:text-gray-300">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function initMobileMenu() {
            const btn = document.getElementById('mobileMenuBtn');
            const drawer = document.getElementById('mobileDrawer');
            const overlay = document.getElementById('mobileOverlay');
            const closeBtn = document.getElementById('closeMobileMenu');
            const bar1 = document.getElementById('bar1');
            const bar2 = document.getElementById('bar2');
            const bar3 = document.getElementById('bar3');

            if (!btn) return;

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

            btn.removeEventListener('click', openMenu);
            closeBtn.removeEventListener('click', closeMenu);
            overlay.removeEventListener('click', closeMenu);

            btn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            overlay.addEventListener('click', closeMenu);
        }

        document.addEventListener('DOMContentLoaded', initMobileMenu);
        document.addEventListener('livewire:navigated', initMobileMenu);
    </script>
    @stack('scripts')
    @livewireScripts

</body>
</html>