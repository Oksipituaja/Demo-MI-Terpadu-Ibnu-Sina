<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        $agendas = Agenda::latest()->paginate(15);

        return view('admin.agendas.index', compact('agendas'));
    }

    public function create(): View
    {
        return view('admin.agendas.create');
    }

    public function store(StoreAgendaRequest $request)
    {
        $data = $request->validated();

        // Pecah datetime menjadi date dan time
        $dt = Carbon::parse($data['event_date']);
        $data['event_date'] = $dt->format('Y-m-d');
        $data['event_time'] = $dt->format('H:i:s');

        Agenda::create($data);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dibuat!');
    }

    public function edit(Agenda $agenda): View
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(Agenda $agenda, UpdateAgendaRequest $request)
    {
        $data = $request->validated();

        // Pecah datetime menjadi date dan time
        $dt = Carbon::parse($data['event_date']);
        $data['event_date'] = $dt->format('Y-m-d');
        $data['event_time'] = $dt->format('H:i:s');

        $agenda->update($data);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dihapus!');
    }
}
