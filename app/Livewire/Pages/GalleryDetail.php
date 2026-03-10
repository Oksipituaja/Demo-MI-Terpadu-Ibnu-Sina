<?php

namespace App\Livewire\Pages;

use App\Models\Gallery as GalleryModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class GalleryDetail extends Component
{
    public string $slug = '';

    public function render()
    {
        $gallery = GalleryModel::where('slug', $this->slug)->firstOrFail();

        // ✅ Hapus $allCategories — tidak dipakai di blade, query sia-sia
        $relatedGalleries = GalleryModel::where('slug', '!=', $this->slug)
            ->where('category', $gallery->category)
            ->limit(3)
            ->get();

        return view('livewire.pages.gallery-detail', [
            'gallery'          => $gallery,
            'relatedGalleries' => $relatedGalleries,
        ]);
    }
}