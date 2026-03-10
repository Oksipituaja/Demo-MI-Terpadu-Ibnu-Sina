<?php

namespace App\Livewire\Pages;

use App\Models\Teacher;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Teachers extends Component
{
    public function render()
    {
        $teachers = Teacher::orderBy('created_at', 'desc')->paginate(60);

        return view('livewire.pages.teachers', [
            'teachers' => $teachers,
        ]);
    }
}
