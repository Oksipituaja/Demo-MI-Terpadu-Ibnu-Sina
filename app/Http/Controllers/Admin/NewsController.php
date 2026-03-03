<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::latest('created_at')->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        $users = User::all();

        return view('admin.news.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $validated['user_id'] = auth()->id();

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article created successfully!');
    }

    public function edit(News $news): View
    {
        $users = User::all();

        return view('admin.news.edit', compact('news', 'users'));
    }

    public function update(News $news, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug,'.$news->id,
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                \Storage::disk('public')->delete($news->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article updated successfully!');
    }

    public function destroy(News $news)
    {
        if ($news->featured_image) {
            \Storage::disk('public')->delete($news->featured_image);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News article deleted successfully!');
    }
}
