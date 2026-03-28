# Panduan Lengkap SPMB / PPDB MI Terpadu Ibnu Sina
## TALL Stack: Laravel 12, Livewire, Alpine.js, Tailwind CSS + MySQL

---

## Analisis Tampilan & Evaluasi Kode yang Ada

Berdasarkan screenshot yang ditampilkan, sistem SPMB Anda sudah memiliki:

**Yang Sudah Berjalan Baik:**
- Landing page PPDB dengan alur pendaftaran 5 langkah (Bayar → Konfirmasi → Token → Formulir → Pengumuman)
- Form pendaftaran dengan field: Nama Siswa, Email, Nomor Telepon, Tanggal Lahir, Sekolah Asal, Nama Wali, Nomor Telepon Wali, Alamat
- Admin panel dengan daftar pendaftar (tabel: Nama Siswa, Email, Nomor Telepon, Tanggal Daftar, Aksi)
- Modal detail pendaftaran
- Notifikasi Gmail sudah berjalan

**Yang Perlu Diperbaiki:**
1. Data nama siswa masih "siswa9" (dummy/seeder belum diganti data real)
2. Email pendaftar masih `user@example.com` (seeder)
3. Modal "Detail Pendaftaran" background hitam — perlu z-index fix di Livewire
4. Belum ada status seleksi (pending/diterima/ditolak/cadangan)
5. Belum ada filter/search di tabel admin
6. Belum ada export Excel/PDF
7. Belum ada gelombang pendaftaran
8. Form belum multi-step (satu halaman langsung kirim)
9. Kolom `sekolah_asal` & `tanggal_lahir` belum tampil di admin detail
10. Tidak ada pembatasan kuota otomatis

---

## OPSI 1: Integrasi Google Forms (Formulir dari Pihak Sekolah)

Gunakan opsi ini jika sekolah sudah punya Google Forms dan ingin tetap memakainya.

### Keunggulan Opsi ini:
- Tidak perlu membuat form dari scratch
- Data otomatis masuk Google Sheets
- Bisa dihubungkan ke Gmail otomatis via Google Apps Script
- Mudah dikelola oleh staf non-teknis

### Langkah Implementasi:

**1. Embed Google Forms ke Halaman Laravel**

```blade
{{-- resources/views/ppdb/index.blade.php --}}
<div id="formulir-pendaftaran" class="my-8">
    <h2 class="text-2xl font-bold text-green-800 mb-4">Formulir Pendaftaran Online</h2>
    <p class="text-gray-600 mb-4">Silakan isi formulir berikut dengan lengkap dan benar.</p>

    {{-- Embed Google Forms --}}
    <div class="rounded-2xl overflow-hidden shadow-lg border border-green-100">
        <iframe
            src="https://docs.google.com/forms/d/e/XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/viewform?embedded=true"
            width="100%"
            height="900"
            frameborder="0"
            marginheight="0"
            marginwidth="0"
            class="w-full"
            loading="lazy">
            Memuat formulir....
        </iframe>
    </div>
</div>
```

**Catatan:** Ganti `XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX` dengan ID Google Forms sekolah.

---

**2. Sinkronisasi Data Google Forms ke Laravel via Webhook**

Buat endpoint di Laravel untuk menerima data dari Google Apps Script:

```php
// routes/api.php
Route::post('/spmb/google-forms-webhook', [SpmbnController::class, 'receiveGoogleForms'])
    ->name('spmb.webhook');
```

```php
// app/Http/Controllers/SpmbController.php
public function receiveGoogleForms(Request $request)
{
    // Verifikasi secret key dari Google Apps Script
    if ($request->header('X-Secret-Key') !== config('spmb.webhook_secret')) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $validated = $request->validate([
        'nama_siswa'   => 'required|string|max:255',
        'email'        => 'required|email',
        'no_telepon'   => 'required|string|max:20',
        'tanggal_lahir'=> 'required|date',
        'nama_wali'    => 'required|string|max:255',
        'no_hp_wali'   => 'required|string|max:20',
        'alamat'       => 'required|string',
        'sekolah_asal' => 'nullable|string|max:255',
    ]);

    $pendaftaran = Pendaftaran::create([
        ...$validated,
        'status'        => 'pending',
        'sumber'        => 'google_forms',
        'no_pendaftaran'=> 'MI-' . date('Y') . '-' . str_pad(
            Pendaftaran::whereYear('created_at', date('Y'))->count() + 1, 4, '0', STR_PAD_LEFT
        ),
    ]);

    // Kirim notifikasi ke WhatsApp
    $this->sendWhatsApp($pendaftaran);

    return response()->json(['success' => true, 'id' => $pendaftaran->id]);
}
```

