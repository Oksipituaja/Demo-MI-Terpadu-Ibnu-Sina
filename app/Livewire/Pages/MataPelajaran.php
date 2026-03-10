<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class MataPelajaran extends Component
{
    public function render()
    {
        return view('livewire.pages.mata-pelajaran');
    }
}