<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ManagementAccountController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\TeacherController;
use App\Livewire\Pages\About;
use App\Livewire\Pages\MataPelajaran;
use App\Livewire\Pages\Peraturan;
use App\Livewire\Pages\Facilities;
use App\Livewire\Pages\FacilityDetail;
use App\Livewire\Pages\Gallery;
use App\Livewire\Pages\GalleryDetail;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\News;
use App\Livewire\Pages\NewsDetail;
use App\Livewire\Pages\PPDB;
use App\Livewire\Pages\Prestasi;
use App\Livewire\Pages\PrestasiDetail;
use App\Livewire\Pages\Privacy;
use App\Livewire\Pages\Teachers;
use App\Livewire\Pages\Terms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

// ===== Storage File Serving (Railway symlink workaround) =====
Route::get('/files/{path}', function (string $path) {
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) {
        abort(404);
    }
    $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';
    return response()->make(
        file_get_contents($fullPath),
        200,
        [
            'Content-Type' => $mimeType,
            'Content-Length' => filesize($fullPath),
            'Cache-Control' => 'public, max-age=86400',
        ]
    );
})->where('path', '.*');

// ===== Public Routes =====
Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/mata-pelajaran', MataPelajaran::class)->name('mata-pelajaran');
Route::get('/peraturan', Peraturan::class)->name('peraturan');
Route::get('/news', News::class)->name('news');
Route::get('/news/{slug}', NewsDetail::class)->name('news.detail');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::get('/gallery/{slug}', GalleryDetail::class)->name('gallery.detail');
Route::get('/teachers', Teachers::class)->name('teachers');
Route::get('/facilities', Facilities::class)->name('facilities');
Route::get('/facilities/{slug}', FacilityDetail::class)->name('facility.detail');
Route::get('/prestasi', Prestasi::class)->name('prestasi.index');
Route::get('/prestasi/{slug}', PrestasiDetail::class)->name('prestasi.detail');
Route::get('/ppdb', PPDB::class)->name('ppdb');
Route::get('/privacy-policy', Privacy::class)->name('privacy');
Route::get('/terms-and-conditions', Terms::class)->name('terms');

// Redirect /agenda ke /news?tab=agenda
Route::get('/agenda', function () {
    return redirect()->route('news', ['tab' => 'agenda']);
})->name('agenda');

// Testing error pages
Route::get('/test-403', fn() => abort(403));
Route::get('/test-404', fn() => abort(404));
Route::get('/test-500', fn() => abort(500));
Route::get('/test-419', fn() => abort(419));
Route::get('/test-429', fn() => abort(429));

Route::get('/debug-link', function () {
    $result = [];
    
    // Cek apakah symlink ada
    $result['link_exists'] = file_exists(public_path('storage'));
    $result['is_link'] = is_link(public_path('storage'));
    
    // Coba buat symlink sekarang
    try {
        \Artisan::call('storage:link');
        $result['artisan_output'] = \Artisan::output();
    } catch (\Exception $e) {
        $result['artisan_error'] = $e->getMessage();
    }
    
    // Cek lagi setelah artisan
    $result['link_exists_after'] = file_exists(public_path('storage'));
    $result['is_link_after'] = is_link(public_path('storage'));
    
    return response()->json($result);
});

Route::get('/debug-cache', function () {
    $key = 'about.principal_greeting';
    $cached = Cache::get($key);
    return response()->json([
        'cache_store' => config('cache.default'),
        'cache_path' => storage_path('framework/cache'),
        'key_exists' => Cache::has($key),
        'cached_value' => $cached ? [
            'id' => $cached->id,
            'image' => $cached->image,
        ] : null,
    ]);
});

Route::get('/debug-path', function () {
    $file = 'about/53lL4kAO6ZWDSEhXqZZgkzFZLnjPbLMGJ1HgcQfP.jpg';
    $path = storage_path('app/public/' . $file);
    return response()->json([
        'storage_path' => $path,
        'file_exists' => file_exists($path),
        'realpath' => realpath(storage_path('app/public')),
    ]);
});

Route::get('/debug-storage', function () {
    $path = storage_path('app/public');
    return response()->json([
        'path' => $path,
        'exists' => is_dir($path),
        'writable' => is_writable($path),
        'files' => is_dir($path) ? scandir($path) : [],
        'public_storage' => public_path('storage'),
        'link_exists' => is_link(public_path('storage')),
    ]);
});

Route::get('/debug-files', function () {
    $base = storage_path('app/public');
    return response()->json([
        'about' => is_dir("$base/about") ? scandir("$base/about") : [],
        'gallery' => is_dir("$base/gallery") ? scandir("$base/gallery") : [],
    ]);
});

// Debug Route
Route::get('/debug/agenda', [\App\Http\Controllers\DebugAgendaController::class, 'checkDisplay'])->name('debug.agenda');

// ===== Authentication Routes =====
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function () {
        $credentials = request()->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, request()->boolean('remember'))) {
            request()->session()->regenerate();
            Auth::user()->forceFill(['last_login' => now()])->save();
            return redirect()->intended('/admin-panel');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    })->name('login.post')->middleware('throttle:5,1');
});

Route::post('/logout', function () {
    if (Auth::check()) {
        Auth::user()->forceFill(['remember_token' => null])->save();
    }
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')
        ->withCookie(Cookie::forget('remember_web_' . sha1('App\Models\User')));
})->name('logout')->middleware('auth');

// ===== Protected Routes =====
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::redirect('/admin', '/admin-panel');

// ===== Admin Panel Routes =====
Route::middleware(['auth', 'auth.timeout'])->prefix('admin-panel')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('news', NewsController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('agendas', AgendaController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('about', AboutController::class);
    Route::resource('prestasis', PrestasiController::class);
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::delete('registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::middleware('super_admin')->resource('management-account', ManagementAccountController::class);
});