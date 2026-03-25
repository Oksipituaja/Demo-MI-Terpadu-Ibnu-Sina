<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class PPDB extends Component
{
    public function render()
    {
        return view('livewire.pages.ppdb', [
            'googleFormUrl' => Setting::get('ppdb_google_form_url'),
        ]);
    }
}
