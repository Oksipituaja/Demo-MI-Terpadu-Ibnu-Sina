<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::with('user')->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'required|string|unique:news',
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status'         => 'required|in:draft,published',
            'published_at'   => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $validated['user_id'] = auth()->id();

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Article created successfully!');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'required|string|unique:news,slug,' . $news->id,
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status'         => 'required|in:draft,published',
            'published_at'   => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(News $news)
    {
        if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
            Storage::disk('public')->delete($news->featured_image);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Article deleted successfully!');
    }
}