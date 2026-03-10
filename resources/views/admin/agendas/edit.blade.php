@extends('admin.layout')

@section('page_title', 'Edit Event')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.agendas.update', $agenda) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" id="agendaTitle" value="{{ old('title', $agenda->title) }}" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Slug
                <span class="ml-1 text-xs text-yellow-600">⚠ Hati-hati mengubah slug</span>
            </label>
            <div class="flex gap-2">
                <input type="text" name="slug" id="agendaSlug" value="{{ old('slug', $agenda->slug) }}" required
                    class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50">
                <button type="button" id="btn-reset-slug"
                    class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-xs font-medium transition">
                    <i class="fas fa-sync-alt mr-1"></i> Generate dari Title
                </button>
            </div>
            @error('slug') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tanggal & Waktu Kegiatan</label>
            <div class="flex gap-2">
                <input type="text" id="eventDateDisplay" readonly
                    class="flex-1 px-3 py-2 border rounded-lg bg-white cursor-pointer focus:ring-2 focus:ring-blue-500">
                <input type="hidden" name="event_date" id="event_date_input"
                    value="{{ old('event_date', $agenda->event_date_time) }}">
                <button type="button" onclick="document.getElementById('eventDateDisplay').click()"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    <i class="fas fa-calendar"></i>
                </button>
            </div>
            @error('event_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="upcoming"  {{ old('status', $agenda->status) === 'upcoming'  ? 'selected' : '' }}>Mendatang</option>
                <option value="ongoing"   {{ old('status', $agenda->status) === 'ongoing'   ? 'selected' : '' }}>Sedang Berlangsung</option>
                <option value="completed" {{ old('status', $agenda->status) === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $agenda->location) }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $agenda->description) }}</textarea>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Update', 'loading' => 'Updating...'])
            <a href="{{ route('admin.agendas.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ── SLUG (edit: hanya via tombol) ──────────────────────────────────
    var titleInput = document.getElementById('agendaTitle');
    var slugInput  = document.getElementById('agendaSlug');

    function generateSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
            .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o')
            .replace(/[ùúûü]/g, 'u')
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/[\s-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    document.getElementById('btn-reset-slug').addEventListener('click', function () {
        if (confirm('Generate ulang slug dari title?\nURL lama bisa tidak berfungsi!')) {
            slugInput.value = generateSlug(titleInput.value);
        }
    });

    // ── FLATPICKR — load nilai existing dari hidden input ──────────────
    var existingValue = document.getElementById('event_date_input').value;

    flatpickr('#eventDateDisplay', {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
        time_24hr: true,
        locale: { firstDayOfWeek: 1 },
        defaultDate: existingValue || null,
        onChange: function (selectedDates, dateStr) {
            document.getElementById('event_date_input').value = dateStr;
        }
    });
});
</script>
@endsection