<?php

namespace App\Livewire\Pages;

use App\Models\Facility as FacilityModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class FacilityDetail extends Component
{
    public string $slug = '';

    public function render()
    {
        $facility = FacilityModel::where('slug', $this->slug)
            ->firstOrFail();

        $otherFacilities = FacilityModel::where('slug', '!=', $this->slug)
            ->limit(3)
            ->get();

        return view('livewire.pages.facility-detail', [
            'facility' => $facility,
            'otherFacilities' => $otherFacilities,
        ]);
    }
}
