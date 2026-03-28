@extends('admin.layout')

@section('page_title', 'Edit Fasilitas')
@section('page_subtitle', 'Perbarui informasi fasilitas sekolah')

@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.facilities.update', $facility) }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf @method('PUT')

            <input type="hidden" name="slug" value="{{ old('slug', $facility->slug) }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Fasilitas</label>
                <input type="text" name="name" id="facilityName" value="{{ old('name', $facility->name) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Ikon
                    <span class="ml-1 text-xs text-gray-400">(Font Awesome, cth: fas fa-book)</span>
                </label>
                <div class="flex items-center gap-2">
                    <input type="text" name="icon" id="iconInput" value="{{ old('icon', $facility->icon) }}"
                        placeholder="fas fa-book" oninput="updateIconPreview()"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg shrink-0">
                        <i id="iconPreviewEl"
                            class="{{ old('icon', $facility->icon) ?? 'fas fa-question' }} text-blue-600 text-lg"></i>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Cari ikon di <a href="https://fontawesome.com/icons" target="_blank"
                        class="text-blue-600 hover:underline">fontawesome.com/icons</a>
                </p>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Deskripsi
                    <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>

                <div id="tinymce-skeleton" class="w-full rounded-lg border border-gray-200 bg-gray-100 overflow-hidden"
                    style="height:300px;">
                    <div class="flex items-center gap-2 px-3 py-2 border-b border-gray-200 bg-gray-50">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="h-5 rounded bg-gray-200 animate-pulse"
                                style="width:{{ [28, 28, 32, 28, 28, 36, 28, 32][$i] }}px"></div>
                            @if (in_array($i, [1, 4]))
                                <div class="w-px h-5 bg-gray-300 mx-1"></div>
                            @endif
                        @endfor
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="h-4 w-3/4 rounded bg-gray-200 animate-pulse"></div>
                        <div class="h-4 w-full rounded bg-gray-200 animate-pulse"></div>
                        <div class="h-4 w-2/3 rounded bg-gray-200 animate-pulse"></div>
                        <div class="h-4 w-5/6 rounded bg-gray-200 animate-pulse"></div>
                        <div class="h-4 w-1/2 rounded bg-gray-200 animate-pulse"></div>
                    </div>
                </div>

                <textarea name="description" id="description" class="hidden">{{ old('description', $facility->description) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kondisi Fasilitas</label>
                <select name="kondisi"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="tersedia" {{ old('kondisi', $facility->kondisi) === 'tersedia' ? 'selected' : '' }}>
                        Tersedia</option>
                    <option value="perbaikan" {{ old('kondisi', $facility->kondisi) === 'perbaikan' ? 'selected' : '' }}>
                        Sedang Perbaikan</option>
                    <option value="belum_ada" {{ old('kondisi', $facility->kondisi) === 'belum_ada' ? 'selected' : '' }}>
                        Belum Ada</option>
                    <option value="akan_ada" {{ old('kondisi', $facility->kondisi) === 'akan_ada' ? 'selected' : '' }}>
                        Akan Ada</option>
                </select>
                @error('kondisi')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Gambar</label>
                @if ($facility->featured_image)
                    <div class="p-4 mb-4 border border-gray-200 rounded-lg bg-gray-50">
                        <p class="mb-2 text-xs font-medium text-gray-600">Gambar Saat Ini</p>
                        <img src="{{ asset('storage/' . $facility->featured_image) }}" alt="{{ $facility->name }}"
                            class="object-cover h-40 max-w-sm rounded">
                    </div>
                @endif
                {{-- FIXED: removed onclick from inner button to prevent double dialog --}}
                <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                    id="dropZone">
                    <input type="file" id="image" name="image" accept="image/*" class="hidden">
                    <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                    <p class="text-gray-600">Seret & letakkan atau
                        <span class="font-medium text-blue-600 hover:text-blue-700 cursor-pointer" id="pickFileBtn">pilih
                            file</span>
                    </p>
                    <p class="mt-1 text-xs text-gray-400">JPG, PNG (Maks. 5MB)</p>
                </div>
                <div id="imagePreview" class="hidden mt-4">
                    <p class="mb-2 text-xs font-medium text-gray-600">Pratinjau Gambar Baru</p>
                    <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                    <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Perubahan',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.facilities.index') }}"
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

            window.updateIconPreview = function() {
                const val = document.getElementById('iconInput').value.trim();
                document.getElementById('iconPreviewEl').className = (val || 'fas fa-question') +
                    ' text-blue-600 text-lg';
            };

            // ── TINYMCE ────────────────────────────────────────────────────────
            tinymce.init({
                selector: '#description',
                license_key: 'gpl',
                height: 300,
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
                    editor.on('change', function() {
                        editor.save();
                    });
                },
                init_instance_callback: function() {
                    const sk = document.getElementById('tinymce-skeleton');
                    if (sk) sk.remove();
                }
            });

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

            // Prevent span click from bubbling to dropZone
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
