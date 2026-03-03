<?php

namespace App\Livewire\Pages;

use App\Models\About as AboutModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.app')]
class About extends Component
{
    #[Url]
    public $expanded = false;

    public function expand()
    {
        $this->expanded = true;
    }

    public function render()
    {
        // Get hero image
        $heroImage = AboutModel::where('key', 'hero_image')->first();

        // Get principal greeting (sambutan kepala sekolah)
        $principalGreeting = AboutModel::where('key', 'principal_greeting')->first();

        // Get all about sections except hero_image
        $aboutSections = AboutModel::where('key', '!=', 'hero_image')->get();

        // Get specific sections for expanded display
        $schoolProfile = AboutModel::where('key', 'school_profile')->first();
        $vision = AboutModel::where('key', 'vision')->first();
        $mission = AboutModel::where('key', 'mission')->first();

        return view('livewire.pages.about', [
            'heroImage' => $heroImage,
            'principalGreeting' => $principalGreeting,
            'aboutSections' => $this->expanded ? $aboutSections : collect(),
            'schoolProfile' => $this->expanded ? $schoolProfile : null,
            'vision' => $this->expanded ? $vision : null,
            'mission' => $this->expanded ? $mission : null,
            'expanded' => $this->expanded,
        ]);
    }
}
