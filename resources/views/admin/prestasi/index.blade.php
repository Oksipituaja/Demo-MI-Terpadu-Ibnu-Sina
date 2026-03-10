@extends('admin.layout')

@section('page_title', 'Agenda')
@section('page_subtitle', 'Kelola agenda dan kegiatan sekolah')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800">Semua Kegiatan</h3>
    <a href="{{ route('admin.agendas.create') }}"
        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i> Add Event
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Lokasi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($agendas as $agenda)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $agenda->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $agenda->event_date->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $agenda->formatted_time ? $agenda->formatted_time . ' WIB' : '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $agenda->location ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $statusClasses = [
                                'upcoming'  => 'bg-blue-100 text-blue-800',
                                'completed' => 'bg-gray-100 text-gray-700',
                            ];
                            $statusLabels = [
                                'upcoming'  => 'Mendatang',
                                'completed' => 'Selesai',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$agenda->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $statusLabels[$agenda->status] ?? ucfirst($agenda->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.agendas.edit', $agenda) }}"
                            class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Hapus agenda ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada agenda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $agendas->links() }}</div>
@endsection