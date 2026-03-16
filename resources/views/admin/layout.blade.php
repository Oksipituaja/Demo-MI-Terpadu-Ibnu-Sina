<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" type="image/x-icon" alt="Logo">
    <title>@yield('title', 'Admin Panel - MI Terpadu Ibnu Sina')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .flatpickr-calendar { z-index: 9999; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 text-white bg-gray-900">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-xl font-bold">MI Terpadu Ibnu Sina Admin</h1>
                <p class="text-xs text-gray-400">Management System</p>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="mr-2 fas fa-chart-line"></i> Dashboard
                </a>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 mb-3 text-xs font-semibold text-gray-500 uppercase">Content Management</p>

                    <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.news.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-newspaper"></i> News & Articles
                    </a>

                    <a href="{{ route('admin.teachers.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.teachers.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-chalkboard-user"></i> Teachers
                    </a>

                    <a href="{{ route('admin.galleries.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-images"></i> Gallery
                    </a>

                    <a href="{{ route('admin.agendas.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.agendas.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-calendar"></i> Agenda
                    </a>

                    <a href="{{ route('admin.facilities.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.facilities.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-building"></i> Facilities
                    </a>

                    <a href="{{ route('admin.about.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.about.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-info-circle"></i> About
                    </a>

                    <a href="{{ route('admin.prestasis.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.prestasi.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-trophy"></i> Prestasi                    </a>

                    <a href="{{ route('admin.registrations.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.registrations.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-user-check"></i> Registrations
                    </a>
                </div>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 mb-3 text-xs font-semibold text-gray-500 uppercase">System Management</p>

                    <a href="{{ route('admin.management-account.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.management-account.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="mr-2 fas fa-users-cog"></i> Account Management
                    </a>
                </div>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 w-64 p-4 bg-gray-800 border-t border-gray-800">
                <div class="flex items-center mb-4">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-600 rounded-full">
                        <i class="text-white fas fa-user"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">Admin</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm text-left bg-red-600 rounded hover:bg-red-700">
                        <i class="mr-2 fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Bar -->
            <div class="p-4 bg-white border-b border-gray-200 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800">@yield('page_title', 'Dashboard')</h2>
                <p class="text-sm text-gray-600">@yield('page_subtitle', 'Manage your school content')</p>
            </div>

            <!-- Content Area -->
            <div class="flex-1 p-6 overflow-auto">
                @if($errors->any())
                    <div class="p-4 mb-4 text-red-800 border border-red-200 rounded bg-red-50">
                        <p class="mb-2 font-semibold">{{ count($errors) }} Error(s)</p>
                        <ul class="text-sm list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="p-4 mb-4 text-green-800 border border-green-200 rounded bg-green-50">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
