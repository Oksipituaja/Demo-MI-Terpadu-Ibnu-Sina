<?php

namespace App\Livewire\Components;

use App\Models\Prestasi;
use Livewire\Component;

class PrestasiCard extends Component
{
    public function render()
    {
        $prestasis = Prestasi::where('status', 'published')
            ->orderBy('achievement_date', 'desc')
            ->limit(3)
            ->get();

        return view('livewire.components.prestasi-card', compact('prestasis'));
    }
}
