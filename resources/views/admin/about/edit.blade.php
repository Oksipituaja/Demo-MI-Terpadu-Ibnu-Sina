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
                <option value="hero_image" {{ $about->key === 'hero_image' ? 'selected' : '' }}>Gambar Utama</option>
                <option value="principal_greeting" {{ $about->key === 'principal_greeting' ? 'selected' : '' }}>Sambutan Kepala Sekolah</option>
                <option value="school_profile" {{ $about->key === 'school_profile' ? 'selected' : '' }}>Profil Sekolah</option>
                <option value="school_info" {{ $about->key === 'school_info' ? 'selected' : '' }}>Informasi Sekolah (JSON)</option>
                <option value="vision" {{ $about->key === 'vision' ? 'selected' : '' }}>Visi</option>
                <option value="mission" {{ $about->key === 'mission' ? 'selected' : '' }}>Misi</option>
            </select>
        </div>

        {{-- Logika Panjang: Parsing JSON untuk School Info --}}
        @php
            $info = [];
            if($about->key === 'school_info') {
                $info = json_decode($about->content, true) ?: [];
            }
        @endphp
        <div id="schoolInfoFields" class="{{ $about->key !== 'school_info' ? 'hidden' : '' }} p-4 space-y-4 border border-blue-200 rounded-lg bg-blue-50">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">NPSN</label>
                    <input type="text" id="si_npsn" value="{{ $info['npsn'] ?? '' }}" class="si-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-700">Nama Sekolah</label>
                    <input type="text" id="si_name" value="{{ $info['nama_sekolah'] ?? '' }}" class="si-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                </div>
            </div>
        </div>

        <div id="contentWrapper" class="{{ $about->key === 'school_info' ? 'hidden' : '' }}">
            <label class="block mb-1 text-sm font-medium text-gray-700">Konten</label>
            <textarea name="content" id="contentField" rows="6">{{ old('content', $about->content) }}</textarea>
        </div>

        <div id="imageField" class="{{ in_array($about->key, ['school_profile', 'vision', 'mission', 'school_info']) ? 'hidden' : '' }}">
            <label class="block mb-1 text-sm font-medium text-gray-700">Gambar</label>
            @if($about->featured_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $about->featured_image) }}" class="w-32 h-32 object-cover rounded-lg border" id="currentImg">
                    <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                </div>
            @endif
            <div class="p-6 text-center border-2 border-gray-300 border-dashed rounded-lg cursor-pointer" id="dropZone">
                <input type="file" id="image" name="featured_image" accept="image/*" class="hidden">
                <p class="text-gray-600">Klik untuk mengganti gambar</p>
            </div>
            <div id="imagePreview" class="hidden mt-4">
                <img id="previewImg" src="" class="h-40 rounded-lg border">
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Perbarui Konten</button>
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

        function buildJson() {
            const data = {
                npsn: document.getElementById('si_npsn').value,
                nama_sekolah: document.getElementById('si_name').value,
            };
            contentField.value = JSON.stringify(data);
        }

        document.querySelectorAll('.si-input').forEach(el => el.addEventListener('input', buildJson));

        function toggleFields() {
            const key = keySelect.value;
            const noImageKeys = ['school_profile', 'vision', 'mission', 'school_info'];

            document.getElementById('principalNameField').classList.toggle('hidden', key !== 'principal_greeting');
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
                            editorInstance = editor;
                            editor.on('change', () => editor.save());
                        }
                    });
                }
            }
        }

        keySelect.addEventListener('change', toggleFields);
        toggleFields();

        // Image Preview Logic
        const fileInput = document.getElementById('image');
        document.getElementById('dropZone').addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', e => {
            if (e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                    if(document.getElementById('currentImg')) {
                        document.getElementById('currentImg').classList.add('opacity-50');
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
</script>
@endpush