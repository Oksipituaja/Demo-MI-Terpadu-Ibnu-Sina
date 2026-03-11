# 📄 CHECKLIST HALAMAN HOME (WELCOME)

Bagian-bagian yang harus ditampilkan di halaman utama sekolah berdasarkan struktur yang ada.

---

## 1️⃣ HERO SECTION
Header/Banner utama halaman home.

### Data yang Diperlukan:
- [ ] **Gambar Hero/Banner** - Foto utama sekolah (ukuran landscape, min 1920x600px)
- [ ] **Judul Utama** - Nama sekolah atau tagline (contoh: "MIS Terpadu Ibnu Sina")
- [ ] **Sub-judul** - Deskripsi singkat sekolah
- [ ] **CTA Button** - Tombol ajakan (contoh: "Pelajari Lebih Lanjut", "Hubungi Kami")
- [ ] **Logo Sekolah** - Logo untuk header/navigation (opsional)

**Status Seeder:** Belum ada di seeder ❌
**Sumber Data:** Dari halaman About atau custom

---

## 2️⃣ SECTION BERITA TERBARU
Menampilkan 3-4 berita terbaru.

### Data yang Diperlukan:
- [ ] **Berita 1-4** - Judul, excerpt, tanggal publikasi (ambil dari NewsSeeder)
- [ ] **Gambar Berita** - Foto untuk setiap berita (akan ditambah saat input berita)
- [ ] **Link "Lihat Semua Berita"** - Tombol menuju halaman berita lengkap

**Status Seeder:** ✓ Sudah lengkap di NewsSeeder
**Alternatif:** Bisa menggunakan featured image atau placeholder

---

## 3️⃣ SECTION AGENDA/KALENDER KEGIATAN
Menampilkan 3-4 agenda mendatang.

### Data yang Diperlukan:
- [ ] **Agenda 1-4** - Judul, tanggal, jam, lokasi (ambil dari AgendaSeeder dengan status `upcoming`)
- [ ] **Icon/Badge** - Badge warna atau icon untuk setiap agenda
- [ ] **Link "Lihat Semua Agenda"** - Tombol menuju halaman kalender/agenda

**Status Seeder:** ✓ Sudah lengkap di AgendaSeeder
**Status Tampilan:** Perlu ditampilkan di home

---

## 4️⃣ SECTION GALERI
Menampilkan galeri foto kegiatan sekolah (carousel atau grid).

### Data yang Diperlukan:
- [ ] **Foto Galeri 1-8** - Foto untuk setiap galeri item (dari GallerySeeder)
- [ ] **Judul Galeri** - Nama kegiatan/foto
- [ ] **Link "Lihat Galeri Lengkap"** - Tombol menuju halaman galeri

**Status Seeder:** ✓ Sudah ada di GallerySeeder (tapi image masih null)
**PENTING:** Kumpulkan foto-foto untuk setiap item galeri

---

## 5️⃣ SECTION FASILITAS
Menampilkan 6-7 fasilitas unggulan sekolah.

### Data yang Diperlukan:
- [ ] **Fasilitas 1-7** - Nama, deskripsi, icon (dari FacilitySeeder)
- [ ] **Icon FontAwesome** - Icon yang sudah disediakan di seeder
- [ ] **Link "Lihat Semua Fasilitas"** - Tombol menuju halaman fasilitas

**Status Seeder:** ✓ Sudah lengkap di FacilitySeeder
**Status Tampilan:** Perlu ditampilkan di home

---

## 6️⃣ SECTION TESTIMONI/SAMBUTAN KEPALA SEKOLAH
Menampilkan ucapan kepala sekolah.

### Data yang Diperlukan:
- [ ] **Nama Kepala Sekolah** - Dari AboutSeeder
- [ ] **Foto Kepala Sekolah** - Portrait photo (ukuran: 300x350px)
- [ ] **Sambutan/Teks** - Kutipan singkat dari sambutan lengkap
- [ ] **Jabatan** - "Kepala Madrasah" atau "Principal"

**Status Seeder:** ✓ Sudah ada di AboutSeeder
**PENTING:** Upload foto kepala sekolah

---

## 7️⃣ SECTION STATISTIK/FACTS
Menampilkan angka-angka penting sekolah (opsional).

### Data yang Diperlukan:
- [ ] **Jumlah Siswa** - Total siswa aktif
- [ ] **Jumlah Guru** - Total guru/staff
- [ ] **Tahun Berdiri** - Sejak kapan sekolah didirikan
- [ ] **Prestasi** - Jumlah total prestasi

