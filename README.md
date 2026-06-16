# Panduan Sistem E-Konseling (Versi Verifikasi TA)

Sistem CRUD sederhana berbasis MVC untuk kebutuhan verifikasi Tugas Akhir, dibangun menggunakan Laravel 10. Sistem ini mendemonstrasikan proses autentikasi manual, relasi antar tabel (ERD), serta operasi Create, Read, Update, dan Delete (CRUD) murni tanpa *tools generator* tambahan.

##  Urutan Langkah Pengerjaan (Step-by-Step)

Berikut adalah alur pembuatan aplikasi dari awal hingga akhir:

### 1. Persiapan Database (.env)
- Buat database baru di MySQL (misal: `db_konseling`).
- Buka file `.env` dan atur koneksi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

### 2. Membuat Tabel (Migrations)
Jalankan perintah `php artisan make:migration` untuk membuat struktur tabel:
1. `..._alter_users_table_add_role.php` -> Menambah kolom `role` (konsuli/konselor) di tabel `users`.
2. `..._create_appointments_table.php` -> Membuat tabel `appointments` dengan *foreign key* `konsuli_id` dan `konselor_id`, serta kolom `tanggal_temu`, `keluhan`, dan `status`.
- Eksekusi dengan: `php artisan migrate`.

### 3. Konfigurasi Model
Buat model menggunakan `php artisan make:model Appointment`.
1. **`app/Models/User.php`**: Tambahkan `role` ke dalam `$fillable`.
2. **`app/Models/Appointment.php`**: Tambahkan kolom ke `$fillable` dan buat relasi `belongsTo` untuk `konsuli` dan `konselor`.

### 4. Membuat Logika Bisnis (Controllers)
Buat controller menggunakan perintah `php artisan make:controller`.
1. **`AuthController.php`**: Menangani proses *login* manual dan *logout*. User diarahkan ke dashboard masing-masing berdasarkan `role`.
2. **`AppointmentController.php`**: Menangani operasi CRUD:
   - Menampilkan daftar dosen dan riwayat (Read).
   - Menyimpan pengajuan janji temu (Create).
   - Dosen mengubah status terima/tolak (Update).
   - Mahasiswa membatalkan janji temu (Delete).

### 5. Mengatur Jalur Aplikasi (Routes)
Buka file **`routes/web.php`**:
- Buat *route* `GET` dan `POST` untuk proses Login.
- Buat *route group* dengan *middleware* `auth` untuk memproteksi halaman Dashboard, Form Booking, Update Status, dan Delete Booking agar hanya bisa diakses setelah *login*.

### 6. Desain Tampilan (Views & CSS)
Buat file *interface* di dalam folder **`resources/views/`**:
1. **`login.blade.php`**: Form login dengan `@csrf`.
2. **`konsuli/dashboard.blade.php`**: Halaman mahasiswa untuk melihat daftar konselor dan riwayat janji temu.
3. **`konsuli/booking.blade.php`**: Form input keluhan dan tanggal.
4. **`konselor/dashboard.blade.php`**: Halaman dosen untuk melihat tabel pengajuan masuk dan tombol aksi (Terima/Tolak).
- *Styling*: Tambahkan file CSS di **`public/css/style.css`** lalu *link* ke setiap file Blade agar tampilan tabel dan form terstruktur rapi.

### 7. Pengisian Data Awal (Seeder)
Buka file **`database/seeders/DatabaseSeeder.php`**:
- Buat dua akun statis (1 akun *role* konsuli, 1 akun *role* konselor) menggunakan `User::create(...)`.
- Jalankan `php artisan db:seed` untuk memasukkan akun ke database.

---

## 🚀 Cara Menjalankan Aplikasi
1. Buka terminal di direktori project.
2. Jalankan perintah: `php artisan serve`.
3. Buka *browser* dan akses: `http://127.0.0.1:8000`.

**Akses Akun Demo:**
- **Konsuli (Mahasiswa):** `mhs@test.com` | Password: `password`
- **Konselor (Dosen):** `dosen@test.com` | Password: `password`