<div class="min-h-screen bg-white">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <nav class="flex items-center space-x-2 text-blue-100 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-white">Agenda</span>
            </nav>
            <h1 class="text-4xl font-bold">Agenda Kegiatan</h1>
            <p class="text-blue-100 mt-2">Jadwal dan kegiatan sekolah terbaru</p>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="max-w-6xl mx-auto px-4 pt-8">
        <div class="flex flex-wrap gap-3">
            <button wire:click="$set('filter', 'all')"
                class="px-5 py-2 rounded-full text-sm font-semibold transition
                    {{ $filter === 'all' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            <button wire:click="$set('filter', 'upcoming')"
                class="px-5 py-2 rounded-full text-sm font-semibold transition
                    {{ $filter === 'upcoming' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                <i class="fas fa-clock mr-1"></i> Mendatang
            </button>
            <button wire:click="$set('filter', 'completed')"
                class="px-5 py-2 rounded-full text-sm font-semibold transition
                    {{ $filter === 'completed' ? 'bg-gray-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                <i class="fas fa-check mr-1"></i> Selesai
            </button>
        </div>
    </div>

    {{-- Agenda List --}}
    <div class="max-w-6xl mx-auto px-4 py-8 pb-20">
        <div class="space-y-4" wire:loading.class="opacity-50 transition-opacity">
            @forelse($agendas as $agenda)
                @php
                    $borderColor = [
                        'upcoming'  => 'border-blue-500',
                        'completed' => 'border-gray-400',
                    ];
                    $badgeClasses = [
                        'upcoming'  => 'bg-blue-100 text-blue-800',
                        'completed' => 'bg-gray-100 text-gray-700',
                    ];
                    $statusLabels = [
                        'upcoming'  => 'Mendatang',
                        'completed' => 'Selesai',
                    ];
                    $showTime = $agenda->formatted_time && $agenda->formatted_time !== '00:00';
                @endphp

                <div class="bg-white border-l-4 {{ $borderColor[$agenda->status] ?? 'border-gray-400' }} p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex justify-between items-start gap-4 flex-col sm:flex-row">
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $agenda->title }}</h3>

                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-3">
                                <span class="flex items-center gap-1.5">
                                    <i class="fas fa-calendar text-blue-600"></i>
                                    {{ $agenda->event_date->format('d M Y') }}
                                </span>

                                @if($showTime)
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-clock text-blue-600"></i>
                                        {{ $agenda->formatted_time }} WIB
                                    </span>
                                @endif

                                @if($agenda->location)
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-red-500"></i>
                                        {{ $agenda->location }}
                                    </span>
                                @endif
                            </div>

                            @if($agenda->description)
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ Str::limit($agenda->description, 200) }}
                                </p>
                            @endif
                        </div>

                        <span class="shrink-0 inline-block px-4 py-2 text-xs font-bold rounded-full whitespace-nowrap
                            {{ $badgeClasses[$agenda->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $statusLabels[$agenda->status] ?? ucfirst($agenda->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 p-12 rounded-xl text-center">
                    <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 font-medium text-lg">Tidak ada agenda untuk kategori ini</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $agendas->links() }}
        </div>
    </div>
</div>