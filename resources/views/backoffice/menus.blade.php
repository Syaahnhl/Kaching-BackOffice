@extends('backoffice::master')

@section('title', 'Katalog Menu - Kaching Back Office')
@section('page_title', 'Manajemen Menu & Stok')

@section('content')
<div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
    <div class="p-4 border-b border-slate-200 flex justify-between items-center">
        <h2 class="font-semibold text-slate-800">Daftar Menu Tersedia</h2>
        <span class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded">Outlet Aktif</span>
    </div>
    <table class="w-full text-left text-sm text-slate-600">
        <thead class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-semibold text-slate-500">
            <tr>
                <th class="px-6 py-3">Nama Menu</th>
                <th class="px-6 py-3">Kategori</th>
                <th class="px-6 py-3">Harga</th>
                <th class="px-6 py-3">Stok</th>
                <th class="px-6 py-3">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($menus as $menu)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-900">{{ $menu->name }}</td>
                <td class="px-6 py-4">{{ $menu->category }}</td>
                <td class="px-6 py-4">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4">{{ $menu->stock }}</td>
                <td class="px-6 py-4">
                    @if($menu->isAvailable)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Tersedia</span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800">Habis</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada menu di katalog outlet ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
