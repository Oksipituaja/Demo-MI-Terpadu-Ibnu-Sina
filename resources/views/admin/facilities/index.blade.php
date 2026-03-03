@extends('admin.layout')

@section('page_title', 'Facilities')
@section('page_subtitle', 'Manage school facilities')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800">All Facilities</h3>
    <a href="{{ route('admin.facilities.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i> Add Facility
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Icon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kondisi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($facilities as $facility)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $facility->name }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($facility->icon)
                            <i class="{{ $facility->icon }} text-xl text-blue-600"></i> {{ $facility->icon }}
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($facility->kondisi === 'tersedia')
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Tersedia</span>
                        @elseif($facility->kondisi === 'perbaikan')
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Perbaikan</span>
                        @elseif($facility->kondisi === 'belum_ada')
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Belum Ada</span>
                        @elseif($facility->kondisi === 'akan_ada')
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Akan Ada</span>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($facility->description, 50) }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.facilities.edit', $facility) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" style="display:inline;" onsubmit="return confirm('Sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">No facilities found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $facilities->links() }}</div>
@endsection
