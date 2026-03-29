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
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'category'         => 'nullable|string|max:100',
            'achievement_date' => 'nullable|date',
            'featured_image'   => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'status'           => 'required|in:draft,published',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        if ($request->hasFile('featured_image')) {
            // Store under 'prestasi' folder in public disk → accessible via asset('storage/prestasi/...')
            $validated['featured_image'] = $request->file('featured_image')->store('prestasi', 'public');
        }

        Prestasi::create($validated);

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(Prestasi $prestasi): View
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Prestasi $prestasi, Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'category'         => 'nullable|string|max:100',
            'achievement_date' => 'nullable|date',
            'featured_image'   => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'status'           => 'required|in:draft,published',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title'], $prestasi->id);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($prestasi->featured_image) {
                \Storage::disk('public')->delete($prestasi->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('prestasi', 'public');
        }

        $prestasi->update($validated);

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->featured_image) {
            \Storage::disk('public')->delete($prestasi->featured_image);
        }
        $prestasi->delete();

        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi berhasil dihapus!');
    }

    /**
     * Generate unique slug with collision detection.
     *
     * @param  ?int  $excludeId  Exclude this ID from uniqueness check (for updates)
     */
    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug     = Str::slug($title);
        $baseSlug = $slug;
        $counter  = 1;

        while (
            Prestasi::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
