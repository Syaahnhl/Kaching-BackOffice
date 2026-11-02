# Panduan Kontribusi Pengembang Kaching-BackOffice

Terima kasih telah berkontribusi pada pengembangan **Kaching Web BackOffice**! Panduan ini mengatur standar kode, alur review, dan etika kolaborasi tim agar pengembangan paralel dapat berjalan lancar.

---

## 1. Aturan Penamaan Branch

Format branch: `<type>/web-<domain>-<deskripsi-singkat>`

Jenis branch (`<type>`):
- `feat/`: Fitur baru (misal: `feat/web-inventory-batch-filter`)
- `fix/`: Perbaikan bug tampilan atau logika controller (misal: `fix/web-staff-role-badge`)
- `refactor/`: Peningkatan struktur kode tanpa merubah fungsionalitas (misal: `refactor/web-menu-card-component`)
- `test/`: Penambahan skenario automated test (misal: `test/web-reservation-empty-state`)

---

## 2. Aturan Standar Kode (Coding Standards)

1. **PSR-12 Compliance:** Seluruh kode PHP wajib mengikuti standar PSR-12. Gunakan indentasi 4 spasi (bukan tab).
2. **Explicit Type Hinting:** Gunakan type hint pada seluruh parameter method dan return type:
   ```php
   public function index(Request $request): View
   {
       // ...
   }
   ```
3. **DTO Immutability:** Data yang dikirim antar-layer wajib dibungkus dalam DTO (Data Transfer Object) murni dengan visibility `public readonly`.
4. **Zero Direct Eloquent Coupling:** Kode di dalam paket ini **DILARANG** mengimpor model Eloquent Core (seperti `App\Models\Transaction`). Seluruh interaksi wajib melalui `src/Contracts/*ServiceInterface.php`.
5. **Clean Blade Views:** Hindari logika PHP rumit di dalam Blade template. Gunakan conditional sederhana (`@if`, `@foreach`) dan komponen Alpine.js untuk interaktivitas client-side.

---

## 3. Komitmen & Conventional Commits

Gunakan standar Conventional Commits:
- `feat(inventory): add low stock alert pill on table view`
- `fix(menus): resolve broken toggle-available POST endpoint parameter`
- `test(shifts): add test scenario for modal cash reconciliation`
- `docs(onboarding): clarify testbench serve command execution`

---

## 4. Checklist Sebelum Mengirim Pull Request (PR)

- [ ] Seluruh unit & feature tests lulus 100% (`./vendor/bin/phpunit`).
- [ ] Tidak ada warning celah keamanan (`composer audit`).
- [ ] Tidak ada perubahan file di luar domain tugas yang diberikan.
- [ ] Tidak ada credential, secret, API key, atau token yang tertinggal.
- [ ] Tampilan halaman telah diuji via browser di `./vendor/bin/testbench serve`.
- [ ] Kode baru disertai pengujian unit/feature yang relevan.
