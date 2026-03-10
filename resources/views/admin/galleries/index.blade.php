@extends('admin.layout')

@section('page_title', 'Gallery')
@section('page_subtitle', 'Kelola galeri foto sekolah')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800">Semua Galeri</h3>
    <a href="{{ route('admin.galleries.create') }}"
        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i> Add Gallery
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($galleries as $gallery)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}"
                                alt="{{ $gallery->title }}"
                                class="w-16 h-12 object-cover rounded-lg">
                        @else
                            <div class="w-16 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-images text-blue-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $gallery->title }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                            {{ $gallery->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($gallery->description, 50) ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}"
                            class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Hapus galeri ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada galeri.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $galleries->links() }}</div>
@endsection