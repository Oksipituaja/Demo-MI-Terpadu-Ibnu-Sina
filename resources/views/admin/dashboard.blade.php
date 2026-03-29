@extends('admin.layout')

@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang di panel admin MI Terpadu Ibnu Sina')

@section('content')

<div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:grid-cols-4">

    <a href="{{ route('admin.news.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-blue-100 rounded-lg group-hover:bg-blue-200">
                <i class="text-xl text-blue-600 fas fa-newspaper"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['news_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Berita & Artikel</p>
        <p class="mt-1 text-xs text-blue-600">Kelola berita →</p>
    </a>

    <a href="{{ route('admin.teachers.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-green-100 rounded-lg group-hover:bg-green-200">
                <i class="text-xl text-green-600 fas fa-chalkboard-user"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['teachers_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Guru</p>
        <p class="mt-1 text-xs text-blue-600">Kelola guru →</p>
    </a>

    <a href="{{ route('admin.galleries.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-purple-100 rounded-lg group-hover:bg-purple-200">
                <i class="text-xl text-purple-600 fas fa-images"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['galleries_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Galeri Foto</p>
        <p class="mt-1 text-xs text-blue-600">Kelola galeri →</p>
    </a>

    <a href="{{ route('admin.agendas.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-yellow-100 rounded-lg group-hover:bg-yellow-200">
                <i class="text-xl text-yellow-600 fas fa-calendar"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['agendas_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Agenda Kegiatan</p>
        <p class="mt-1 text-xs text-blue-600">Kelola agenda →</p>
    </a>

    <a href="{{ route('admin.facilities.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-red-100 rounded-lg group-hover:bg-red-200">
                <i class="text-xl text-red-500 fas fa-building"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['facilities_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Fasilitas</p>
        <p class="mt-1 text-xs text-blue-600">Kelola fasilitas →</p>
    </a>

    <a href="{{ route('admin.registrations.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-indigo-100 rounded-lg group-hover:bg-indigo-200">
                <i class="text-xl text-indigo-600 fas fa-user-check"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['registrations_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Pendaftaran Siswa</p>
        <p class="mt-1 text-xs text-blue-600">Lihat pendaftaran →</p>
    </a>

    <a href="{{ route('admin.prestasis.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-orange-100 rounded-lg group-hover:bg-orange-200">
                <i class="text-xl text-orange-500 fas fa-trophy"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['prestasi_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Prestasi Siswa</p>
        <p class="mt-1 text-xs text-blue-600">Kelola prestasi →</p>
    </a>

    <a href="{{ route('admin.about.index') }}" class="p-6 transition bg-white rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-teal-100 rounded-lg group-hover:bg-teal-200">
                <i class="text-xl text-teal-600 fas fa-info-circle"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['about_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Tentang Sekolah</p>
        <p class="mt-1 text-xs text-blue-600">Kelola informasi →</p>
    </a>

    @if(auth()->user()->role === \App\Enums\UserRole::SuperAdmin)
    <a href="{{ route('admin.management-account.index') }}" class="p-6 transition bg-white border-2 border-pink-200 rounded-lg shadow hover:shadow-md group">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center justify-center w-12 h-12 transition bg-pink-100 rounded-lg group-hover:bg-pink-200">
                <i class="text-xl text-pink-600 fas fa-users-cog"></i>
            </div>
            <span class="text-3xl font-bold text-gray-800">{{ $stats['management_account_count'] }}</span>
        </div>
        <p class="text-sm font-medium text-gray-600">Manajemen Akun</p>
        <p class="mt-1 text-xs text-pink-500"><i class="mr-1 fas fa-shield-alt"></i>Super Admin Only</p>
    </a>
    @endif

</div>

<div class="p-6 bg-white rounded-lg shadow">
    <h3 class="mb-3 text-lg font-semibold text-gray-800">
        <i class="mr-2 text-blue-600 fas fa-hand-paper"></i>
        Selamat Datang, {{ Auth::user()->name }}!
    </h3>
    <p class="mb-4 text-sm text-gray-600">Gunakan menu di sebelah kiri untuk mengelola konten website sekolah. Berikut yang dapat Anda lakukan:</p>
    <div class="grid grid-cols-1 gap-2 text-sm text-gray-600 md:grid-cols-2">
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Tambah dan edit berita sekolah</div>
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Kelola data guru dan pengajar</div>
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Upload foto galeri kegiatan</div>
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Atur jadwal agenda kegiatan</div>
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Update informasi fasilitas</div>
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Lihat data pendaftaran siswa baru</div>
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Catat prestasi peserta didik</div>
        <div class="flex items-center gap-2"><i class="w-4 text-blue-500 fas fa-check"></i> Edit profil dan informasi sekolah</div>
        @if(auth()->user()->role === \App\Enums\UserRole::SuperAdmin)
        <div class="flex items-center gap-2"><i class="w-4 text-pink-500 fas fa-shield-alt"></i> Kelola akun pengguna admin</div>
        @endif
    </div>
</div>

@endsection