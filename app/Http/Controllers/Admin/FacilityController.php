<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        $facilities = Facility::latest()->paginate(15);

        return view('admin.facilities.index', compact('facilities'));
    }

    public function create(): View
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:facilities',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'kondisi' => 'required|in:tersedia,perbaikan,belum_ada,akan_ada',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('facilities', 'public');
        }

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Facility added successfully!');
    }

    public function edit(Facility $facility): View
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:facilities,slug,'.$facility->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'featured_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'kondisi' => 'required|in:tersedia,perbaikan,belum_ada,akan_ada',
        ]);

        if ($request->hasFile('featured_image')) {
            // Check if old featured_image exists before deleting
            if ($facility->featured_image && \Storage::disk('public')->exists($facility->featured_image)) {
                \Storage::disk('public')->delete($facility->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('facilities', 'public');
        }

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Facility updated successfully!');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->featured_image && \Storage::disk('public')->exists($facility->featured_image)) {
            \Storage::disk('public')->delete($facility->featured_image);
        }
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Facility deleted successfully!');
    }
}
