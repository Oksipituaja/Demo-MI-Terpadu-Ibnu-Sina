@extends('admin.layout')

@section('page_title', 'Konsultasi')
@section('page_subtitle', 'Pertanyaan masuk dari pengunjung website')

@section('content')

    {{-- ===== TOAST CONTAINER ===== --}}
    <div id="toastContainer" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    {{-- ===== STATS BAR ===== --}}
    <div class="grid grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 px-5 py-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 flex-shrink-0">
                <i class="fas fa-comments text-gray-500"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalAll }}</div>
                <div class="text-xs text-gray-400 font-medium">Total Pertanyaan</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-amber-100 px-5 py-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-amber-50 flex-shrink-0">
                <i class="fas fa-clock text-amber-500"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-amber-600">{{ $totalPending }}</div>
                <div class="text-xs text-amber-400 font-medium">Belum Dijawab</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-emerald-100 px-5 py-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-emerald-50 flex-shrink-0">
                <i class="fas fa-check-circle text-emerald-500"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-emerald-600">{{ $totalReplied }}</div>
                <div class="text-xs text-emerald-400 font-medium">Sudah Dijawab</div>
            </div>
        </div>

    </div>

    {{-- ===== FILTER & SEARCH ===== --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 px-5 py-3 mb-5">
        <form method="GET" action="{{ route('admin.consultations.index') }}" class="flex flex-wrap items-center gap-3"
            id="filterForm">

            {{-- Search --}}
            <div class="flex-1 min-w-[200px] relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" name="search" id="liveSearchInput" value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau topik..." autocomplete="off"
                    class="w-full pl-9 pr-8 py-2 text-sm border border-gray-200 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400">
                <i id="searchSpinner"
                    class="fas fa-circle-notch fa-spin absolute right-3 top-1/2 -translate-y-1/2 text-indigo-400 text-sm"
                    style="display:none;"></i>
            </div>

            {{-- Status Pills --}}
            <div class="flex items-center gap-1 bg-gray-100 rounded-lg p-1 shrink-0">
                @foreach (['' => 'Semua', 'pending' => 'Belum Dijawab', 'replied' => 'Sudah Dijawab'] as $val => $label)
                    <button type="button" onclick="setStatusFilter('{{ $val }}')"
                        data-status-btn="{{ $val }}"
                        class="px-3 py-1.5 text-xs font-medium rounded-md transition-all duration-150 whitespace-nowrap
                               {{ request('status', '') === $val
                                   ? 'bg-white text-indigo-600 shadow-sm font-semibold'
                                   : 'text-gray-500 hover:text-gray-700' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <input type="hidden" name="status" id="statusHiddenInput" value="{{ request('status', '') }}">

            {{-- Reset --}}
            @if (request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.consultations.index') }}"
                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-medium text-gray-500
                           bg-gray-100 rounded-lg hover:bg-gray-200 hover:text-gray-700 transition shrink-0">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif

        </form>
    </div>

    {{-- ===== TABLE ===== --}}
    <div class="overflow-hidden bg-white rounded-xl shadow-sm border border-gray-100" id="tableWrapper">
        <div class="overflow-x-auto">
            <table class="w-full" id="consultationTable">
                <thead class="border-b border-gray-100 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-500 uppercase tracking-wider">Penanya
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-500 uppercase tracking-wider">Topik /
                            Pertanyaan</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50" id="tableBody">

                    @forelse($consultations as $item)
                        <tr class="hover:bg-gray-50 transition-colors {{ $item->isPending() ? 'bg-amber-50/30' : '' }}"
                            data-name="{{ strtolower($item->name) }}" data-email="{{ strtolower($item->email) }}"
                            data-subject="{{ strtolower($item->subject ?? '') }}" data-status="{{ $item->status }}">

                            {{-- Penanya --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex items-center justify-center w-9 h-9 text-xs font-bold text-white rounded-full shrink-0
                                                {{ $item->isPending() ? 'bg-amber-500' : 'bg-emerald-500' }}">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $item->email }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Topik / Pertanyaan --}}
                            <td class="px-6 py-4 max-w-xs">
                                @if ($item->subject)
                                    <div class="text-sm font-medium text-gray-800 mb-0.5">{{ $item->subject }}</div>
                                @endif
                                <div class="text-xs text-gray-400 line-clamp-2">{{ Str::limit($item->message, 80) }}</div>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">{{ $item->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }} WIB</div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                @if ($item->isPending())
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                        <i class="fas fa-clock text-amber-500 text-[10px]"></i>
                                        Belum Dijawab
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                        <i class="fas fa-check-circle text-emerald-500 text-[10px]"></i>
                                        Sudah Dijawab
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    {{-- Tombol Jawab / Lihat --}}
                                    <button type="button"
                                        onclick="openReplyModal(
                                            {{ $item->id }},
                                            {{ json_encode($item->name) }},
                                            {{ json_encode($item->email) }},
                                            {{ json_encode($item->subject ?? '') }},
                                            {{ json_encode($item->message) }},
                                            {{ json_encode($item->created_at->format('d M Y, H:i')) }},
                                            {{ $item->isReplied() ? 'true' : 'false' }},
                                            {{ json_encode($item->reply ?? '') }}
                                        )"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg transition
                                               {{ $item->isPending()
                                                   ? 'bg-indigo-600 text-white hover:bg-indigo-700'
                                                   : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        <i class="fas {{ $item->isPending() ? 'fa-reply' : 'fa-eye' }}"></i>
                                        {{ $item->isPending() ? 'Jawab' : 'Lihat' }}
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.consultations.destroy', $item) }}" method="POST"
                                        onsubmit="return confirmDelete(event, {{ json_encode($item->name) }}, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-comments text-2xl text-gray-300"></i>
                                    </div>
                                    <p class="text-gray-400 text-sm">Belum ada pertanyaan masuk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                    {{-- Empty state untuk live search --}}
                    <tr id="liveEmptyRow" class="hidden">
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-search text-xl text-gray-300"></i>
                                </div>
                                <p class="text-gray-400 text-sm">Tidak ada hasil yang cocok.</p>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-5" id="paginationWrapper">{{ $consultations->links() }}</div>


    {{-- ===== MODAL JAWAB / LIHAT ===== --}}
    <div id="replyModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50 backdrop-blur-sm p-4">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h3 id="modalTitle" class="text-base font-bold text-gray-800">Detail Pertanyaan</h3>
                    <p id="modalMeta" class="text-xs text-gray-400 mt-0.5"></p>
                </div>
                <button onclick="closeModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="px-6 py-5 space-y-4 max-h-[65vh] overflow-y-auto">

                {{-- Avatar + Nama + Email --}}
                <div class="flex items-center gap-3 bg-gray-50 rounded-xl px-4 py-3">
                    <div id="modalAvatar"
                        class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold shrink-0 bg-indigo-500">
                    </div>
                    <div>
                        <div id="modalName" class="text-sm font-semibold text-gray-800"></div>
                        <div id="modalEmail" class="text-xs text-gray-400"></div>
                    </div>
                </div>

                {{-- Topik (opsional) --}}
                <div id="subjectWrap" class="hidden">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Topik</p>
                    <p id="modalSubject" class="text-sm font-medium text-gray-700"></p>
                </div>

                {{-- Pertanyaan --}}
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Pertanyaan</p>
                    <div class="bg-gray-50 border border-gray-100 rounded-xl px-4 py-3">
                        <p id="modalMessage" class="text-sm text-gray-700 leading-relaxed whitespace-pre-line"></p>
                    </div>
                </div>

                {{-- Jawaban sebelumnya (jika sudah dijawab) --}}
                <div id="existingReplyWrap" class="hidden">
                    <p class="text-xs font-semibold text-emerald-500 uppercase tracking-wider mb-2">Jawaban Dikirim</p>
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl px-4 py-3">
                        <p id="existingReply" class="text-sm text-emerald-800 leading-relaxed whitespace-pre-line"></p>
                    </div>
                </div>

                {{-- Form jawab (jika belum dijawab) --}}
                <form id="replyForm" method="POST" class="hidden space-y-3">
                    @csrf
                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 block">
                            Tulis Jawaban <span class="text-red-400">*</span>
                        </label>
                        <textarea name="reply" id="replyTextarea" rows="5" required
                            placeholder="Tulis jawaban yang jelas dan informatif..."
                            class="w-full text-sm border border-gray-200 rounded-xl px-4 py-3
                                   focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400
                                   resize-none transition-all"></textarea>
                    </div>
                    <p class="text-xs text-gray-400 flex items-center gap-1.5">
                        <i class="fas fa-paper-plane text-[10px]"></i>
                        Jawaban akan dikirim ke email:
                        <span id="replyTargetEmail" class="font-semibold text-indigo-600"></span>
                    </p>
                </form>

            </div>

            {{-- Modal Footer --}}
            <div id="modalFooter" class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <button onclick="closeModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    Tutup
                </button>
                <button id="submitReplyBtn" type="button" onclick="submitReply()"
                    class="hidden px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition inline-flex items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Kirim Jawaban
                </button>
            </div>

        </div>
    </div>


    @push('scripts')
        <script>
            // =====================================================
            // TOAST SYSTEM
            // =====================================================
            const _toastTheme = {
                success: {
                    icon: 'fa-circle-check',
                    color: 'text-emerald-500',
                    bar: 'bg-emerald-500',
                    border: 'border-l-emerald-500'
                },
                error: {
                    icon: 'fa-circle-xmark',
                    color: 'text-red-500',
                    bar: 'bg-red-500',
                    border: 'border-l-red-500'
                },
                info: {
                    icon: 'fa-circle-info',
                    color: 'text-indigo-500',
                    bar: 'bg-indigo-500',
                    border: 'border-l-indigo-500'
                },
                warning: {
                    icon: 'fa-triangle-exclamation',
                    color: 'text-amber-500',
                    bar: 'bg-amber-500',
                    border: 'border-l-amber-500'
                },
            };

            function showToast(message, type = 'success', duration = 4500) {
                const t = _toastTheme[type] ?? _toastTheme.success;
                const container = document.getElementById('toastContainer');
                const toast = document.createElement('div');

                toast.setAttribute('data-toast', '');
                toast.className = [
                    'pointer-events-auto relative overflow-hidden flex items-start gap-3',
                    'px-4 py-3 rounded-xl shadow-lg bg-white border border-gray-100 border-l-4',
                    t.border,
                    'min-w-[280px] max-w-sm',
                    'translate-x-full opacity-0 transition-all duration-300 ease-out',
                ].join(' ');

                toast.innerHTML = `
            <i class="fas ${t.icon} ${t.color} text-lg mt-0.5 shrink-0"></i>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-800 leading-snug">${message}</p>
            </div>
            <button onclick="dismissToast(this.closest('[data-toast]'))"
                class="shrink-0 text-gray-400 hover:text-gray-600 transition mt-0.5">
                <i class="fas fa-xmark text-sm"></i>
            </button>
            <div class="absolute bottom-0 left-0 h-[3px] ${t.bar} rounded-full toast-bar"
                style="width:100%; transition:width ${duration}ms linear;"></div>
        `;

                container.appendChild(toast);
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                    const bar = toast.querySelector('.toast-bar');
                    if (bar) setTimeout(() => bar.style.width = '0%', 50);
                }));
                toast._timer = setTimeout(() => dismissToast(toast), duration);
            }

            function dismissToast(toast) {
                if (!toast) return;
                clearTimeout(toast._timer);
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }

            // Flash → Toast
            @if (session('success'))
                document.addEventListener('DOMContentLoaded', () => showToast(@json(session('success')), 'success'));
            @endif
            @if (session('error'))
                document.addEventListener('DOMContentLoaded', () => showToast(@json(session('error')), 'error'));
            @endif
            @if (session('warning'))
                document.addEventListener('DOMContentLoaded', () => showToast(@json(session('warning')), 'warning'));
            @endif
            @if (session('info'))
                document.addEventListener('DOMContentLoaded', () => showToast(@json(session('info')), 'info'));
            @endif

            // =====================================================
            // LIVE SEARCH + STATUS FILTER
            // =====================================================
            (function() {
                const input = document.getElementById('liveSearchInput');
                const hiddenStat = document.getElementById('statusHiddenInput');
                const spinner = document.getElementById('searchSpinner');
                const tbody = document.getElementById('tableBody');
                const pagination = document.getElementById('paginationWrapper');
                const liveEmpty = document.getElementById('liveEmptyRow');
                let timer = null;

                function filterRows() {
                    const q = input.value.toLowerCase().trim();
                    const status = hiddenStat.value;
                    const rows = tbody.querySelectorAll('tr[data-name]');
                    let visible = 0;

                    rows.forEach(row => {
                        const matchSearch = !q ||
                            (row.dataset.name || '').includes(q) ||
                            (row.dataset.email || '').includes(q) ||
                            (row.dataset.subject || '').includes(q);
                        const matchStatus = !status || row.dataset.status === status;

                        if (matchSearch && matchStatus) {
                            row.classList.remove('hidden');
                            visible++;
                        } else {
                            row.classList.add('hidden');
                        }
                    });

                    liveEmpty.classList.toggle('hidden', visible > 0);
                    pagination.classList.toggle('hidden', !!(q || status));
                }

                input.addEventListener('input', () => {
                    spinner.style.display = 'block';
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        filterRows();
                        spinner.style.display = 'none';
                    }, 280);
                });

                window.setStatusFilter = function(val) {
                    hiddenStat.value = val;

                    document.querySelectorAll('[data-status-btn]').forEach(btn => {
                        const active = btn.dataset.statusBtn === val;
                        btn.classList.toggle('bg-white', active);
                        btn.classList.toggle('text-indigo-600', active);
                        btn.classList.toggle('shadow-sm', active);
                        btn.classList.toggle('font-semibold', active);
                        btn.classList.toggle('text-gray-500', !active);
                        btn.classList.toggle('hover:text-gray-700', !active);
                    });

                    // Jika ada teks search → filter lokal, else submit form untuk server-side filter
                    input.value.trim() ? filterRows() : document.getElementById('filterForm').submit();
                };
            })();

            // =====================================================
            // DELETE CONFIRM
            // =====================================================
            function confirmDelete(e, name, form) {
                e.preventDefault();
                if (confirm(`Hapus pertanyaan dari "${name}"?\nData tidak dapat dikembalikan.`)) form.submit();
                return false;
            }

            // =====================================================
            // MODAL JAWAB / LIHAT
            // =====================================================
            let _currentFormAction = '';

            function openReplyModal(id, name, email, subject, message, date, isReplied, existingReply) {
                // Title & meta
                document.getElementById('modalTitle').textContent = isReplied ? 'Detail Pertanyaan' : 'Jawab Pertanyaan';
                document.getElementById('modalMeta').textContent = 'Masuk pada ' + date;

                // Avatar
                const avatar = document.getElementById('modalAvatar');
                avatar.textContent = name.charAt(0).toUpperCase();
                avatar.className =
                    'w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold shrink-0 ' +
                    (isReplied ? 'bg-emerald-500' : 'bg-amber-500');

                // Nama & email
                document.getElementById('modalName').textContent = name;
                document.getElementById('modalEmail').textContent = email;

                // Topik
                const subjectWrap = document.getElementById('subjectWrap');
                if (subject && subject.trim() !== '') {
                    subjectWrap.classList.remove('hidden');
                    document.getElementById('modalSubject').textContent = subject;
                } else {
                    subjectWrap.classList.add('hidden');
                }

                // Pesan
                document.getElementById('modalMessage').textContent = message;
                document.getElementById('replyTargetEmail').textContent = email;

                if (isReplied) {
                    // Mode lihat
                    document.getElementById('existingReplyWrap').classList.remove('hidden');
                    document.getElementById('existingReply').textContent = existingReply;
                    document.getElementById('replyForm').classList.add('hidden');
                    document.getElementById('submitReplyBtn').classList.add('hidden');
                } else {
                    // Mode jawab
                    document.getElementById('existingReplyWrap').classList.add('hidden');
                    document.getElementById('replyForm').classList.remove('hidden');
                    document.getElementById('submitReplyBtn').classList.remove('hidden');
                    document.getElementById('replyTextarea').value = '';
                    _currentFormAction = `/admin-panel/consultations/${id}/reply`;
                    document.getElementById('replyForm').action = _currentFormAction;
                }

                const modal = document.getElementById('replyModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function submitReply() {
                const textarea = document.getElementById('replyTextarea');
                if (!textarea.value.trim()) {
                    textarea.focus();
                    showToast('Jawaban tidak boleh kosong.', 'warning');
                    return;
                }
                document.getElementById('replyForm').submit();
            }

            function closeModal() {
                const modal = document.getElementById('replyModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Klik di luar modal → tutup
            document.getElementById('replyModal').addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });

            // ESC → tutup
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeModal();
            });
        </script>
    @endpush

@endsection
