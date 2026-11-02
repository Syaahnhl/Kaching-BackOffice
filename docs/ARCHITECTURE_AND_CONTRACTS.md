# Panduan Arsitektur & Kontrak Integrasi Kaching Enterprise

Dokumen ini menjelaskan batas tanggung jawab (bounded context), aliran data, dan kontrak integrasi resmi antara **Core Server**, **Android POS**, **Web BackOffice**, dan **Intelligence AI**.

---

## 1. Topologi Arsitektur & Prinsip Komunikasi

Ekosistem Kaching mengadopsi model **Contract-First Modular Monolith**:
- **Core Server (`serverkaching`):** Satu-satunya pemegang Authoritative Transactional Source of Truth (SSOT). Mengelola database transaksi, status keuangan, stok bahan baku, isolasi tenant multi-outlet, dan approval hak akses.
- **Web BackOffice (`Kaching-BackOffice`):** Web presentation layer yang beroperasi sebagai package mandiri. Hanya berkomunikasi dengan Core melalui interface adapter resmi (`app/Adapters/BackOffice/*`).
- **Intelligence (`Kaching-Intelligence`):** Stateless reasoning engine (Copilot, analytics, demand forecasting). Berperan murni sebagai *Action Proposer*, tidak pernah melakukan mutasi langsung ke database transaksi Core.
- **Android POS (`Kaching`):** Offline-first mobile client yang menyinkronkan data secara periodik ke Core Server via endpoint REST API terenkripsi.

---

## 2. Matriks Kepemilikan Data & Otoritas Transaksi (SSOT)

| Entitas Bisnis | Pemilik Resmi (Authoritative SSOT) | Aturan Akses BackOffice & Klien |
|:---|:---:|:---|
| **User & Tenant Identity** | Core Server (`users`, `outlets`) | Read-Only via DTO & session guard. |
| **Staff & PIN Credentials** | Core Server (`staff`, `shifts`) | Validasi PIN 6-digit mutlak di Core; PIN tidak pernah diekspos ke klien. |
| **Transaksi & Faktur** | Core Server (`transactions`, `payments`) | BackOffice hanya menampilkan data agregat melalui `ReportingServiceInterface`. |
| **Stok & Mutasi Bahan Baku** | Core Server (`items`, `stock_movements`) | Perubahan stok cepat via `InventoryServiceInterface::quickStockAdjustment()`. |
| **Katalog Menu & Harga** | Core Server (`menus`, `modifiers`) | Toggle ketersediaan via `MenuServiceInterface::toggleAvailable()`. |
| **Reservasi Meja** | Core Server (`reservations`, `tables`) | Dikelola via `ReservationServiceInterface`. |
| **Pengadaan (Procurement)** | Core Server (`procurements`, `suppliers`) | Dikelola via `ProcurementServiceInterface`. |

---

## 3. Daftar Kontrak Resmi BackOffice (10 Interface)

Seluruh developer Web BackOffice berinteraksi dengan Core Server **HANYA** melalui 10 Interface berikut di namespace `Kaching\BackOffice\Contracts\`:

1. `AuthenticatableUserInterface`: Mengambil data user yang sedang login (ID, Nama, Email, Peran).
2. `BackOfficeAuthorizationInterface`: Memeriksa izin akses per modul (`hasPermission($user, $permission)`).
3. `CurrentOutletResolverInterface`: Mengambil ID dan data outlet yang sedang aktif pada sesi browser.
4. `ReportingServiceInterface`: Mengambil metrik ringkasan dashboard (Gross Sales, Net Sales, Total Orders, Average Basket).
5. `MenuServiceInterface`: Mengambil daftar menu, update stok cepat, dan toggle status ketersediaan menu.
6. `InventoryServiceInterface`: Mengambil daftar bahan baku, status low-stock, dan satuan UOM.
7. `ReservationServiceInterface`: Mengambil daftar reservasi meja aktif dan status kedatangan tamu.
8. `ProcurementServiceInterface`: Mengambil riwayat pengadaan bahan baku dari supplier.
9. `StaffServiceInterface`: Mengambil daftar staf outlet dan status shift aktif.
10. `ShiftServiceInterface`: Mengambil riwayat shift kasir dan rekonsiliasi kas modal awal.

---

## 4. Kebijakan Breaking Change & Versioning

1. **Aturan Backward Compatibility:** Penambahan field baru pada DTO diperbolehkan jika bersifat opsional (nullable).
2. **Prosedur Modifikasi Kontrak:** Jika ada kebutuhan penambahan method baru pada Interface:
   - Buat draft proposal perubahan DTO / Interface.
   - Diskusikan bersama pemilik Core Server (`@lead-architect`).
   - Implementasikan adapter di Core Server terlebih dahulu sebelum menaikkan versi dependensi di BackOffice.
