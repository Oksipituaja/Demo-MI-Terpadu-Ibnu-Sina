<?php

namespace App\Livewire\Pages;

use App\Models\News as NewsModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class NewsDetail extends Component
{
    public string $slug = '';

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $news = NewsModel::where('slug', $this->slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('livewire.pages.news-detail', [
            'news' => $news,
        ]);
    }
}