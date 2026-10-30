@extends('backoffice::master')

@section('title', 'Karyawan & Hak Akses - Kaching Back Office')
@section('page_title', 'Karyawan & Hak Akses')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-semibold text-slate-900">Manajemen Staf & Akses POS</h2>
            <p class="text-xs text-slate-500">Kelola profil staf cabang. Informasi PIN dan kompensasi dilindungi keamanan Core SSOT.</p>
        </div>
        <button class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition">
            + Tambah Staf Baru
        </button>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Nama Staf</th>
                        <th class="py-3.5 px-4">Peran (Role)</th>
                        <th class="py-3.5 px-4">Tipe Kerja</th>
                        <th class="py-3.5 px-4">Status Akun</th>
                        <th class="py-3.5 px-4">Keamanan PIN</th>
                        <th class="py-3.5 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($staffMembers as $staff)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4 font-semibold text-slate-900">{{ $staff->staffName }}</td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded text-xs font-semibold
                                {{ $staff->role === 'MANAGER' ? 'bg-purple-100 text-purple-800' : ($staff->role === 'KASIR' ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-800') }}">
                                {{ $staff->role }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-xs">{{ ucfirst(str_replace('_', ' ', $staff->employmentType)) }}</td>
                        <td class="py-3.5 px-4">
                            @if($staff->isActive)
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-xs text-slate-500">
                            <span class="inline-flex items-center gap-1.5 text-slate-600 font-mono">
                                •••••• (Terproteksi)
                            </span>
                            @if($staff->mustChangePin)
                                <span class="ml-2 px-1.5 py-0.5 bg-amber-100 text-amber-800 rounded text-[10px] font-semibold">Wajib Ganti</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <button class="text-xs text-blue-600 hover:text-blue-800 font-medium">Edit Akses</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">Belum ada staf yang terdaftar di outlet ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
