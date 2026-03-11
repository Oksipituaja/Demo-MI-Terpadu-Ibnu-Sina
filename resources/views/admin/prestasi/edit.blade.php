@extends('admin.layout')

@section('page_title', 'Edit Prestasi')
@section('page_subtitle', 'Edit prestasi peserta didik')

@section('content')
<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
    <form action="{{ route('admin.prestasis.update', $prestasi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-medium">Judul Prestasi</label>
            <input type="text" name="title" id="prestasiTitle" value="{{ old('title', $prestasi->title) }}" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">
                Slug
                <span class="ml-1 text-xs text-yellow-600">⚠ Hati-hati mengubah slug</span>
            </label>
            <div class="flex gap-2">
                <input type="text" name="slug" id="prestasiSlug" value="{{ old('slug', $prestasi->slug) }}" required
                    class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50">
                <button type="button" id="btn-reset-slug"
                    class="px-3 py-2 text-xs font-medium text-gray-600 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                    <i class="mr-1 fas fa-sync-alt"></i> Generate dari Judul
                </button>
            </div>
            @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Kategori</label>
            <input type="text" name="category" value="{{ old('category', $prestasi->category) }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="cth: Juara 1, Juara 2, Harapan 1">
            @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Tanggal Prestasi</label>
            <input type="date" name="achievement_date"
                value="{{ old('achievement_date', $prestasi->achievement_date?->format('Y-m-d')) }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('achievement_date') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Deskripsi</label>
            <textarea name="description" rows="4" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $prestasi->description) }}</textarea>
            @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Gambar</label>
            @if($prestasi->image)
                <div class="flex items-center gap-3 mb-2">
                    <img src="{{ Storage::url($prestasi->image) }}" alt="Current image"
                        class="object-cover w-20 h-20 border rounded-lg">
                    <span class="text-xs text-gray-500">Gambar saat ini. Upload baru untuk mengganti.</span>
                </div>
            @endif
            <input type="file" name="image" accept="image/*"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG, WebP, AVIF. Maks: 5MB</p>
            @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Status</label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="draft"     {{ old('status', $prestasi->status) === 'draft'     ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $prestasi->status) === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Update', 'loading' => 'Updating...'])
            <a href="{{ route('admin.prestasis.index') }}" class="px-4 py-2 text-gray-800 bg-gray-200 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var titleInput = document.getElementById('prestasiTitle');
    var slugInput  = document.getElementById('prestasiSlug');

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
        if (confirm('Generate ulang slug dari judul?\nURL lama bisa tidak berfungsi!')) {
            slugInput.value = generateSlug(titleInput.value);
        }
    });
});
</script>
@endsection