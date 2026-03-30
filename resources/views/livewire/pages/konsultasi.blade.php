<div>

    {{-- ═══════════ HERO ═══════════ --}}
    <section class="relative overflow-hidden bg-[#F0F4ED]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-[560px] h-[560px] rounded-full"
                style="background:radial-gradient(circle,rgba(21,128,61,.07) 0%,transparent 60%)"></div>
            <div class="absolute rounded-full -bottom-28 -left-28 w-96 h-96"
                style="background:radial-gradient(circle,rgba(234,179,8,.05) 0%,transparent 60%)"></div>
        </div>

        <div class="relative z-10 max-w-screen-xl px-6 py-14 mx-auto lg:py-20">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 w-fit px-3.5 py-1.5 rounded-full bg-white border border-[#15803d]/15 mb-5"
                    style="box-shadow:0 1px 8px rgba(21,128,61,.09)">
                    <span class="w-1.5 h-1.5 rounded-full flex-shrink-0 bg-[#22c55e]"></span>
                    <span class="text-[11.5px] font-semibold text-[#15803d] tracking-wide">Layanan Konsultasi</span>
                </div>
                <h1
                    class="text-[2rem] sm:text-[2.4rem] lg:text-[2.8rem] font-extrabold leading-[1.18] tracking-tight text-gray-900 mb-4">
                    Ada Pertanyaan<br>
                    <span
                        style="background:linear-gradient(90deg,#15803d,#22c55e);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        Seputar Sekolah?
                    </span>
                </h1>
                <p class="text-[15px] leading-relaxed text-gray-500">
                    Kirimkan pertanyaan Anda tentang PPDB, kurikulum, fasilitas, atau hal lain seputar
                    {{ config('app.name') }}. Tim kami akan menjawab langsung ke email Anda dalam 1&ndash;2 hari kerja.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════ KONTEN UTAMA ═══════════ --}}
    <section class="py-14 bg-white border-t border-[#e8f5e9]">
        <div class="max-w-screen-xl px-6 mx-auto">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-16">

                {{-- ── KIRI: Info + Kontak ── --}}
                <div class="flex flex-col gap-8 lg:col-span-5">

                    {{-- Keunggulan --}}
                    <div class="flex flex-col gap-3">
                        @foreach ([['fas fa-bolt', 'Respons Cepat', 'Jawaban dikirim dalam 1&ndash;2 hari kerja'], ['fas fa-envelope-open-text', 'Langsung ke Email', 'Jawaban dikirim langsung ke inbox Anda'], ['fas fa-shield-alt', 'Privasi Terjaga', 'Data Anda aman dan tidak akan disebarkan']] as [$icon, $title, $desc])
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-[#f8fdf9] border border-[#15803d]/10">
                                <div class="flex items-center justify-center w-10 h-10 rounded-xl flex-shrink-0"
                                    style="background:#15803d;box-shadow:0 4px 12px rgba(21,128,61,.28)">
                                    <i class="{{ $icon }} text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#14532d]">{{ $title }}</p>
                                    <p class="text-[13px] text-gray-400 mt-0.5 leading-relaxed">{!! $desc !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-[#e8f5e9]"></div>

                    {{-- Kontak Langsung --}}
                    <div>
                        <p class="text-[11px] font-extrabold uppercase tracking-[.18em] text-[#15803d] mb-4">
                            Atau Hubungi Langsung
                        </p>
                        <div class="flex flex-col gap-3">
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                                class="flex items-center gap-3.5 p-4 rounded-2xl bg-[#f8fdf9] border border-[#15803d]/10 transition-all hover:-translate-y-0.5 hover:shadow-md group">
                                <div class="flex items-center justify-center w-10 h-10 rounded-xl flex-shrink-0"
                                    style="background:#25d366;box-shadow:0 4px 12px rgba(37,211,102,.28)">
                                    <i class="fab fa-whatsapp text-white text-base"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">WhatsApp</p>
                                    <p class="text-sm font-extrabold text-[#14532d]">+62 812-3456-7890</p>
                                </div>
                                <i
                                    class="fas fa-arrow-right text-[#15803d] text-xs ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </a>
                            <a href="mailto:info@miterpaduibnusina.sch.id"
                                class="flex items-center gap-3.5 p-4 rounded-2xl bg-[#f8fdf9] border border-[#15803d]/10 transition-all hover:-translate-y-0.5 hover:shadow-md group">
                                <div class="flex items-center justify-center w-10 h-10 rounded-xl flex-shrink-0"
                                    style="background:#15803d;box-shadow:0 4px 12px rgba(21,128,61,.28)">
                                    <i class="fas fa-envelope text-white text-sm"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Email</p>
                                    <p class="text-sm font-extrabold text-[#14532d] truncate">
                                        info@miterpaduibnusina.sch.id</p>
                                </div>
                                <i
                                    class="fas fa-arrow-right text-[#15803d] text-xs ml-auto opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Badge Akreditasi --}}
                    <div class="flex items-center gap-3 p-4 rounded-2xl border border-[#15803d]/10"
                        style="background:linear-gradient(135deg,#f0fdf4,#dcfce7)">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl flex-shrink-0"
                            style="background:#15803d;box-shadow:0 4px 12px rgba(21,128,61,.3)">
                            <svg width="16" height="16" fill="none" stroke="white" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Status Resmi</p>
                            <p class="text-sm font-extrabold text-[#14532d]">Terakreditasi B &mdash; Kemenag RI</p>
                        </div>
                    </div>

                </div>

                {{-- ── KANAN: Form ── --}}
                <div class="lg:col-span-7">
                    <div class="relative">

                        {{-- Dekoratif dashed border --}}
                        <div class="hidden lg:block absolute rounded-[28px] border-2 border-dashed border-[#15803d]/14"
                            style="inset:-14px;transform:rotate(-1deg)"></div>

                        <div class="relative bg-white rounded-[22px] border border-[#15803d]/10 overflow-hidden"
                            style="box-shadow:0 12px 40px rgba(21,128,61,.10)">

                            {{-- Header form --}}
                            <div class="px-7 py-5 border-b border-[#e8f5e9]"
                                style="background:linear-gradient(90deg,#15803d,#22c55e)">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white/20">
                                        <i class="fas fa-comments text-white text-base"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-extrabold text-[15px] leading-none">Formulir
                                            Konsultasi</p>
                                        <p class="text-[11px] text-green-100 mt-1">{{ config('app.name') }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- ── SUCCESS STATE ── --}}
                            @if (session()->has('sent'))
                                <div class="px-7 py-10 text-center">
                                    <div class="flex items-center justify-center w-16 h-16 rounded-full mx-auto mb-5"
                                        style="background:linear-gradient(135deg,#dcfce7,#bbf7d0)">
                                        <svg width="28" height="28" fill="none" stroke="#15803d"
                                            stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-extrabold text-[#14532d] mb-2">Pertanyaan Terkirim!</h3>
                                    <p class="text-[14px] text-gray-500 leading-relaxed mb-6">
                                        Terima kasih! Tim kami akan segera menjawab pertanyaan Anda<br>
                                        dan mengirimkan jawaban ke email yang Anda daftarkan.
                                    </p>
                                    <div
                                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-[#15803d] bg-[#15803d]/[.08] border border-[#15803d]/15">
                                        <i class="fas fa-clock text-xs"></i>
                                        Estimasi balasan: 1&ndash;2 hari kerja
                                    </div>
                                </div>

                                {{-- ── FORM STATE ── --}}
                            @else
                                <form wire:submit.prevent="submit" class="px-7 py-7 space-y-5">

                                    {{-- Nama & Email --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-[11px] font-extrabold uppercase tracking-[.12em] text-gray-400 mb-2">
                                                Nama Lengkap <span class="text-red-400">*</span>
                                            </label>
                                            <input type="text" wire:model="name" placeholder="Contoh: Budi Santoso"
                                                class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#15803d]/25 focus:border-[#15803d]/50 transition-all
                                                    {{ $errors->has('name') ? 'border-red-300 bg-red-50 focus:ring-red-200' : 'border-gray-200 bg-gray-50 hover:border-[#15803d]/30' }}">
                                            @error('name')
                                                <p class="flex items-center gap-1 text-[11px] text-red-500 mt-1.5">
                                                    <i class="fas fa-exclamation-circle text-[10px]"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[11px] font-extrabold uppercase tracking-[.12em] text-gray-400 mb-2">
                                                Email Aktif <span class="text-red-400">*</span>
                                            </label>
                                            <input type="email" wire:model="email" placeholder="email@anda.com"
                                                class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#15803d]/25 focus:border-[#15803d]/50 transition-all
                                                    {{ $errors->has('email') ? 'border-red-300 bg-red-50 focus:ring-red-200' : 'border-gray-200 bg-gray-50 hover:border-[#15803d]/30' }}">
                                            @error('email')
                                                <p class="flex items-center gap-1 text-[11px] text-red-500 mt-1.5">
                                                    <i class="fas fa-exclamation-circle text-[10px]"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Topik --}}
                                    <div>
                                        <label
                                            class="block text-[11px] font-extrabold uppercase tracking-[.12em] text-gray-400 mb-2">
                                            Topik Pertanyaan
                                            <span
                                                class="normal-case tracking-normal font-normal text-gray-400/70 ml-1">(opsional)</span>
                                        </label>
                                        <input type="text" wire:model="subject"
                                            placeholder="Contoh: Syarat Pendaftaran, Biaya Sekolah, Kurikulum..."
                                            class="w-full px-4 py-2.5 text-sm border border-gray-200 bg-gray-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#15803d]/25 focus:border-[#15803d]/50 hover:border-[#15803d]/30 transition-all">
                                    </div>

                                    {{-- Pertanyaan --}}
                                    <div>
                                        <label
                                            class="block text-[11px] font-extrabold uppercase tracking-[.12em] text-gray-400 mb-2">
                                            Pertanyaan <span class="text-red-400">*</span>
                                        </label>
                                        <textarea wire:model="message" rows="5"
                                            placeholder="Tuliskan pertanyaan Anda secara jelas dan detail agar kami dapat memberikan jawaban yang tepat..."
                                            class="w-full px-4 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#15803d]/25 focus:border-[#15803d]/50 resize-none transition-all
                                                {{ $errors->has('message') ? 'border-red-300 bg-red-50 focus:ring-red-200' : 'border-gray-200 bg-gray-50 hover:border-[#15803d]/30' }}"></textarea>
                                        @error('message')
                                            <p class="flex items-center gap-1 text-[11px] text-red-500 mt-1.5">
                                                <i class="fas fa-exclamation-circle text-[10px]"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Submit --}}
                                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-1">
                                        <p
                                            class="text-[11.5px] text-gray-400 flex items-center gap-1.5 order-2 sm:order-1">
                                            <i class="fas fa-lock text-[10px]"></i>
                                            Data Anda aman &amp; tidak disebarkan
                                        </p>
                                        <button type="submit" wire:loading.attr="disabled"
                                            wire:loading.class="opacity-75 cursor-not-allowed"
                                            class="order-1 sm:order-2 w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3 text-sm font-bold rounded-xl transition-all hover:-translate-y-0.5 active:scale-[.98] disabled:opacity-60"
                                            style="background:#EAB308;color:#14532d;box-shadow:0 4px 14px rgba(234,179,8,.35)">
                                            <span wire:loading.remove wire:target="submit">
                                                <i class="fas fa-paper-plane text-xs mr-1"></i> Kirim Pertanyaan
                                            </span>
                                            <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                                </svg>
                                                Mengirim...
                                            </span>
                                        </button>
                                    </div>

                                </form>
                            @endif

                        </div>

                        {{-- Badge floating --}}
                        @if (!session()->has('sent'))
                            <div class="absolute -bottom-5 -left-4 z-10 hidden lg:flex items-center gap-2.5 px-4 py-3 rounded-2xl bg-white"
                                style="box-shadow:0 6px 24px rgba(0,0,0,.10);border:1px solid rgba(21,128,61,.08)">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full flex-shrink-0"
                                    style="background:#15803d;box-shadow:0 3px 10px rgba(21,128,61,.38)">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[8px] uppercase tracking-widest text-gray-400 font-bold leading-none mb-0.5">
                                        Dijawab Tim</p>
                                    <p class="text-[13px] font-extrabold text-gray-900 leading-none">Langsung ke Email
                                    </p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ═══════════ FAQ ═══════════ --}}
    <section class="py-16 bg-[#F0F4ED] border-t border-[#e8f5e9]">
        <div class="max-w-screen-xl px-6 mx-auto">
            <div class="max-w-xl mx-auto text-center mb-10">
                <span class="text-[11px] font-extrabold uppercase tracking-[.18em] text-[#15803d]">FAQ</span>
                <h2 class="mt-3 text-[1.7rem] font-extrabold text-[#14532d] tracking-tight">
                    Pertanyaan yang Sering Ditanyakan
                </h2>
            </div>
            <div class="max-w-3xl mx-auto grid grid-cols-1 gap-3">
                @foreach ([['Kapan pendaftaran siswa baru dibuka?', 'Pendaftaran peserta didik baru (PPDB/SPMB) dibuka setiap awal tahun ajaran. Pantau terus halaman SPMB kami untuk informasi terbaru.'], ['Apa saja syarat pendaftaran?', 'Syarat umum meliputi: akta kelahiran, kartu keluarga, dan foto terbaru. Detail lengkap tersedia di halaman SPMB.'], ['Apakah ada biaya konsultasi?', 'Tidak ada. Layanan konsultasi ini sepenuhnya gratis untuk semua calon wali murid dan masyarakat umum.'], ['Berapa lama waktu balasan?', 'Kami berusaha menjawab setiap pertanyaan dalam 1&ndash;2 hari kerja langsung ke email Anda.']] as [$q, $a])
                    <div x-data="{ open: false }"
                        class="bg-white rounded-2xl border border-[#15803d]/10 overflow-hidden"
                        style="box-shadow:0 1px 8px rgba(21,128,61,.05)">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-6 py-4 text-left transition-colors hover:bg-[#f8fdf9]">
                            <span class="text-[14px] font-bold text-[#14532d] pr-4">{{ $q }}</span>
                            <span
                                class="flex-shrink-0 flex items-center justify-center w-7 h-7 rounded-full transition-all"
                                :class="open ? 'bg-[#15803d] rotate-45' : 'bg-[#15803d]/10'"
                                style="transition:transform .2s,background .2s">
                                <i class="fas fa-plus text-[10px]" :class="open ? 'text-white' : 'text-[#15803d]'"></i>
                            </span>
                        </button>
                        <div x-show="open" x-collapse class="px-6 pb-5">
                            <p class="text-[13.5px] text-gray-500 leading-relaxed border-t border-[#e8f5e9] pt-4">
                                {!! $a !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
