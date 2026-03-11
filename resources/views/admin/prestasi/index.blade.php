@extends('admin.layout')

@section('page_title', 'Prestasi')
@section('page_subtitle', 'Kelola prestasi peserta didik')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h3 class="text-lg font-semibold text-gray-800">Semua Prestasi</h3>
    <a href="{{ route('admin.prestasis.create') }}"
        class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
        <i class="mr-2 fas fa-plus"></i> Add Prestasi
    </a>
</div>

@if(session('success'))
    <div class="px-4 py-3 mb-4 text-green-800 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-hidden bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="border-b bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium text-left text-gray-700 uppercase">Judul</th>
                <th class="px-6 py-3 text-xs font-medium text-left text-gray-700 uppercase">Kategori</th>
                <th class="px-6 py-3 text-xs font-medium text-left text-gray-700 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-xs font-medium text-left text-gray-700 uppercase">Status</th>
                <th class="px-6 py-3 text-xs font-medium text-left text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($prestasis as $prestasi)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $prestasi->title }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $prestasi->category ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $prestasi->achievement_date ? $prestasi->achievement_date->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $statusClasses = [
                                'published' => 'bg-green-100 text-green-800',
                                'draft'     => 'bg-gray-100 text-gray-700',
                            ];
                            $statusLabels = [
                                'published' => 'Published',
                                'draft'     => 'Draft',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$prestasi->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $statusLabels[$prestasi->status] ?? ucfirst($prestasi->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-2 text-sm">
                        <a href="{{ route('admin.prestasis.edit', $prestasi) }}"
                            class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.prestasis.destroy', $prestasi) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Hapus prestasi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada prestasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $prestasis->links() }}</div>
@endsection