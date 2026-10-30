# Kaching Back Office Presentation & Administration Module

Modular, independently developable Laravel package for Kaching Back Office.

## Overview
This package encapsulates the administration UI, dashboard presentation, catalog management, inventory viewports, and staff administration interfaces of Kaching POS.

## Key Principles
1. **Zero Core Business Leakage**: Core POS transactional engines, offline sync algorithms, payment gateway keys, and AI Copilot services remain strictly private inside the main Kaching host repository.
2. **Contract-Based Integration**: All interactions between this package and Kaching services occur through explicit interfaces (`Kaching\BackOffice\Contracts`).
3. **Mock Host Feasibility**: External developers can build, preview, and test UI components using in-memory mock services and synthetic data fixtures without needing access to production infrastructure or secrets.
