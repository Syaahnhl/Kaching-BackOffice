# Known Limitations & Boundaries

## Scope & Architectural Boundaries
1. **Presentation & BackOffice Administration Only**:
   - Package ini secara sengaja TIDAK memuat logic transaksi kasir (POS Core), kalkulator offline sync, token enkripsi database SQLite/SQLCipher Android, integrasi payment gateway MIDTRANS/QRIS, maupun model AI Copilot.
   - Seluruh logika mutasi finansial dan sinkronisasi hardware printer dilayani oleh Core Server via Controller internalnya.

2. **Isolated Testbench Execution**:
   - Saat dijalankan secara standalone melalui testbench (`tests/TestCase.php`), data diinjeksi via `SyntheticDataFixtures` dan mock in-memory service (`tests/Fixtures/*`).
   - Fitur stateful seperti mutasi shift atau live stock opname di mode standalone tidak mengubah database MySQL Core, melainkan menguji kepatuhan kontrak DTO dan view rendering.

3. **Read-Only / Delegation Modifiers**:
   - Stock update cepat (`updateQuickStock`) mendelegasikan ke `StockService::stockOpname` di Core.
   - Status approval reservasi mendelegasikan ke `ApproveReservationToKdsAction` di Core.
   - Gaji staff, PIN staff, dan password sengaja dieksklusikan dari `StaffMemberDTO` demi kepatuhan keamanan multi-tenant.

4. **Multi-Outlet Switching**:
   - Pergantian outlet aktif bergantung pada resolusi `CurrentOutletResolverInterface`. Pada mode standalone, resolver disimulasikan via `MockOutletResolver`.
