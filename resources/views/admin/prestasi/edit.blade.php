@extends('admin.layout')

@section('page_title', 'Edit Prestasi')
@section('page_subtitle', 'Perbarui data prestasi peserta didik')

@section('content')
<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
    <form action="{{ route('admin.prestasis.update', $prestasi) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        {{-- Slug hidden --}}
        <input type="hidden" name="slug" id="prestasiSlug" value="{{ old('slug', $prestasi->slug) }}">

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Judul Prestasi</label>
            <input type="text" name="title" id="prestasiTitle" value="{{ old('title', $prestasi->title) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">
                Kategori
                <span class="ml-1 text-xs text-gray-400">(opsional)</span>
            </label>
            <input type="text" name="category" value="{{ old('category', $prestasi->category) }}"
                list="categoryOptions"
                placeholder="Pilih atau ketik kategori..."
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <datalist id="categoryOptions">
                <option value="Juara 1">
                <option value="Juara 2">
                <option value="Juara 3">
                <option value="Harapan 1">
                <option value="Harapan 2">
                <option value="Harapan 3">
                <option value="Finalis">
                <option value="Peserta">
            </datalist>
            @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Prestasi</label>
            <div class="flex gap-2">
                <div id="achievementDateDisplay"
                    class="flex-1 px-4 py-2 text-sm border border-gray-300 rounded-lg select-none bg-gray-50 {{ old('achievement_date', $prestasi->achievement_date) ? 'text-gray-800' : 'text-gray-400' }}">
                    {{ old('achievement_date', $prestasi->achievement_date?->format('d M Y')) ?? 'Belum dipilih' }}
                </div>
                <input type="hidden" name="achievement_date" id="achievement_date_input"
                    value="{{ old('achievement_date', $prestasi->achievement_date?->format('Y-m-d')) }}">
                <button type="button" id="btn-pick-date"
                    class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shrink-0">
                    <i class="mr-1 fas fa-calendar"></i> Pilih
                </button>
            </div>
            @error('achievement_date') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $prestasi->description) }}</textarea>
            @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Gambar</label>
            @if($prestasi->image)
                <div class="p-4 mb-3 border border-gray-200 rounded-lg bg-gray-50">
                    <p class="mb-2 text-xs font-medium text-gray-600">Gambar Saat Ini</p>
                    <img src="{{ Storage::url($prestasi->image) }}" alt="{{ $prestasi->title }}"
                        class="object-cover w-24 h-24 rounded-lg">
                    <p class="mt-1 text-xs text-gray-400">Upload gambar baru untuk mengganti</p>
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, WebP. Maks: 5MB</p>
            @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="draft"     {{ old('status', $prestasi->status) === 'draft'     ? 'selected' : '' }}>Draft (Belum Tayang)</option>
                <option value="published" {{ old('status', $prestasi->status) === 'published' ? 'selected' : '' }}>Publikasi (Tayang)</option>
            </select>
            @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Simpan Perubahan', 'loading' => 'Menyimpan...'])
            <a href="{{ route('admin.prestasis.index') }}"
                class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                <i class="mr-2 fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── DATE PICKER ────────────────────────────────────────────────────
    const months      = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const display     = document.getElementById('achievementDateDisplay');
    const hiddenInput = document.getElementById('achievement_date_input');
    const btnPickDate = document.getElementById('btn-pick-date');

    const fpContainer = document.createElement('div');
    fpContainer.style.cssText = 'position:fixed;z-index:99999;display:none;';
    document.body.appendChild(fpContainer);

    const fp = flatpickr(fpContainer, {
        enableTime: false,
        dateFormat: 'Y-m-d',
        disableMobile: true,
        locale: window.flatpickrLocaleId,
        defaultDate: hiddenInput.value || null,
        onChange: function(selectedDates) {
            if (selectedDates[0]) {
                const d = selectedDates[0];
                hiddenInput.value = d.getFullYear() + '-' +
                    String(d.getMonth() + 1).padStart(2, '0') + '-' +
                    String(d.getDate()).padStart(2, '0');
                display.textContent = String(d.getDate()).padStart(2, '0') + ' ' +
                    months[d.getMonth()] + ' ' + d.getFullYear();
                display.classList.remove('text-gray-400');
                display.classList.add('text-gray-800');
            }
        },
        onClose: function() {
            fpContainer.style.display = 'none';
        }
    });

    btnPickDate.addEventListener('click', function(e) {
        e.stopPropagation();
        const rect = btnPickDate.getBoundingClientRect();
        fpContainer.style.cssText = `position:fixed;z-index:99999;top:${rect.bottom + 8}px;left:${rect.left}px;display:block;`;
        fp.open();
    });

    document.addEventListener('click', function(e) {
        const cal = document.querySelector('.flatpickr-calendar');
        if (
            !fpContainer.contains(e.target) &&
            !(cal && cal.contains(e.target)) &&
            e.target.id !== 'btn-pick-date'
        ) {
            fp.close();
            fpContainer.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection