@extends('admin.layout')

@section('page_title', 'Tambah Foto Galeri')
@section('page_subtitle', 'Tambah foto baru ke galeri sekolah')

@section('content')
<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <input type="hidden" name="slug" id="gallerySlug" value="{{ old('slug') }}">

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Judul Foto</label>
            <input type="text" name="title" id="galleryTitle" value="{{ old('title') }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}" required
                list="categoryList"
                placeholder="cth: Acara Sekolah, Olahraga, Seni"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <datalist id="categoryList">
                <option value="Acara Sekolah">
                <option value="Program Pembelajaran">
                <option value="Olahraga">
                <option value="Seni">
                <option value="Ekstrakurikuler">
                <option value="Keagamaan">
            </datalist>
            @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">
                Deskripsi
                <span class="ml-1 text-xs text-gray-400">(opsional)</span>
            </label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">
                Gambar
                <span class="ml-1 text-xs text-gray-400">(opsional)</span>
            </label>
            <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                id="dropZone">
                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                <p class="text-gray-600">Seret & letakkan atau
                    <button type="button" class="font-medium text-blue-600 hover:text-blue-700"
                        onclick="document.getElementById('image').click()">pilih file</button>
                </p>
                <p class="mt-1 text-xs text-gray-400">JPG, PNG, WebP (Maks. 5MB)</p>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Simpan Foto', 'loading' => 'Menyimpan...'])
            <a href="{{ route('admin.galleries.index') }}"
                class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                <i class="mr-2 fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('galleryTitle');
    const slugInput  = document.getElementById('gallerySlug');

    function generateSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[àáâãäå]/g,'a').replace(/[èéêë]/g,'e')
            .replace(/[ìíîï]/g,'i').replace(/[òóôõö]/g,'o')
            .replace(/[ùúûü]/g,'u')
            .replace(/[^a-z0-9\s-]/g,'')
            .replace(/[\s-]+/g,'-').replace(/^-+|-+$/g,'');
    }

    titleInput.addEventListener('input', function () {
        slugInput.value = generateSlug(this.value);
    });

    // ── TINYMCE ────────────────────────────────────────────────────────
    tinymce.init({
        selector: '#description',
        license_key: 'gpl',
        height: 250,
        menubar: false,
        plugins: 'lists link autolink',
        toolbar: [
            'undo redo | bold italic underline | forecolor',
            'bullist numlist | link | removeformat'
        ],
        toolbar_mode: 'wrap',
        skin_url: '/build/tinymce/skins/ui/oxide',
        content_css: '/build/tinymce/skins/content/default/content.min.css',
        content_style: 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; }',
        setup: function(editor) {
            editor.on('change', function() { editor.save(); });
        }
    });

    // ── IMAGE UPLOAD ───────────────────────────────────────────────────
    const dropZone     = document.getElementById('dropZone');
    const fileInput    = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg   = document.getElementById('previewImg');
    const fileName     = document.getElementById('fileName');
    const maxSize      = 5 * 1024 * 1024;

    function handleFile(file) {
        if (!file.type.startsWith('image/')) { alert('Pilih file gambar yang valid'); return; }
        if (file.size > maxSize) { alert('Ukuran file maksimal 5MB'); return; }
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            fileName.textContent = `File: ${file.name} (${(file.size/1024).toFixed(2)} KB)`;
            imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', e => { if (e.target.files[0]) handleFile(e.target.files[0]); });
    dropZone.addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-blue-500','bg-blue-50'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-blue-500','bg-blue-50'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault(); dropZone.classList.remove('border-blue-500','bg-blue-50');
        if (e.dataTransfer.files[0]) { fileInput.files = e.dataTransfer.files; handleFile(e.dataTransfer.files[0]); }
    });
});
</script>
@endpush
@endsection