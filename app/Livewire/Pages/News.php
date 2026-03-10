<?php

namespace App\Livewire\Pages;

use App\Models\News as NewsModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Withpagination;

#[Layout('components.layouts.app')]
class News extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $news = NewsModel::where('status', 'published')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%")
                    ->orWhere('excerpt', 'like', "%{$this->search}%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(50);

        return view('livewire.pages.news', [
            'news' => $news,
        ]);
    }
}
