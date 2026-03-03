<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PrestasiController extends Controller
{
    public function index(): View
    {
        $prestasis = Prestasi::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create(): View
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
            'achievement_date' => 'nullable|date',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('prestasi', 'public');
        }

        Prestasi::create($validated);

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi created successfully!');
    }

    public function edit(Prestasi $prestasi): View
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Prestasi $prestasi, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
            'achievement_date' => 'nullable|date',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($prestasi->image) {
                \Storage::disk('public')->delete($prestasi->image);
            }
            $validated['image'] = $request->file('image')->store('prestasi', 'public');
        }

        $prestasi->update($validated);

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi updated successfully!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->image) {
            \Storage::disk('public')->delete($prestasi->image);
        }
        $prestasi->delete();

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi deleted successfully!');
    }
}
