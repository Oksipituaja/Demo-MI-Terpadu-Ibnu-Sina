@extends('admin.layout')

@section('page_title', 'Edit News Article')
@section('page_subtitle', 'Update article information')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="p-6 bg-white rounded-lg shadow">
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block mb-1 text-sm font-medium text-gray-700">
                        Slug
                        <span class="ml-2 text-xs font-normal text-yellow-600">⚠ Hati-hati mengubah slug — bisa memutus link
                            yang sudah ada</span>
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $news->slug) }}" required
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                        <button type="button" id="btn-regenerate-slug"
                            class="px-3 py-2 text-xs font-medium text-gray-600 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                            <i class="mr-1 fas fa-sync-alt"></i> Generate dari Title
                        </button>
                    </div>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt" class="block mb-1 text-sm font-medium text-gray-700">Excerpt</label>
                    <textarea id="excerpt" name="excerpt" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('excerpt', $news->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block mb-1 text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content">{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="draft" {{ old('status', $news->status) === 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>
                                Published</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="published_at" class="block mb-1 text-sm font-medium text-gray-700">Publish Date</label>
                        <div class="flex gap-2">
                            <input type="text" id="publishDate" placeholder="Click to select date & time" readonly
                                class="flex-1 px-4 py-2 bg-white border border-gray-300 rounded-lg cursor-pointer">
                            <input type="hidden" name="published_at" id="published_at_input"
                                value="{{ old('published_at', $news->published_at?->format('Y-m-d H:i')) }}">
                            <button type="button"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                                onclick="document.getElementById('publishDate').click()">
                                <i class="mr-2 fas fa-calendar"></i> Pick
                            </button>
                        </div>
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Featured Image</label>
                    @if ($news->featured_image)
                        <div class="p-4 mb-4 border border-gray-200 rounded-lg bg-gray-50">
                            <p class="mb-2 text-xs font-medium text-gray-600">Gambar Saat Ini</p>
                            <img src="{{ asset('files/' . $news->featured_image) }}" alt="{{ $news->title }}"
                                class="object-cover h-40 max-w-sm rounded">
                        </div>
                    @endif
                    <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                        id="dropZone">
                        <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden">
                        <div>
                            <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                            <p class="text-gray-600">Drag & drop atau
                                <button type="button" class="font-medium text-blue-600 hover:text-blue-700"
                                    onclick="document.getElementById('featured_image').click()">pilih file</button>
                            </p>
                            <p class="mt-2 text-xs text-gray-500">JPG, PNG (Max 2MB)</p>
                        </div>
                    </div>
                    <div id="imagePreview" class="hidden mt-4">
                        <p class="mb-2 text-xs font-medium text-gray-600">Pratinjau Gambar Baru</p>
                        <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                        <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
                    </div>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-4 border-t">
                    @include('components.admin-submit-btn', [
                        'label' => 'Update Article',
                        'loading' => 'Updating...',
                    ])
                    <a href="{{ route('admin.news.index') }}"
                        class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                        <i class="mr-2 fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ── TINYMCE ────────────────────────────────────────────────────────
            tinymce.init({
                selector: '#content',
                height: 450,
                menubar: false,
                plugins: 'lists link autolink image table codesample',
                toolbar: [
                    'undo redo | bold italic underline strikethrough | forecolor backcolor',
                    'h1 h2 h3 | bullist numlist | outdent indent | blockquote',
                    'link image table codesample | alignleft aligncenter alignright alignjustify | removeformat'
                ],
                toolbar_mode: 'wrap',
                skin_url: '/build/tinymce/skins/ui/oxide',
                content_css: '/build/tinymce/skins/content/default/content.min.css',
                content_style: 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; max-width: 100%; }',
                image_uploadtab: false,
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });

            // ── SLUG ──────────────────────────────────────────────────────────
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            function generateSlug(text) {
                return text.toLowerCase().trim()
                    .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
                    .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o')
                    .replace(/[ùúûü]/g, 'u').replace(/[ñ]/g, 'n')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/[\s-]+/g, '-').replace(/^-+|-+$/g, '');
            }

            document.getElementById('btn-regenerate-slug').addEventListener('click', function() {
                if (confirm(
                        'Generate ulang slug dari title?\nPeringatan: URL lama bisa tidak berfungsi!')) {
                    slugInput.value = generateSlug(titleInput.value);
                }
            });

            // ── FLATPICKR ──────────────────────────────────────────────────────
            flatpickr('#publishDate', {
                enableTime: true,
                dateFormat: 'Y-m-d H:i',
                time_24hr: true,
                defaultDate: document.getElementById('published_at_input').value || null,
                onChange: function(s, dateStr) {
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
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    return;
                }
                if (file.size > maxSize) {
                    alert('File size must be less than 2MB');
                    return;
                }
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    fileName.textContent = `File: ${file.name} (${(file.size/1024).toFixed(2)} KB)`;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', e => {
                if (e.target.files[0]) handleFile(e.target.files[0]);
            });
            dropZone.addEventListener('dragover', e => {
                e.preventDefault();
                dropZone.classList.add('border-blue-500', 'bg-blue-50');
            });
            dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-blue-500',
                'bg-blue-50'));
            dropZone.addEventListener('drop', e => {
                e.preventDefault();
                dropZone.classList.remove('border-blue-500', 'bg-blue-50');
                if (e.dataTransfer.files[0]) {
                    fileInput.files = e.dataTransfer.files;
                    handleFile(e.dataTransfer.files[0]);
                }
            });
        });
    </script>
@endsection
