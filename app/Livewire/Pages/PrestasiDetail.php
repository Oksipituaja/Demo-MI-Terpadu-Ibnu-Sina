<?php

namespace App\Livewire\Pages;

use App\Models\Prestasi;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class PrestasiDetail extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $prestasi = Prestasi::where('slug', $this->slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('livewire.pages.prestasi-detail', compact('prestasi'));
    }
}
