@extends('admin.layout')

@section('page_title', 'Manajemen Akun')
@section('page_subtitle', 'Kelola pengguna dan akses sistem')

@section('content')

<div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-900">{{ $users->total() }}</p>
            </div>
            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                <i class="text-blue-600 fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Admin Aktif</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\User::where('is_active', true)->get()->filter(fn($u) => in_array($u->role?->value, ['admin', 'super_admin']))->count() }}</p>
            </div>
            <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full">
                <i class="text-purple-600 fas fa-shield-alt"></i>
            </div>
        </div>
    </div>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Pengguna Aktif</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\User::where('is_active', true)->count() }}</p>
            </div>
            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                <i class="text-green-600 fas fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="flex items-center justify-between mb-6">
    <h3 class="text-lg font-semibold text-gray-800">Daftar Pengguna</h3>
    <a href="{{ route('admin.management-account.create') }}"
        class="flex items-center gap-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
        <i class="fas fa-plus"></i> Tambah Pengguna
    </a>
</div>

<div class="overflow-hidden bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="border-b border-gray-200 bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Nama</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Email</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Role</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Login Terakhir</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-8 h-8 text-xs font-semibold text-white bg-blue-500 rounded-full shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @php
                                $roleClass = match($user->role?->value) {
                                    'super_admin' => 'bg-red-100 text-red-700',
                                    'admin'       => 'bg-yellow-100 text-yellow-700',
                                    default       => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $roleClass }}">
                                {{ $user->role?->label() ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->is_active)
                                <span class="inline-flex items-center gap-1 text-sm text-green-600">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-sm text-red-500">
                                    <i class="fas fa-times-circle"></i> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $user->last_login?->format('d M Y, H:i') ?? 'Belum pernah' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.management-account.edit', $user) }}"
                                    class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.management-account.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('Hapus pengguna \'{{ addslashes($user->name) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 text-sm text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <i class="mb-3 text-4xl text-gray-300 fas fa-users"></i>
                            <p class="text-gray-500">Belum ada pengguna.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $users->links() }}</div>

@endsection