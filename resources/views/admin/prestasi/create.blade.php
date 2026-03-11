@extends('admin.layout')

@section('page_title', 'Add Prestasi')
@section('page_subtitle', 'Tambah prestasi peserta didik baru')

@section('content')
<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
    <form action="{{ route('admin.prestasis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium">Judul Prestasi</label>
            <input type="text" name="title" id="prestasiTitle" value="{{ old('title') }}" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="cth: Juara 1 Olimpiade Matematika Tingkat Kabupaten">
            @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">
                Slug
                <span class="ml-1 text-xs text-green-600">✓ Auto-generate dari judul</span>
            </label>
            <div class="flex gap-2">
                <input type="text" name="slug" id="prestasiSlug" value="{{ old('slug') }}" required
                    class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50"
                    placeholder="akan-diisi-otomatis">
                <button type="button" id="btn-reset-slug"
                    class="px-3 py-2 text-xs font-medium text-gray-600 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                    <i class="mr-1 fas fa-sync-alt"></i> Reset
                </button>
            </div>
            @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="cth: Juara 1, Juara 2, Harapan 1">
            @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Tanggal Prestasi</label>
            <input type="date" name="achievement_date" value="{{ old('achievement_date') }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('achievement_date') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Deskripsi</label>
            <textarea name="description" rows="4" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="Ceritakan detail prestasi ini...">{{ old('description') }}</textarea>
            @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Gambar</label>
            <input type="file" name="image" accept="image/*"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG, WebP, AVIF. Maks: 5MB</p>
            @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Status</label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="draft"     {{ old('status', 'draft') === 'draft'     ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Save', 'loading' => 'Saving...'])
            <a href="{{ route('admin.prestasis.index') }}" class="px-4 py-2 text-gray-800 bg-gray-200 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var titleInput = document.getElementById('prestasiTitle');
    var slugInput  = document.getElementById('prestasiSlug');
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
});
</script>
@endsection