@extends('admin.layout')

@section('page_title', 'Agenda')
@section('page_subtitle', 'Manage school events')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800">All Events</h3>
    <a href="{{ route('admin.agendas.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i> Add Event
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Location</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($agendas as $agenda)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $agenda->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $agenda->event_date->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        @if($agenda->event_time)
                            {{ \Carbon\Carbon::parse($agenda->event_time)->format('H:i') }} WIB
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $agenda->location ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $agenda->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($agenda->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.agendas.edit', $agenda) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST" style="display:inline;" onsubmit="return confirm('Sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">No events found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $agendas->links() }}</div>
@endsection