---

**3. Google Apps Script — Auto Kirim ke Laravel + Gmail**

Pasang script ini di Google Forms (Tools → Script Editor):

```javascript
// Code.gs — Google Apps Script
const LARAVEL_WEBHOOK_URL = 'https://miterpaduibnusina.sch.id/api/spmb/google-forms-webhook';
const WEBHOOK_SECRET = 'secret_key_rahasia_anda';
const ADMIN_EMAIL = 'admin@miterpaduibnusina.sch.id';

function onFormSubmit(e) {
  const response = e.response;
  const answers  = response.getItemResponses();

  // Ambil jawaban berdasarkan urutan pertanyaan di Google Forms
  const data = {
    nama_siswa:    answers[0].getResponse(),
    email:         answers[1].getResponse(),
    no_telepon:    answers[2].getResponse(),
    tanggal_lahir: answers[3].getResponse(),
    nama_wali:     answers[4].getResponse(),
    no_hp_wali:    answers[5].getResponse(),
    alamat:        answers[6].getResponse(),
    sekolah_asal:  answers[7] ? answers[7].getResponse() : '',
  };

  // 1. Kirim ke Laravel
  kirimKeLaravel(data);

  // 2. Kirim email konfirmasi ke pendaftar
  kirimEmailKonfirmasi(data);

  // 3. Notifikasi ke admin
  notifikasiAdmin(data);
}

function kirimKeLaravel(data) {
  const options = {
    method: 'post',
    contentType: 'application/json',
    headers: { 'X-Secret-Key': WEBHOOK_SECRET },
    payload: JSON.stringify(data),
    muteHttpExceptions: true,
  };
  UrlFetchApp.fetch(LARAVEL_WEBHOOK_URL, options);
}

function kirimEmailKonfirmasi(data) {
  const subject = `✅ Konfirmasi Pendaftaran SPMB MI Terpadu Ibnu Sina - ${data.nama_siswa}`;
  const body = `
Assalamu'alaikum Warahmatullahi Wabarakatuh,

Yth. Bapak/Ibu ${data.nama_wali},

Terima kasih telah mendaftarkan putra/putri Anda:

Nama Calon Siswa : ${data.nama_siswa}
Tanggal Lahir    : ${data.tanggal_lahir}
Sekolah Asal     : ${data.sekolah_asal || '-'}

Pendaftaran Anda telah kami terima dan sedang dalam proses verifikasi.

Informasi selanjutnya akan disampaikan melalui email dan WhatsApp ke nomor: ${data.no_hp_wali}

Jadwal seleksi dan pengumuman dapat dilihat di:
https://miterpaduibnusina.sch.id/ppdb

Wassalamu'alaikum Warahmatullahi Wabarakatuh,

