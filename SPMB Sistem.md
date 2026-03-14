# 📋 CHECKLIST DATA INPUT APLIKASI SEKOLAH

Panduan lengkap untuk mengisi semua data yang diperlukan aplikasi. Sumber data berasal dari seeder dan kebutuhan halaman home.

---

# ✓ HALAMAN HOME (WELCOME)

Bagian-bagian yang harus ditampilkan di halaman utama sekolah.

## 1️⃣ HERO SECTION
Header/Banner utama halaman home.

- [ ] **Gambar Hero/Banner** - Foto utama sekolah (ukuran: 1920x600px)
- [ ] **Judul Utama** - Nama sekolah atau tagline
- [ ] **Sub-judul** - Deskripsi singkat sekolah
- [ ] **CTA Button** - Tombol ajakan (contoh: "Pelajari Lebih Lanjut")

---

## 2️⃣ BERITA TERBARU (NEWS)
Menampilkan 3-4 berita terbaru di halaman home.

### Berita 1
- [ ] **Title** - Judul berita (contoh: "Pembukaan Tahun Ajaran 2024/2025")
- [ ] **Slug** - URL friendly (auto-generate dari title)
- [ ] **Excerpt** - Ringkasan singkat berita (1-2 kalimat)
- [ ] **Featured Image** - Foto berita (400x300px)
- [ ] **Content** - Konten lengkap berita (HTML/Rich Text)
- [ ] **Status** - `published`
- [ ] **Published Date** - Tanggal publikasi (format: YYYY-MM-DD)

### Berita 2
- [ ] Title
- [ ] Excerpt
- [ ] Featured Image
- [ ] Content
- [ ] Status
- [ ] Published Date

### Berita 3
- [ ] Title
- [ ] Excerpt
- [ ] Featured Image
- [ ] Content
- [ ] Status
- [ ] Published Date

### Berita 4
- [ ] Title
- [ ] Excerpt
- [ ] Featured Image
- [ ] Content
- [ ] Status
- [ ] Published Date

### Berita 5 - 6 (Opsional)
- [ ] Title, Excerpt, Featured Image, Content, Status, Published Date

---

## 3️⃣ AGENDA/KALENDER KEGIATAN (EVENTS)
Menampilkan 3-4 agenda mendatang di halaman home.

### Agenda 1
- [ ] **Title** - Nama kegiatan
- [ ] **Slug** - URL friendly
- [ ] **Description** - Deskripsi kegiatan
- [ ] **Event Date** - Tanggal event (format: YYYY-MM-DD)
- [ ] **Event Time** - Jam mulai (format: HH:MM:SS)
- [ ] **Location** - Tempat kegiatan
- [ ] **Status** - `upcoming`

### Agenda 2
- [ ] Title, Description, Event Date, Event Time, Location, Status

### Agenda 3
- [ ] Title, Description, Event Date, Event Time, Location, Status

### Agenda 4
- [ ] Title, Description, Event Date, Event Time, Location, Status

---

## 4️⃣ GALERI SEKOLAH (GALLERY)
Menampilkan galeri foto kegiatan sekolah (carousel atau grid).

### Galeri 1
- [ ] **Title** - Nama kegiatan/foto
- [ ] **Slug** - URL friendly
- [ ] **Description** - Deskripsi singkat
- [ ] **Category** - Kategori galeri (lihat daftar di bawah)
- [ ] **Image** - Foto/gambar (400x300px)

### Galeri 2 - 8
- [ ] Title, Description, Category, Image (minimal 8 item)

**Kategori yang tersedia:**
- Acara Sekolah
- Program Pembelajaran
- Olahraga
- Seni
- Ekstrakurikuler
- Keagamaan

---

## 5️⃣ FASILITAS SEKOLAH (FACILITIES)
Menampilkan 6-7 fasilitas unggulan sekolah.

### Fasilitas 1
- [ ] **Name** - Nama fasilitas (contoh: "Perpustakaan")
- [ ] **Slug** - URL friendly
- [ ] **Description** - Deskripsi lengkap fasilitas
- [ ] **Icon** - Icon FontAwesome (contoh: "fas fa-book-open")
- [ ] **Kondisi** - Status (`tersedia` / `perbaikan`)

### Fasilitas 2 - 7
- [ ] Name, Description, Icon, Kondisi (minimal 6-7 item)

---

## 6️⃣ SAMBUTAN KEPALA SEKOLAH
Menampilkan ucapan/bentuk kepala sekolah.

