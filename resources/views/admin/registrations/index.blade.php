@extends('admin.layout')

@section('page_title', 'Pendaftaran Siswa')
@section('page_subtitle', 'Data pendaftaran siswa baru (PPDB)')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h3 class="text-lg font-semibold text-gray-800">Daftar Pendaftar</h3>
    </div>
</div>

<div class="overflow-hidden bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="border-b border-gray-200 bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Nama Siswa</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Email Orang Tua</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">No. Telepon</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Tanggal Daftar</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($registrations as $reg)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-8 h-8 text-xs font-semibold text-white bg-indigo-500 rounded-full shrink-0">
                                    {{ strtoupper(substr($reg->student_name ?? 'S', 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $reg->student_name ?? '—' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $reg->email ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $reg->phone ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div>{{ $reg->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $reg->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <button type="button"
                                    onclick="showDetails(
                                        '{{ addslashes($reg->student_name ?? '') }}',
                                        '{{ addslashes($reg->email ?? '') }}',
                                        '{{ addslashes($reg->phone ?? '') }}',
                                        '{{ addslashes($reg->guardian_name ?? '') }}',
                                        '{{ addslashes($reg->guardian_phone ?? '') }}',
                                        '{{ $reg->created_at->format('d M Y, H:i') }}'
                                    )"
                                    class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                                <form action="{{ route('admin.registrations.destroy', $reg) }}" method="POST"
                                    onsubmit="return confirm('Hapus data pendaftaran \'{{ addslashes($reg->student_name ?? '') }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 text-sm text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <i class="mb-3 text-4xl text-gray-300 fas fa-user-check"></i>
                            <p class="text-gray-500">Belum ada data pendaftaran.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $registrations->links() }}</div>

{{-- Modal Detail --}}
<div id="detailsModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md mx-4 bg-white rounded-lg shadow-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Detail Pendaftaran</h3>
            <button onclick="closeModal()" class="text-xl leading-none text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="modalContent" class="px-6 py-4 space-y-3 text-sm"></div>
        <div class="px-6 py-4 text-right border-t border-gray-200">
            <button onclick="closeModal()"
                class="px-4 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showDetails(name, email, phone, guardian, guardianPhone, date) {
    document.getElementById('modalContent').innerHTML = `
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Nama Siswa</span>
            <span class="font-medium text-gray-900">${name || '—'}</span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Nama Orang Tua</span>
            <span class="font-medium text-gray-900">${guardian || '—'}</span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Email</span>
            <span class="font-medium text-gray-900">${email || '—'}</span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">No. Telepon Siswa</span>
            <span class="font-medium text-gray-900">${phone || '—'}</span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">No. Telepon Orang Tua</span>
            <span class="font-medium text-gray-900">${guardianPhone || '—'}</span>
        </div>
        <div class="flex justify-between py-2">
            <span class="text-gray-500">Tanggal Daftar</span>
            <span class="font-medium text-gray-900">${date}</span>
        </div>
    `;
    const modal = document.getElementById('detailsModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('detailsModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('detailsModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
@endpush

@endsection