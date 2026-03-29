<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" type="image/x-icon">
    <title>@yield('title', 'Admin Panel - MI Terpadu Ibnu Sina')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .flatpickr-calendar { z-index: 9999 !important; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-64 text-white bg-gray-900">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-xl font-bold">MI Terpadu Ibnu Sina</h1>
                <p class="text-xs text-gray-400">Panel Admin</p>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="w-5 mr-2 fas fa-chart-line"></i> Dashboard
                </a>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 mb-2 text-xs font-semibold tracking-wider text-gray-500 uppercase">Kelola Konten</p>

                    <a href="{{ route('admin.news.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.news.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-newspaper"></i> Berita & Artikel
                    </a>
                    <a href="{{ route('admin.teachers.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.teachers.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-chalkboard-user"></i> Data Guru
                    </a>
                    <a href="{{ route('admin.galleries.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-images"></i> Galeri Foto
                    </a>
                    <a href="{{ route('admin.agendas.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.agendas.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-calendar"></i> Agenda Kegiatan
                    </a>
                    <a href="{{ route('admin.facilities.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.facilities.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-building"></i> Fasilitas
                    </a>
                    <a href="{{ route('admin.about.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.about.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-info-circle"></i> Tentang Sekolah
                    </a>
                    <a href="{{ route('admin.prestasis.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.prestasi.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-trophy"></i> Prestasi Siswa
                    </a>
                    <a href="{{ route('admin.registrations.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.registrations.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-user-check"></i> Pendaftaran Siswa
                    </a>
                    <a href="{{ route('admin.settings.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fab fa-google"></i> Pengaturan PPDB
                    </a>
                </div>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 mb-2 text-xs font-semibold tracking-wider text-gray-500 uppercase">Sistem</p>
                    <a href="{{ route('admin.management-account.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.management-account.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-users-cog"></i> Manajemen Akun
                    </a>
                </div>
            </nav>

            <!-- User info & logout -->
            <div class="absolute bottom-0 left-0 right-0 w-64 p-4 bg-gray-800 border-t border-gray-700">
                <div class="flex items-center mb-3">
                    <div class="flex items-center justify-center w-10 h-10 text-sm font-semibold text-white bg-blue-600 rounded-full shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="ml-3 overflow-hidden">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->role?->label() ?? 'Admin' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-sm text-left text-white bg-red-600 rounded-lg hover:bg-red-700">
                        <i class="mr-2 fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <div class="p-4 bg-white border-b border-gray-200 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800">@yield('page_title', 'Dashboard')</h2>
                <p class="text-sm text-gray-600">@yield('page_subtitle', 'Kelola konten website sekolah')</p>
            </div>

            <div class="flex-1 p-6 overflow-auto">

                @if($errors->any())
                    <div id="flash-errors"
                        class="flex items-start justify-between gap-3 px-4 py-3 mb-4 text-red-800 border border-red-200 rounded-lg bg-red-50">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                            <div>
                                <p class="mb-1 text-sm font-semibold">{{ count($errors) }} kesalahan ditemukan:</p>
                                <ul class="text-sm list-disc list-inside space-y-0.5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button onclick="document.getElementById('flash-errors').remove()"
                            class="ml-2 text-lg leading-none text-red-400 hover:text-red-600 shrink-0">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('success'))
                    <div id="flash-success"
                        class="flex items-center justify-between gap-3 px-4 py-3 mb-4 text-green-800 border border-green-200 rounded-lg bg-green-50">
                        <div class="flex items-center gap-2">
                            <i class="text-green-600 fas fa-check-circle"></i>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                        <button onclick="document.getElementById('flash-success').remove()"
                            class="ml-4 text-lg leading-none text-green-500 hover:text-green-700 shrink-0">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div id="flash-error"
                        class="flex items-center justify-between gap-3 px-4 py-3 mb-4 text-red-800 border border-red-200 rounded-lg bg-red-50">
                        <div class="flex items-center gap-2">
                            <i class="text-red-600 fas fa-times-circle"></i>
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                        </div>
                        <button onclick="document.getElementById('flash-error').remove()"
                            class="ml-4 text-lg leading-none text-red-500 hover:text-red-700 shrink-0">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            ['flash-success', 'flash-error'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) {
                    el.style.transition = 'opacity 0.5s ease';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 500);
                }
            });
        }, 4000);
    </script>

    @stack('scripts')
</body>
</html>