**Status:** Bisa diambil dari database atau diinput manual
**Catatan:** Data ini bisa dicek dari halaman admin atau database

---

## 8️⃣ SECTION TENTANG KAMI
Informasi ringkas tentang sekolah.

### Data yang Diperlukan:
- [ ] **Nama Sekolah** - Dari AboutSeeder
- [ ] **NPSN** - Dari AboutSeeder
- [ ] **Deskripsi Singkat** - Dari AboutSeeder (profil sekolah)
- [ ] **Alamat** - Dari AboutSeeder
- [ ] **Visi & Misi** - Dari AboutSeeder

**Status Seeder:** ✓ Sudah lengkap di AboutSeeder
**Status Tampilan:** Perlu ditampilkan ringkas di home

---

## 9️⃣ SECTION GURU/STAFF (OPSIONAL)
Menampilkan foto/profil guru unggulan.

### Data yang Diperlukan:
- [ ] **Foto Guru 1-3** - Guru unggulan/berprestasi
- [ ] **Nama Guru** - Dari TeacherSeeder
- [ ] **Jabatan/Mata Pelajaran** - Dari TeacherSeeder
- [ ] **Bio Singkat** - Dari TeacherSeeder

**Status Seeder:** ✓ Sudah ada di TeacherSeeder
**PENTING:** Upload foto guru-guru
**Catatan:** Bisa skip jika halaman home sudah cukup panjang

---

## 🔟 SECTION KONTAK/CTA
Call-to-action untuk hubungi sekolah.

### Data yang Diperlukan:
- [ ] **Nomor Telepon** - Dari konfigurasi sekolah
- [ ] **Email Sekolah** - Dari konfigurasi sekolah
- [ ] **Alamat Lengkap** - Dari AboutSeeder
- [ ] **Google Maps Embed** - Lokasi sekolah (opsional)
- [ ] **Jam Operasional** - Jam buka/tutup (dari konfigurasi)

**Status:** Perlu ditambahkan ke config atau About
**Catatan:** Google Maps bisa ditambah kemudian

---

## 📝 RINGKASAN DATA YANG PERLU DISIAPKAN

### ✓ SUDAH ADA DI SEEDER (Tinggal Ditampilkan):
1. **News** - 6 berita ✓
2. **Agenda** - 4 event ✓
3. **Gallery** - 8 item (tanpa foto) ⚠️
4. **Facility** - 7 fasilitas ✓
5. **Teacher** - 3 guru (tanpa foto) ⚠️
6. **About/Sekolah Info** - Data lengkap ✓
7. **Prestasi** - 3 prestasi (tanpa foto) ⚠️

### ❌ PERLU DITAMBAHKAN:
1. **Foto/Gambar:**
   - [ ] Hero Banner (landscape 1920x600px)
   - [ ] Foto kepala sekolah (portrait 300x350px)
   - [ ] Foto untuk 8 item galeri
   - [ ] Foto untuk 3 guru (portrait 250x300px)
   - [ ] Foto untuk 3 prestasi (landscape 400x300px)

2. **Konfigurasi Sekolah:**
   - [ ] Nomor telepon sekolah
   - [ ] Email sekolah
   - [ ] Jam operasional
   - [ ] Google Maps Embed (opsional)

3. **Konten Tambahan:**
   - [ ] Tagline/Slogan sekolah
   - [ ] Deskripsi singkat untuk setiap section

---

## 🎯 CHECKLIST GAMBAR YANG HARUS DISIAPKAN

| No | Jenis | Ukuran Rekomendasi | Jumlah | Status |
|----|-------|-------------------|--------|--------|
| 1 | Hero Banner | 1920x600px | 1 | [ ] |
| 2 | Foto Kepala Sekolah | 300x350px | 1 | [ ] |
| 3 | Foto Galeri | 400x300px | 8 | [ ] |
| 4 | Foto Guru | 250x300px | 3 | [ ] |
| 5 | Foto Prestasi | 400x300px | 3 | [ ] |
| 6 | Logo Sekolah (opsional) | 300x300px | 1 | [ ] |

---

## 📌 INSTRUKSI NEXT STEP

1. **Siapkan semua gambar** sesuai ukuran yang disarankan
2. **Input berita** dengan featured image
3. **Input galeri** dengan foto untuk setiap item
4. **Input guru** dengan foto profile
5. **Input prestasi** dengan foto/bukti
6. **Setup konfigurasi** nomor telp dan email
7. **Update halaman home** untuk menampilkan semua section

---

**Catatan:** Home page akan menampilkan data dari berbagai seeder secara terintegrasi. Pastikan semua data sudah complete sebelum go live! 🚀
