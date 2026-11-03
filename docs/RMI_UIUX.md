# Raw Material Intelligence UI workspace

This change adds a read-only, permission-gated RMI presentation page to the BackOffice package. Existing views, sidebar, header, contracts, financial logic, models and fixtures are unchanged. `BackOfficeServiceProvider` has eight additive lines for the new route/controller import and a dedicated asset publishing group.

## Local preview

After the package's normal `composer install` (including dev dependencies), run from the repo root:

```powershell
php -S 127.0.0.1:8791 scripts/preview-rmi.php
```

Open `http://127.0.0.1:8791/backoffice/raw-material-intelligence`.

The preview uses the existing Testbench mock host and grants the RMI permission only in that loopback-only development entry point. It accepts GET/HEAD requests, serves only allowlisted RMI assets and does not read production credentials. Do not use the fixture host as a production entry point.

## Host integration

1. Register the package and bind its existing authorization contracts as usual.
2. Explicitly grant `view-raw-material-intelligence` to the intended actor through the host's `BackOfficeAuthorizationInterface`. It is denied by default. Existing permissions are not expanded.
3. Publish only the new page's assets:

```bash
php artisan vendor:publish --tag=kaching-backoffice-rmi-assets
```

The destination is `public/vendor/backoffice/rmi`. The source is `resources/rmi`. The existing global asset publishing groups are unchanged.

The GET route is named `backoffice.raw-material-intelligence` at `{backoffice.route_prefix}/raw-material-intelligence` (default `/backoffice/raw-material-intelligence`). It uses the existing permission middleware. No sidebar entry is added because the global navigation is deliberately preserved. Link to the route from host-owned navigation when that is in scope.

The page extends `backoffice::master`. Since the existing layout has no asset stacks, page-specific stylesheet/script tags are rendered in the content section. CSS is scoped to `#rmi-app`; the font declaration applies only there. Google Fonts, Tailwind and existing host dependencies still require the host's usual network/CSP settings.

This route does **not** replace the production host's `/copilot/raw-material-intelligence` route. Before using this UI in that host, map its actual data and actions explicitly. No existing Core endpoint or financial controller was copied from the separate Copilot reference repo.

## Data and behavior

- Ringkasan, Simulasi and Pasar form one workspace, with Data & Sumber and calculation detail dialogs.
- Prices are editable manual inputs. Recipes, mappings and selling prices are synthetic examples. Archived stories are labeled and do not claim current RSS data.
- The simulator changes one ingredient price at a time. Other recipe costs, quantities and selling prices remain fixed. Unit conversions support kg/g and liter/ml.
- Incomplete `otherCost` yields partial ingredient cost; total recipe cost and margin stay unavailable. An unknown selling price suppresses margin. Explicit zero cost differs from missing cost.
- Margin uses ingredient recipe cost only. Labour, overhead and operating costs are excluded, so this is not full production HPP or net business margin.
- Kachi builds a local scenario summary for copying. There is no live AI request or generated live answer.
- There is no Core data access, transactional mutation, DB query, API key or tenant dataset in this new page.

## Verification

```bash
vendor/bin/phpunit
node --test tests/ui/rmi-simulator.test.cjs
```

Integration tests cover namespaced rendering, explicit permission denial/grant, actual asset publication, unchanged sidebar/header controls, no RMI assets on existing pages, and absence of Core adapter calls. The page introduces no POST/PUT route.

The RMI component is responsive at 390 px. The existing package shell still keeps a 256 px sidebar at that viewport, leaving only 134 px for content; the full host page remains constrained on mobile. That inherited shell limitation is documented rather than changing global navigation outside this feature's scope. Desktop host integration and the standalone responsive RMI component are verified separately.
