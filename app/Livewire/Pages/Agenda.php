<?php

namespace App\Livewire\Pages;

use App\Models\Agenda as AgendaModel;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Agenda extends Component
{
    public string $filter = 'upcoming';

    public function render()
    {
        $today = Carbon::today();

        $agendas = AgendaModel::when($this->filter !== 'all', function ($query) {
            $query->where('status', $this->filter);
        })
            ->orderByRaw('
                CASE WHEN event_date >= ? THEN 0 ELSE 1 END,
                CASE WHEN event_date >= ? THEN event_date ELSE NULL END ASC,
                event_date DESC
            ', [$today, $today])
            ->paginate(10);

        return view('livewire.pages.agenda', [
            'agendas' => $agendas,
        ]);
    }
}
