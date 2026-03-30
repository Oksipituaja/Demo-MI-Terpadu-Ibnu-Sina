<?php

namespace App\Jobs;

use App\Mail\ConsultationReplyMail;
use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendConsultationReplyMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Jumlah percobaan ulang jika job gagal.
     */
    public int $tries = 3;

    /**
     * Timeout per attempt (detik).
     * Default Laravel = null → hang selamanya jika SMTP tidak merespons.
     * 30 detik cukup untuk koneksi SMTP normal, termasuk Railway → Gmail.
     */
    public int $timeout = 30;

    /**
     * Jeda antar retry (detik):
     * - Retry ke-2: tunggu 10 detik
     * - Retry ke-3: tunggu 30 detik
     */
    public array $backoff = [10, 30];

    public function __construct(
        public Consultation $consultation
    ) {}

    /**
     * Eksekusi job — kirim email ke penanya.
     */
    public function handle(): void
    {
        Mail::to($this->consultation->email)
            ->send(new ConsultationReplyMail($this->consultation));

        Log::info('[SendConsultationReplyMail] Email berhasil dikirim', [
            'consultation_id' => $this->consultation->id,
            'to'              => $this->consultation->email,
            'attempt'         => $this->attempts(),
        ]);
    }

    /**
     * Dipanggil setelah semua retry habis.
     * Data jawaban di DB sudah tersimpan — hanya email yang gagal terkirim.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('[SendConsultationReplyMail] Semua retry gagal — email tidak terkirim', [
            'consultation_id' => $this->consultation->id,
            'to'              => $this->consultation->email,
            'attempts'        => $this->tries,
            'error'           => $exception->getMessage(),
        ]);
    }
}
