@extends('admin.layout')

@section('page_title', 'Edit Konten Sekolah')
@section('page_subtitle', 'Perbarui informasi tentang sekolah')

@section('content')
<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
    <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title', $about->title) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('title')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div id="principalNameField" class="{{ $about->key !== 'principal_greeting' ? 'hidden' : '' }}">
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kepala Sekolah</label>
            <input type="text" name="principal_name" value="{{ old('principal_name', $about->principal_name) }}"
                placeholder="cth: Drs. Ahmad Fauzi, M.Pd"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Tipe Konten</label>
            <select id="keySelect" name="key" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50">
                <option value="home_hero_image"    {{ $about->key === 'home_hero_image'    ? 'selected' : '' }}>🏠 Gambar Hero Beranda</option>
                <option value="hero_image"         {{ $about->key === 'hero_image'         ? 'selected' : '' }}>📄 Gambar Hero Tentang Kami</option>
                <option value="principal_greeting" {{ $about->key === 'principal_greeting' ? 'selected' : '' }}>Sambutan Kepala Sekolah</option>
                <option value="school_profile"     {{ $about->key === 'school_profile'     ? 'selected' : '' }}>Profil Sekolah</option>
                <option value="school_info"        {{ $about->key === 'school_info'        ? 'selected' : '' }}>Informasi Sekolah (JSON)</option>
                <option value="vision"             {{ $about->key === 'vision'             ? 'selected' : '' }}>Visi</option>
                <option value="mission"            {{ $about->key === 'mission'            ? 'selected' : '' }}>Misi</option>
            </select>
            <p id="keyHint" class="mt-1 text-xs text-gray-400 hidden"></p>
        </div>

        @php
            $info = [];
            if ($about->key === 'school_info') {
                $info = json_decode($about->content, true) ?: [];
            }
        @endphp
        <div id="schoolInfoFields" class="{{ $about->key !== 'school_info' ? 'hidden' : '' }} p-4 space-y-4 border border-blue-200 rounded-lg bg-blue-50">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">NPSN</label>
                    <input type="text" id="si_npsn" value="{{ $info['npsn'] ?? '' }}"
                        class="si-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Nama Sekolah</label>
                    <input type="text" id="si_name" value="{{ $info['nama_sekolah'] ?? '' }}"
                        class="si-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                </div>
            </div>
        </div>

        {{-- Content + Skeleton — tersembunyi untuk image-only key --}}
        @php $imageOnlyKeys = ['home_hero_image', 'hero_image']; @endphp
        <div id="contentWrapper" class="{{ $about->key === 'school_info' || in_array($about->key, $imageOnlyKeys) ? 'hidden' : '' }}">
            <label class="block mb-1 text-sm font-medium text-gray-700">Konten</label>

            <div id="tinymce-skeleton" class="w-full rounded-lg border border-gray-200 bg-gray-100 overflow-hidden"
                style="height:350px;">
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

            <textarea name="content" id="contentField" class="hidden">{{ old('content', $about->content) }}</textarea>
            @error('content')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image Field --}}
        @php $noImageKeys = ['school_profile', 'vision', 'mission', 'school_info']; @endphp
        <div id="imageField" class="{{ in_array($about->key, $noImageKeys) ? 'hidden' : '' }}">
            <label class="block mb-1 text-sm font-medium text-gray-700" id="imageLabel">
                @if($about->key === 'home_hero_image') Gambar Hero Beranda
                @elseif($about->key === 'hero_image') Gambar Hero Tentang Kami
                @else Gambar
                @endif
            </label>

            @if ($about->featured_image)
                <div class="p-4 mb-4 border border-gray-200 rounded-lg bg-gray-50">
                    <p class="mb-2 text-xs font-medium text-gray-600">Gambar Saat Ini</p>
                    <img src="{{ asset('storage/' . $about->featured_image) }}"
                        alt="{{ $about->title }}"
                        class="object-cover h-40 max-w-sm rounded-lg" id="currentImg">
                </div>
            @endif

            <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                id="dropZone">
                <input type="file" id="image" name="featured_image" accept="image/*" class="hidden">
                <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                <p class="text-gray-600">Seret & letakkan atau
                    <span class="font-medium text-blue-600 hover:text-blue-700 cursor-pointer" id="pickFileBtn">pilih file</span>
                </p>
                <p class="mt-1 text-xs text-gray-400">JPG, PNG (Maks. 5MB)</p>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <p class="mb-2 text-xs font-medium text-gray-600">Pratinjau Gambar Baru</p>
                <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
            </div>
            @error('featured_image')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', [
                'label'   => 'Simpan Perubahan',
                'loading' => 'Menyimpan...',
            ])
            <a href="{{ route('admin.about.index') }}"
                class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                <i class="mr-2 fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const keySelect      = document.getElementById('keySelect');
        const contentField   = document.getElementById('contentField');
        const contentWrapper = document.getElementById('contentWrapper');
        const skeleton       = document.getElementById('tinymce-skeleton');
        const keyHint        = document.getElementById('keyHint');
        const imageLabel     = document.getElementById('imageLabel');

        const imageOnlyKeys = ['home_hero_image', 'hero_image'];
        const noImageKeys   = ['school_profile', 'vision', 'mission', 'school_info'];

        const hints = {
            'home_hero_image'    : 'Gambar ini ditampilkan di section kanan hero halaman Beranda.',
            'hero_image'         : 'Gambar ini ditampilkan sebagai banner besar di halaman Tentang Kami.',
            'principal_greeting' : 'Foto & sambutan kepala sekolah ditampilkan di Beranda dan halaman Tentang.',
        };

        let tinymceReady = false;

        function buildJson() {
            const data = {
                npsn         : document.getElementById('si_npsn').value,
                nama_sekolah : document.getElementById('si_name').value,
            };
            contentField.value = JSON.stringify(data);
        }
        document.querySelectorAll('.si-input').forEach(el => el.addEventListener('input', buildJson));

        function initTinyMCE() {
            if (tinymceReady || typeof tinymce === 'undefined') return;
            tinymceReady = true;
            tinymce.init({
                selector      : '#contentField',
                license_key   : 'gpl',
                height        : 350,
                menubar       : false,
                plugins       : 'lists link autolink',
                toolbar       : [
                    'undo redo | bold italic underline strikethrough | forecolor backcolor',
                    'bullist numlist | outdent indent | blockquote',
                    'link | alignleft aligncenter alignright alignjustify | removeformat'
                ],
                toolbar_mode  : 'wrap',
                skin_url      : '/build/tinymce/skins/ui/oxide',
                content_css   : '/build/tinymce/skins/content/default/content.min.css',
                content_style : 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; max-width: 100%; }',
                setup: function (editor) {
                    editor.on('change', function () { editor.save(); });
                },
                init_instance_callback: function () {
                    if (skeleton) skeleton.remove();
                    contentField.classList.remove('hidden');
                }
            });
        }

        function toggleFields() {
            const key          = keySelect.value;
            const isImageOnly  = imageOnlyKeys.includes(key);
            const isSchoolInfo = key === 'school_info';
            const hasContent   = key !== '' && !isSchoolInfo && !isImageOnly;
            const showImage    = !noImageKeys.includes(key) && key !== '';

            if (hints[key]) {
                keyHint.textContent = hints[key];
                keyHint.classList.remove('hidden');
            } else {
                keyHint.classList.add('hidden');
            }

            if (imageLabel) {
                if (key === 'home_hero_image') imageLabel.textContent = 'Gambar Hero Beranda';
                else if (key === 'hero_image') imageLabel.textContent = 'Gambar Hero Tentang Kami';
                else imageLabel.textContent = 'Gambar';
            }

            document.getElementById('principalNameField')
                .classList.toggle('hidden', key !== 'principal_greeting');
            document.getElementById('imageField')
                .classList.toggle('hidden', !showImage);
            document.getElementById('schoolInfoFields')
                .classList.toggle('hidden', !isSchoolInfo);
            contentWrapper.classList.toggle('hidden', !hasContent);

            if (isSchoolInfo) {
                if (typeof tinymce !== 'undefined' && tinymce.get('contentField')) {
                    tinymce.get('contentField').remove();
                    tinymceReady = false;
                }
                if (skeleton) skeleton.style.display = 'none';
                contentField.classList.remove('hidden');
                buildJson();
            } else if (hasContent) {
                if (skeleton) skeleton.style.display = '';
                contentField.classList.add('hidden');
                initTinyMCE();
            } else {
                if (typeof tinymce !== 'undefined' && tinymce.get('contentField')) {
                    tinymce.get('contentField').remove();
                    tinymceReady = false;
                }
                if (skeleton) skeleton.style.display = 'none';
            }
        }

        keySelect.addEventListener('change', toggleFields);
        toggleFields();

        // ── Image upload ───────────────────────────────────────────────────────
        const dropZone     = document.getElementById('dropZone');
        const pickFileBtn  = document.getElementById('pickFileBtn');
        const fileInput    = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg   = document.getElementById('previewImg');
        const fileName     = document.getElementById('fileName');
        const maxSize      = 5 * 1024 * 1024;

        function handleFile(file) {
            if (!file.type.startsWith('image/')) { alert('Pilih file gambar yang valid'); return; }
            if (file.size > maxSize) { alert('Ukuran file maksimal 5MB'); return; }
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                fileName.textContent = `File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                imagePreview.classList.remove('hidden');
                const currentImg = document.getElementById('currentImg');
                if (currentImg) currentImg.classList.add('opacity-50');
            };
            reader.readAsDataURL(file);
        }

        dropZone.addEventListener('click', function () { fileInput.click(); });
        pickFileBtn.addEventListener('click', function (e) { e.stopPropagation(); fileInput.click(); });
        fileInput.addEventListener('change', e => { if (e.target.files[0]) handleFile(e.target.files[0]); });
        dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-blue-500', 'bg-blue-50'); });
        dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('border-blue-500', 'bg-blue-50'); });
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            if (e.dataTransfer.files[0]) { fileInput.files = e.dataTransfer.files; handleFile(e.dataTransfer.files[0]); }
        });
    });
</script>
@endpush