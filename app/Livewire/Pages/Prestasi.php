<?php

namespace App\Livewire\Pages;

use App\Models\Prestasi as PrestasiModel;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Prestasi extends Component
{
    use WithPagination;

    public function render()
    {
        $prestasis = PrestasiModel::where('status', 'published')
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
            ->paginate(12);

        return view('livewire.pages.prestasi', compact('prestasis'));
    }
}
