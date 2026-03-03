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
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'kondisi' => 'required|in:tersedia,perbaikan,belum_ada,akan_ada',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('facilities', 'public');
        }

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Facility added successfully!');
    }

    public function edit(Facility $facility): View
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Facility $facility, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:facilities,slug,'.$facility->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'kondisi' => 'required|in:tersedia,perbaikan,belum_ada,akan_ada',
        ]);

        if ($request->hasFile('image')) {
            if ($facility->image) {
                \Storage::disk('public')->delete($facility->image);
            }
            $validated['image'] = $request->file('image')->store('facilities', 'public');
        }

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Facility updated successfully!');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->image) {
            \Storage::disk('public')->delete($facility->image);
        }
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Facility deleted successfully!');
    }
}
