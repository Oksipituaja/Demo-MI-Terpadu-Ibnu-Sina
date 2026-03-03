<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = Teacher::latest()->paginate(15);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:teachers',
            'email' => 'required|email|unique:teachers',
            'phone' => 'nullable|string',
            'subject' => 'nullable|string',
            'bio' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('teachers', 'public');
        }

        Teacher::create($validated);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher): View
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Teacher $teacher, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:teachers,slug,'.$teacher->id,
            'email' => 'required|email|unique:teachers,email,'.$teacher->id,
            'phone' => 'nullable|string',
            'subject' => 'nullable|string',
            'bio' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($teacher->image) {
                \Storage::disk('public')->delete($teacher->image);
            }
            $validated['image'] = $request->file('image')->store('teachers', 'public');
        }

        $teacher->update($validated);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->image) {
            \Storage::disk('public')->delete($teacher->image);
        }
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
