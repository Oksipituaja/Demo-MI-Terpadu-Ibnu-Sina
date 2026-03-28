<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index(): View
    {
        $abouts = About::paginate(15);
        return view('admin.about.index', compact('abouts'));
    }

    public function create(): View
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'principal_name' => 'nullable|string|max:255',
            'key'            => 'required|string|unique:abouts',
            'content'        => 'nullable|string',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
        ]);

        if ($request->hasFile('featured_image')) {
            $folder = match($validated['key']) {
                'home_hero_image' => 'hero/home',
                'hero_image'      => 'hero/about',
                default           => 'about',
            };
            $validated['featured_image'] = $request->file('featured_image')->store($folder, 'public');
        }

        // Untuk key yang hanya butuh gambar (hero), content tidak wajib
        if (empty($validated['content'])) {
            $validated['content'] = '';
        }

        About::create($validated);
        $this->clearAboutCache();

        return redirect()->route('admin.about.index')
            ->with('success', 'Konten berhasil ditambahkan!');
    }

    public function edit(About $about): View
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(About $about, Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'principal_name' => 'nullable|string|max:255',
            'key'            => 'required|string|unique:abouts,key,' . $about->id,
            'content'        => 'nullable|string',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($about->featured_image) {
                Storage::disk('public')->delete($about->featured_image);
            }
            $folder = match($validated['key']) {
                'home_hero_image' => 'hero/home',
                'hero_image'      => 'hero/about',
                default           => 'about',
            };
            $validated['featured_image'] = $request->file('featured_image')->store($folder, 'public');
        }

        if (empty($validated['content'])) {
            $validated['content'] = $about->content ?? '';
        }

        $about->update($validated);
        $this->clearAboutCache();

        return redirect()->route('admin.about.index')
            ->with('success', 'Konten berhasil diperbarui!');
    }

    public function destroy(About $about)
    {
        if ($about->featured_image) {
            Storage::disk('public')->delete($about->featured_image);
        }
        $about->delete();
        $this->clearAboutCache();

        return redirect()->route('admin.about.index')
            ->with('success', 'Konten berhasil dihapus!');
    }

    private function clearAboutCache(): void
    {
        Cache::forget('about.principal_greeting');
        Cache::forget('about.home_hero_image');  // key HOME hero
        Cache::forget('about.hero_image');        // key ABOUT hero
    }
}