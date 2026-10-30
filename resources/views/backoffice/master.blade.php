<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kaching Back Office')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col">
            <div class="p-4 border-b border-slate-800 flex items-center justify-between">
                <span class="text-xl font-bold tracking-tight text-white">KACHING</span>
                <span class="text-xs bg-blue-600 px-2 py-0.5 rounded text-white font-medium">BETA</span>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('backoffice.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-slate-800 transition">
                    Dashboard
                </a>
                <a href="{{ route('backoffice.menus') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-slate-800 transition">
                    Menu & Katalog
                </a>
                <a href="{{ route('backoffice.inventory') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-slate-800 transition">
                    Inventaris & Bahan
                </a>
                <a href="{{ route('backoffice.reservations') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-slate-800 transition">
                    Reservasi Meja
                </a>
                <a href="{{ route('backoffice.procurement') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-slate-800 transition">
                    Pengadaan & Supplier
                </a>
                <a href="{{ route('backoffice.staff') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-slate-800 transition">
                    Karyawan & Hak Akses
                </a>
                <a href="{{ route('backoffice.shifts') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-slate-800 transition">
                    Riwayat Shift Kasir
                </a>
            </nav>
            <div class="p-4 border-t border-slate-800 text-xs text-slate-400">
                <p>Kaching Modular UI</p>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white border-b border-slate-200 p-4 flex items-center justify-between">
                <h1 class="text-lg font-semibold">@yield('page_title', 'Overview')</h1>
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-slate-600">Mock Host Session</span>
                </div>
            </header>
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
