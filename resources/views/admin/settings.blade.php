@extends('admin.layout')

@section('page_title', 'Pengaturan PPDB')
@section('page_subtitle', 'Kelola link Google Form pendaftaran siswa baru')

@section('content')

    <div class="max-w-xl">
        <div class="overflow-hidden bg-white border rounded-xl shadow-sm" style="border-color: #15803d26">

            <div class="flex items-center gap-3 px-6 py-4 rounded-t-xl" style="background: #15803d">
                <i class="text-white fab fa-google text-lg"></i>
                <div>
                    <h3 class="font-bold text-white">Link Google Form PPDB</h3>
                    <p class="text-xs" style="color: #86efac">Paste link Google Form pendaftaran di sini</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 space-y-5">
                @csrf

                <div>
                    <label class="block mb-1.5 text-sm font-bold text-gray-700">
                        URL Google Form
                    </label>
                    <input type="url" name="ppdb_google_form_url"
                        value="{{ old('ppdb_google_form_url', $googleFormUrl) }}"
                        placeholder="https://docs.google.com/forms/d/e/..."
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('ppdb_google_form_url')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1.5 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Kosongkan untuk menutup pendaftaran — halaman PPDB akan tampilkan pesan "Belum Dibuka".
                    </p>
                </div>

                {{-- Status badge --}}
                <div class="flex items-center gap-2 px-4 py-3 rounded-lg text-sm font-medium
                    {{ $googleFormUrl ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-yellow-50 text-yellow-700 border border-yellow-200' }}">
                    <i class="fas {{ $googleFormUrl ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                    {{ $googleFormUrl ? 'Pendaftaran aktif — Google Form tersimpan.' : 'Pendaftaran ditutup — belum ada link Google Form.' }}
                </div>

                <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-bold text-white rounded-xl transition hover:-translate-y-0.5"
                        style="background: #15803d; box-shadow: 0 4px 12px #15803d33">
                        <i class="fas fa-save"></i> Simpan Pengaturan
                    </button>

                    @if ($googleFormUrl)
                        <a href="{{ $googleFormUrl }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-green-700 bg-green-50 border border-green-200 rounded-xl hover:bg-green-100 transition">
                            <i class="fab fa-google"></i> Buka Form
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

@endsection