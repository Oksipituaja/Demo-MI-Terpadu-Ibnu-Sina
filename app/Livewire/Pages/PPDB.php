<?php

namespace App\Livewire\Pages;

use App\Mail\NewRegistrationMail;
use App\Models\Registration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class PPDB extends Component
{
    public string $student_name   = '';
    public string $email          = '';
    public string $phone          = '';
    public string $birth_date     = '';
    public string $current_school = '';
    public string $address        = '';
    public string $guardian_name  = '';
    public string $guardian_phone = '';

    public function submit()
    {
        $validated = $this->validate([
            'student_name'   => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:15',
            'birth_date'     => 'required|date',
            'current_school' => 'nullable|string|max:255',
            'address'        => 'nullable|string',
            'guardian_name'  => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:15',
        ]);

        $registration = Registration::create($validated);

        // Kirim notifikasi email ke admin
        try {
            Mail::to(config('mail.from.address'))
                ->send(new NewRegistrationMail($registration));
        } catch (\Exception $e) {
            // Gagal kirim email tidak menghentikan proses pendaftaran
            Log::error('PPDB mail failed: ' . $e->getMessage());
        }

        $this->reset();
        session()->flash('success', 'Pendaftaran berhasil dikirim! Tim kami akan menghubungi Anda segera.');
    }

    public function render()
    {
        return view('livewire.pages.ppdb');
    }
}