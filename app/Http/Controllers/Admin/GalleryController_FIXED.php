<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:galleries',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'featured_image' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
        ]);

        $validated['featured_image'] = $request->file('featured_image')->store('gallery', 'public');
        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item added successfully!');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Gallery $gallery, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:galleries,slug,'.$gallery->id,
            'description' => 'nullable|string',
            'category' => 'required|string',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
        ]);

        if ($request->hasFile('featured_image')) {
            // FIX #1: Check if old featured_image exists before deleting
            if ($gallery->featured_image && \Storage::disk('public')->exists($gallery->featured_image)) {
                \Storage::disk('public')->delete($gallery->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        // FIX #1: Check if featured_image exists before deleting
        if ($gallery->featured_image && \Storage::disk('public')->exists($gallery->featured_image)) {
            \Storage::disk('public')->delete($gallery->featured_image);
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item deleted successfully!');
    }
}
