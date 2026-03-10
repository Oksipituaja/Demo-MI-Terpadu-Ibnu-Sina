@extends('admin.layout')

@section('page_title', 'Edit Facility')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.facilities.update', $facility) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" id="facilityName" value="{{ old('name', $facility->name) }}" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Slug
                <span class="ml-1 text-xs text-yellow-600">⚠ Hati-hati mengubah slug</span>
            </label>
            <div class="flex gap-2">
                <input type="text" name="slug" id="facilitySlug" value="{{ old('slug', $facility->slug) }}" required
                    class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50">
                <button type="button" id="btn-reset-slug"
                    class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-xs font-medium transition">
                    <i class="fas fa-sync-alt mr-1"></i> Generate dari Name
                </button>
            </div>
            @error('slug') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Icon
                <span class="text-xs text-gray-500 ml-1">(Font Awesome class, cth: fas fa-book)</span>
            </label>
            <div class="flex gap-2 items-center">
                <input type="text" name="icon" id="iconInput" value="{{ old('icon', $facility->icon) }}"
                    placeholder="fas fa-book"
                    class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    oninput="updateIconPreview()">
                <div id="iconPreview"
                    class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                    <i id="iconPreviewEl" class="{{ old('icon', $facility->icon) ?? 'fas fa-question' }} text-blue-600 text-lg"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-1">
                Cari icon di <a href="https://fontawesome.com/icons" target="_blank" class="text-blue-600 hover:underline">fontawesome.com/icons</a>
            </p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $facility->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Kondisi Fasilitas</label>
            <select name="kondisi" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Kondisi --</option>
                <option value="tersedia"  {{ old('kondisi', $facility->kondisi) === 'tersedia'  ? 'selected' : '' }}>Tersedia</option>
                <option value="perbaikan" {{ old('kondisi', $facility->kondisi) === 'perbaikan' ? 'selected' : '' }}>Sedang Perbaikan</option>
                <option value="belum_ada" {{ old('kondisi', $facility->kondisi) === 'belum_ada' ? 'selected' : '' }}>Belum Ada</option>
                <option value="akan_ada"  {{ old('kondisi', $facility->kondisi) === 'akan_ada'  ? 'selected' : '' }}>Akan Ada</option>
            </select>
            @error('kondisi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Image</label>
            @if($facility->image)
                <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-xs font-medium text-gray-600 mb-2">Gambar Saat Ini</p>
                    <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}"
                        class="max-w-sm h-40 object-cover rounded">
                </div>
            @endif
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition" id="dropZone">
                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                <div>
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Drag & drop atau
                        <button type="button" class="text-blue-600 hover:text-blue-700 font-medium"
                            onclick="document.getElementById('image').click()">pilih file</button>
                    </p>
                    <p class="text-xs text-gray-500 mt-2">JPG, PNG (Max 5MB)</p>
                </div>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <p class="text-xs font-medium text-gray-600 mb-2">Pratinjau Gambar Baru</p>
                <img id="previewImg" src="" alt="Preview" class="max-w-sm h-40 object-cover rounded-lg">
                <p id="fileName" class="text-xs text-gray-600 mt-2"></p>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Update', 'loading' => 'Updating...'])
            <a href="{{ route('admin.facilities.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var nameInput = document.getElementById('facilityName');
    var slugInput = document.getElementById('facilitySlug');

    function generateSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[àáâãäå]/g, 'a')
            .replace(/[èéêë]/g, 'e')
            .replace(/[ìíîï]/g, 'i')
            .replace(/[òóôõö]/g, 'o')
            .replace(/[ùúûü]/g, 'u')
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/[\s-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    document.getElementById('btn-reset-slug').addEventListener('click', function () {
        if (confirm('Generate ulang slug dari name?\nURL lama bisa tidak berfungsi!')) {
            slugInput.value = generateSlug(nameInput.value);
        }
    });

    window.updateIconPreview = function () {
        var val = document.getElementById('iconInput').value.trim();
        var el  = document.getElementById('iconPreviewEl');
        el.className = val ? val + ' text-blue-600 text-lg' : 'fas fa-question text-blue-600 text-lg';
    };

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