# Kaching BackOffice — Presentation & Administration Workspace

Modular, independently developable Laravel package for Kaching BackOffice administration portal.

[![Test Suite](https://img.shields.io/badge/PHPUnit-18%20Passed-brightgreen)](tests/)
[![Security](https://img.shields.io/badge/Security-Fail--Closed-blue)](docs/SECURITY.md)
[![Contracts](https://img.shields.io/badge/Contracts-10%20Bound-purple)](docs/CONTRACTS.md)

---

## 1. Overview
Repository ini dirancang khusus untuk pengembangan **UI, Dashboard, Catalog, Inventory, Reservasi, Staff, dan Shift Viewports** Kaching BackOffice secara independen tanpa perlu mengakses backend Core Server, mobile Android, atau kredensial produksi.

## 2. Core Architectural Principles
1. **Zero Core Business Leakage:** Engine transaksi, algoritma offline sync, SQLCipher key provider, dan model AI tetap terisolasi di Core Server host.
2. **Strict Contract-Driven Integration:** Semua interaksi antara UI BackOffice dan Core berjalan via 10 interface kanonikal (`Kaching\BackOffice\Contracts\*`).
3. **Mock Host Feasibility:** Developer kedua dapat meng-clone repo ini, menjalankan suite pengujian, dan mengembangkan Blade/Tailwind UI menggunakan in-memory mock service dan synthetic fixtures.

---

## 3. Quick Start Guide (Developer Onboarding)

### Prasyarat
- PHP >= 8.2
- Composer 2.x
- Git

### Langkah Instalasi
```bash
# 1. Clone repository
git clone git@github.com:Syaahnhl/Kaching-BackOffice.git
cd Kaching-BackOffice

# 2. Install dependencies
composer install

# 3. Setup environment lokal
cp .env.example .env

# 4. Jalankan automated test suite
./vendor/bin/phpunit
```

### Menjalankan Local UI Preview
Untuk melihat rendering UI secara visual dengan data sintetis:
```bash
php preview.php
```
Buka browser di `http://localhost:8000` untuk mengecek layout responsive (Mobile, Tablet, Desktop) pada seluruh modul BackOffice.

---

## 4. Struktur Package & Modul
- `src/Contracts/`: 10 Service Interfaces kanonikal (Menu, Inventory, Reporting, Reservation, Staff, Shift, Procurement, Auth, Resolver).
- `src/DTO/`: Data Transfer Objects yang mengamankan isolasi data (StaffMemberDTO mengecualikan PIN/gaji).
- `src/Http/Controllers/`: Controller presentasi UI BackOffice.
- `resources/views/backoffice/`: Blade templates neobrutalisme / modern Tailwind.
- `database/seeders/SyntheticDataFixtures.php`: Fixture data dummy/sintetis untuk preview lokal.
- `docs/`: Dokumentasi arsitektur (`ARCHITECTURE.md`), spesifikasi kontrak (`CONTRACTS.md`), panduan setup (`SETUP_GUIDE.md`), keamanan (`SECURITY.md`), dan batasan (`KNOWN_LIMITATIONS.md`).

---

## 5. Dokumentasi Terkait
- [Arsitektur & Pemisahan Domain](docs/ARCHITECTURE.md)
- [Spesifikasi Kontrak & DTO](docs/CONTRACTS.md)
- [Panduan Keamanan & Isolasi Tenant](docs/SECURITY.md)
- [Known Limitations & Batasan](docs/KNOWN_LIMITATIONS.md)
