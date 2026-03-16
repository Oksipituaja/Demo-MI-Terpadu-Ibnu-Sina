@extends('admin.layout')

@section('page_title', 'About Sections')
@section('page_subtitle', 'Manage about page content')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800">All About Sections</h3>
    <a href="{{ route('admin.about.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i> Add Section
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Key</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Content Preview</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($abouts as $about)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $about->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600"><code class="bg-gray-100 px-2 py-1 rounded">{{ $about->key }}</code></td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        @if($about->image)
                            <img src="{{ asset('files/' . $about->image) }}" alt="{{ $about->title }}" class="h-16 rounded object-cover">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit(strip_tags($about->content), 50) }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.about.edit', $about) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.about.destroy', $about) }}" method="POST" style="display:inline;" onsubmit="return confirm('Sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No about sections found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $abouts->links() }}</div>
@endsection