Panitia SPMB
MI Terpadu Ibnu Sina
Jl. Raya Bangsri - Keling KM.4, Jepara
Telp: 0853 8310 2007
  `;

  GmailApp.sendEmail(data.email, subject, body, {
    name: 'SPMB MI Terpadu Ibnu Sina',
    replyTo: ADMIN_EMAIL,
  });
}

function notifikasiAdmin(data) {
  const subject = `📋 Pendaftar Baru: ${data.nama_siswa}`;
  const body = `Ada pendaftar baru masuk:\n\n` +
    `Nama: ${data.nama_siswa}\n` +
    `Email: ${data.email}\n` +
    `Wali: ${data.nama_wali} (${data.no_hp_wali})\n` +
    `Alamat: ${data.alamat}\n\n` +
    `Lihat panel admin: https://miterpaduibnusina.sch.id/admin-panel/registrations`;

  GmailApp.sendEmail(ADMIN_EMAIL, subject, body);
}
```

---

**4. Kirim Notifikasi WhatsApp via Fonnte/WA Gateway**

```php
// app/Services/WhatsAppService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    private string $token;
    private string $apiUrl = 'https://api.fonnte.com/send';

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    public function kirim(string $nomor, string $pesan): bool
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post($this->apiUrl, [
            'target'  => $this->formatNomor($nomor),
            'message' => $pesan,
        ]);

        return $response->successful();
    }

    private function formatNomor(string $nomor): string
    {
        $nomor = preg_replace('/[^0-9]/', '', $nomor);
        if (str_starts_with($nomor, '0')) {
            $nomor = '62' . substr($nomor, 1);
        }
        return $nomor;
    }

    public function pesanKonfirmasi(array $data): string
    {
        return "Assalamu'alaikum 🌙\n\n" .
            "*Konfirmasi Pendaftaran SPMB*\n" .
            "*MI Terpadu Ibnu Sina*\n\n" .
            "✅ Pendaftaran atas nama *{$data['nama_siswa']}* telah diterima.\n\n" .
            "📋 No. Pendaftaran: *{$data['no_pendaftaran']}*\n" .
            "👤 Nama Wali: {$data['nama_wali']}\n" .
            "📅 Tanggal Daftar: " . now()->format('d M Y, H:i') . " WIB\n\n" .
            "ℹ️ Informasi selanjutnya akan disampaikan melalui pesan ini.\n\n" .
            "_Panitia SPMB MI Terpadu Ibnu Sina_";
    }
}
```

---

## OPSI 2: Form Kode Biasa (Livewire + Laravel 12)

Gunakan opsi ini untuk kontrol penuh atas data dan tampilan.

### Database Migration

```php
// database/migrations/xxxx_create_pendaftarans_table.php
Schema::create('pendaftarans', function (Blueprint $table) {
    $table->id();
    $table->string('no_pendaftaran')->unique()->nullable();
    $table->string('nama_siswa');
    $table->string('email');
    $table->string('no_telepon', 20);
    $table->date('tanggal_lahir');
    $table->string('jenis_kelamin')->default('L'); // L / P
    $table->string('sekolah_asal')->nullable();
    $table->string('nama_wali');
    $table->string('no_hp_wali', 20);
    $table->text('alamat');
    $table->string('agama')->default('Islam');
    $table->enum('status', ['pending', 'verifikasi', 'diterima', 'ditolak', 'cadangan'])
          ->default('pending');
    $table->integer('gelombang')->default(1);
    $table->string('sumber')->default('form_online'); // form_online / google_forms
    $table->string('bukti_pembayaran')->nullable(); // path file
    $table->boolean('sudah_bayar')->default(false);
    $table->timestamp('tanggal_bayar')->nullable();
    $table->text('catatan_admin')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

---

### Model Pendaftaran

```php
// app/Models/Pendaftaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendaftaran extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'no_pendaftaran', 'nama_siswa', 'email', 'no_telepon',
        'tanggal_lahir', 'jenis_kelamin', 'sekolah_asal',
        'nama_wali', 'no_hp_wali', 'alamat', 'agama',
        'status', 'gelombang', 'sumber', 'bukti_pembayaran',
        'sudah_bayar', 'tanggal_bayar', 'catatan_admin',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_bayar' => 'datetime',
        'sudah_bayar'   => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $tahun  = date('Y');
            $urutan = self::whereYear('created_at', $tahun)->count() + 1;
            $model->no_pendaftaran = 'MI-' . $tahun . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
        });
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'    => '<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>',
            'verifikasi' => '<span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Verifikasi</span>',
            'diterima'   => '<span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Diterima</span>',
            'ditolak'    => '<span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Ditolak</span>',
            'cadangan'   => '<span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">Cadangan</span>',
            default      => $this->status,
        };
    }
}
```

---

### Livewire Component — Form Pendaftaran Multi-Step

```php
// app/Livewire/FormPendaftaran.php
namespace App\Livewire;

use App\Models\Pendaftaran;
use App\Mail\KonfirmasiPendaftaran;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPendaftaran extends Component
{
    use WithFileUploads;

    public int $step = 1;
    public int $totalStep = 3;

    // Step 1 — Data Siswa
    public string $nama_siswa   = '';
    public string $tanggal_lahir = '';
    public string $jenis_kelamin = 'L';
    public string $sekolah_asal  = '';
    public string $agama         = 'Islam';

    // Step 2 — Data Wali
    public string $nama_wali   = '';
    public string $no_hp_wali  = '';
    public string $email       = '';
    public string $no_telepon  = '';
    public string $alamat      = '';

    // Step 3 — Konfirmasi & Bayar
    public $bukti_pembayaran;
    public bool $setuju = false;

    public bool $sukses = false;
    public ?Pendaftaran $hasil = null;

    protected array $rules = [
        // Step 1
        'nama_siswa'     => 'required|string|min:3|max:255',
        'tanggal_lahir'  => 'required|date|before:today',
        'jenis_kelamin'  => 'required|in:L,P',
        'sekolah_asal'   => 'nullable|string|max:255',
        'agama'          => 'required|string|max:50',
        // Step 2
        'nama_wali'      => 'required|string|min:3|max:255',
        'no_hp_wali'     => 'required|string|min:9|max:15',
        'email'          => 'required|email|unique:pendaftarans,email',
        'no_telepon'     => 'required|string|min:9|max:15',
        'alamat'         => 'required|string|min:10',
        // Step 3
        'bukti_pembayaran' => 'nullable|image|max:2048',
        'setuju'           => 'accepted',
    ];

    protected array $messages = [
        'nama_siswa.required'    => 'Nama siswa wajib diisi.',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        'email.unique'           => 'Email ini sudah digunakan untuk mendaftar.',
        'setuju.accepted'        => 'Anda harus menyetujui pernyataan ini.',
    ];

    public function nextStep(): void
    {
        $this->validateStep();
        $this->step++;
    }

    public function prevStep(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    private function validateStep(): void
    {
        $stepRules = match($this->step) {
            1 => ['nama_siswa', 'tanggal_lahir', 'jenis_kelamin', 'agama'],
            2 => ['nama_wali', 'no_hp_wali', 'email', 'no_telepon', 'alamat'],
            3 => ['setuju'],
            default => [],
        };

        $this->validate(array_intersect_key(
            $this->rules,
            array_flip($stepRules)
        ), $this->messages);
    }

    public function submit(): void
    {
        $this->validateStep();

        $path = null;
        if ($this->bukti_pembayaran) {
            $path = $this->bukti_pembayaran->store('bukti-pembayaran', 'public');
        }

        $pendaftaran = Pendaftaran::create([
            'nama_siswa'       => $this->nama_siswa,
            'tanggal_lahir'    => $this->tanggal_lahir,
            'jenis_kelamin'    => $this->jenis_kelamin,
            'sekolah_asal'     => $this->sekolah_asal,
            'agama'            => $this->agama,
            'nama_wali'        => $this->nama_wali,
            'no_hp_wali'       => $this->no_hp_wali,
            'email'            => $this->email,
            'no_telepon'       => $this->no_telepon,
            'alamat'           => $this->alamat,
            'bukti_pembayaran' => $path,
            'sudah_bayar'      => (bool) $path,
        ]);

        // Kirim email konfirmasi
        Mail::to($pendaftaran->email)->send(new KonfirmasiPendaftaran($pendaftaran));

        // Kirim WhatsApp
        app(WhatsAppService::class)->kirim(
            $pendaftaran->no_hp_wali,
            app(WhatsAppService::class)->pesanKonfirmasi($pendaftaran->toArray())
        );

        $this->sukses = true;
        $this->hasil  = $pendaftaran;
    }

    public function render()
    {
        return view('livewire.form-pendaftaran');
    }
}
```

---

### Blade View — Form Multi-Step

```blade
{{-- resources/views/livewire/form-pendaftaran.blade.php --}}
<div>
    @if ($sukses)
        {{-- Sukses --}}
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-green-800 mb-2">Pendaftaran Berhasil!</h3>
            <p class="text-gray-600 mb-4">No. Pendaftaran Anda:</p>
            <div class="text-3xl font-bold text-green-700 bg-green-50 border-2 border-green-200 rounded-2xl py-4 px-8 inline-block mb-6">
                {{ $hasil->no_pendaftaran }}
            </div>
            <p class="text-gray-500 text-sm">Email konfirmasi telah dikirim ke <strong>{{ $hasil->email }}</strong><br>
               dan WhatsApp ke <strong>{{ $hasil->no_hp_wali }}</strong></p>
        </div>
    @else
        {{-- Progress Bar --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                @foreach(['Data Siswa', 'Data Wali', 'Konfirmasi'] as $i => $label)
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm
                            {{ $step > $i + 1 ? 'bg-green-600 text-white' : ($step == $i + 1 ? 'bg-green-700 text-white ring-4 ring-green-200' : 'bg-gray-200 text-gray-500') }}">
                            {{ $step > $i + 1 ? '✓' : $i + 1 }}
                        </div>
                        <span class="mt-1 text-xs {{ $step == $i + 1 ? 'text-green-700 font-semibold' : 'text-gray-400' }}">
                            {{ $label }}
                        </span>
                    </div>
                    @if ($i < 2)
                        <div class="flex-1 h-0.5 {{ $step > $i + 1 ? 'bg-green-600' : 'bg-gray-200' }} mx-2 mb-4"></div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Step 1: Data Siswa --}}
        @if ($step === 1)
        <div>
            <h3 class="font-bold text-lg text-gray-800 mb-4">Data Calon Siswa</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Siswa <span class="text-red-500">*</span></label>
                    <input wire:model.live="nama_siswa" type="text" placeholder="Nama lengkap sesuai akta lahir"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('nama_siswa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input wire:model.live="tanggal_lahir" type="date"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                    @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select wire:model="jenis_kelamin" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                    <select wire:model="agama" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                        <option>Islam</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Asal TK / RA</label>
                    <input wire:model="sekolah_asal" type="text" placeholder="TK / RA asal (opsional)"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button wire:click="nextStep"
                    class="bg-green-700 text-white px-8 py-2.5 rounded-xl hover:bg-green-800 font-semibold transition-colors">
                    Lanjut →
                </button>
            </div>
        </div>
        @endif

        {{-- Step 2: Data Wali --}}
        @if ($step === 2)
        <div>
            <h3 class="font-bold text-lg text-gray-800 mb-4">Data Orang Tua / Wali</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Wali <span class="text-red-500">*</span></label>
                    <input wire:model.live="nama_wali" type="text" placeholder="Nama ayah/ibu/wali"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                    @error('nama_wali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. HP Wali <span class="text-red-500">*</span></label>
                    <input wire:model.live="no_hp_wali" type="tel" placeholder="08xxxxxxxxxx"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                    @error('no_hp_wali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input wire:model.live="email" type="email" placeholder="email@contoh.com"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-red-500">*</span></label>
                    <input wire:model.live="no_telepon" type="tel" placeholder="08xxxxxxxxxx"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                    @error('no_telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea wire:model.live="alamat" rows="3" placeholder="Jalan, RT/RW, Desa, Kecamatan, Kabupaten"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none resize-none"></textarea>
                    @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <button wire:click="prevStep" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                    ← Kembali
                </button>
                <button wire:click="nextStep" class="bg-green-700 text-white px-8 py-2.5 rounded-xl hover:bg-green-800 font-semibold transition-colors">
                    Lanjut →
                </button>
            </div>
        </div>
        @endif

        {{-- Step 3: Konfirmasi & Pembayaran --}}
        @if ($step === 3)
        <div>
            <h3 class="font-bold text-lg text-gray-800 mb-4">Konfirmasi Pendaftaran</h3>

            {{-- Ringkasan --}}
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
                <h4 class="font-semibold text-green-800 mb-3">Ringkasan Data</h4>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <span class="text-gray-500">Nama Siswa</span><span class="font-medium">{{ $nama_siswa }}</span>
                    <span class="text-gray-500">Tanggal Lahir</span><span class="font-medium">{{ $tanggal_lahir }}</span>
                    <span class="text-gray-500">Jenis Kelamin</span><span class="font-medium">{{ $jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    <span class="text-gray-500">Nama Wali</span><span class="font-medium">{{ $nama_wali }}</span>
                    <span class="text-gray-500">Email</span><span class="font-medium">{{ $email }}</span>
                    <span class="text-gray-500">No. HP Wali</span><span class="font-medium">{{ $no_hp_wali }}</span>
                </div>
            </div>

            {{-- Upload Bukti Bayar --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Pembayaran (Opsional)</label>
                <input wire:model="bukti_pembayaran" type="file" accept="image/*"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm">
                <p class="text-xs text-gray-400 mt-1">Format JPG/PNG, maks 2MB. Bisa dikumpulkan saat daftar ulang.</p>
                @error('bukti_pembayaran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Persetujuan --}}
            <label class="flex items-start gap-3 cursor-pointer mb-6">
                <input wire:model="setuju" type="checkbox" class="mt-0.5 w-4 h-4 text-green-600 rounded">
                <span class="text-sm text-gray-600">
                    Saya menyatakan bahwa data yang saya isi adalah <strong>benar dan dapat dipertanggungjawabkan</strong>.
                    Saya menyetujui syarat dan ketentuan pendaftaran MI Terpadu Ibnu Sina.
                </span>
            </label>
            @error('setuju') <p class="text-red-500 text-xs -mt-4 mb-4">{{ $message }}</p> @enderror

            <div class="flex justify-between">
                <button wire:click="prevStep" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                    ← Kembali
                </button>
                <button wire:click="submit" wire:loading.attr="disabled"
                    class="bg-green-700 text-white px-8 py-2.5 rounded-xl hover:bg-green-800 font-semibold transition-colors disabled:opacity-50">
                    <span wire:loading.remove>✅ Kirim Pendaftaran</span>
                    <span wire:loading>Mengirim...</span>
                </button>
            </div>
        </div>
        @endif
    @endif
</div>
```

---

### Mailable — Email Konfirmasi (Gmail SMTP)

```php
// app/Mail/KonfirmasiPendaftaran.php
namespace App\Mail;

use App\Models\Pendaftaran;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KonfirmasiPendaftaran extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Pendaftaran $pendaftaran) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Konfirmasi Pendaftaran SPMB MI Terpadu Ibnu Sina — ' . $this->pendaftaran->nama_siswa,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.konfirmasi-pendaftaran',
        );
    }
}
```

```blade
{{-- resources/views/emails/konfirmasi-pendaftaran.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f0faf5; margin: 0; padding: 20px; }
        .card { background: white; border-radius: 16px; max-width: 560px; margin: 0 auto; padding: 36px; }
        .header { background: #166534; color: white; border-radius: 12px; padding: 24px; text-align: center; margin-bottom: 24px; }
        .badge { background: #dcfce7; color: #166534; padding: 8px 20px; border-radius: 999px; font-size: 22px; font-weight: bold; display: inline-block; margin: 12px 0; }
        .row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; }
        .label { color: #6b7280; font-size: 14px; }
        .value { font-weight: 600; font-size: 14px; }
        .footer { text-align: center; color: #9ca3af; font-size: 12px; margin-top: 24px; }
    </style>
</head>
<body>
<div class="card">
    <div class="header">
        <h2 style="margin:0;font-size:20px;">MI Terpadu Ibnu Sina</h2>
        <p style="margin:4px 0 0;opacity:.8;font-size:13px;">Sistem Penerimaan Murid Baru {{ date('Y') }}/{{ date('Y')+1 }}</p>
    </div>

    <p style="color:#374151;">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
    <p style="color:#374151;">Yth. Bapak/Ibu <strong>{{ $pendaftaran->nama_wali }}</strong>,</p>
    <p style="color:#6b7280;">Pendaftaran putra/putri Anda telah <strong style="color:#166534;">berhasil diterima</strong>. Berikut detail pendaftaran:</p>

    <div class="badge">{{ $pendaftaran->no_pendaftaran }}</div>

    <div>
        <div class="row"><span class="label">Nama Siswa</span><span class="value">{{ $pendaftaran->nama_siswa }}</span></div>
        <div class="row"><span class="label">Tanggal Lahir</span><span class="value">{{ $pendaftaran->tanggal_lahir->format('d M Y') }}</span></div>
        <div class="row"><span class="label">Jenis Kelamin</span><span class="value">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
        <div class="row"><span class="label">Tanggal Daftar</span><span class="value">{{ $pendaftaran->created_at->format('d M Y, H:i') }} WIB</span></div>
    </div>

    <div style="background:#fefce8;border:1px solid #fde047;border-radius:12px;padding:16px;margin:20px 0;">
        <p style="margin:0;color:#713f12;font-size:14px;">⚠️ <strong>Langkah Selanjutnya:</strong> Simpan nomor pendaftaran Anda. Informasi seleksi dan jadwal daftar ulang akan disampaikan melalui email dan WhatsApp ke nomor <strong>{{ $pendaftaran->no_hp_wali }}</strong>.</p>
    </div>

    <p style="color:#6b7280;font-size:13px;">Informasi lebih lanjut: <a href="https://miterpaduibnusina.sch.id/ppdb" style="color:#166534;">miterpaduibnusina.sch.id/ppdb</a></p>
    <div class="footer">MI Terpadu Ibnu Sina — Jl. Raya Bangsri KM.4, Jepara • (123) 4567-8901</div>
</div>
</body>
</html>
```

---

### Konfigurasi .env — Gmail SMTP & WhatsApp

```env
# Gmail SMTP
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=emailsekolah@gmail.com
MAIL_PASSWORD=xxxx_xxxx_xxxx_xxxx   # App Password Gmail (bukan password utama)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=emailsekolah@gmail.com
MAIL_FROM_NAME="SPMB MI Terpadu Ibnu Sina"

# WhatsApp via Fonnte
FONNTE_TOKEN=token_dari_fonnte_anda

# Webhook secret (Opsi Google Forms)
SPMB_WEBHOOK_SECRET=buat_random_string_panjang_di_sini
```

---

### Perbaikan Admin Panel

**1. Tambah kolom status dan filter:**

```php
// app/Livewire/Admin/DaftarPendaftaran.php
namespace App\Livewire\Admin;

use App\Models\Pendaftaran;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPendaftaran extends Component
{
    use WithPagination;

    public string $search  = '';
    public string $status  = '';
    public string $sortBy  = 'created_at';
    public string $sortDir = 'desc';

    public ?int $selectedId = null;

    protected $queryString = ['search', 'status'];

    public function updatingSearch(): void { $this->resetPage(); }

    public function updateStatus(int $id, string $status): void
    {
        Pendaftaran::findOrFail($id)->update(['status' => $status]);
        $this->dispatch('statusUpdated');
    }

    public function render()
    {
        $pendaftarans = Pendaftaran::query()
            ->when($this->search, fn($q) => $q
                ->where('nama_siswa', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('no_pendaftaran', 'like', "%{$this->search}%")
            )
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(15);

        return view('livewire.admin.daftar-pendaftaran', compact('pendaftarans'));
    }
}
```

**2. Fix modal background hitam:**

```blade
{{-- Tambahkan ini pada layout admin --}}
<div
    x-data="{ open: false, data: {} }"
    @open-modal.window="open = true; data = $event.detail"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    x-show="open"
    x-cloak>
    ...
</div>
```

Masalah background hitam terjadi karena Livewire modal tidak punya `min-height` atau Alpine `x-cloak` tidak di-load. Tambahkan `x-cloak` style di `<head>`:

```html
<style>[x-cloak] { display: none !important; }</style>
```

---

## Ringkasan Perbaikan Prioritas

| # | Masalah | Solusi | Prioritas |
|---|---------|--------|-----------|
| 1 | Data dummy (siswa9) | Hapus seeder, gunakan data real | TINGGI |
| 2 | Modal background hitam | Tambah x-cloak CSS + min-height | TINGGI |
| 3 | Tidak ada kolom status | Tambah enum status ke migration | TINGGI |
| 4 | Tidak ada filter admin | Livewire search + filter status | SEDANG |
| 5 | Form tidak multi-step | Implementasi FormPendaftaran.php | SEDANG |
| 6 | Tidak ada export | Tambah Maatwebsite/Excel + DomPDF | SEDANG |
| 7 | Tidak ada WhatsApp | Integrasi Fonnte/WA Gateway | RENDAH |
| 8 | Tidak ada kuota otomatis | Tambah field kuota ke tabel pengaturan | RENDAH |

---

*Dokumen ini dibuat untuk MI Terpadu Ibnu Sina — Panduan SPMB TALL Stack*
*Laravel 12 + Livewire 3 + Alpine.js 3 + Tailwind CSS + MySQL*