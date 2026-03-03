<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(): View
    {
        $registrations = Registration::latest()->paginate(15);

        return view('admin.registrations.index', compact('registrations'));
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.registrations.index')->with('success', 'Registration deleted successfully!');
    }
}
