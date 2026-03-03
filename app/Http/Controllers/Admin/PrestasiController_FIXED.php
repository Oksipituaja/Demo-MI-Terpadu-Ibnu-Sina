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
        $prestasis = Prestasi::orderByRaw("
            CASE 
                WHEN category LIKE '%Juara 1%' THEN 1
                WHEN category LIKE '%Juara 2%' THEN 2
                WHEN category LIKE '%Juara 3%' THEN 3
                WHEN category LIKE '%Harapan 1%' THEN 4
                WHEN category LIKE '%Harapan 2%' THEN 5
                WHEN category LIKE '%Harapan 3%' THEN 6
                WHEN category LIKE '%Harapan%' THEN 7
                ELSE 99
            END,
            achievement_date DESC
        ")->paginate(15);

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

        // FIX #2: Generate slug with uniqueness check and counter if collision
        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

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

        // FIX #2: Generate slug with uniqueness check (exclude current record)
        $newSlug = $this->generateUniqueSlug($validated['title'], $prestasi->id);
        $validated['slug'] = $newSlug;

        if ($request->hasFile('image')) {
            if ($prestasi->image && \Storage::disk('public')->exists($prestasi->image)) {
                \Storage::disk('public')->delete($prestasi->image);
            }
            $validated['image'] = $request->file('image')->store('prestasi', 'public');
        }

        $prestasi->update($validated);

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi updated successfully!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->image && \Storage::disk('public')->exists($prestasi->image)) {
            \Storage::disk('public')->delete($prestasi->image);
        }
        $prestasi->delete();

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi deleted successfully!');
    }

    /**
     * Generate unique slug with collision detection and counter
     *
     * @param  ?int  $excludeId  - Exclude this ID from uniqueness check (for updates)
     */
    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $baseSlug = $slug;
        $counter = 1;

        while (Prestasi::where('slug', $slug)
            ->when($excludeId, function ($query) use ($excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
