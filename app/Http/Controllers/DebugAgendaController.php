<?php

/**
 * Quick Browser Test untuk Verify Agenda Data
 * Access: localhost:8000/check-agenda-display
 *
 * Add route di routes/web.php:
 * Route::get('/check-agenda-display', function () {
 *     return view('admin.agenda-check');
 * });
 */

// app/Http/Controllers/DebugController.php (opsional)
// Atau langsung di routes/web.php

namespace App\Http\Controllers;

use App\Models\Agenda;

class DebugAgendaController extends Controller
{
    public function checkDisplay()
    {
        $agendas = Agenda::all();

        return response()->json([
            'count' => $agendas->count(),
            'data' => $agendas->map(fn ($a) => [
                'id' => $a->id,
                'title' => $a->title,
                'event_date' => $a->event_date,
                'event_time' => $a->event_time,
                'formatted_time' => $a->formatted_time,
                'event_date_time' => $a->event_date_time,
                'status' => $a->status,
            ])->toArray(),
        ]);
    }
}
