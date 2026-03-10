@extends('admin.layout')

@section('page_title', 'Add Gallery')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" id="galleryTitle" value="{{ old('title') }}" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Slug
                <span class="ml-1 text-xs text-green-600">✓ Auto-generate dari title</span>
            </label>
            <div class="flex gap-2">
                <input type="text" name="slug" id="gallerySlug" value="{{ old('slug') }}" required
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
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <div class="flex gap-2">
                <input type="text" name="category" id="categoryInput" value="{{ old('category') }}" required
                    list="categoryList"
                    placeholder="cth: Acara Sekolah, Olahraga, Seni"
                    class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <datalist id="categoryList">
                    <option value="Acara Sekolah">
                    <option value="Program Pembelajaran">
                    <option value="Olahraga">
                    <option value="Seni">
                    <option value="Ekstrakurikuler">
                    <option value="Keagamaan">
                </datalist>
            </div>
            @error('category') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="3"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Image
                <span class="text-xs text-gray-500 ml-1">(Opsional)</span>
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition" id="dropZone">
                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                <div>
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Drag & drop atau
                        <button type="button" class="text-blue-600 hover:text-blue-700 font-medium"
                            onclick="document.getElementById('image').click()">pilih file</button>
                    </p>
                    <p class="text-xs text-gray-500 mt-2">JPG, PNG, WebP (Max 5MB)</p>
                </div>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <img id="previewImg" src="" alt="Preview" class="max-w-sm h-40 object-cover rounded-lg">
                <p id="fileName" class="text-xs text-gray-600 mt-2"></p>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Save', 'loading' => 'Saving...'])
            <a href="{{ route('admin.galleries.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var titleInput = document.getElementById('galleryTitle');
    var slugInput  = document.getElementById('gallerySlug');
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

    var dropZone     = document.getElementById('dropZone');
    var fileInput    = document.getElementById('image');
    var imagePreview = document.getElementById('imagePreview');
    var previewImg   = document.getElementById('previewImg');
    var fileName     = document.getElementById('fileName');
    var maxSize      = 5 * 1024 * 1024;

    function handleFile(file) {
        if (!file.type.startsWith('image/')) { alert('Please select an image file'); return; }
        if (file.size > maxSize) { alert('File size must be less than 5MB'); return; }
        var reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            fileName.textContent = 'File: ' + file.name + ' (' + (file.size/1024).toFixed(2) + ' KB)';
            imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', function (e) { if (e.target.files[0]) handleFile(e.target.files[0]); });
    dropZone.addEventListener('dragover', function (e) { e.preventDefault(); dropZone.classList.add('border-blue-500', 'bg-blue-50'); });
    dropZone.addEventListener('dragleave', function () { dropZone.classList.remove('border-blue-500', 'bg-blue-50'); });
    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        if (e.dataTransfer.files[0]) { fileInput.files = e.dataTransfer.files; handleFile(e.dataTransfer.files[0]); }
    });
});
</script>
@endsection