<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $googleFormUrl = Setting::get('ppdb_google_form_url');
        return view('admin.settings', compact('googleFormUrl'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'ppdb_google_form_url' => [
                'nullable',
                'url',
                function ($attribute, $value, $fail) {
                    if ($value && !str_contains($value, 'docs.google.com/forms')) {
                        $fail('Link harus dari Google Forms (docs.google.com/forms).');
                    }
                },
            ],
        ]);

        Setting::set('ppdb_google_form_url', $request->ppdb_google_form_url ?: null);

        return back()->with('success', 'Pengaturan PPDB berhasil disimpan.');
    }
}