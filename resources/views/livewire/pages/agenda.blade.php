<div class="min-h-screen" style="background: #F0F4ED">
    <div class="px-4 py-12 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="max-w-6xl mx-auto">
            <nav class="flex items-center mb-4 space-x-2 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Agenda</span>
            </nav>
            <h1 class="text-4xl font-bold">Agenda Kegiatan</h1>
            <p class="mt-2" style="color: #bbf7d0">Jadwal dan kegiatan sekolah terbaru</p>
        </div>
    </div>

    <div class="max-w-6xl px-4 pt-8 mx-auto">
        <div class="flex flex-wrap gap-3">
            <button wire:click="$set('filter', 'all')"
                class="px-5 py-2 text-sm font-semibold transition rounded-full"
                style="{{ $filter === 'all' ? 'background: #15803d; color: white; box-shadow: 0 2px 8px #15803d33' : 'background: #dcfce7; color: #15803d' }}">
                Semua
            </button>
            <button wire:click="$set('filter', 'upcoming')"
                class="px-5 py-2 text-sm font-semibold transition rounded-full"
                style="{{ $filter === 'upcoming' ? 'background: #15803d; color: white; box-shadow: 0 2px 8px #15803d33' : 'background: #dcfce7; color: #15803d' }}">
                <i class="mr-1 fas fa-clock"></i> Mendatang
            </button>
            <button wire:click="$set('filter', 'completed')"
                class="px-5 py-2 text-sm font-semibold transition rounded-full"
                style="{{ $filter === 'completed' ? 'background: #6b7280; color: white' : 'background: #dcfce7; color: #15803d' }}">
                <i class="mr-1 fas fa-check"></i> Selesai
            </button>
        </div>
    </div>

    <div class="max-w-6xl px-4 py-8 pb-20 mx-auto">
        <div class="space-y-4" wire:loading.class="transition-opacity opacity-50">
            @forelse($agendas as $agenda)
                @php
                    $showTime = $agenda->formatted_time && $agenda->formatted_time !== '00:00';
                    $statusLabels = ['upcoming' => 'Mendatang', 'completed' => 'Selesai'];
                @endphp

                <div class="p-6 transition-shadow duration-300 bg-white border-l-4 shadow-sm rounded-xl hover:shadow-md"
                    style="border-color: {{ $agenda->status === 'upcoming' ? '#15803d' : '#9ca3af' }}">
                    <div class="flex flex-col items-start justify-between gap-4 sm:flex-row">
                        <div class="flex-1">
                            <h3 class="mb-2 text-lg font-bold" style="color: #14532d">{{ $agenda->title }}</h3>

                            <div class="flex flex-wrap items-center gap-4 mb-3 text-sm text-gray-500">
                                <span class="flex items-center gap-1.5">
                                    <i class="fas fa-calendar" style="color: #15803d"></i>
                                    {{ $agenda->event_date->format('d M Y') }}
                                </span>
                                @if($showTime)
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-clock" style="color: #15803d"></i>
                                        {{ $agenda->formatted_time }} WIB
                                    </span>
                                @endif
                                @if($agenda->location)
                                    <span class="flex items-center gap-1.5">
                                        <i class="text-red-500 fas fa-map-marker-alt"></i>
                                        {{ $agenda->location }}
                                    </span>
                                @endif
                            </div>

                            @if($agenda->description)
                                <p class="text-sm leading-relaxed text-gray-600">
                                    {{ Str::limit($agenda->description, 200) }}
                                </p>
                            @endif
                        </div>

                        <span class="inline-block px-4 py-2 text-xs font-bold rounded-full shrink-0 whitespace-nowrap"
                            style="{{ $agenda->status === 'upcoming' ? 'background: #dcfce7; color: #15803d' : 'background: #f3f4f6; color: #6b7280' }}">
                            {{ $statusLabels[$agenda->status] ?? ucfirst($agenda->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center rounded-xl" style="background: #F0F4ED">
                    <i class="mb-4 text-4xl fas fa-calendar-times" style="color: #15803d40"></i>
                    <p class="text-lg font-medium text-gray-500">Tidak ada agenda untuk kategori ini</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $agendas->links() }}
        </div>
    </div>
</div>