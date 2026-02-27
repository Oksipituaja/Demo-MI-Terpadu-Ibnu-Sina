<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Public routes for the school website.
| Filament admin panel routes are auto-loaded via Filament\PanelProvider
| and accessible at /admin (requires authentication via Laravel Breeze)
|
*/

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\TeacherController;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Agenda;
use App\Livewire\Pages\Facilities;
use App\Livewire\Pages\FacilityDetail;
use App\Livewire\Pages\Gallery;
use App\Livewire\Pages\GalleryDetail;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\News;
use App\Livewire\Pages\NewsDetail;
use App\Livewire\Pages\PPDB;
use App\Livewire\Pages\Privacy;
use App\Livewire\Pages\Teachers;
use App\Livewire\Pages\Terms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/news', News::class)->name('news');
Route::get('/news/{slug}', NewsDetail::class)->name('news.detail');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::get('/gallery/{slug}', GalleryDetail::class)->name('gallery.detail');
Route::get('/teachers', Teachers::class)->name('teachers');
Route::get('/agenda', Agenda::class)->name('agenda');
Route::get('/facilities', Facilities::class)->name('facilities');
Route::get('/facilities/{slug}', FacilityDetail::class)->name('facility.detail');
Route::get('/ppdb', PPDB::class)->name('ppdb');
Route::get('/privacy-policy', Privacy::class)->name('privacy');
Route::get('/terms-and-conditions', Terms::class)->name('terms');

// Debug Route (untuk verify agenda data)
Route::get('/debug/agenda', [\App\Http\Controllers\DebugAgendaController::class, 'checkDisplay'])->name('debug.agenda');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function () {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, request()->boolean('remember'))) {
            request()->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    });

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function () {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    });
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout')->middleware('auth');

// Dashboard - Protected Route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin redirect
Route::redirect('/admin', '/admin-panel');

// Admin Panel Routes
Route::middleware('auth')->prefix('admin-panel')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // News Routes
    Route::resource('news', NewsController::class);

    // Teachers Routes
    Route::resource('teachers', TeacherController::class);

    // Gallery Routes
    Route::resource('galleries', GalleryController::class);

    // Agenda Routes
    Route::resource('agendas', AgendaController::class);

    // Facilities Routes
    Route::resource('facilities', FacilityController::class);

    // About Routes
    Route::resource('about', AboutController::class);

    // Registrations Routes (view only)
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::delete('registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
});

// Filament Admin Panel - Auto-routed via PanelProvider
// Requires authentication
