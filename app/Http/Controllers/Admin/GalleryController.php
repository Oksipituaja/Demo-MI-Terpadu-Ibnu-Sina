<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::latest()->paginate(15);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.galleries.create');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:galleries,slug|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:100',
            'featured_image'       => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('gallery', 'public');
        }

        Gallery::create($validated);
        Cache::forget('gallery.all_categories');

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:galleries,slug,' . $gallery->id . '|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:100',
            'featured_image'       => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($gallery->featured_image && Storage::disk('public')->exists($gallery->featured_image)) {
                Storage::disk('public')->delete($gallery->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('gallery', 'public');
        }

        $gallery->update($validated);
        Cache::forget('gallery.all_categories');

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->featured_image && Storage::disk('public')->exists($gallery->featured_image)) {
            Storage::disk('public')->delete($gallery->featured_image);
        }
        $gallery->delete();
        Cache::forget('gallery.all_categories');

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}