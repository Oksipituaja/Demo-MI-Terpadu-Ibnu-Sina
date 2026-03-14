<?php

namespace App\Livewire\Pages;

use App\Models\Agenda as AgendaModel;
use App\Models\News as NewsModel;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class News extends Component
{
    use WithPagination;

    #[Url]
    public string $tab = 'berita';

    #[Url]
    public string $search = '';

    public string $filter = 'upcoming';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedTab(): void
    {
        $this->resetPage();
        $this->search = '';
        $this->filter = 'upcoming';
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
        $this->updatedTab();
    }

    public function render()
    {
        $today = Carbon::today();

        $news = NewsModel::where('status', 'published')
            ->when($this->search, fn($q) =>
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%")
                  ->orWhere('excerpt', 'like', "%{$this->search}%")
            )
            ->orderBy('published_at', 'desc')
            ->paginate(9, pageName: 'newsPage');

        $agendas = AgendaModel::when($this->filter !== 'all', fn($q) =>
                $q->where('status', $this->filter)
            )
            ->orderByRaw("
                CASE WHEN event_date >= ? THEN 0 ELSE 1 END,
                CASE WHEN event_date >= ? THEN event_date ELSE '9999-12-31' END ASC,
                event_date DESC
            ", [$today, $today])
            ->paginate(10, pageName: 'agendaPage');

        return view('livewire.pages.news', [
            'news'    => $news,
            'agendas' => $agendas,
        ]);
    }
}