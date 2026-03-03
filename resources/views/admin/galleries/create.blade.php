@extends('admin.layout')

@section('page_title', 'Add Gallery Item')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div><label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div><label class="block text-sm font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('slug') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div><label class="block text-sm font-medium mb-1">Category</label>
            <input type="text" name="category" value="{{ old('category') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Image Upload with Preview -->
        <div>
            <label class="block text-sm font-medium mb-2">Image (Required - Max 5 MB)</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition" id="dropZone">
                <input type="file" name="image" accept="image/*" required id="imageInput" class="hidden">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-300 mb-3 inline-block"></i>
                <p class="text-gray-600">Drag & drop image atau <button type="button" onclick="document.getElementById('imageInput').click()" class="text-blue-600 hover:text-blue-800 font-semibold">pilih file</button></p>
                <p class="text-xs text-gray-500 mt-2">JPG, PNG (Maks 5 MB)</p>
            </div>
            <!-- Image Preview -->
            <div id="imagePreview" class="mt-4 hidden">
                <img id="previewImg" src="" alt="Preview" class="max-w-xs h-48 object-cover rounded-lg">
                <p id="fileName" class="text-sm text-gray-600 mt-2"></p>
            </div>
            @error('image') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
        </div>

        <div><label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Save', 'loading' => 'Saving...'])
            <a href="{{ route('admin.galleries.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const dropZone = document.getElementById('dropZone');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const fileName = document.getElementById('fileName');

    // Handle file selection
    imageInput.addEventListener('change', function(e) {
        handleFile(this.files[0]);
    });

    // Handle drag & drop
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-blue-500', 'bg-blue-50');
    });
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        handleFile(e.dataTransfer.files[0]);
    });

    function handleFile(file) {
        if (file && file.type.startsWith('image/')) {
            if (file.size > 5 * 1024 * 1024) {
                alert('File terlalu besar. Maksimal 5 MB');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                fileName.textContent = `File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            alert('File harus berupa image');
        }
    }
});
</script>
@endsection
