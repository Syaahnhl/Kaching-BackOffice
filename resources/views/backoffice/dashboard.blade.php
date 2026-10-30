@extends('backoffice::master')

@section('title', 'Dashboard - Kaching Back Office')
@section('page_title', 'Performance Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Gross Sales</span>
            <div class="text-2xl font-bold mt-2 text-slate-900">
                Rp {{ number_format($metrics->totalGrossSales, 0, ',', '.') }}
            </div>
            <span class="text-xs text-emerald-600 font-medium mt-1 inline-block">Realtime Synced</span>
        </div>
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Net Sales</span>
            <div class="text-2xl font-bold mt-2 text-slate-900">
                Rp {{ number_format($metrics->totalNetSales, 0, ',', '.') }}
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Transactions</span>
            <div class="text-2xl font-bold mt-2 text-slate-900">
                {{ number_format($metrics->totalTransactions) }}
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Cash in Hand</span>
            <div class="text-2xl font-bold mt-2 text-slate-900">
                Rp {{ number_format($metrics->cashInHand, 0, ',', '.') }}
            </div>
        </div>
    </div>
</div>
@endsection
