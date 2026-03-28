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
                    <option value="hero_image" {{ old('key') === 'hero_image' ? 'selected' : '' }}>Gambar Utama</option>
                    <option value="principal_greeting" {{ old('key') === 'principal_greeting' ? 'selected' : '' }}>Sambutan
                        Kepala Sekolah</option>
                    <option value="school_profile" {{ old('key') === 'school_profile' ? 'selected' : '' }}>Profil Sekolah
                    </option>
                    <option value="school_info" {{ old('key') === 'school_info' ? 'selected' : '' }}>Informasi Sekolah
                        (JSON)</option>
                    <option value="vision" {{ old('key') === 'vision' ? 'selected' : '' }}>Visi</option>
                    <option value="mission" {{ old('key') === 'mission' ? 'selected' : '' }}>Misi</option>
                </select>
            </div>

            {{-- Logika Panjang: Input JSON untuk School Info --}}
            <div id="schoolInfoFields" class="hidden p-4 space-y-4 border border-blue-200 rounded-lg bg-blue-50">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">NPSN</label>
                        <input type="text" id="si_npsn"
                            class="si-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Nama Sekolah</label>
                        <input type="text" id="si_name"
                            class="si-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>

            <div id="contentWrapper">
                <label class="block mb-1 text-sm font-medium text-gray-700">Konten</label>
                <textarea name="content" id="contentField" rows="6">{{ old('content') }}</textarea>
            </div>

            <div id="imageField">
                <label class="block mb-1 text-sm font-medium text-gray-700">Gambar</label>
                <div class="p-6 text-center border-2 border-gray-300 border-dashed rounded-lg cursor-pointer"
                    id="dropZone">
                    <input type="file" id="image" name="featured_image" accept="image/*" class="hidden">
                    <p class="text-gray-600">Klik untuk upload gambar</p>
                </div>
                <div id="imagePreview" class="hidden mt-4">
                    <img id="previewImg" src="" class="h-40 rounded-lg border">
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg">Simpan</button>
                <a href="{{ route('admin.about.index') }}" class="px-6 py-2 bg-gray-200 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const keySelect = document.getElementById('keySelect');
            const contentField = document.getElementById('contentField');
            let editorInstance = null;

            // Logika Panjang: Build JSON otomatis
            function buildJson() {
                const data = {
                    npsn: document.getElementById('si_npsn').value,
                    nama_sekolah: document.getElementById('si_name').value,
                };
                contentField.value = JSON.stringify(data);
            }

            document.querySelectorAll('.si-input').forEach(el => el.addEventListener('input', buildJson));

            // Logika Panjang: Toggle Field & TinyMCE
            function toggleFields() {
                const key = keySelect.value;
                const noImageKeys = ['school_profile', 'vision', 'mission', 'school_info'];

                document.getElementById('principalNameField').classList.toggle('hidden', key !==
                    'principal_greeting');
                document.getElementById('imageField').classList.toggle('hidden', noImageKeys.includes(key));
                document.getElementById('schoolInfoFields').classList.toggle('hidden', key !== 'school_info');
                document.getElementById('contentWrapper').classList.toggle('hidden', key === 'school_info');

                if (key === 'school_info') {
                    if (tinymce.get('contentField')) tinymce.get('contentField').remove();
                    buildJson();
                } else if (key !== '') {
                    if (!tinymce.get('contentField')) {
                        tinymce.init({
                            selector: '#contentField',
                            setup: (editor) => {
                                editor.on('change', () => editor.save());
                            }
                        });
                    }
                }
            }

            keySelect.addEventListener('change', toggleFields);
            toggleFields();

            // Logika Panjang: Preview Gambar
            const fileInput = document.getElementById('image');
            document.getElementById('dropZone').addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', e => {
                if (e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        document.getElementById('previewImg').src = e.target.result;
                        document.getElementById('imagePreview').classList.remove('hidden');
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        });
    </script>
@endpush
