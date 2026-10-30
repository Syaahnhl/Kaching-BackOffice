@extends('backoffice::master')

@section('title', 'Pengadaan & Supplier - Kaching Back Office')
@section('page_title', 'Pengadaan & Supplier')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-semibold text-slate-900">Daftar Supplier Bahan</h2>
            <p class="text-xs text-slate-500">Kelola kontak vendor dan pembuatan pesanan restock otomatis via WhatsApp.</p>
        </div>
        <button class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition">
            + Tambah Supplier
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($suppliers as $supplier)
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between">
                    <span class="text-sm font-bold text-slate-900">{{ $supplier['name'] }}</span>
                    <span class="text-xs px-2 py-0.5 bg-blue-50 text-blue-700 rounded font-medium">{{ $supplier['items_count'] }} Item Pasokan</span>
                </div>
                <p class="mt-2 text-xs text-slate-500">Kontak: <span class="font-medium text-slate-700">{{ $supplier['phone'] }}</span></p>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-100 flex gap-2">
                <button class="w-full py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg transition">
                    Draft Pesan WA
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
