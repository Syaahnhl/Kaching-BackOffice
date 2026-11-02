# BackOffice Developer Onboarding & Local Setup Guide

Selamat datang di tim pengembang **Kaching Web BackOffice**! Panduan ini dirancang agar developer baru dapat langsung melakukan clone, setup environment, menjalankan local testbench, mengembangkan fitur baru, dan menjalankan automated tests secara mandiri **tanpa ketergantungan pada database production atau mesin milik developer lain**.

---

## 1. Prerequisites (Kebutuhan Sistem)

Pastikan lingkungan lokal Anda memenuhi spesifikasi berikut:
- **PHP:** Versi 8.2 atau lebih tinggi (mendukung PHP 8.2, 8.3, dan 8.4)
- **Composer:** Versi 2.5 atau lebih tinggi
- **Git:** Versi 2.30 atau lebih tinggi
- **Browser:** Google Chrome / Firefox / Safari modern
- **IDE:** VS Code / PhpStorm (disarankan ekstensi Laravel Blade & Tailwind CSS)
- **Node.js & NPM:** Opsional (saat ini CSS Tailwind dan Alpine.js di-load via CDN pada master layout untuk kemudahan preview lokal tanpa build step berat)

Verifikasi instalasi di terminal Anda:
```bash
php -v
composer --version
git --version
```

---

## 2. Quickstart: 3 Menit Menjalankan BackOffice Lokal

Kaching-BackOffice adalah **modular web package** yang dilengkapi dengan **Orchestra Testbench**. Anda tidak perlu menginstall Core Server lengkap hanya untuk mengembangkan UI Web!

### Langkah 1: Clone Repository
```bash
git clone https://github.com/Syaahnhl/Kaching-BackOffice.git
cd Kaching-BackOffice
```

### Langkah 2: Install Dependencies
```bash
composer install
```

### Langkah 3: Jalankan Automated Test Suite
Pastikan 100% test lulus di lingkungan lokal Anda:
```bash
./vendor/bin/phpunit
```
*(Hasil yang diharapkan: `OK (18 tests, 69 assertions)`)*

### Langkah 4: Jalankan Local UI Preview Server
Jalankan live preview menggunakan Testbench serve bawaan:
```bash
./vendor/bin/testbench serve
```
Buka browser Anda di:
- **Dashboard:** `http://localhost:8000/backoffice/dashboard`
- **Menu & Katalog:** `http://localhost:8000/backoffice/menus`
- **Inventaris & Bahan:** `http://localhost:8000/backoffice/inventory`
- **Reservasi Meja:** `http://localhost:8000/backoffice/reservations`
- **Pengadaan & Supplier:** `http://localhost:8000/backoffice/procurement`
- **Karyawan & Hak Akses:** `http://localhost:8000/backoffice/staff`
- **Riwayat Shift Kasir:** `http://localhost:8000/backoffice/shifts`

Data yang tampil di halaman preview berasal dari **Synthetic Fixtures** (`tests/Fixtures/` dan `database/seeders/SyntheticDataFixtures.php`), sehingga 100% aman, cepat, dan terisolasi dari database production!

---

## 3. Struktur Direktori & Arsitektur Paket

Paket ini menganut prinsip **Clean Architecture & Domain Separation**:

```
kaching-backoffice/
├── config/
│   └── backoffice.php                # Konfigurasi route_prefix, middleware, dan tema
├── database/seeders/
│   └── SyntheticDataFixtures.php     # Data sintetis untuk seeding preview lokal
├── docs/                             # Dokumentasi arsitektur, kontrak, dan keamanan
├── resources/views/backoffice/       # Blade Views per domain bisnis
│   ├── master.blade.php              # Shell Layout bersama (Sidebar, Navbar, Header)
│   ├── dashboard.blade.php           # Domain: Dashboard & Metrik
│   ├── menus.blade.php               # Domain: Katalog Menu & Harga
│   ├── inventory.blade.php           # Domain: Stok & Bahan Baku
│   ├── reservations.blade.php        # Domain: Reservasi & Meja
│   ├── procurement.blade.php         # Domain: Pengadaan & Supplier
│   ├── staff.blade.php               # Domain: Karyawan & Hak Akses
│   └── shifts.blade.php              # Domain: Rekap Shift & Kasir
├── src/
│   ├── BackOfficeServiceProvider.php # Registrasi paket ke Laravel
│   ├── Contracts/                    # 10 Explicit Interface dengan Core Server
│   ├── DTO/                          # Data Transfer Objects murni (framework-agnostic)
│   ├── Http/Controllers/             # Controller per domain
│   └── Http/Middleware/              # Middleware hak akses BackOffice
└── tests/                            # Unit & Feature Test Suite
    ├── Feature/                      # Pengujian rendering view & otorisasi
    ├── Fixtures/                     # Mock service untuk pengujian lokal
    └── Unit/                         # Pengujian serialisasi DTO
```

---

## 4. Alur Kerja Kolaborasi (Git & PR Workflow)

Untuk mencegah benturan kode saat dikerjakan oleh 10-20 developer secara paralel:

1. **Sinkronisasi Branch:**
   Selalu buat feature branch baru dari branch `master`:
   ```bash
   git checkout master
   git pull origin master
   git checkout -b feat/web-<nama-fitur>-<inisial-dev>
   # Contoh: git checkout -b feat/web-inventory-filter-budi
   ```

2. **Aturan Kepemilikan File (File Ownership Rules):**
   - Kerjakan perubahan Anda **HANYA** pada controller, view, dan test yang menjadi domain tugas Anda.
   - **DILARANG MENGUBAH** file `master.blade.php` tanpa koordinasi dengan Lead UI/Reviewer.
   - **DILARANG MENGUBAH** file interface di `src/Contracts/` secara sepihak. Perubahan kontrak harus disepakati bersama pemilik Core Server.

3. **Verifikasi Mandiri Sebelum Buat PR:**
   Sebelum commit dan push, pastikan langkah-langkah ini lulus:
   ```bash
   # 1. Jalankan test suite
   ./vendor/bin/phpunit

   # 2. Periksa celah keamanan dependensi
   composer audit

   # 3. Validasi git status (pastikan tidak ada file sampah)
   git status
   ```

4. **Kirim Pull Request:**
   - Buat PR yang menargetkan branch `master`.
   - Gunakan format template PR yang disediakan.
   - Minimal 1 persetujuan (approval) dari code owner domain terkait diperlukan sebelum merge.
