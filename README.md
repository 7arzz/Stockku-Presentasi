# Stockku - Premium Point of Sale (POS)

Stockku adalah aplikasi Point of Sale (POS) premium berbasis *web* yang dibangun menggunakan ekosistem Laravel modern. Antarmukanya menggunakan desain *Glassmorphism* interaktif, memberikan impresi yang sangat modern dan premium bagi pengguna (kasir maupun admin).

---

## 🚀 Fitur Utama

- **Premium UI/UX:** Tema gelap (*Dark Mode*) dengan elemen tembus pandang bergaya *Glassmorphism*. Dilengkapi lencana dinamis (Badge) dan animasi efek *hover* yang lembut.
- **Kalkulator Kasir Real-Time (Interactive POS):** Layar kasir diperlengkapi dengan penghitungan subtotal dan kembalian secara *real-time* via JavaScript tanpa perlu melakukan *refresh* halaman. Sistem ini juga dilengkapi dengan validasi otomatis yang mencegah uang bayar kurang dari total item.
- **Multi-Role Authentication & Authorization:** Sistem *login* aman yang secara ketat merute pengguna ke fungsi spesifik mereka berdasarkan peranan (*Role*).
- **Manajemen Inventaris:** Laporan detail, tambah, perbarui, dan hapus stok produk interaktif.
- **Riwayat Transaksi:** Pencatatan otomatis mendetail untuk setiap transaksi yang terjadi di sistem kasir, memberikan wawasan yang cepat terkait sirkulasi penjualan.

---

## 👥 Manajemen Hak Akses (Role Base Access Control)

Aplikasi ini dibagi menjadi 4 peranan sistem (*Role*) spesifik yang memiliki fungsi dan akses dasbor masing-masing setelah mereka **Log In**:

| Peranan (Role) | Akses Fitur Utama | Batasan Khusus |
|---|---|---|
| **`admin`** | Akses Penuh Sistem (CRUD Produk, Kasir, Laporan Transaksi) | Tidak Ada |
| **`kasir`** | **Mulai Kasir** (Transaksi Pelanggan Cepat) | Tidak bisa mengolah/melihat data selain antarmuka POS |
| **`gudang`** | **Update Stok Produk** | Hanya dapat mengedit ketersediaan stok produk dan nama produk (Tanpa bisa hapus & tambah produk baru) |
| **`owner`** | **Laporan Stok** & **Laporan Penjualan** | Semua akses bersifat *Read-Only* (Hanya bisa membaca informasi) |

Karyawan dengan hak akses tertentu hanya dapat beroperasi di *dashboard* khusus mereka yang diatur secara otomatis oleh sistem `RoleMiddleware`.

---

## 🛠️ Instalasi & Panduan Migrasi (Customer Guide)

Berikut adalah panduan lengkap cara melakukan *setup* aplikasi Stockku pada komputer server atau *localhost*.

### 1. Persiapan Kebutuhan Server
Pastikan sistem operasi Anda (Windows/Linux/Mac) sudah terinstal perangkat lunak berikut:
- **PHP** (Minimal versi 8.2)
- **Composer**
- **Database MySQL / MariaDB / SQLite** (Disesuaikan dengan preferensi Anda di lingkungan Laravel)
- **Node.js & NPM** (Hanya opsional jika ingin melakukan build ulang aset frontend)

### 2. Konfigurasi Lingkungan (Environment)
1. Buka teks editor Anda pada folder proyek.
2. Gantilah nama file `.env.example` menjadi `.env`.
3. Buka file `.env` dan atur konfigurasi database Anda sesuai dengan server database yang dijalankan (misalnya MySQL). Khusus jika belum dikonfigurasi, gunakan format SQLite (opsi instan default Laravel 11/12):
```env
DB_CONNECTION=sqlite
# Atau jika menggunakan MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=stockku
# DB_USERNAME=root
# DB_PASSWORD=
```
4. Instalasi dependensi Composer:
```bash
composer install
```
5. Bangkitkan alias *Application Key*:
```bash
php artisan key:generate
```

### 3. Panduan Penting (Database Migration)
Untuk membangun struktur tabel (termasuk tabel **Users** dengan Role sistem, **Products**, **Transactions**, dll) secara otomatis, jalankan perintah migrasi berikut pada Terminal/Command Prompt Anda:

```bash
php artisan migrate
```

> **Catatan:** Jangan melewati tahapan ini. Database wajib di-migrasi untuk menyiapkan arsitektur *Role* Kasir/Admin di tabel `users`.

### 4. Menjalankan Server Aplikasi
Setelah migrasi berhasil tanpa kendala (*DONE*), jalankan server Laravel bawaan:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui browser dengan alamat lokal: **`http://localhost:8000`** atau **`http://127.0.0.1:8000`**.

---

## 🧑‍💻 Memulai Pertama Kali

1. Buka aplikasi di lokal (`http://localhost:8000`).
2. Tampilan *Welcome Screen* akan mengarahkan Anda ke tombol navigasi **Login / Mulai Masuk**.
3. Klik **Daftar Sekarang**.
4. Daftarkan akun utama Anda dengan peranan/Role sebagai **Admin** untuk mengambil hak akses penuh terhadap aplikasi terlebih dahulu.
5. Selanjutnya, gunakan akun Admin tersebut atau persilahkan karyawan mendaftarkan akun masing-masing dengan *role* yang ditentukan (`Kasir`, `Gudang`, atau `Owner`).
6. Tambahkan Produk dasar sebelum memulai Transaksi via Dasbor Admin -> **Kelola Produk**.

Selamat menggunakan Stockku! Berbisnis menjadi lebih terstruktur, aman, dan mempesona.
