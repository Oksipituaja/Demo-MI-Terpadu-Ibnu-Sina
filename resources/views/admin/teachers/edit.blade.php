@extends('admin.layout')

@section('page_title', 'Edit Guru')
@section('page_subtitle', 'Perbarui informasi guru')

@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf @method('PUT')

            <input type="hidden" name="slug" value="{{ old('slug', $teacher->slug) }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $teacher->name) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $teacher->email) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    No. Telepon
                    <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>
                <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Jabatan/Mapel</label>
                <input type="text" name="subject" value="{{ old('subject', $teacher->subject) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Foto</label>
                @if ($teacher->featured_image)
                    <div class="p-4 mb-4 border border-gray-200 rounded-lg bg-gray-50">
                        <p class="mb-2 text-xs font-medium text-gray-600">Foto Saat Ini</p>
                        <img src="{{ asset('storage/' . $teacher->featured_image) }}" alt="{{ $teacher->name }}"
                            class="object-cover h-40 max-w-sm rounded-lg">
                    </div>
                @endif
                {{-- FIXED: removed onclick from inner button to prevent double dialog --}}
                <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                    id="dropZone">
                    <input type="file" id="image" name="featured_image" accept="image/*" class="hidden">
                    <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                    <p class="text-gray-600">Seret & letakkan atau
                        <span class="font-medium text-blue-600 hover:text-blue-700 cursor-pointer" id="pickFileBtn">pilih
                            file</span>
                    </p>
                    <p class="mt-1 text-xs text-gray-400">JPG, PNG (Maks. 5MB)</p>
                </div>
                <div id="imagePreview" class="hidden mt-4">
                    <p class="mb-2 text-xs font-medium text-gray-600">Pratinjau Foto Baru</p>
                    <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                    <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
                </div>
                @error('image')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Perubahan',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.teachers.index') }}"
                    class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ── IMAGE UPLOAD (FIXED: no more double dialog) ────────────────────
            const dropZone = document.getElementById('dropZone');
            const pickFileBtn = document.getElementById('pickFileBtn');
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            const maxSize = 5 * 1024 * 1024;

            function handleFile(file) {
                if (!file.type.startsWith('image/')) {
                    alert('Pilih file gambar yang valid');
                    return;
                }
                if (file.size > maxSize) {
                    alert('Ukuran file maksimal 5MB');
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

            dropZone.addEventListener('click', function() {
                fileInput.click();
            });

            pickFileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });

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
@endpush
