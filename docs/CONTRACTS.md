# Kaching Back Office Interface Contracts

## Overview
All business communication between the Back Office package and the Kaching host application happens via these contracts:

### 1. AuthenticatableUserInterface
- `getId(): int`
- `getName(): string`
- `getEmail(): string`
- `getRole(): string` (`owner`, `manager`, `staff`)
- `isSuperadmin(): bool`
- `getAvatarUrl(): ?string`

### 2. CurrentOutletResolverInterface
- `getCurrentOutletId(): ?int`
- `getAccessibleOutlets(): array`
- `switchOutlet(int $outletId): bool`

### 3. BackOfficeAuthorizationInterface
- `canAccess(string $permission): bool`
- `assertAuthorized(string $permission): void` (Throws 403 on deny)

### 4. MenuServiceInterface
- `getMenusForCurrentOutlet(?string $category = null): array`
- `findMenuById(int $id): ?MenuDTO`
- `toggleAvailability(int $id): bool`
- `updateQuickStock(int $id, float $quantity): bool`

### 5. ReportingServiceInterface
- `getDashboardMetrics(string $startDate, string $endDate, ?int $outletId = null): DashboardMetricsDTO`
- `getSalesChartData(string $period = 'daily', ?int $outletId = null): array`

### 6. InventoryServiceInterface
- `getInventoryItems(?string $search = null, int $perPage = 25): array`
- `findItemById(int $id): ?InventoryItemDTO`
- `getLowStockAlerts(): array`

### 7. ShiftServiceInterface
- `getShiftHistory(?int $outletId = null, int $perPage = 15): array`
- `getShiftDetail(int $shiftId): ?array`
