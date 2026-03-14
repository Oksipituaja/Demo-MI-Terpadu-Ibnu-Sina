@extends('admin.layout')

@section('page_title', 'Edit About Section')

@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block mb-1 text-sm font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title', $about->title) }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="principalNameField" class="hidden">
                <label class="block mb-1 text-sm font-medium">Principal Name</label>
                <input type="text" name="principal_name" value="{{ old('principal_name', $about->principal_name) }}"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Nama Kepala Sekolah">
                @error('principal_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Key (Unique identifier)</label>
                <select id="keySelect" name="key" disabled
                    class="w-full px-3 py-2 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="hero_image" {{ $about->key === 'hero_image' ? 'selected' : '' }}>Hero Image
                        (Gambar di Homepage)</option>
                    <option value="principal_greeting" {{ $about->key === 'principal_greeting' ? 'selected' : '' }}>Sambutan
                        Kepala Sekolah</option>
                    <option value="school_profile" {{ $about->key === 'school_profile' ? 'selected' : '' }}>Profil
                        Sekolah</option>
                    <option value="school_info" {{ $about->key === 'school_info' ? 'selected' : '' }}>Informasi
                        Sekolah (NPSN, SK, dll)</option>
                    <option value="vision" {{ $about->key === 'vision' ? 'selected' : '' }}>Visi</option>
                    <option value="mission" {{ $about->key === 'mission' ? 'selected' : '' }}>Misi</option>
                </select>
                <input type="hidden" name="key" value="{{ $about->key }}">
                <p class="mt-1 text-xs text-gray-500">Key tidak bisa diubah</p>
                @error('key')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @php
                $schoolInfo = $about->key === 'school_info' ? json_decode($about->content, true) : [];
            @endphp
            <div id="schoolInfoFields"
                class="{{ $about->key === 'school_info' ? '' : 'hidden' }} space-y-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm font-semibold text-blue-700">
                    <i class="mr-1 fas fa-info-circle"></i> Data ini akan disimpan sebagai JSON di field Content
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">NPSN</label>
                        <input type="text" id="si_npsn" value="{{ $schoolInfo['npsn'] ?? '60712544' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Nama Sekolah</label>
                        <input type="text" id="si_name"
                            value="{{ $schoolInfo['nama_sekolah'] ?? 'MIS TERPADU IBNU SINA' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Naungan</label>
                        <input type="text" id="si_naungan" value="{{ $schoolInfo['naungan'] ?? 'Kementerian Agama' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Jenjang Pendidikan</label>
                        <input type="text" id="si_jenjang" value="{{ $schoolInfo['jenjang'] ?? 'MI' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Status Sekolah</label>
                        <input type="text" id="si_status" value="{{ $schoolInfo['status'] ?? 'Swasta' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Tanggal Berdiri</label>
                        <input type="text" id="si_berdiri"
                            value="{{ $schoolInfo['tanggal_berdiri'] ?? '28 Januari 2008' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">No. SK Pendirian</label>
                        <input type="text" id="si_sk_pendirian"
                            value="{{ $schoolInfo['sk_pendirian'] ?? 'Kd.11.20/4/PP.03.2/58/2008' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Tanggal Operasional</label>
                        <input type="text" id="si_operasional"
                            value="{{ $schoolInfo['tanggal_operasional'] ?? '28 Januari 2008' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-1 text-xs font-medium text-gray-700">No. SK Operasional</label>
                        <input type="text" id="si_sk_operasional"
                            value="{{ $schoolInfo['sk_operasional'] ?? 'kd.11.20/MI/167/08' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Alamat Lengkap</label>
                        <input type="text" id="si_alamat"
                            value="{{ $schoolInfo['alamat'] ?? 'Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457' }}"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Content</label>
                <textarea name="content" id="contentField" rows="6" required
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 {{ $about->key === 'school_info' ? 'bg-gray-50 text-gray-500 text-xs' : '' }}"
                    {{ $about->key === 'school_info' ? 'readonly' : '' }}>{{ old('content', $about->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="imageField">
                <label class="block mb-1 text-sm font-medium">Image (Optional)</label>
                @if ($about->image)
                    <div class="p-4 mb-4 border border-gray-200 rounded-lg bg-gray-50">
                        <p class="mb-2 text-xs font-medium text-gray-600">Gambar Saat Ini</p>
                        <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}"
                            class="object-cover h-40 max-w-sm rounded"
                            onerror="this.closest('div').innerHTML='<p class=\'text-xs text-red-500\'>File gambar tidak ditemukan</p>'">
                    </div>
                @endif
                <div class="p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50"
                    id="dropZone">
                    <input type="file" id="image" name="image" accept="image/*" class="hidden">
                    <div>
                        <i class="mb-2 text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                        <p class="text-gray-600">Drag & drop atau
                            <button type="button" class="font-medium text-blue-600 hover:text-blue-700"
                                onclick="document.getElementById('image').click()">pilih file</button>
                        </p>
                        <p class="mt-2 text-xs text-gray-500">JPG, PNG (Max 5MB)</p>
                    </div>
                </div>
                <div id="imagePreview" class="hidden mt-4">
                    <p class="mb-2 text-xs font-medium text-gray-600">Pratinjau Gambar Baru</p>
                    <img id="previewImg" src="" alt="Preview" class="object-cover h-40 max-w-sm rounded-lg">
                    <p id="fileName" class="mt-2 text-xs text-gray-600"></p>
                </div>
                @error('image')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', ['label' => 'Update', 'loading' => 'Updating...'])
                <a href="{{ route('admin.about.index') }}"
                    class="px-4 py-2 text-gray-800 bg-gray-200 rounded-lg">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentKey = '{{ $about->key }}';
            const principalNameField = document.getElementById('principalNameField');
            const imageField = document.getElementById('imageField');
            const schoolInfoFields = document.getElementById('schoolInfoFields');
            const contentField = document.getElementById('contentField');
            const noImageKeys = ['school_profile', 'mission', 'vision', 'school_info'];

            function buildSchoolInfoJson() {
                const data = {
                    npsn: document.getElementById('si_npsn').value,
                    nama_sekolah: document.getElementById('si_name').value,
                    naungan: document.getElementById('si_naungan').value,
                    jenjang: document.getElementById('si_jenjang').value,
                    status: document.getElementById('si_status').value,
                    tanggal_berdiri: document.getElementById('si_berdiri').value,
                    sk_pendirian: document.getElementById('si_sk_pendirian').value,
                    tanggal_operasional: document.getElementById('si_operasional').value,
                    sk_operasional: document.getElementById('si_sk_operasional').value,
                    alamat: document.getElementById('si_alamat').value,
                };
                contentField.value = JSON.stringify(data, null, 2);
            }

            document.querySelectorAll('[id^="si_"]').forEach(function(input) {
                input.addEventListener('input', buildSchoolInfoJson);
            });

            function toggleFields() {
                principalNameField.classList.toggle('hidden', currentKey !== 'principal_greeting');
                imageField.classList.toggle('hidden', noImageKeys.includes(currentKey));
                schoolInfoFields.classList.toggle('hidden', currentKey !== 'school_info');

                if (currentKey === 'school_info') {
                    contentField.setAttribute('readonly', true);
                    contentField.classList.add('bg-gray-50', 'text-gray-500', 'text-xs');
                } else {
                    contentField.removeAttribute('readonly');
                    contentField.classList.remove('bg-gray-50', 'text-gray-500', 'text-xs');
                }
            }

            toggleFields();

            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            const maxSize = 5 * 1024 * 1024;

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
                    fileName.textContent = `File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
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
@endsection
