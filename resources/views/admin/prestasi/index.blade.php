@extends('admin.layout')

@section('page_title', 'Prestasi Sekolah')
@section('page_subtitle', 'Kelola prestasi dan pencapaian sekolah')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800">All Achievements</h3>
    <a href="{{ route('admin.prestasis.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i> Add Achievement
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($prestasis as $prestasi)
                @php
                    $award = getAwardIcon($prestasi->category);
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $prestasi->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        @if($prestasi->category)
                            <div class="flex items-center gap-2">
                                <span class="text-xl">{{ $award['emoji'] }}</span>
                                <span class="px-2 py-1 rounded text-xs font-medium" style="background-color: rgba(59, 130, 246, 0.1); color: #1e40af;">
                                    {{ $prestasi->category }}
                                </span>
                            </div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        @if($prestasi->achievement_date)
                            {{ $prestasi->achievement_date->format('d M Y') }}
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        @if($prestasi->image)
                            <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" class="h-16 rounded object-cover">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($prestasi->status === 'published')
                            <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Published</span>
                        @else
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.prestasis.edit', $prestasi) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.prestasis.destroy', $prestasi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">No achievements found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $prestasis->links() }}</div>
@endsection
