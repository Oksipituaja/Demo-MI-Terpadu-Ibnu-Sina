<div class="min-h-screen bg-white">

    {{-- Hero --}}
    <div class="relative overflow-hidden bg-linear-to-br from-blue-700 via-blue-600 to-indigo-700">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-300 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-300 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="relative max-w-4xl px-6 mx-auto py-14 md:py-20">
            <div class="flex items-center gap-2 mb-4 text-sm text-blue-200">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Beranda</a>
                <i class="text-xs fas fa-chevron-right"></i>
                <span class="font-medium text-white">SPMB / PPDB</span>
            </div>
            <h1 class="mb-3 text-3xl font-bold text-white md:text-5xl">Pendaftaran Peserta Didik Baru</h1>
            <p class="text-base text-blue-100 md:text-lg max-w-xl">
                Daftarkan putra/putri Anda di <span class="font-semibold text-yellow-300">MI Terpadu Ibnu Sina</span>
                dan jadikan mereka generasi muslim yang berilmu dan berakhlaqul karimah.
            </p>
        </div>
    </div>

    <div class="max-w-4xl px-6 py-14 mx-auto space-y-12">

        {{-- ===== INFO PENDAFTARAN ===== --}}

        {{-- Alur Pendaftaran --}}
        <div>
            <div class="mb-8 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest text-blue-500 uppercase">Cara Mendaftar</span>
                <h2 class="text-2xl font-bold text-gray-900">Alur Pendaftaran Online</h2>
                <div class="w-12 h-1 mx-auto mt-3 bg-yellow-400 rounded-full"></div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                @php
                    $alur = [
                        ['step' => '01', 'icon' => 'fa-money-bill-wave', 'color' => 'bg-blue-600',   'label' => 'Bayar Pendaftaran', 'desc' => 'Transfer Rp 100.000 ke BRI a.n. MI Terpadu Ibnu Sina'],
                        ['step' => '02', 'icon' => 'fa-paper-plane',     'color' => 'bg-green-600',  'label' => 'Konfirmasi',        'desc' => 'Kirim bukti ke Ustadz Rizka · 085 290 191 131'],
                        ['step' => '03', 'icon' => 'fa-key',             'color' => 'bg-indigo-600', 'label' => 'Terima Token',      'desc' => 'Dapatkan token & nomor pendaftaran'],
                        ['step' => '04', 'icon' => 'fa-edit',            'color' => 'bg-amber-500',  'label' => 'Isi Formulir',      'desc' => 'Login & lengkapi data calon siswa'],
                        ['step' => '05', 'icon' => 'fa-bell',            'color' => 'bg-red-500',    'label' => 'Pengumuman',        'desc' => 'Tunggu hasil seleksi & info daftar ulang'],
                    ];
                @endphp
                @foreach($alur as $item)
                    <div class="relative flex flex-col items-center p-5 text-center bg-white border border-gray-200 shadow-sm rounded-2xl">
                        <div class="flex items-center justify-center w-12 h-12 mb-3 rounded-xl {{ $item['color'] }}">
                            <i class="text-base text-white fas {{ $item['icon'] }}"></i>
                        </div>
                        <span class="mb-1 text-xs font-black text-gray-300">{{ $item['step'] }}</span>
                        <p class="mb-1 text-sm font-bold text-gray-900">{{ $item['label'] }}</p>
                        <p class="text-xs leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Info Rekening --}}
            <div class="flex flex-col items-start gap-4 p-5 mt-5 border sm:flex-row sm:items-center bg-blue-50 border-blue-200 rounded-2xl">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-600 rounded-xl shrink-0">
                    <i class="text-lg text-white fas fa-university"></i>
                </div>
                <div class="flex-1">
                    <p class="mb-0.5 text-xs font-bold tracking-widest text-blue-500 uppercase">Rekening Pembayaran</p>
                    <p class="text-base font-bold text-gray-900">Bank BRI · <span class="font-mono text-blue-700">5899-01-034638-53-0</span></p>
                    <p class="text-sm text-gray-600">a.n. <span class="font-semibold">MI Terpadu Ibnu Sina</span> · Biaya pendaftaran <span class="font-bold text-blue-700">Rp 100.000</span></p>
                </div>
                <div class="text-sm text-gray-600">
                    <p class="mb-1 text-xs font-bold text-gray-500">Format konfirmasi:</p>
                    <code class="px-3 py-1.5 text-xs font-mono bg-white border border-blue-200 rounded-lg text-blue-800">
                        Nama pengirim#nama calon siswa
                    </code>
                </div>
            </div>
        </div>

        {{-- Persyaratan --}}
        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-2xl">
            <div class="flex items-center gap-3 px-6 py-4 bg-green-600">
                <i class="text-white fas fa-clipboard-list"></i>
                <div>
                    <h3 class="font-bold text-white">Persyaratan Pendaftaran</h3>
                    <p class="text-xs text-green-100">Dokumen yang perlu disiapkan</p>
                </div>
            </div>
            @php
                $syarat = [
                    ['icon' => 'fa-heartbeat',  'text' => 'Sehat jasmani dan rohani'],
                    ['icon' => 'fa-image',      'text' => 'Pas foto berwarna ukuran 3×4 (3 lembar)'],
                    ['icon' => 'fa-baby',       'text' => 'Fotokopi Akta Kelahiran (3 lembar)'],
                    ['icon' => 'fa-users',      'text' => 'Fotokopi Kartu Keluarga (3 lembar)'],
                    ['icon' => 'fa-scroll',     'text' => 'Fotokopi Ijazah (jika sudah memiliki)'],
                    ['icon' => 'fa-money-bill', 'text' => 'Membayar Infaq Pendaftaran & Screening Rp 100.000'],
                    ['icon' => 'fa-folder',     'text' => 'Semua berkas fisik diserahkan saat daftar ulang (untuk pendaftar online)'],
                ];
            @endphp
            <div class="px-6 py-2">
                @foreach($syarat as $s)
                    <div class="flex items-start gap-4 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-green-50 shrink-0 mt-0.5">
                            <i class="text-xs text-green-600 fas {{ $s['icon'] }}"></i>
                        </div>
                        <span class="text-sm text-gray-700">{{ $s['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Kontak --}}
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="flex items-center gap-4 p-5 border border-blue-100 bg-blue-50 rounded-2xl">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-600 rounded-xl shrink-0">
                    <i class="text-white fas fa-phone"></i>
                </div>
                <div>
                    <p class="mb-0.5 text-xs font-bold tracking-widest text-blue-500 uppercase">Humas</p>
                    <a href="tel:085383102007" class="text-base font-bold text-gray-900 hover:text-blue-600 transition-colors">0853 8310 2007</a>
                    <p class="text-xs text-gray-500">Informasi & pertanyaan umum</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-5 border border-green-100 bg-green-50 rounded-2xl">
                <div class="flex items-center justify-center w-12 h-12 bg-green-600 rounded-xl shrink-0">
                    <i class="text-white fab fa-whatsapp"></i>
                </div>
                <div>
                    <p class="mb-0.5 text-xs font-bold tracking-widest text-green-600 uppercase">Konfirmasi Pembayaran</p>
                    <a href="https://wa.me/6285290191131" target="_blank" class="text-base font-bold text-gray-900 hover:text-green-600 transition-colors">085 290 191 131</a>
                    <p class="text-xs text-gray-500">Ustadz Rizka</p>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="flex items-center gap-4">
            <div class="flex-1 border-t border-gray-200"></div>
            <span class="px-4 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 rounded-full uppercase tracking-widest">Formulir Pendaftaran Online</span>
            <div class="flex-1 border-t border-gray-200"></div>
        </div>

        {{-- ===== FORM PENDAFTARAN ===== --}}
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800"><i class="mr-2 text-blue-600 fas fa-edit"></i>Isi Data Calon Siswa</h3>
                <p class="mt-0.5 text-xs text-gray-500">Lengkapi semua kolom bertanda * dengan benar</p>
            </div>

            <div class="p-6">
                @if (session()->has('success'))
                    <div class="p-4 mb-6 text-green-700 border border-green-400 rounded-lg bg-green-100">
                        <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
                    </div>
                @endif

                <form wire:submit="submit" class="space-y-5">

                    <div class="grid gap-5 sm:grid-cols-2">
                        {{-- Nama Siswa --}}
                        <div class="sm:col-span-2">
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Nama Siswa <span class="text-red-500">*</span></label>
                            <input type="text"
                                   wire:model="student_name"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                   placeholder="Nama lengkap calon siswa">
                            @error('student_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Email <span class="text-red-500">*</span></label>
                            <input type="email"
                                   wire:model="email"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                   placeholder="email@contoh.com">
                            @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input type="tel"
                                   wire:model="phone"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                   placeholder="08xxxxxxxxxx">
                            @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text"
                                       id="birth_date_picker"
                                       wire:model="birth_date"
                                       placeholder="Pilih tanggal lahir"
                                       readonly
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm cursor-pointer bg-white">
                                <i class="absolute text-gray-400 -translate-y-1/2 fas fa-calendar-alt right-3 top-1/2 pointer-events-none"></i>
                            </div>
                            @error('birth_date') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        {{-- Sekolah Asal --}}
                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Sekolah Asal</label>
                            <input type="text"
                                   wire:model="current_school"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                   placeholder="TK / RA asal (opsional)">
                            @error('current_school') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        {{-- Nama Wali --}}
                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Nama Wali / Orang Tua</label>
                            <input type="text"
                                   wire:model="guardian_name"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                   placeholder="Nama ayah/ibu/wali">
                            @error('guardian_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        {{-- Nomor Wali --}}
                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Nomor Telepon Wali</label>
                            <input type="tel"
                                   wire:model="guardian_phone"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                   placeholder="08xxxxxxxxxx">
                            @error('guardian_phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="sm:col-span-2">
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Alamat Lengkap</label>
                            <textarea wire:model="address"
                                      rows="3"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                      placeholder="Jalan, RT/RW, Desa, Kecamatan, Kabupaten"></textarea>
                            @error('address') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400"><span class="text-red-500">*</span> Kolom wajib diisi</p>
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition-all">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pendaftaran
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
document.addEventListener('livewire:navigated', initFlatpickr);
document.addEventListener('DOMContentLoaded', initFlatpickr);

function initFlatpickr() {
    const el = document.getElementById('birth_date_picker');
    if (!el || el._flatpickr) return;

    flatpickr(el, {
        locale:     flatpickr.l10ns.id,
        dateFormat: 'Y-m-d',
        altInput:   true,
        altFormat:  'd F Y',
        maxDate:    'today',
        onChange:   function(selectedDates, dateStr) {
            @this.set('birth_date', dateStr);
        }
    });
}
</script>
</div>