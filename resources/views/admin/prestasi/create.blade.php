@extends('admin.layout')

@section('page_title', 'Add Achievement')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.prestasis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="6" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Category <span class="text-red-500">*</span></label>
                <select 
                    id="category" 
                    name="category" 
                    onchange="updateCategoryField()"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 mb-2"
                >
                    <option value="">-- Select Category --</option>
                    <optgroup label="Rankings">
                        <option value="Juara 1" {{ old('category') === 'Juara 1' ? 'selected' : '' }}>🥇 Juara 1 (Gold)</option>
                        <option value="Juara 2" {{ old('category') === 'Juara 2' ? 'selected' : '' }}>🥈 Juara 2 (Silver)</option>
                        <option value="Juara 3" {{ old('category') === 'Juara 3' ? 'selected' : '' }}>🥉 Juara 3 (Bronze)</option>
                    </optgroup>
                    <optgroup label="Harapan">
                        <option value="Harapan 1" {{ old('category') === 'Harapan 1' ? 'selected' : '' }}>⭐ Harapan 1 (Gold)</option>
                        <option value="Harapan 2" {{ old('category') === 'Harapan 2' ? 'selected' : '' }}>⭐ Harapan 2 (Silver)</option>
                        <option value="Harapan 3" {{ old('category') === 'Harapan 3' ? 'selected' : '' }}>⭐ Harapan 3 (Bronze)</option>
                    </optgroup>
                </select>

                <div>
                    <label class="block text-xs text-gray-600 mb-1">Or add custom category:</label>
                    <input 
                        type="text" 
                        id="customCategory" 
                        placeholder="e.g., Juara 1 IT Software" 
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 text-sm"
                        onkeyup="updatePreviewFromCustom()"
                    >
                </div>

                <div id="awardPreview" class="mt-3 p-4 bg-linear-to-r from-gray-50 to-gray-100 rounded-lg border border-gray-200 flex items-center gap-4">
                    <div>
                        <span id="previewIcon" class="text-4xl inline-flex items-center justify-center w-16 h-16 rounded-full" style="background: linear-gradient(135deg, #fbbf24, #f59e0b);">
                            👑
                        </span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Award Preview</p>
                        <p id="previewLabel" class="text-lg font-bold text-gray-900">Juara 1</p>
                    </div>
                </div>
                @error('category') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Achievement Date</label>
                <input type="date" name="achievement_date" value="{{ old('achievement_date') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('achievement_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Image</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition" id="dropZone">
                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                <div>
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Drag & drop or <button type="button" class="text-blue-600 hover:text-blue-700 font-medium" onclick="document.getElementById('image').click()">choose file</button></p>
                    <p class="text-xs text-gray-500 mt-2">JPG, PNG (Max 5MB)</p>
                </div>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <img id="previewImg" src="" alt="Preview" class="max-w-sm h-40 object-cover rounded-lg">
                <p id="fileName" class="text-xs text-gray-600 mt-2"></p>
            </div>
            @error('image') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <script>
        const categoryPreviewData = {
            'JUARA 1': { icon: '👑', label: 'Juara 1', color: 'from-yellow-300 to-yellow-500' },
            'JUARA 2': { icon: '🥈', label: 'Juara 2', color: 'from-gray-400 to-gray-500' },
            'JUARA 3': { icon: '🥉', label: 'Juara 3', color: 'from-orange-400 to-amber-500' },
            'HARAPAN 1': { icon: '⭐', label: 'Harapan 1', color: 'from-yellow-300 to-yellow-500' },
            'HARAPAN 2': { icon: '⭐', label: 'Harapan 2', color: 'from-gray-400 to-gray-500' },
            'HARAPAN 3': { icon: '⭐', label: 'Harapan 3', color: 'from-orange-400 to-amber-500' },
            'HARAPAN': { icon: '⭐', label: 'Harapan', color: 'from-blue-400 to-blue-500' },
        };

        function updatePreview(category) {
            const categoryUpper = category.toUpperCase();
            let preview = categoryPreviewData['JUARA 1'];

            for (const key in categoryPreviewData) {
                if (categoryUpper.includes(key)) {
                    preview = categoryPreviewData[key];
                    break;
                }
            }

            document.getElementById('previewIcon').textContent = preview.icon;
            document.getElementById('previewIcon').style.background = `linear-gradient(135deg, var(--tw-gradient-stops))`;
            document.getElementById('previewLabel').textContent = preview.label;
        }

        function updateCategoryField() {
            const select = document.getElementById('category');
            const customInput = document.getElementById('customCategory');
            const hiddenField = document.querySelector('input[name="category"]');

            if (select.value) {
                customInput.value = '';
                hiddenField.value = select.value;
                updatePreview(select.value);
            }
        }

        function updatePreviewFromCustom() {
            const customInput = document.getElementById('customCategory');
            const select = document.getElementById('category');
            const hiddenField = document.querySelector('input[name="category"]');

            select.value = '';
            hiddenField.value = customInput.value;
            updatePreview(customInput.value);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            const maxSize = 5 * 1024 * 1024;

            function handleFile(file) {
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    return;
                }
                if (file.size > maxSize) {
                    alert('File size must be less than 5MB');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    fileName.textContent = `File: ${file.name} (${(file.size/1024).toFixed(2)} KB)`;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', function(e) {
                if (e.target.files[0]) handleFile(e.target.files[0]);
            });

            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZone.classList.add('border-blue-500', 'bg-blue-50');
            });

            dropZone.addEventListener('dragleave', function() {
                dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('border-blue-500', 'bg-blue-50');
                if (e.dataTransfer.files[0]) {
                    fileInput.files = e.dataTransfer.files;
                    handleFile(e.dataTransfer.files[0]);
                }
            });

            // Initialize preview on load
            const currentCategory = document.querySelector('input[name="category"]').value;
            if (currentCategory) {
                updatePreview(currentCategory);
            }
        });
        </script>

        <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', ['label' => 'Save', 'loading' => 'Saving...'])
            <a href="{{ route('admin.prestasis.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>
@endsection
