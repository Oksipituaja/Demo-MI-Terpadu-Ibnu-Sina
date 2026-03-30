@extends('admin.layout')

@section('page_title', 'Konsultasi')
@section('page_subtitle', 'Pertanyaan masuk dari pengunjung website')

@section('content')

    {{-- ===== TOAST CONTAINER ===== --}}
    <div id="toastContainer" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    {{-- Stats Bar --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 px-5 py-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100">
                <i class="fas fa-comments text-gray-500"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalAll }}</div>
                <div class="text-xs text-gray-400 font-medium">Total Pertanyaan</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-amber-100 px-5 py-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-amber-50">
                <i class="fas fa-clock text-amber-500"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-amber-600">{{ $totalPending }}</div>
                <div class="text-xs text-amber-400 font-medium">Belum Dijawab</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-emerald-100 px-5 py-4 flex items-center gap-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-emerald-50">
                <i class="fas fa-check-circle text-emerald-500"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-emerald-600">{{ $totalReplied }}</div>
                <div class="text-xs text-emerald-400 font-medium">Sudah Dijawab</div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 px-5 py-4 mb-5">
        <form method="GET" action="{{ route('admin.consultations.index') }}" class="flex flex-wrap items-center gap-3"
            id="filterForm">
            <div class="flex-1 min-w-[200px] relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" name="search" id="liveSearchInput" value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau topik..." autocomplete="off"
                    class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400">
                {{-- Live search spinner (hidden until typing) --}}
                <i id="searchSpinner"
                    class="fas fa-circle-notch fa-spin absolute right-3 top-1/2 -translate-y-1/2 text-indigo-400 text-sm"
                    style="display:none;"></i>
            </div>
            <select name="status" id="statusFilter"
                class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 bg-white">
                <option value="">Semua Status</option>
                <option value="pending" @selected(request('status') === 'pending')>Belum Dijawab</option>
                <option value="replied" @selected(request('status') === 'replied')>Sudah Dijawab</option>
            </select>
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            @if (request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.consultations.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Table --}}
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
                            <td class="px-6 py-4 max-w-xs">
                                @if ($item->subject)
                                    <div class="text-sm font-medium text-gray-800 mb-0.5">{{ $item->subject }}</div>
                                @endif
                                <div class="text-xs text-gray-400 line-clamp-2">{{ Str::limit($item->message, 80) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">{{ $item->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }} WIB</div>
                            </td>
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
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button type="button"
                                        onclick="openReplyModal(
                                        {{ $item->id }},
                                        '{{ addslashes($item->name) }}',
                                        '{{ addslashes($item->email) }}',
                                        '{{ addslashes($item->subject ?? '') }}',
                                        '{{ addslashes($item->message) }}',
                                        '{{ $item->created_at->format('d M Y, H:i') }}',
                                        {{ $item->isReplied() ? 'true' : 'false' }},
                                        '{{ addslashes($item->reply ?? '') }}'
                                    )"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg transition
                                        {{ $item->isPending()
                                            ? 'bg-indigo-600 text-white hover:bg-indigo-700'
                                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        <i class="fas {{ $item->isPending() ? 'fa-reply' : 'fa-eye' }}"></i>
                                        {{ $item->isPending() ? 'Jawab' : 'Lihat' }}
                                    </button>
                                    <form action="{{ route('admin.consultations.destroy', $item) }}" method="POST"
                                        onsubmit="return confirmDelete(event, '{{ addslashes($item->name) }}', this)">
                                        @csrf @method('DELETE')
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

                    {{-- Live search empty state (hidden by default) --}}
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

    <div class="mt-5" id="paginationWrapper">{{ $consultations->links() }}</div>

    {{-- ===== Modal Jawab / Lihat ===== --}}
    <div id="replyModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50 backdrop-blur-sm">
        <div class="w-full max-w-lg mx-4 bg-white rounded-2xl shadow-2xl overflow-hidden">

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

                {{-- Penanya --}}
                <div class="flex items-center gap-3 bg-gray-50 rounded-xl px-4 py-3">
                    <div id="modalAvatar"
                        class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold shrink-0 bg-indigo-500">
                    </div>
                    <div>
                        <div id="modalName" class="text-sm font-semibold text-gray-800"></div>
                        <div id="modalEmail" class="text-xs text-gray-400"></div>
                    </div>
                </div>

                {{-- Topik --}}
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

                {{-- Jawaban yang sudah ada (mode view) --}}
                <div id="existingReplyWrap" class="hidden">
                    <p class="text-xs font-semibold text-emerald-500 uppercase tracking-wider mb-2">Jawaban Dikirim</p>
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl px-4 py-3">
                        <p id="existingReply" class="text-sm text-emerald-800 leading-relaxed whitespace-pre-line"></p>
                    </div>
                </div>

                {{-- Form Jawab (mode reply) --}}
                <form id="replyForm" method="POST" class="hidden space-y-3">
                    @csrf
                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 block">
                            Tulis Jawaban <span class="text-red-400">*</span>
                        </label>
                        <textarea name="reply" id="replyTextarea" rows="5" required
                            placeholder="Tulis jawaban yang jelas dan informatif..."
                            class="w-full text-sm border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 resize-none"></textarea>
                    </div>
                    <p class="text-xs text-gray-400">
                        <i class="fas fa-paper-plane mr-1"></i>
                        Jawaban akan langsung dikirim ke email: <span id="replyTargetEmail"
                            class="font-semibold text-indigo-600"></span>
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
                    class="hidden px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Kirim Jawaban
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // =============================================
            // TOAST SYSTEM
            // =============================================
            const toastIcons = {
                success: {
                    icon: 'fa-circle-check',
                    color: 'text-emerald-500',
                    bar: 'bg-emerald-500',
                    bg: 'bg-white border-l-4 border-emerald-500'
                },
                error: {
                    icon: 'fa-circle-xmark',
                    color: 'text-red-500',
                    bar: 'bg-red-500',
                    bg: 'bg-white border-l-4 border-red-500'
                },
                info: {
                    icon: 'fa-circle-info',
                    color: 'text-indigo-500',
                    bar: 'bg-indigo-500',
                    bg: 'bg-white border-l-4 border-indigo-500'
                },
                warning: {
                    icon: 'fa-triangle-exclamation',
                    color: 'text-amber-500',
                    bar: 'bg-amber-500',
                    bg: 'bg-white border-l-4 border-amber-500'
                },
            };

            function showToast(message, type = 'success', duration = 4000) {
                const t = toastIcons[type] || toastIcons.success;
                const container = document.getElementById('toastContainer');

                const toast = document.createElement('div');
                toast.className = `pointer-events-auto relative overflow-hidden flex items-start gap-3 px-4 py-3 rounded-xl shadow-lg ${t.bg} min-w-[280px] max-w-sm
        translate-x-full opacity-0 transition-all duration-300 ease-out`;

                toast.innerHTML = `
        <i class="fas ${t.icon} ${t.color} text-lg mt-0.5 shrink-0"></i>
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-800 leading-snug">${message}</p>
        </div>
        <button onclick="dismissToast(this.closest('[data-toast]'))"
            class="shrink-0 text-gray-400 hover:text-gray-600 transition mt-0.5">
            <i class="fas fa-xmark text-sm"></i>
        </button>
        <div class="absolute bottom-0 left-0 h-[3px] ${t.bar} rounded-full toast-progress" style="width:100%; transition: width ${duration}ms linear;"></div>
    `;
                toast.setAttribute('data-toast', '');
                container.appendChild(toast);

                // Slide in
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        toast.classList.remove('translate-x-full', 'opacity-0');
                        toast.classList.add('translate-x-0', 'opacity-100');
                        // Start progress bar
                        const bar = toast.querySelector('.toast-progress');
                        if (bar) setTimeout(() => bar.style.width = '0%', 50);
                    });
                });

                // Auto dismiss
                const timer = setTimeout(() => dismissToast(toast), duration);
                toast._timer = timer;
            }

            function dismissToast(toast) {
                if (!toast) return;
                clearTimeout(toast._timer);
                toast.classList.add('translate-x-full', 'opacity-0');
                toast.classList.remove('translate-x-0', 'opacity-100');
                setTimeout(() => toast.remove(), 300);
            }

            // =============================================
            // FLASH MESSAGES → TOAST
            // =============================================
            @if (session('success'))
                document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('success')) }}',
                    'success'));
            @endif
            @if (session('error'))
                document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('error')) }}', 'error'));
            @endif
            @if (session('warning'))
                document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('warning')) }}',
                    'warning'));
            @endif
            @if (session('info'))
                document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('info')) }}', 'info'));
            @endif

            // =============================================
            // LIVE SEARCH (client-side filter)
            // =============================================
            (function() {
                const input = document.getElementById('liveSearchInput');
                const statusSel = document.getElementById('statusFilter');
                const spinner = document.getElementById('searchSpinner');
                const tbody = document.getElementById('tableBody');
                const pagination = document.getElementById('paginationWrapper');
                const liveEmpty = document.getElementById('liveEmptyRow');
                let debounceTimer = null;

                function filterRows() {
                    const q = input.value.toLowerCase().trim();
                    const status = statusSel.value;
                    const rows = tbody.querySelectorAll('tr[data-name]');
                    let visible = 0;

                    rows.forEach(row => {
                        const name = row.dataset.name || '';
                        const email = row.dataset.email || '';
                        const subject = row.dataset.subject || '';
                        const rowStatus = row.dataset.status || '';

                        const matchSearch = !q || name.includes(q) || email.includes(q) || subject.includes(q);
                        const matchStatus = !status || rowStatus === status;

                        if (matchSearch && matchStatus) {
                            row.classList.remove('hidden');
                            visible++;
                        } else {
                            row.classList.add('hidden');
                        }
                    });

                    // Toggle empty state
                    liveEmpty.classList.toggle('hidden', visible > 0);

                    // Hide pagination when filtering live
                    if (q || status) {
                        pagination.classList.add('hidden');
                    } else {
                        pagination.classList.remove('hidden');
                    }
                }

                input.addEventListener('input', () => {
                    spinner.style.display = 'block';
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        filterRows();
                        spinner.style.display = 'none';
                    }, 300);
                });

                // Status dropdown also triggers live filter
                statusSel.addEventListener('change', () => {
                    // If there's a search query, filter live; otherwise submit form
                    if (input.value.trim()) {
                        filterRows();
                    }
                    // If no search, let form submit handle it (standard filter)
                });
            })();

            // =============================================
            // DELETE CONFIRMATION
            // =============================================
            function confirmDelete(e, name, form) {
                e.preventDefault();
                if (confirm(`Hapus pertanyaan dari "${name}"?\nData tidak dapat dikembalikan.`)) {
                    form.submit();
                }
                return false;
            }

            // =============================================
            // MODAL
            // =============================================
            let currentFormAction = '';

            function openReplyModal(id, name, email, subject, message, date, isReplied, existingReply) {
                document.getElementById('modalTitle').textContent = isReplied ? 'Detail Pertanyaan' : 'Jawab Pertanyaan';
                document.getElementById('modalMeta').textContent = 'Masuk pada ' + date;

                document.getElementById('modalAvatar').textContent = name.charAt(0).toUpperCase();
                document.getElementById('modalAvatar').className =
                    'w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold shrink-0 ' +
                    (isReplied ? 'bg-emerald-500' : 'bg-amber-500');
                document.getElementById('modalName').textContent = name;
                document.getElementById('modalEmail').textContent = email;

                if (subject && subject.trim() !== '') {
                    document.getElementById('subjectWrap').classList.remove('hidden');
                    document.getElementById('modalSubject').textContent = subject;
                } else {
                    document.getElementById('subjectWrap').classList.add('hidden');
                }

                document.getElementById('modalMessage').textContent = message;
                document.getElementById('replyTargetEmail').textContent = email;

                if (isReplied) {
                    document.getElementById('existingReplyWrap').classList.remove('hidden');
                    document.getElementById('existingReply').textContent = existingReply;
                    document.getElementById('replyForm').classList.add('hidden');
                    document.getElementById('submitReplyBtn').classList.add('hidden');
                } else {
                    document.getElementById('existingReplyWrap').classList.add('hidden');
                    document.getElementById('replyForm').classList.remove('hidden');
                    document.getElementById('submitReplyBtn').classList.remove('hidden');
                    document.getElementById('replyTextarea').value = '';
                    currentFormAction = `/admin-panel/consultations/${id}/reply`;
                    document.getElementById('replyForm').action = currentFormAction;
                }

                const modal = document.getElementById('replyModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function submitReply() {
                document.getElementById('replyForm').submit();
            }

            function closeModal() {
                const modal = document.getElementById('replyModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.getElementById('replyModal').addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });
        </script>
    @endpush

@endsection
