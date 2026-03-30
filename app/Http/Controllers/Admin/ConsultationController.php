<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendConsultationReplyMail;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        // Cegah jawab ulang yang sudah dijawab
        if ($consultation->isReplied()) {
            return redirect()
                ->route('admin.consultations.index')
                ->with('warning', 'Pertanyaan ini sudah dijawab sebelumnya.');
        }

        // 1. Simpan ke DB dulu — data aman meskipun SMTP/queue gagal
        $consultation->update([
            'reply'      => $request->reply,
            'replied_at' => now(),
            'status'     => 'replied',
        ]);

        // 2. Dispatch job pengiriman email ke queue
        //    QUEUE_CONNECTION=sync     → langsung kirim (local dev)
        //    QUEUE_CONNECTION=database → masuk antrian, diproses queue:work (Railway/production)
        try {
            SendConsultationReplyMail::dispatch($consultation);

            Log::info('[ConsultationController] Mail job dispatched', [
                'consultation_id' => $consultation->id,
                'to'              => $consultation->email,
                'queue_driver'    => config('queue.default'),
            ]);
        } catch (\Throwable $e) {
            Log::error('[ConsultationController] Gagal dispatch mail job', [
                'consultation_id' => $consultation->id,
                'error'           => $e->getMessage(),
            ]);

            return redirect()
                ->route('admin.consultations.index')
                ->with('warning', "Jawaban disimpan, tapi gagal menjadwalkan email ke {$consultation->email}. Cek log untuk detail.");
        }

        $message = config('queue.default') === 'sync'
            ? "Jawaban berhasil disimpan dan email dikirim ke {$consultation->email}!"
            : "Jawaban disimpan. Email ke {$consultation->email} sedang diproses di antrian.";

        return redirect()
            ->route('admin.consultations.index')
            ->with('success', $message);
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return redirect()
            ->route('admin.consultations.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
