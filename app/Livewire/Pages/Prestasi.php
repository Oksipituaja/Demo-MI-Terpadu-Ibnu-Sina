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
            ->orderBy('achievement_date', 'desc')
            ->paginate(12);

        return view('livewire.pages.prestasi', compact('prestasis'));
    }
}