- [ ] **Nama Kepala Sekolah** - Nama lengkap
- [ ] **Foto Kepala Sekolah** - Portrait (300x350px)
- [ ] **Sambutan/Teks** - Kutipan motivasi/sambutan
- [ ] **Jabatan** - "Kepala Madrasah"

---

## 7️⃣ INFORMASI SEKOLAH (ABOUT)
Data lengkap tentang sekolah.

### Profil Sekolah
- [ ] **Nama Sekolah** - Nama lengkap
- [ ] **NPSN** - Nomor Pokok Sekolah Nasional
- [ ] **Naungan** - Kementerian/Dinas
- [ ] **Jenjang** - MI/SD/SMP/SMA
- [ ] **Status** - Negeri/Swasta
- [ ] **Tanggal Berdiri** - Format: DD Bulan Tahun
- [ ] **SK Pendirian** - Nomor SK
- [ ] **Alamat Lengkap** - Alamat jalan

### Visi & Misi
- [ ] **Visi** - Pernyataan visi sekolah
- [ ] **Misi 1-3** - 2-3 pernyataan misi sekolah

### Kontak Sekolah
- [ ] **Nomor Telepon** - Format: +62-xxxx-xxxx
- [ ] **Email** - Email sekolah
- [ ] **Jam Operasional** - Jam buka/tutup

---

## 8️⃣ DATA GURU/STAFF (TEACHERS)
Profil guru-guru sekolah.

### Guru 1
- [ ] **Name** - Nama lengkap guru
- [ ] **Slug** - URL friendly
- [ ] **Email** - Email guru
- [ ] **Position** - Jabatan/Mata Pelajaran
- [ ] **Education** - Pendidikan terakhir
- [ ] **Bio** - Biografi singkat
- [ ] **Photo** - Foto profile (250x300px)
- [ ] **Phone** - Nomor telepon (opsional)

### Guru 2 - 3
- [ ] Name, Position, Education, Bio, Photo (minimal 3 guru)

---

## 9️⃣ PRESTASI SEKOLAH (ACHIEVEMENTS)
Prestasi dan penghargaan sekolah.

### Prestasi 1
- [ ] **Title** - Judul prestasi (contoh: "Juara 1 Kompetisi Sains")
- [ ] **Slug** - URL friendly
- [ ] **Description** - Deskripsi prestasi
- [ ] **Category** - Kategori (Akademik/Olahraga/Seni)
- [ ] **Year** - Tahun prestasi (format: YYYY)
- [ ] **Award** - Jenis penghargaan (Juara 1/2/3/Medali)
- [ ] **Achievement Level** - Tingkat (Kelas/Sekolah/Kabupaten/Nasional/Internasional)
- [ ] **Image** - Foto/bukti prestasi (400x300px)

### Prestasi 2 - 3
- [ ] Title, Description, Category, Year, Award, Achievement Level, Image (minimal 3 item)

---

# 📌 FORMAT & CATATAN PENTING

## Format Data yang Digunakan:

**Tanggal:** `YYYY-MM-DD` (contoh: 2026-03-11)
**Jam:** `HH:MM:SS` (contoh: 07:00:00 untuk pukul 7 pagi)

### Status Berita:
- `published` - Sudah dipublikasikan (tampil di halaman)
- `draft` - Masih konsep (hanya admin yang lihat)

### Status Agenda:
- `upcoming` - Akan datang
- `ongoing` - Sedang berlangsung
- `completed` - Sudah selesai

### Kondisi Fasilitas:
- `tersedia` - Fasilitas tersedia dan dalam kondisi baik
- `perbaikan` - Sedang dalam proses perbaikan
- `tidak tersedia` - Tidak tersedia/rusak berat

### Kategori Galeri:
- Acara Sekolah
- Program Pembelajaran
- Olahraga
- Seni
- Ekstrakurikuler
- Keagamaan

### Kategori Prestasi:
- Akademik
- Olahraga
- Seni
- Lainnya

### Tingkat Prestasi:
- Kelas - Kompetisi tingkat kelas
- Sekolah - Kompetisi tingkat sekolah
- Kabupaten - Tingkat kabupaten/kota
- Nasional - Tingkat nasional
- Internasional - Tingkat internasional

---

## Icon FontAwesome untuk Fasilitas:

