@extends('admin.layout')

@section('page_title', 'Add Event')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.agendas.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" id="agendaTitle" value="{{ old('title') }}" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Slug
                <span class="ml-1 text-xs text-green-600">✓ Auto-generate dari title</span>
            </label>
            <div class="flex gap-2">
                <input type="text" name="slug" id="agendaSlug" value="{{ old('slug') }}" required
                    class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50"
                    placeholder="akan-diisi-otomatis">
                <button type="button" id="btn-reset-slug"
                    class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-xs font-medium transition">
                    <i class="fas fa-sync-alt mr-1"></i> Reset
                </button>
            </div>
            @error('slug') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tanggal & Waktu Kegiatan</label>
            <div class="flex gap-2">
                <input type="text" id="eventDateDisplay" placeholder="Klik untuk pilih tanggal & jam" readonly
                    class="flex-1 px-3 py-2 border rounded-lg bg-white cursor-pointer focus:ring-2 focus:ring-blue-500">
                {{-- Hidden input — nilai dikirim ke controller --}}
                <input type="hidden" name="event_date" id="event_date_input" value="{{ old('event_date') }}">
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
                <option value="upcoming"  {{ old('status', 'upcoming') === 'upcoming'  ? 'selected' : '' }}>Mendatang</option>
                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Lokasi</label>
            <input type="text" name="location" value="{{ old('location') }}"
                placeholder="cth: Aula SD Bangsri"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Save', 'loading' => 'Saving...'])
            <a href="{{ route('admin.agendas.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ── AUTO SLUG ──────────────────────────────────────────────────────
    var titleInput = document.getElementById('agendaTitle');
    var slugInput  = document.getElementById('agendaSlug');
    var slugEdited = false;

    function generateSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
            .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o')
            .replace(/[ùúûü]/g, 'u')
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/[\s-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    titleInput.addEventListener('input', function () {
        if (!slugEdited) slugInput.value = generateSlug(this.value);
    });
    slugInput.addEventListener('input', function () {
        slugEdited = this.value !== generateSlug(titleInput.value);
    });
    document.getElementById('btn-reset-slug').addEventListener('click', function () {
        slugInput.value = generateSlug(titleInput.value);
        slugEdited = false;
    });

    // ── FLATPICKR ──────────────────────────────────────────────────────
    flatpickr('#eventDateDisplay', {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
        time_24hr: true,
        locale: { firstDayOfWeek: 1 },
        onChange: function (selectedDates, dateStr) {
            document.getElementById('event_date_input').value = dateStr;
        }
    });
});
</script>
@endsection