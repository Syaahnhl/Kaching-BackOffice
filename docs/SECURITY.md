# Kaching Back Office Security Policy & Boundaries

## Scope & Access Restrictions
External developers collaborating on `kaching/backoffice` operate under strict isolation boundaries:
1. **Zero Access to Core Codebase**: External developers must only be granted access to the private repository `Syaahnhl/Kaching-BackOffice`. They must NEVER receive read, write, or fork permissions to `kaching-server` or `Kaching-Workspace/android`.
2. **Denylist Enforcement**:
   - Never commit `.env`, `.env.*`, API keys, private keys (`.key`, `.pem`, `.jks`), or database dumps.
   - Core transactional logic (POS offline sync, payment gateways, FIFO stock mutation) is completely excluded from this repository.
   - Proprietary AI logic (Copilot prompt chains, CatBoost demand forecasting, Financial Investigation) is strictly barred.
3. **Synthetic Data Only**: All automated tests, local fixtures, and previews MUST utilize `SyntheticDataFixtures` or factory mocks. Never paste or import real customer names, phone numbers, or live transaction histories.
4. **Mandatory CI & Review Gate**: Every Pull Request must pass automated PHP linting, security audits (`composer audit`), and unit/feature test suites prior to human review and merge.
