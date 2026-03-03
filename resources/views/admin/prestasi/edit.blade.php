@extends('admin.layout')

@section('page_title', 'Edit Achievement')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.prestasis.update', $prestasi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $prestasi->title) }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="6" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $prestasi->description) }}</textarea>
            @error('description') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Category <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="category" 
                    name="category" 
                    value="{{ old('category', $prestasi->category) }}" 
                    placeholder="e.g., Juara 1 IT Software" 
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                >
                <p class="text-xs text-gray-500 mt-2">
                    Format: <strong>Juara 1</strong>, <strong>Juara 2</strong>, <strong>Juara 3</strong>, <strong>Juara Harapan</strong>, or custom text
                </p>
                <div id="awardPreview" class="mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200 flex items-center gap-3">
                    <span id="previewEmoji" class="text-3xl">🏆</span>
                    <span id="previewLabel" class="text-sm text-gray-600">Award Preview</span>
                </div>
                @error('category') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Achievement Date</label>
                <input type="date" name="achievement_date" value="{{ old('achievement_date', $prestasi->achievement_date?->format('Y-m-d')) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('achievement_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Image</label>
            @if($prestasi->image)
                <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-xs font-medium text-gray-600 mb-2">Current Image</p>
                    <img src="{{ asset('storage/' . $prestasi->image) }}" alt="{{ $prestasi->title }}" class="max-w-sm h-40 object-cover rounded">
                </div>
            @endif
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
                <option value="draft" {{ old('status', $prestasi->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $prestasi->status) === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <script>
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

            // Category award preview
            const categoryInput = document.getElementById('category');
            const previewEmoji = document.getElementById('previewEmoji');
            const previewLabel = document.getElementById('previewLabel');

            function updateAwardPreview(category) {
                const categoryUpper = category.toUpperCase();
                let emoji = '🏆';
                let label = 'Prestasi';

                if (categoryUpper.includes('JUARA 1')) {
                    emoji = '🥇';
                    label = 'Juara 1 (Gold)';
                } else if (categoryUpper.includes('JUARA 2')) {
                    emoji = '🥈';
                    label = 'Juara 2 (Silver)';
                } else if (categoryUpper.includes('JUARA 3')) {
                    emoji = '🥉';
                    label = 'Juara 3 (Bronze)';
                } else if (categoryUpper.includes('HARAPAN')) {
                    emoji = '⭐';
                    label = 'Harapan (Star)';
                }

                previewEmoji.textContent = emoji;
                previewLabel.textContent = label;
            }

            categoryInput.addEventListener('input', function(e) {
                updateAwardPreview(e.target.value);
            });

            // Initialize preview on page load
            updateAwardPreview(categoryInput.value);
        });
        </script>

        <div class="flex gap-3 pt-4 border-t">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg"><i class="fas fa-save mr-2"></i> Update</button>
            <a href="{{ route('admin.prestasis.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>

    <form action="{{ route('admin.prestasis.destroy', $prestasi) }}" method="POST" class="mt-6 pt-6 border-t" onsubmit="return confirm('Are you sure?')">
        @csrf @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
            <i class="fas fa-trash mr-2"></i> Delete This Achievement
        </button>
    </form>
</div>
@endsection
