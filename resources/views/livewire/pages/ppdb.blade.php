<div class="min-h-screen" style="background: #F0F4ED">

    {{-- Hero --}}
    <div class="relative overflow-hidden" style="background: linear-gradient(to bottom right, #15803d, #166534, #14532d)">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 rounded-full w-96 h-96 blur-3xl"
                style="background: #EAB308"></div>
            <div class="absolute bottom-0 left-0 -translate-x-1/2 translate-y-1/2 rounded-full w-72 h-72 blur-3xl"
                style="background: #86efac"></div>
        </div>
        <div class="relative max-w-4xl px-6 mx-auto py-14 md:py-20">
            <div class="flex items-center gap-2 mb-4 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Beranda</a>
                <i class="text-xs fas fa-chevron-right"></i>
                <span class="font-medium text-white">SPMB / PPDB</span>
            </div>
            <h1 class="mb-3 text-3xl font-bold text-white md:text-5xl">Pendaftaran Peserta Didik Baru</h1>
            <p class="max-w-xl text-base md:text-lg" style="color: #bbf7d0">
                Daftarkan putra/putri Anda di <span class="font-semibold" style="color: #EAB308">MI Terpadu Ibnu
                    Sina</span>
                dan jadikan mereka generasi muslim yang berilmu dan berakhlaqul karimah.
            </p>
        </div>
    </div>

    <div class="max-w-4xl px-6 mx-auto space-y-12 py-14">

        {{-- Alur Pendaftaran --}}
        <div>
            <div class="mb-8 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Cara
                    Mendaftar</span>
                <h2 class="text-2xl font-bold text-gray-900">Alur Pendaftaran Online</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308"></div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                @php
                    $alur = [
                        [
                            'step' => '01',
                            'icon' => 'fa-money-bill-wave',
                            'bgStyle' => 'background: #15803d',
                            'label' => 'Bayar Pendaftaran',
                            'desc' => 'Transfer Rp 100.000 ke BRI a.n. MI Terpadu Ibnu Sina',
                        ],
                        [
                            'step' => '02',
                            'icon' => 'fa-paper-plane',
                            'bgStyle' => 'background: #2563eb',
                            'label' => 'Konfirmasi',
                            'desc' => 'Kirim bukti ke Example Name · 081 234 567 890',
                        ],
                        [
                            'step' => '03',
                            'icon' => 'fa-key',
                            'bgStyle' => 'background: #7c3aed',
                            'label' => 'Terima Token',
                            'desc' => 'Dapatkan token & nomor pendaftaran',
                        ],
                        [
                            'step' => '04',
                            'icon' => 'fa-edit',
                            'bgStyle' => 'background: #EAB308',
                            'label' => 'Isi Formulir',
                            'desc' => 'Login & lengkapi data calon siswa',
                        ],
                        [
                            'step' => '05',
                            'icon' => 'fa-bell',
                            'bgStyle' => 'background: #dc2626',
                            'label' => 'Pengumuman',
                            'desc' => 'Tunggu hasil seleksi & info daftar ulang',
                        ],
                    ];
                @endphp
                @foreach ($alur as $item)
                    <div
                        class="relative flex flex-col items-center p-5 text-center bg-white border border-gray-200 shadow-sm rounded-2xl">
                        <div class="flex items-center justify-center w-12 h-12 mb-3 rounded-xl"
                            style="{{ $item['bgStyle'] }}">
                            <i class="text-base fas {{ $item['icon'] }}" style="color: white"></i>
                        </div>
                        <span class="mb-1 text-xs font-black text-gray-300">{{ $item['step'] }}</span>
                        <p class="mb-1 text-sm font-bold text-gray-900">{{ $item['label'] }}</p>
                        <p class="text-xs leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Info Rekening --}}
            <div class="flex flex-col items-start gap-4 p-5 mt-5 border sm:flex-row sm:items-center rounded-2xl"
                style="background: #dcfce7; border-color: #15803d26">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl shrink-0" style="background: #15803d">
                    <i class="text-lg text-white fas fa-university"></i>
                </div>
                <div class="flex-1">
                    <p class="mb-0.5 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Rekening
                        Pembayaran</p>
                    <p class="text-base font-bold text-gray-900">Bank BRI · <span class="font-mono"
                            style="color: #15803d">5899-01-034638-53-0</span></p>
                    <p class="text-sm text-gray-600">a.n. <span class="font-semibold">MI Terpadu Ibnu Sina</span> ·
                        Biaya pendaftaran <span class="font-bold" style="color: #15803d">Rp 100.000</span></p>
                </div>
                <div class="text-sm text-gray-600">
                    <p class="mb-1 text-xs font-bold text-gray-500">Format konfirmasi:</p>
                    <code class="px-3 py-1.5 text-xs font-mono bg-white border rounded-lg"
                        style="border-color: #15803d26; color: #14532d">
                        Nama pengirim#nama calon siswa
                    </code>
                </div>
            </div>
        </div>

        {{-- Persyaratan --}}
        <div class="overflow-hidden bg-white border shadow-sm rounded-2xl" style="border-color: #15803d26">
            <div class="flex items-center gap-3 px-6 py-4" style="background: #15803d">
                <i class="text-white fas fa-clipboard-list"></i>
                <div>
                    <h3 class="font-bold text-white">Persyaratan Pendaftaran</h3>
                    <p class="text-xs" style="color: #86efac">Dokumen yang perlu disiapkan</p>
                </div>
            </div>
            @php
                $syarat = [
                    ['icon' => 'fa-heartbeat', 'text' => 'Sehat jasmani dan rohani'],
                    ['icon' => 'fa-image', 'text' => 'Pas foto berwarna ukuran 3×4 (3 lembar)'],
                    ['icon' => 'fa-baby', 'text' => 'Fotokopi Akta Kelahiran (3 lembar)'],
                    ['icon' => 'fa-users', 'text' => 'Fotokopi Kartu Keluarga (3 lembar)'],
                    ['icon' => 'fa-scroll', 'text' => 'Fotokopi Ijazah (jika sudah memiliki)'],
                    ['icon' => 'fa-money-bill', 'text' => 'Membayar Infaq Pendaftaran & Screening Rp 100.000'],
                    [
                        'icon' => 'fa-folder',
                        'text' => 'Semua berkas fisik diserahkan saat daftar ulang (untuk pendaftar online)',
                    ],
                ];
            @endphp
            <div class="px-6 py-2">
                @foreach ($syarat as $s)
                    <div class="flex items-start gap-4 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg shrink-0 mt-0.5"
                            style="background: #15803d1a">
                            <i class="text-xs fas {{ $s['icon'] }}" style="color: #15803d"></i>
                        </div>
                        <span class="text-sm text-gray-700">{{ $s['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Kontak --}}
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="flex items-center gap-4 p-5 border rounded-2xl"
                style="background: #dcfce7; border-color: #15803d26">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl shrink-0" style="background: #15803d">
                    <i class="text-white fas fa-phone"></i>
                </div>
                <div>
                    <p class="mb-0.5 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Humas</p>
                    <a href="tel:081234567890"
                        class="text-base font-bold text-gray-900 transition-colors hover:opacity-80">0853 8310 2007</a>
                    <p class="text-xs text-gray-500">Informasi & pertanyaan umum</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-5 border rounded-2xl"
                style="background: #dcfce7; border-color: #15803d26">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl shrink-0" style="background: #15803d">
                    <i class="text-white fab fa-whatsapp"></i>
                </div>
                <div>
                    <p class="mb-0.5 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Konfirmasi
                        Pembayaran</p>
                    <a href="https://wa.me/6285290191131" target="_blank"
                        class="text-base font-bold text-gray-900 transition-colors hover:opacity-80">085 290 191 131</a>
                    <p class="text-xs text-gray-500">Ustadz Rizka</p>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="flex items-center gap-4">
            <div class="flex-1 border-t border-gray-200"></div>
            <span class="px-4 py-1.5 text-xs font-bold rounded-full uppercase tracking-widest"
                style="color: #15803d; background: #dcfce7; border: 1px solid #15803d26">
                Formulir Pendaftaran Online
            </span>
            <div class="flex-1 border-t border-gray-200"></div>
        </div>

        {{-- Form --}}
        <div class="overflow-hidden bg-white border shadow-sm rounded-2xl" style="border-color: #15803d26">
            <div class="px-6 py-4 border-b border-gray-100" style="background: #F0F4ED">
                <h3 class="font-bold text-gray-800">
                    <i class="mr-2 fas fa-edit" style="color: #15803d"></i>Isi Data Calon Siswa
                </h3>
                <p class="mt-0.5 text-xs text-gray-500">Lengkapi semua kolom bertanda * dengan benar</p>
            </div>

            <div class="p-6">
                <form wire:submit="submit" class="space-y-5">
                    <div class="grid gap-5 sm:grid-cols-2">

                        <div class="sm:col-span-2">
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">
                                Nama Siswa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="student_name" name="student_name" wire:model="student_name"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Nama lengkap calon siswa">
                            @error('student_name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" wire:model="email"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="email@contoh.com">
                            @error('email')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" wire:model="phone"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" id="birth_date_picker" placeholder="Pilih tanggal lahir"
                                    autocomplete="off"
                                    class="w-full px-4 py-2.5 text-sm bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                    style="cursor: pointer;">
                                <i
                                    class="absolute text-gray-400 -translate-y-1/2 pointer-events-none fas fa-calendar-alt right-3 top-1/2"></i>
                            </div>
                            @error('birth_date')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Sekolah Asal</label>
                            <input type="text" id="current_school" name="current_school"
                                wire:model="current_school"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="TK / RA asal (opsional)">
                            @error('current_school')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Nama Wali / Orang Tua</label>
                            <input type="text" id="guardian_name" name="guardian_name" wire:model="guardian_name"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Nama ayah/ibu/wali">
                            @error('guardian_name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Nomor Telepon Wali</label>
                            <input type="tel" id="guardian_phone" name="guardian_phone"
                                wire:model="guardian_phone"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="08xxxxxxxxxx">
                            @error('guardian_phone')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Alamat Lengkap</label>
                            <textarea id="address" name="address" wire:model="address" rows="3"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Jalan, RT/RW, Desa, Kecamatan, Kabupaten"></textarea>
                            @error('address')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400"><span class="text-red-500">*</span> Kolom wajib diisi</p>
                        <button type="submit" wire:loading.attr="disabled"
                            class="inline-flex items-center gap-2 px-6 py-2.5 font-bold text-white text-sm rounded-xl transition-all disabled:opacity-70 disabled:cursor-not-allowed hover:-translate-y-0.5"
                            style="background: #15803d; box-shadow: 0 4px 12px #15803d33">
                            <i wire:loading.remove wire:target="submit" class="fas fa-paper-plane"></i>
                            <span wire:loading.remove wire:target="submit">Kirim Pendaftaran</span>
                            <span wire:loading wire:target="submit">Loading...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Toast --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
            style="position:fixed; top:80px; left:50%; transform:translateX(-50%); z-index:9999; width:max-content; max-width:90vw;">
            <div class="flex items-center gap-3 px-5 py-4 text-sm font-semibold text-white shadow-xl rounded-2xl"
                style="background: #15803d">
                <i class="text-base fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                function initFlatpickr() {
                    const el = document.getElementById('birth_date_picker');
                    if (!el) return;

                    if (window._flatpickrInstance) {
                        window._flatpickrInstance.destroy();
                        window._flatpickrInstance = null;
                    }

                    window._flatpickrInstance = flatpickr(el, {
                        locale: window.flatpickrLocaleId || 'default',
                        dateFormat: 'Y-m-d',
                        altInput: true,
                        altFormat: 'd F Y',
                        maxDate: 'today',
                        disableMobile: true,
                        onChange: function(selectedDates, dateStr) {
                            @this.set('birth_date', dateStr, false);
                        }
                    });
                }

                initFlatpickr();

                Livewire.on('form-submitted', () => {
                    setTimeout(initFlatpickr, 300);
                });

                document.addEventListener('livewire:update', () => {
                    setTimeout(initFlatpickr, 100);
                });
            });
        </script>
    @endpush
</div>
