<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Peraturan extends Component
{
    public function render()
    {
        return view('livewire.pages.peraturan');
    }
}