Gunakan icon dari FontAwesome 5. Contoh:
- `fas fa-book-open` - Perpustakaan
- `fas fa-desktop` - Laboratorium Komputer
- `fas fa-running` - Lapangan Olahraga
- `fas fa-utensils` - Kantin
- `fas fa-first-aid` - Ruang UKS
- `fas fa-chalkboard` - Aula/Ruang Kelas
- `fas fa-microscope` - Laboratorium Sains

---

## Ukuran Gambar Rekomendasi:

| Jenis | Ukuran | Rasio |
|-------|--------|-------|
| Hero Banner | 1920x600px | 16:5 |
| Foto Berita | 400x300px | 4:3 |
| Foto Galeri | 400x300px | 4:3 |
| Foto Guru | 250x300px | 5:6 |
| Foto Prestasi | 400x300px | 4:3 |
| Foto Kepala Sekolah | 300x350px | 6:7 |
| Logo Sekolah | 300x300px | 1:1 |

---

# 🎯 CHECKLIST RINGKAS

## ✓ DATA DARI SEEDER (Sudah Ada):

| No | Item | Qty | Seeder | Status |
|----|------|-----|--------|--------|
| 1 | Berita | 6 | NewsSeeder | ✓ |
| 2 | Agenda | 4 | AgendaSeeder | ✓ |
| 3 | Galeri | 8 | GallerySeeder | ⚠️ (tanpa foto) |
| 4 | Fasilitas | 7 | FacilitySeeder | ✓ |
| 5 | Guru | 3 | TeacherSeeder | ⚠️ (tanpa foto) |
| 6 | Info Sekolah | - | AboutSeeder | ✓ |
| 7 | Prestasi | 3 | PrestasiSeeder | ⚠️ (tanpa foto) |

## ❌ GAMBAR YANG PERLU DISIAPKAN:

| No | Jenis | Ukuran | Qty | Checkbox |
|----|-------|--------|-----|----------|
| 1 | Hero Banner | 1920x600 | 1 | [ ] |
| 2 | Foto Kepala Sekolah | 300x350 | 1 | [ ] |
| 3 | Foto Berita | 400x300 | 6 | [ ] |
| 4 | Foto Galeri | 400x300 | 8 | [ ] |
| 5 | Foto Guru | 250x300 | 3 | [ ] |
| 6 | Foto Prestasi | 400x300 | 3 | [ ] |

**Total Gambar: 22 file**

---

# 📍 INSTRUKSI STEP-BY-STEP

## Step 1: Siapkan Gambar
- [ ] Kumpulkan semua foto sesuai ukuran
- [ ] Format: JPG atau PNG
- [ ] Kompres jika ukuran > 500KB

## Step 2: Update Data Seeder (Opsional)
- [ ] Tambah featured_image di NewsSeeder
- [ ] Tambah image di GallerySeeder
- [ ] Tambah photo di TeacherSeeder
- [ ] Tambah image di PrestasiSeeder

## Step 3: Input Data ke Admin Panel
1. **Berita** - Input 6 berita dengan foto
2. **Agenda** - Input 4 agenda (tanpa foto)
3. **Galeri** - Input 8 item galeri dengan foto
4. **Fasilitas** - Sudah ada, verifikasi saja
5. **Guru** - Input 3 guru dengan foto
6. **Prestasi** - Input 3 prestasi dengan foto
7. **Tentang** - Update info sekolah jika perlu

## Step 4: Verifikasi Halaman Home
- [ ] Hero section muncul dengan baik
- [ ] Berita terbaru ditampilkan
- [ ] Agenda/kalender muncul
- [ ] Galeri responsive
- [ ] Fasilitas tertampil
- [ ] Sambutan kepala sekolah muncul
- [ ] Kontak sekolah terlihat

## Step 5: Go Live
- [ ] Semua data sudah lengkap
- [ ] Semua gambar sudah upload
- [ ] Halaman home sudah ditest
- [ ] Mobile view sudah dicheck

---

# 📚 REFERENSI SEEDER

File seeder yang perlu diketahui:
- `database/seeders/NewsSeeder.php` - Berita
- `database/seeders/AgendaSeeder.php` - Agenda/Event
- `database/seeders/GallerySeeder.php` - Galeri
- `database/seeders/FacilitySeeder.php` - Fasilitas
- `database/seeders/TeacherSeeder.php` - Data Guru
- `database/seeders/AboutSeeder.php` - Info Sekolah
- `database/seeders/PrestasiSeeder.php` - Prestasi
- `database/seeders/UserSeeder.php` - User Admin

---

**✅ SIAP MULAI? Gunakan checklist ini untuk tracking progress!** 🚀
