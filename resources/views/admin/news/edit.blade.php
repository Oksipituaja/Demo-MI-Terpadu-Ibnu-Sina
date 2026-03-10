@extends('admin.layout')

@section('page_title', 'Edit News Article')
@section('page_subtitle', 'Update article information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                    Slug
                    <span class="ml-2 text-xs text-yellow-600 font-normal">⚠ Hati-hati mengubah slug — bisa memutus link yang sudah ada</span>
                </label>
                <div class="flex gap-2">
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $news->slug) }}" required
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                    <button type="button" id="btn-regenerate-slug"
                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-xs font-medium transition">
                        <i class="fas fa-sync-alt mr-1"></i> Generate dari Title
                    </button>
                </div>
                @error('slug') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('excerpt', $news->excerpt) }}</textarea>
                @error('excerpt') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea id="content" name="content" rows="8" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('content', $news->content) }}</textarea>
                @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="draft" {{ old('status', $news->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Publish Date</label>
                    <div class="flex gap-2">
                        <input type="text" id="publishDate" placeholder="Click to select date & time" readonly
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-white cursor-pointer">
                        <input type="hidden" name="published_at" id="published_at_input"
                            value="{{ old('published_at', $news->published_at?->format('Y-m-d H:i')) }}">
                        <button type="button" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium"
                            onclick="document.getElementById('publishDate').click()">
                            <i class="fas fa-calendar mr-2"></i> Pick
                        </button>
                    </div>
                    @error('published_at') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                @if($news->featured_image)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-xs font-medium text-gray-600 mb-2">Gambar Saat Ini</p>
                        <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}"
                            class="max-w-sm h-40 object-cover rounded">
                    </div>
                @endif
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
                    <p class="text-xs font-medium text-gray-600 mb-2">Pratinjau Gambar Baru</p>
                    <img id="previewImg" src="" alt="Preview" class="max-w-sm h-40 object-cover rounded-lg">
                    <p id="fileName" class="text-xs text-gray-600 mt-2"></p>
                </div>
                @error('featured_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', ['label' => 'Update Article', 'loading' => 'Updating...'])
                <a href="{{ route('admin.news.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ── SLUG (edit: hanya via tombol, tidak auto-update) ───────────────
    const titleInput = document.getElementById('title');
    const slugInput  = document.getElementById('slug');

    function generateSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[àáâãäå]/g,'a').replace(/[èéêë]/g,'e')
            .replace(/[ìíîï]/g,'i').replace(/[òóôõö]/g,'o')
            .replace(/[ùúûü]/g,'u').replace(/[ñ]/g,'n')
            .replace(/[^a-z0-9\s-]/g,'')
            .replace(/[\s-]+/g,'-').replace(/^-+|-+$/g,'');
    }

    // Halaman edit: slug tidak auto-update agar URL lama tidak putus
    // Hanya generate jika user klik tombol secara sadar
    document.getElementById('btn-regenerate-slug').addEventListener('click', function () {
        if (confirm('Generate ulang slug dari title?\nPeringatan: URL lama bisa tidak berfungsi!')) {
            slugInput.value = generateSlug(titleInput.value);
        }
    });

    // ── FLATPICKR ──────────────────────────────────────────────────────
    flatpickr('#publishDate', {
        enableTime: true, dateFormat: 'Y-m-d H:i', time_24hr: true,
        defaultDate: document.getElementById('published_at_input').value || null,
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