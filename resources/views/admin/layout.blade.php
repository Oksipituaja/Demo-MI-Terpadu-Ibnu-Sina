<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - SD Bangsri School')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .flatpickr-calendar { z-index: 9999; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-xl font-bold">SD Bangsri Admin</h1>
                <p class="text-xs text-gray-400">Management System</p>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 text-xs uppercase text-gray-500 font-semibold mb-3">Content Management</p>

                    <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.news.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-newspaper mr-2"></i> News & Articles
                    </a>

                    <a href="{{ route('admin.teachers.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.teachers.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-chalkboard-user mr-2"></i> Teachers
                    </a>

                    <a href="{{ route('admin.galleries.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-images mr-2"></i> Gallery
                    </a>

                    <a href="{{ route('admin.agendas.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.agendas.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-calendar mr-2"></i> Agenda
                    </a>

                    <a href="{{ route('admin.facilities.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.facilities.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-building mr-2"></i> Facilities
                    </a>

                    <a href="{{ route('admin.about.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.about.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-info-circle mr-2"></i> About
                    </a>

                    <a href="{{ route('admin.prestasis.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.prestasis.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-trophy mr-2"></i> Prestasi
                    </a>

                    <a href="{{ route('admin.registrations.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.registrations.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-user-check mr-2"></i> Registrations
                    </a>
                </div>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 text-xs uppercase text-gray-500 font-semibold mb-3">System Management</p>

                    <a href="{{ route('admin.management-account.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('admin.management-account.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                        <i class="fas fa-users-cog mr-2"></i> Account Management
                    </a>
                </div>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-800 w-64 bg-gray-800">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">Admin</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm bg-red-600 hover:bg-red-700 rounded text-left">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm p-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800">@yield('page_title', 'Dashboard')</h2>
                <p class="text-sm text-gray-600">@yield('page_subtitle', 'Manage your school content')</p>
            </div>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded text-red-800">
                        <p class="font-semibold mb-2">{{ count($errors) }} Error(s)</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
