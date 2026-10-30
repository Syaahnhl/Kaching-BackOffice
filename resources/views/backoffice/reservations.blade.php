@extends('backoffice::master')

@section('title', 'Reservasi Meja - Kaching Back Office')
@section('page_title', 'Reservasi Meja')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="text-sm font-medium text-slate-700">Tanggal Reservasi:</span>
            <input type="date" value="{{ $date ?? date('Y-m-d') }}"
                   class="px-3 py-1.5 border border-slate-200 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition">
            + Tambah Reservasi
        </button>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Nama Pelanggan</th>
                        <th class="py-3.5 px-4">Kontak</th>
                        <th class="py-3.5 px-4">Pax</th>
                        <th class="py-3.5 px-4">Meja</th>
                        <th class="py-3.5 px-4">Waktu</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reservations as $res)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4 font-medium text-slate-900">{{ $res['customer_name'] }}</td>
                        <td class="py-3.5 px-4">{{ $res['customer_phone'] }}</td>
                        <td class="py-3.5 px-4">{{ $res['pax'] }} Orang</td>
                        <td class="py-3.5 px-4"><span class="px-2 py-0.5 bg-slate-100 rounded text-xs font-semibold">{{ $res['table_number'] }}</span></td>
                        <td class="py-3.5 px-4 font-medium">{{ $res['reservation_time'] }}</td>
                        <td class="py-3.5 px-4">
                            @if($res['status'] === 'confirmed')
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Dikonfirmasi</span>
                            @elseif($res['status'] === 'pending')
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">Menunggu</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">{{ ucfirst($res['status']) }}</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-xs text-slate-500">{{ $res['notes'] ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-400">Tidak ada reservasi pada tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
