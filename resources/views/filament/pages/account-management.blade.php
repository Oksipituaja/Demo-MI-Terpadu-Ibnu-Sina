<x-filament-panels::page>
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Pengguna</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $this->getTableRecords()->count() }}</p>
                    </div>
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Admin Aktif</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $this->getTableRecords()->whereIn('role', ['admin', 'super_admin'])->count() }}</p>
                    </div>
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Pengguna Aktif</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $this->getTableRecords()->where('is_active', true)->count() }}</p>
                    </div>
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{ $this->table }}

        {{ $this->table }}
    </div>
</x-filament-panels::page>
