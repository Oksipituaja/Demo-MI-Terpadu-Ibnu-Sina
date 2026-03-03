<?php

namespace App\Livewire\Components;

use App\Models\Prestasi;
use Livewire\Component;

class PrestasiCard extends Component
{
    public function render()
    {
        $prestasis = Prestasi::where('status', 'published')
            ->orderByRaw("
                CASE 
                    WHEN category LIKE '%Juara 1%' THEN 1
                    WHEN category LIKE '%Juara 2%' THEN 2
                    WHEN category LIKE '%Juara 3%' THEN 3
                    WHEN category LIKE '%Harapan 1%' THEN 4
                    WHEN category LIKE '%Harapan 2%' THEN 5
                    WHEN category LIKE '%Harapan 3%' THEN 6
                    WHEN category LIKE '%Harapan%' THEN 7
                    ELSE 99
                END,
                achievement_date DESC
            ")
            ->limit(3)
            ->get();

        return view('livewire.components.prestasi-card', compact('prestasis'));
    }
}
