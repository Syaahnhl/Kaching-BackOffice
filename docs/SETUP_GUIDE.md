# Developer Setup & Local Testbench Guide

## Prerequisites
- PHP 8.2 or higher
- Composer 2.x
- Git

## Getting Started
1. Clone the private repository:
   ```bash
   git clone git@github.com:Syaahnhl/Kaching-BackOffice.git
   cd Kaching-BackOffice
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Run the automated test suite:
   ```bash
   ./vendor/bin/phpunit
   ```
4. Run security audit:
   ```bash
   composer audit
   ```

## Running Local UI Preview with Orchestra Workbench
This package integrates with Orchestra Workbench to provide an in-memory preview of the Back Office UI:
```bash
./vendor/bin/testbench serve
```
Visit `http://localhost:8000/backoffice/dashboard` or `http://localhost:8000/backoffice/menus` to inspect the UI rendered with synthetic data fixtures.

## Pull Request Workflow
1. Create a feature branch from `main`: `git checkout -b feature/ui-improvement`
2. Implement your changes adhering strictly to the contract interfaces.
3. Ensure all tests pass: `./vendor/bin/phpunit`
4. Submit a Pull Request targeting `main`. Do not push directly to `main`.
