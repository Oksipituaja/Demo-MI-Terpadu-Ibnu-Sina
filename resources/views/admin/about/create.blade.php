@extends('admin.layout')

@section('page_title', 'Add About Section')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div><label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div id="principalNameField" class="hidden"><label class="block text-sm font-medium mb-1">Principal Name</label>
            <input type="text" name="principal_name" value="{{ old('principal_name') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Nama Kepala Sekolah">
            @error('principal_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div><label class="block text-sm font-medium mb-1">Key (Unique identifier)</label>
            <select id="keySelect" name="key" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Tipe --</option>
                <option value="hero_image" {{ old('key') === 'hero_image' ? 'selected' : '' }}>Hero Image (Gambar di Homepage)</option>
                <option value="principal_greeting" {{ old('key') === 'principal_greeting' ? 'selected' : '' }}>Sambutan Kepala Sekolah</option>
                <option value="school_profile" {{ old('key') === 'school_profile' ? 'selected' : '' }}>Profil Sekolah</option>
                <option value="vision" {{ old('key') === 'vision' ? 'selected' : '' }}>Visi</option>
                <option value="mission" {{ old('key') === 'mission' ? 'selected' : '' }}>Misi</option>
            </select>
            <p class="text-gray-500 text-xs mt-1">Pilih atau gunakan key custom dengan lowercase underscore</p>
            @error('key') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div><label class="block text-sm font-medium mb-1">Content</label>
            <textarea name="content" rows="6" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('content') }}</textarea>
            @error('content') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div id="imageField"><label class="block text-sm font-medium mb-1">Image (Optional)</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition" id="dropZone">
                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                <div>
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Drag & drop atau <button type="button" class="text-blue-600 hover:text-blue-700 font-medium" onclick="document.getElementById('image').click()">pilih file</button></p>
                    <p class="text-xs text-gray-500 mt-2">JPG, PNG (Max 5MB)</p>
                </div>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <img id="previewImg" src="" alt="Preview" class="max-w-sm h-40 object-cover rounded-lg">
                <p id="fileName" class="text-xs text-gray-600 mt-2"></p>
            </div>
            @error('image') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const keySelect = document.getElementById('keySelect');
            const principalNameField = document.getElementById('principalNameField');
            const imageField = document.getElementById('imageField');
            const noImageKeys = ['school_profile', 'mission', 'vision'];

            function toggleFields() {
                const selectedKey = keySelect.value;
                
                // Toggle principal name field
                if (selectedKey === 'principal_greeting') {
                    principalNameField.classList.remove('hidden');
                } else {
                    principalNameField.classList.add('hidden');
                }
                
                // Toggle image field
                if (noImageKeys.includes(selectedKey)) {
                    imageField.classList.add('hidden');
                } else {
                    imageField.classList.remove('hidden');
                }
            }

            keySelect.addEventListener('change', toggleFields);
            toggleFields(); // Call on page load
        });
        </script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            const maxSize = 5 * 1024 * 1024; // 5MB

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
        });
        </script>

        <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', ['label' => 'Save', 'loading' => 'Saving...'])
            <a href="{{ route('admin.about.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>
@endsection
