@extends('admin.layout')
@section('page_title', 'Tambah Konten Sekolah')
@section('page_subtitle', 'Tambah informasi tentang sekolah')
@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="principalNameField" class="hidden">
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kepala Sekolah</label>
                <input type="text" name="principal_name" value="{{ old('principal_name') }}"
                    placeholder="cth: Drs. Ahmad Fauzi, M.Pd"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Tipe Konten</label>
                <select id="keySelect" name="key" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="home_hero_image" {{ old('key') === 'home_hero_image' ? 'selected' : '' }}>Gambar Hero
                        Beranda</option>
                    <option value="hero_image" {{ old('key') === 'hero_image' ? 'selected' : '' }}>Gambar Hero
                        Tentang Kami</option>
                    <option value="principal_greeting" {{ old('key') === 'principal_greeting' ? 'selected' : '' }}>Sambutan
                        Kepala Sekolah</option>
                    <option value="school_profile" {{ old('key') === 'school_profile' ? 'selected' : '' }}>Profil
                        Sekolah</option>
                    <option value="school_info" {{ old('key') === 'school_info' ? 'selected' : '' }}>Informasi
                        Sekolah (JSON)</option>
                    <option value="vision" {{ old('key') === 'vision' ? 'selected' : '' }}>Visi</option>
                    <option value="mission" {{ old('key') === 'mission' ? 'selected' : '' }}>Misi</option>
                </select>
                <p id="keyHint" class="hidden mt-1 text-xs text-gray-400"></p>
            </div>

            {{-- JSON Fields --}}
            <div id="schoolInfoFields" class="hidden p-4 space-y-4 border border-blue-200 rounded-lg bg-blue-50">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">NPSN</label>
                        <input type="text" id="si_npsn"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Nama Sekolah</label>
                        <input type="text" id="si_name"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                </div>
            </div>

            {{-- Content TinyMCE --}}
            <div id="contentWrapper" class="hidden">
                <label class="block mb-1 text-sm font-medium text-gray-700">Konten</label>
                <div id="tinymce-skeleton"
                    class="hidden w-full overflow-hidden bg-gray-100 border border-gray-200 rounded-lg"
                    style="height:350px;">
                    <div class="flex items-center gap-2 px-3 py-2 border-b border-gray-200 bg-gray-50">
                        @for ($i = 0; $i < 10; $i++)
                            <div class="h-5 bg-gray-200 rounded animate-pulse"
                                style="width:{{ [28, 28, 32, 28, 32, 28, 28, 36, 28, 32][$i] }}px"></div>
                            @if (in_array($i, [1, 3, 6]))
                                <div class="w-px h-5 mx-1 bg-gray-300"></div>
                            @endif
                        @endfor
                    </div>
                    <div class="p-4 space-y-3">
                        @foreach ([75, 100, 83, 66, 100, 80] as $w)
                            <div class="h-4 bg-gray-200 rounded animate-pulse" style="width:{{ $w }}%"></div>
                        @endforeach
                    </div>
                </div>
                <textarea name="content" id="contentField" class="hidden">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- ✅ Crop Component — rasio dinamis via Alpine + JS di bawah --}}
            {{-- Wrapper visibility dikelola JS, component ini selalu dirender tapi disembunyikan --}}
            <div id="imageFieldWrapper" class="hidden">
                {{--
                    Kita tidak bisa mengubah aspect-ratio component secara dinamis karena Blade
                    di-render server-side. Solusi: render 3 varian, tampilkan sesuai key.
                --}}
                <div id="crop169" class="hidden">
                    <x-image-crop-upload id="crop169input" name="featured_image" label="Gambar" aspect-ratio="16/9"
                        :optional="false" :error="$errors->first('featured_image')" />
                </div>
                <div id="crop11" class="hidden">
                    <x-image-crop-upload id="crop11input" name="featured_image" label="Foto Kepala Sekolah"
                        aspect-ratio="1/1" preview-class="w-40 h-40" :optional="false" :error="$errors->first('featured_image')" />
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Konten',
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
        document.addEventListener('DOMContentLoaded', function() {
            const keySelect = document.getElementById('keySelect');
            const contentField = document.getElementById('contentField');
            const contentWrapper = document.getElementById('contentWrapper');
            const skeleton = document.getElementById('tinymce-skeleton');
            const keyHint = document.getElementById('keyHint');
            const imageWrapper = document.getElementById('imageFieldWrapper');
            const crop169 = document.getElementById('crop169');
            const crop11 = document.getElementById('crop11');

            const imageOnlyKeys = ['home_hero_image', 'hero_image'];
            const noImageKeys = ['school_profile', 'vision', 'mission', 'school_info'];
            const hints = {
                'home_hero_image': 'Gambar ini ditampilkan di section kanan hero halaman Beranda.',
                'hero_image': 'Gambar ini ditampilkan sebagai banner besar di halaman Tentang Kami.',
                'principal_greeting': 'Foto & sambutan kepala sekolah ditampilkan di Beranda dan halaman Tentang.',
            };

            let tinymceReady = false;

            function buildJson() {
                const data = {
                    npsn: document.getElementById('si_npsn').value,
                    nama_sekolah: document.getElementById('si_name').value
                };
                contentField.value = JSON.stringify(data);
            }
            document.querySelectorAll('.si-input').forEach(el => el.addEventListener('input', buildJson));

            function initTinyMCE() {
                if (tinymceReady || typeof tinymce === 'undefined') return;
                tinymceReady = true;
                tinymce.init({
                    selector: '#contentField',
                    license_key: 'gpl',
                    height: 350,
                    menubar: false,
                    plugins: 'lists link autolink',
                    toolbar: ['undo redo | bold italic underline strikethrough | forecolor backcolor',
                        'bullist numlist | outdent indent | blockquote | link | alignleft aligncenter alignright | removeformat'
                    ],
                    toolbar_mode: 'wrap',
                    skin_url: '/build/tinymce/skins/ui/oxide',
                    content_css: '/build/tinymce/skins/content/default/content.min.css',
                    content_style: 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; }',
                    setup: e => e.on('change', () => e.save()),
                    init_instance_callback: () => {
                        if (skeleton) skeleton.remove();
                        contentField.classList.remove('hidden');
                    }
                });
            }

            function toggleFields() {
                const key = keySelect.value;
                const isImageOnly = imageOnlyKeys.includes(key);
                const isSchoolInfo = key === 'school_info';
                const hasContent = key !== '' && !isSchoolInfo && !isImageOnly;
                const showImage = !noImageKeys.includes(key) && key !== '';
                const isPrincipal = key === 'principal_greeting';
                const isHero = key === 'home_hero_image' || key === 'hero_image';

                // Hint
                keyHint.textContent = hints[key] ?? '';
                keyHint.classList.toggle('hidden', !hints[key]);

                // Principal name
                document.getElementById('principalNameField').classList.toggle('hidden', !isPrincipal);

                // School info fields
                document.getElementById('schoolInfoFields').classList.toggle('hidden', !isSchoolInfo);

                // Content wrapper
                contentWrapper.classList.toggle('hidden', !hasContent);

                // Image — show/hide wrapper and correct crop variant
                imageWrapper.classList.toggle('hidden', !showImage);
                if (showImage) {
                    crop169.classList.toggle('hidden', isPrincipal);
                    crop11.classList.toggle('hidden', !isPrincipal);
                }

                // TinyMCE logic
                if (isSchoolInfo) {
                    if (typeof tinymce !== 'undefined' && tinymce.get('contentField')) {
                        tinymce.get('contentField').remove();
                        tinymceReady = false;
                    }
                    if (skeleton) skeleton.classList.add('hidden');
                    contentField.classList.remove('hidden');
                    buildJson();
                } else if (hasContent) {
                    if (skeleton) skeleton.classList.remove('hidden');
                    contentField.classList.add('hidden');
                    initTinyMCE();
                } else {
                    if (typeof tinymce !== 'undefined' && tinymce.get('contentField')) {
                        tinymce.get('contentField').remove();
                        tinymceReady = false;
                    }
                    if (skeleton) skeleton.classList.add('hidden');
                }
            }

            keySelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
@endpush
