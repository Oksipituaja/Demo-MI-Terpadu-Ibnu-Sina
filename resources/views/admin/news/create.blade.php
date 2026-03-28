@extends('admin.layout')

@section('page_title', 'Tambah Berita')
@section('page_subtitle', 'Tambah artikel berita baru')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="p-6 bg-white rounded-lg shadow">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <input type="hidden" id="slug" name="slug" value="{{ old('slug') }}">

                <div>
                    <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Judul Berita</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        placeholder="Masukkan judul berita..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt" class="block mb-1 text-sm font-medium text-gray-700">
                        Ringkasan
                        <span class="ml-1 text-xs font-normal text-gray-400">(ditampilkan di halaman daftar berita)</span>
                    </label>
                    <textarea id="excerpt" name="excerpt" rows="3" placeholder="Tulis ringkasan singkat berita ini..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block mb-1 text-sm font-medium text-gray-700">Isi Berita</label>

                    {{-- FIXED: Added skeleton loader (consistent with edit page) --}}
                    <div id="tinymce-skeleton" class="w-full rounded-lg border border-gray-200 bg-gray-100 overflow-hidden"
                        style="height:450px;">
                        <div class="flex items-center gap-2 px-3 py-2 border-b border-gray-200 bg-gray-50">
                            @for ($i = 0; $i < 10; $i++)
                                <div class="h-5 rounded bg-gray-200 animate-pulse"
                                    style="width:{{ [28, 28, 32, 28, 32, 28, 28, 36, 28, 32][$i] }}px"></div>
                                @if (in_array($i, [1, 3, 6]))
                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>
                                @endif
                            @endfor
                        </div>
                        <div class="p-4 space-y-3">
                            <div class="h-4 w-3/4 rounded bg-gray-200 animate-pulse"></div>
                            <div class="h-4 w-full rounded bg-gray-200 animate-pulse"></div>
                            <div class="h-4 w-5/6 rounded bg-gray-200 animate-pulse"></div>
                            <div class="h-4 w-2/3 rounded bg-gray-200 animate-pulse"></div>
                            <div class="h-4 w-full rounded bg-gray-200 animate-pulse"></div>
                            <div class="h-4 w-4/5 rounded bg-gray-200 animate-pulse"></div>
                        </div>
                    </div>

                    <textarea id="content" name="content" class="hidden">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Belum Tayang)
                            </option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publikasi
                                (Tayang)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Publikasi</label>
                        <div class="flex gap-2">
                            <div id="publishDateDisplay"
                                class="flex-1 px-4 py-2 text-sm text-gray-400 border border-gray-300 rounded-lg select-none bg-gray-50">
                                Belum dipilih
                            </div>
                            <input type="hidden" name="published_at" id="published_at_input"
                                value="{{ old('published_at') }}">
                            <button type="button" id="btn-pick-date"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shrink-0">
                                <i class="mr-1 fas fa-calendar"></i> Pilih
                            </button>
                        </div>
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Gambar Utama
                        <span class="ml-1 text-xs font-normal text-gray-400">(opsional)</span>
                    </label>
                    <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                        id="dropZone">
                        <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden">
                        <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                        <p class="text-gray-600">Seret & letakkan atau
                            <span class="font-medium text-blue-600 hover:text-blue-700 cursor-pointer"
                                id="pickFileBtn">pilih file</span>
                        </p>
                        <p class="mt-1 text-xs text-gray-400">JPG, PNG (Maks. 2MB)</p>
                    </div>
                    <div id="imagePreview" class="hidden mt-4">
                        <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                        <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
                    </div>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-4 border-t">
                    @include('components.admin-submit-btn', [
                        'label' => 'Simpan Berita',
                        'loading' => 'Menyimpan...',
                    ])
                    <a href="{{ route('admin.news.index') }}"
                        class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                        <i class="mr-2 fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── AUTO SLUG ──────────────────────────────────────────────────────
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

            titleInput.addEventListener('input', function() {
                slugInput.value = generateSlug(this.value);
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
                    alert('Pilih file gambar yang valid');
                    return;
                }
                if (file.size > maxSize) {
                    alert('Ukuran file maksimal 2MB');
                    return;
                }
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    fileName.textContent = `File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', e => {
                if (e.target.files[0]) handleFile(e.target.files[0]);
            });

            dropZone.addEventListener('click', function() {
                fileInput.click();
            });

            const pickFileBtn = document.getElementById('pickFileBtn');
            if (pickFileBtn) {
                pickFileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fileInput.click();
                });
            }
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

            // ── DATE PICKER ────────────────────────────────────────────────────
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const display = document.getElementById('publishDateDisplay');
            const hiddenInput = document.getElementById('published_at_input');
            const btnPickDate = document.getElementById('btn-pick-date');

            const fpContainer = document.createElement('div');
            fpContainer.style.cssText = 'position:fixed;z-index:99999;display:none;';
            document.body.appendChild(fpContainer);

            const fp = flatpickr(fpContainer, {
                enableTime: true,
                dateFormat: 'Y-m-d H:i',
                time_24hr: true,
                disableMobile: true,
                locale: window.flatpickrLocaleId,
                onChange: function(selectedDates) {
                    if (selectedDates[0]) {
                        const d = selectedDates[0];
                        hiddenInput.value = d.getFullYear() + '-' +
                            String(d.getMonth() + 1).padStart(2, '0') + '-' +
                            String(d.getDate()).padStart(2, '0') + ' ' +
                            String(d.getHours()).padStart(2, '0') + ':' +
                            String(d.getMinutes()).padStart(2, '0');
                        display.textContent = String(d.getDate()).padStart(2, '0') + ' ' +
                            months[d.getMonth()] + ' ' + d.getFullYear() + ', ' +
                            String(d.getHours()).padStart(2, '0') + ':' +
                            String(d.getMinutes()).padStart(2, '0');
                        display.classList.remove('text-gray-400');
                        display.classList.add('text-gray-800');
                    }
                },
                onClose: function() {
                    fpContainer.style.display = 'none';
                }
            });

            btnPickDate.addEventListener('click', function(e) {
                e.stopPropagation();
                const rect = btnPickDate.getBoundingClientRect();
                fpContainer.style.cssText =
                    `position:fixed;z-index:99999;top:${rect.bottom + 8}px;left:${rect.left}px;display:block;`;
                fp.open();
            });

            document.addEventListener('click', function(e) {
                const cal = document.querySelector('.flatpickr-calendar');
                if (
                    !fpContainer.contains(e.target) &&
                    !(cal && cal.contains(e.target)) &&
                    e.target.id !== 'btn-pick-date'
                ) {
                    fp.close();
                    fpContainer.style.display = 'none';
                }
            });

            // ── TINYMCE ────────────────────────────────────────────────────────
            tinymce.init({
                selector: '#content',
                license_key: 'gpl',
                height: 450,
                menubar: false,
                plugins: 'lists link autolink',
                toolbar: [
                    'undo redo | bold italic underline strikethrough | forecolor backcolor',
                    'bullist numlist | outdent indent | blockquote',
                    'link | alignleft aligncenter alignright alignjustify | removeformat'
                ],
                toolbar_mode: 'wrap',
                skin_url: '/build/tinymce/skins/ui/oxide',
                content_css: '/build/tinymce/skins/content/default/content.min.css',
                content_style: 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; max-width: 100%; }',
                image_uploadtab: false,
                ignore_clickoutside_selector: '[class*="flatpickr"]',
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                },
                init_instance_callback: function() {
                    const skeleton = document.getElementById('tinymce-skeleton');
                    if (skeleton) skeleton.remove();
                }
            });
        });
    </script>
@endpush
