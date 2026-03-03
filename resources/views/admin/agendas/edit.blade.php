@extends('admin.layout')

@section('page_title', 'Edit Event')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.agendas.update', $agenda) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $agenda->title) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $agenda->slug) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('slug') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Event Date</label>
            <div class="flex gap-2">
                <input type="text" id="eventDate" placeholder="Click to select date & time" readonly class="flex-1 px-3 py-2 border rounded-lg bg-white cursor-pointer">
                <input type="hidden" name="event_date" id="event_date_input" value="{{ old('event_date', $agenda->event_date_time) }}">
                <button type="button" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg" onclick="document.getElementById('eventDate').click()">
                    <i class="fas fa-calendar mr-2"></i> Pick Date
                </button>
            </div>
            @error('event_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="upcoming" {{ old('status', $agenda->status) === 'upcoming' ? 'selected' : '' }}>Mendatang (Upcoming)</option>
                <option value="ongoing" {{ old('status', $agenda->status) === 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung (Ongoing)</option>
                <option value="completed" {{ old('status', $agenda->status) === 'completed' ? 'selected' : '' }}>Selesai (Completed)</option>
            </select>
            @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location', $agenda->location) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $agenda->description) }}</textarea>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Update', 'loading' => 'Updating...'])
            <a href="{{ route('admin.agendas.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr('#eventDate', {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
        time_24hr: true,
        defaultDate: '{{ old('event_date', $agenda->event_date_time) }}',
        onChange: function(selectedDates, dateStr) {
            document.getElementById('event_date_input').value = dateStr;
        }
    });
});
</script>
@endsection