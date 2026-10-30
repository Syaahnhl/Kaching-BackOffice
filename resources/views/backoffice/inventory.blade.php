@extends('backoffice::master')

@section('title', 'Inventaris & Bahan Baku - Kaching Back Office')
@section('page_title', 'Inventaris & Bahan Baku')

@section('content')
<div class="space-y-6">
    <!-- Header Summary & Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Item Bahan</span>
            <div class="mt-2 flex items-baseline justify-between">
                <span class="text-2xl font-bold text-slate-900">{{ count($items) }}</span>
                <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded font-medium">Tersedia</span>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Peringatan Stok Rendah</span>
            <div class="mt-2 flex items-baseline justify-between">
                <span class="text-2xl font-bold text-amber-600">{{ count($lowStock) }}</span>
                <span class="text-xs bg-amber-50 text-amber-700 px-2 py-0.5 rounded font-medium">Perlu Restock</span>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Metode Perhitungan</span>
            <div class="mt-2 flex items-baseline justify-between">
                <span class="text-lg font-bold text-slate-800">Core FIFO Ledger</span>
                <span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded font-medium">Protected SSOT</span>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="relative w-full md:w-96">
            <input type="text" placeholder="Cari bahan baku atau item..." value="{{ $search ?? '' }}"
                   class="w-full pl-3 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="flex items-center gap-2 w-full md:w-auto">
            <button class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition">
                + Tambah Item Bahan
            </button>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Nama Bahan Baku</th>
                        <th class="py-3.5 px-4">Stok Saat Ini</th>
                        <th class="py-3.5 px-4">Satuan (UOM)</th>
                        <th class="py-3.5 px-4">Batas Minimum</th>
                        <th class="py-3.5 px-4">Harga Beli Rata-rata</th>
                        <th class="py-3.5 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($items as $item)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4 font-medium text-slate-900">{{ $item->name }}</td>
                        <td class="py-3.5 px-4 font-semibold {{ $item->currentStock <= $item->minimumStock ? 'text-amber-600' : 'text-slate-800' }}">
                            {{ number_format($item->currentStock, 2) }}
                        </td>
                        <td class="py-3.5 px-4"><span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-xs">{{ $item->baseUom }}</span></td>
                        <td class="py-3.5 px-4">{{ number_format($item->minimumStock, 2) }}</td>
                        <td class="py-3.5 px-4">Rp {{ number_format($item->costPrice, 0, ',', '.') }}</td>
                        <td class="py-3.5 px-4">
                            @if($item->currentStock <= $item->minimumStock)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Menipis</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data inventaris.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
