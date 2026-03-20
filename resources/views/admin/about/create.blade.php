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
            @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div id="principalNameField" class="hidden">
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kepala Sekolah</label>
            <input type="text" name="principal_name" value="{{ old('principal_name') }}"
                placeholder="cth: Drs. Ahmad Fauzi, M.Pd"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('principal_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Tipe Konten</label>
            <select id="keySelect" name="key" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Tipe --</option>
                <option value="hero_image"         {{ old('key') === 'hero_image'         ? 'selected' : '' }}>Gambar Utama (Homepage)</option>
                <option value="principal_greeting" {{ old('key') === 'principal_greeting' ? 'selected' : '' }}>Sambutan Kepala Sekolah</option>
                <option value="school_profile"     {{ old('key') === 'school_profile'     ? 'selected' : '' }}>Profil Sekolah</option>
                <option value="school_info"        {{ old('key') === 'school_info'        ? 'selected' : '' }}>Informasi Sekolah (NPSN, SK, dll)</option>
                <option value="vision"             {{ old('key') === 'vision'             ? 'selected' : '' }}>Visi</option>
                <option value="mission"            {{ old('key') === 'mission'            ? 'selected' : '' }}>Misi</option>
            </select>
            <p class="mt-1 text-xs text-gray-500">Pilih tipe konten yang ingin ditambahkan</p>
            @error('key') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- School Info Fields --}}
        <div id="schoolInfoFields" class="hidden p-4 space-y-4 border border-blue-200 rounded-lg bg-blue-50">
            <p class="text-sm font-semibold text-blue-700">
                <i class="mr-1 fas fa-info-circle"></i> Data ini akan disimpan sebagai JSON
            </p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">NPSN</label>
                    <input type="text" id="si_npsn" value="60712544"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Nama Sekolah</label>
                    <input type="text" id="si_name" value="MIS TERPADU IBNU SINA"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Naungan</label>
                    <input type="text" id="si_naungan" value="Kementerian Agama"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Jenjang Pendidikan</label>
                    <input type="text" id="si_jenjang" value="MI"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Status Sekolah</label>
                    <input type="text" id="si_status" value="Swasta"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Tanggal Berdiri</label>
                    <input type="text" id="si_berdiri" value="28 Januari 2008"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">No. SK Pendirian</label>
                    <input type="text" id="si_sk_pendirian" value="Kd.11.20/4/PP.03.2/58/2008"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Tanggal Operasional</label>
                    <input type="text" id="si_operasional" value="28 Januari 2008"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-700">No. SK Operasional</label>
                    <input type="text" id="si_sk_operasional" value="kd.11.20/MI/167/08"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-700">Alamat Lengkap</label>
                    <input type="text" id="si_alamat" value="Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <div id="contentWrapper">
            <label class="block mb-1 text-sm font-medium text-gray-700">Konten</label>
            <textarea name="content" id="contentField" rows="6">{{ old('content') }}</textarea>
            @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div id="imageField">
            <label class="block mb-1 text-sm font-medium text-gray-700">
                Gambar
                <span class="ml-1 text-xs text-gray-400">(opsional)</span>
            </label>
            <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                id="dropZone">
                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                <p class="text-gray-600">Seret & letakkan atau
                    <button type="button" class="font-medium text-blue-600 hover:text-blue-700"
                        onclick="document.getElementById('image').click()">pilih file</button>
                </p>
                <p class="mt-1 text-xs text-gray-400">JPG, PNG (Maks. 5MB)</p>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
            </div>
            @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-4 border-t">
            @include('components.admin-submit-btn', ['label' => 'Simpan Konten', 'loading' => 'Menyimpan...'])
            <a href="{{ route('admin.about.index') }}"
                class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                <i class="mr-2 fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const keySelect          = document.getElementById('keySelect');
    const principalNameField = document.getElementById('principalNameField');
    const imageField         = document.getElementById('imageField');
    const schoolInfoFields   = document.getElementById('schoolInfoFields');
    const contentWrapper     = document.getElementById('contentWrapper');
    const contentField       = document.getElementById('contentField');
    const noImageKeys        = ['school_profile', 'mission', 'vision', 'school_info'];

    let editorInstance = null;

    function buildSchoolInfoJson() {
        const data = {
            npsn:                document.getElementById('si_npsn').value,
            nama_sekolah:        document.getElementById('si_name').value,
            naungan:             document.getElementById('si_naungan').value,
            jenjang:             document.getElementById('si_jenjang').value,
            status:              document.getElementById('si_status').value,
            tanggal_berdiri:     document.getElementById('si_berdiri').value,
            sk_pendirian:        document.getElementById('si_sk_pendirian').value,
            tanggal_operasional: document.getElementById('si_operasional').value,
            sk_operasional:      document.getElementById('si_sk_operasional').value,
            alamat:              document.getElementById('si_alamat').value,
        };
        contentField.value = JSON.stringify(data, null, 2);
    }

    document.querySelectorAll('[id^="si_"]').forEach(function (input) {
        input.addEventListener('input', buildSchoolInfoJson);
    });

    function initEditor() {
        if (editorInstance) return;
        tinymce.init({
            selector: '#contentField',
            license_key: 'gpl',
            height: 350,
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
            content_style: 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; }',
            setup: function(editor) {
                editorInstance = editor;
                editor.on('change', function() { editor.save(); });
            }
        });
    }

    function destroyEditor() {
        if (tinymce.get('contentField')) {
            tinymce.get('contentField').remove();
            editorInstance = null;
        }
    }

    function toggleFields() {
        const key = keySelect.value;

        principalNameField.classList.toggle('hidden', key !== 'principal_greeting');
        imageField.classList.toggle('hidden', noImageKeys.includes(key));
        schoolInfoFields.classList.toggle('hidden', key !== 'school_info');
        contentWrapper.classList.toggle('hidden', key === 'school_info');

        if (key === 'school_info') {
            destroyEditor();
            buildSchoolInfoJson();
        } else {
            if (key !== '') initEditor();
            else destroyEditor();
        }
    }

    keySelect.addEventListener('change', toggleFields);
    toggleFields();

    // ── IMAGE UPLOAD ───────────────────────────────────────────────────
    const dropZone     = document.getElementById('dropZone');
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
            fileName.textContent = `File: ${file.name} (${(file.size/1024).toFixed(2)} KB)`;
            imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', e => { if (e.target.files[0]) handleFile(e.target.files[0]); });
    dropZone.addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-blue-500','bg-blue-50'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-blue-500','bg-blue-50'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault(); dropZone.classList.remove('border-blue-500','bg-blue-50');
        if (e.dataTransfer.files[0]) { fileInput.files = e.dataTransfer.files; handleFile(e.dataTransfer.files[0]); }
    });
});
</script>
@endpush
@endsection