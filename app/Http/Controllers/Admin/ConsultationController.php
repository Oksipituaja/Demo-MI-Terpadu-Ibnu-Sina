<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConsultationReplyMail;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Consultation::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        $consultations = $query->paginate(15)->withQueryString();

        $totalPending = Consultation::where('status', 'pending')->count();
        $totalReplied = Consultation::where('status', 'replied')->count();
        $totalAll     = Consultation::count();

        return view('admin.consultations.index', compact(
            'consultations',
            'totalPending',
            'totalReplied',
            'totalAll'
        ));
    }

    public function reply(Request $request, Consultation $consultation)
    {
        $request->validate([
            'reply' => 'required|string|min:10',
        ], [
            'reply.required' => 'Jawaban tidak boleh kosong.',
            'reply.min'      => 'Jawaban minimal 10 karakter.',
        ]);

        $consultation->update([
            'reply'      => $request->reply,
            'replied_at' => now(),
            'status'     => 'replied',
        ]);

        Mail::to($consultation->email)->send(
            new ConsultationReplyMail($consultation)
        );

        return redirect()
            ->route('admin.consultations.index')
            ->with('success', "Jawaban berhasil dikirim ke {$consultation->email}!");
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return redirect()
            ->route('admin.consultations.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
