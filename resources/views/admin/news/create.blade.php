@extends('admin.layout')

@section('page_title', 'Create News Article')
@section('page_subtitle', 'Add a new news article')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                    Slug
                    <span class="ml-2 text-xs text-green-600 font-normal">✓ Auto-generate dari title</span>
                </label>
                <div class="flex gap-2">
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50"
                        placeholder="akan-diisi-otomatis">
                    <button type="button" id="btn-regenerate-slug"
                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-xs font-medium transition">
                        <i class="fas fa-sync-alt mr-1"></i> Reset
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Terisi otomatis saat mengetik title. Bisa diedit manual jika perlu.</p>
                @error('slug') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('excerpt') }}</textarea>
                @error('excerpt') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea id="content" name="content" rows="8" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('content') }}</textarea>
                @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Publish Date & Time</label>
                    <div class="flex gap-2">
                        <input type="text" id="publishDate" placeholder="Click to select date & time" readonly
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-white cursor-pointer">
                        <input type="hidden" name="published_at" id="published_at_input" value="{{ old('published_at') }}">
                        <button type="button" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium"
                            onclick="document.getElementById('publishDate').click()">
                            <i class="fas fa-calendar mr-2"></i> Pick
                        </button>
                    </div>
                    @error('published_at') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition" id="dropZone">
                    <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden">
                    <div>
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">Drag & drop atau
                            <button type="button" class="text-blue-600 hover:text-blue-700 font-medium"
                                onclick="document.getElementById('featured_image').click()">pilih file</button>
                        </p>
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG (Max 2MB)</p>
                    </div>
                </div>
                <div id="imagePreview" class="hidden mt-4">
                    <img id="previewImg" src="" alt="Preview" class="max-w-sm h-40 object-cover rounded-lg">
                    <p id="fileName" class="text-xs text-gray-600 mt-2"></p>
                </div>
                @error('featured_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', ['label' => 'Create Article', 'loading' => 'Creating...'])
                <a href="{{ route('admin.news.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ── AUTO SLUG ──────────────────────────────────────────────────────
    const titleInput = document.getElementById('title');
    const slugInput  = document.getElementById('slug');
    let slugManuallyEdited = false;

    function generateSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[àáâãäå]/g,'a').replace(/[èéêë]/g,'e')
            .replace(/[ìíîï]/g,'i').replace(/[òóôõö]/g,'o')
            .replace(/[ùúûü]/g,'u').replace(/[ñ]/g,'n')
            .replace(/[^a-z0-9\s-]/g,'')
            .replace(/[\s-]+/g,'-').replace(/^-+|-+$/g,'');
    }

    titleInput.addEventListener('input', function () {
        if (!slugManuallyEdited) slugInput.value = generateSlug(this.value);
    });

    slugInput.addEventListener('input', function () {
        slugManuallyEdited = this.value !== generateSlug(titleInput.value);
    });

    document.getElementById('btn-regenerate-slug').addEventListener('click', function () {
        slugInput.value = generateSlug(titleInput.value);
        slugManuallyEdited = false;
    });

    // ── FLATPICKR ──────────────────────────────────────────────────────
    flatpickr('#publishDate', {
        enableTime: true, dateFormat: 'Y-m-d H:i', time_24hr: true,
        onChange: function (s, dateStr) {
            document.getElementById('published_at_input').value = dateStr;
        }
    });

    // ── IMAGE UPLOAD ───────────────────────────────────────────────────
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('featured_image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const fileName = document.getElementById('fileName');
    const maxSize = 2 * 1024 * 1024;

    function handleFile(file) {
        if (!file.type.startsWith('image/')) { alert('Please select an image file'); return; }
        if (file.size > maxSize) { alert('File size must be less than 2MB'); return; }
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            fileName.textContent = `File: ${file.name} (${(file.size/1024).toFixed(2)} KB)`;
            imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', e => { if (e.target.files[0]) handleFile(e.target.files[0]); });
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-blue-500','bg-blue-50'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-blue-500','bg-blue-50'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault(); dropZone.classList.remove('border-blue-500','bg-blue-50');
        if (e.dataTransfer.files[0]) { fileInput.files = e.dataTransfer.files; handleFile(e.dataTransfer.files[0]); }
    });
});
</script>
@endsection