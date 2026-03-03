<?php

namespace App\Livewire\Pages;

use App\Models\Gallery as GalleryModel;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Gallery extends Component
{
    use WithPagination;

    public string $category = '';

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $galleries = GalleryModel::select(['id', 'title', 'slug', 'image', 'category', 'description'])
            ->when($this->category, function ($query) {
                $query->where('category', $this->category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Cache categories
        $categories = Cache::remember('gallery.all_categories', 3600, function () {
            return GalleryModel::distinct('category')
                ->select('category')
                ->whereNotNull('category')
                ->pluck('category')
                ->toArray();
        });

        return view('livewire.pages.gallery', [
            'galleries' => $galleries,
            'categories' => $categories,
        ]);
    }
}
