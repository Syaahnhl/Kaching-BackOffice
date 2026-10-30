@extends('backoffice::master')

@section('title', 'Riwayat Shift Kasir - Kaching Back Office')
@section('page_title', 'Riwayat Shift Kasir')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-semibold text-slate-900">Rekapitulasi Shift Kasir POS</h2>
            <p class="text-xs text-slate-500">Melihat catatan waktu buka/tutup shift dan kas awal. Balancing keuangan diproses Core SSOT.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded-lg">Audit Shift Read-Only</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Kasir / Operator</th>
                        <th class="py-3.5 px-4">Mulai Shift</th>
                        <th class="py-3.5 px-4">Selesai Shift</th>
                        <th class="py-3.5 px-4">Modal Awal</th>
                        <th class="py-3.5 px-4">Kas Aktual Akhir</th>
                        <th class="py-3.5 px-4">Selisih</th>
                        <th class="py-3.5 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($shifts as $shift)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4 font-semibold text-slate-900">{{ $shift['staff_name'] }}</td>
                        <td class="py-3.5 px-4 text-xs">{{ $shift['start_time'] }}</td>
                        <td class="py-3.5 px-4 text-xs">{{ $shift['end_time'] ?? '-' }}</td>
                        <td class="py-3.5 px-4">Rp {{ number_format($shift['start_cash'], 0, ',', '.') }}</td>
                        <td class="py-3.5 px-4">
                            @if($shift['actual_cash'] !== null)
                                Rp {{ number_format($shift['actual_cash'], 0, ',', '.') }}
                            @else
                                <span class="text-xs text-slate-400 italic">Sedang Berjalan</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if($shift['difference'] !== null)
                                <span class="font-semibold {{ $shift['difference'] < 0 ? 'text-red-600' : 'text-slate-700' }}">
                                    Rp {{ number_format($shift['difference'], 0, ',', '.') }}
                                </span>
                            @else
                                <span class="text-xs text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if($shift['status'] === 'closed')
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">Selesai (Ditutup)</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Aktif (Open)</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-400">Tidak ada riwayat shift.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
