# Kaching Back Office Architecture Specification

## 1. Architectural Philosophy & Isolation Invariants
`kaching/backoffice` is an isolated presentation, reporting, and management package designed for Kaching POS. It adheres to the **Zero Core Business Leakage** principle:
- **No Direct Eloquent / DB Access**: The package never accesses core models or runs raw queries against Kaching's host databases.
- **Contract-Based Boundary**: All data retrieval and actions must be routed through explicit interfaces defined in `Kaching\BackOffice\Contracts`.
- **Fail-Closed Authorization**: All routes, actions, and UI widgets are guarded by default. If a capability or permission is unspecified, access is denied.

## 2. Component Boundaries
```
+-------------------------------------------------------+
|              Kaching Back Office Package               |
|                                                       |
|  +--------------------+      +---------------------+  |
|  |   Blade Views      |      |     Controllers     |  |
|  +--------------------+      +---------------------+  |
|            |                            |             |
|            v                            v             |
|  +--------------------+      +---------------------+  |
|  |     ViewModels     |      |        DTOs         |  |
|  +--------------------+      +---------------------+  |
|            |                            |             |
+------------|----------------------------|-------------+
             |                            |
      (Contracts Boundary - Interfaces Only)
             |                            |
+------------v----------------------------v-------------+
|             Kaching Host Application (Core)            |
|                                                       |
|  - Real Database & Eloquent Models                    |
|  - POS Transaction & Offline BulkSync Engine           |
|  - AI Copilot, CatBoost Forecasting & Risk Radar      |
|  - Payment Gateways & Secret Keys                     |
+-------------------------------------------------------+
```
