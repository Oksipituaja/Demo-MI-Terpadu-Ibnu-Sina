<?php

namespace App\Livewire\Pages;

use App\Models\Consultation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Konsultasi extends Component
{
    public string $name    = '';
    public string $email   = '';
    public string $subject = '';
    public string $message = '';

    protected function rules(): array
    {
        return [
            'name'    => 'required|string|min:2|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:10|max:2000',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required'    => 'Nama lengkap wajib diisi.',
            'name.min'         => 'Nama minimal 2 karakter.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'message.required' => 'Pertanyaan wajib diisi.',
            'message.min'      => 'Pertanyaan minimal 10 karakter.',
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        $consultation = Consultation::create($validated);

        // Kirim email konfirmasi ke pengirim (opsional)
        try {
            Mail::to($consultation->email)
                ->send(new \App\Mail\ConsultationReceivedMail($consultation));
        } catch (\Exception $e) {
            Log::warning('Email konfirmasi konsultasi gagal: ' . $e->getMessage());
            // Tidak throw — form tetap sukses meski email gagal
        }

        $this->reset(['name', 'email', 'subject', 'message']);
        session()->flash('sent', true);
    }

    public function render()
    {
        return view('livewire.pages.konsultasi')
            ->layout('components.layouts.app', ['title' => 'Konsultasi']);
    }
}
