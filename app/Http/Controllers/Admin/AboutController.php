<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            'title' => 'required|string|max:255',
            'principal_name' => 'nullable|string|max:255',
            'key' => 'required|string|unique:abouts',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $folder = $validated['key'] === 'hero_image' ? 'hero' : 'about';
            $validated['image'] = $request->file('image')->store($folder, 'public');
        }

        About::create($validated);

        return redirect()->route('admin.about.index')->with('success', 'About section created successfully!');
    }

    public function edit(About $about): View
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(About $about, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'principal_name' => 'nullable|string|max:255',
            'key' => 'required|string|unique:abouts,key,'.$about->id,
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image) {
                \Storage::disk('public')->delete($about->image);
            }
            $folder = $validated['key'] === 'hero_image' ? 'hero' : 'about';
            $validated['image'] = $request->file('image')->store($folder, 'public');
        }

        $about->update($validated);

        return redirect()->route('admin.about.index')->with('success', 'About section updated successfully!');
    }

    public function destroy(About $about)
    {
        if ($about->image) {
            \Storage::disk('public')->delete($about->image);
        }
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'About section deleted successfully!');
    }
}
