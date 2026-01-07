@extends('layouts.admin')

@section('title', 'Monitoring Alat Produksi')
@section('page-title', 'Monitoring Alat Produksi')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl p-6 mb-8 border border-orange-200">
    <div class="flex items-start">
        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center mr-4 shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Monitoring Aset Produksi</h2>
            <p class="text-gray-700">
                Dashboard monitoring distribusi alat & bahan baku per wilayah untuk decision support.
            </p>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Total Alat Terdaftar</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $alatPerKecamatan->sum('total_alat') }}</h3>
        <p class="text-xs text-gray-500 mt-1">Unit alat produksi</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Jenis Alat Berbeda</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $alatPerKecamatan->sum('jenis_alat') }}</h3>
        <p class="text-xs text-gray-500 mt-1">Variasi alat produksi</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Jenis Bahan Baku</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $bahanPerKecamatan->sum('jenis_bahan') }}</h3>
        <p class="text-xs text-gray-500 mt-1">Total jenis bahan</p>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Tools per Kecamatan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Distribusi Alat per Kecamatan</h3>
        <div style="height: 300px;">
            <canvas id="toolsDistributionChart"></canvas>
        </div>
    </div>

    <!-- Top Tools -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Top 10 Alat Produksi</h3>
        <div style="height: 300px;">
            <canvas id="topToolsChart"></canvas>
        </div>
    </div>
</div>

<!-- Alat per Kecamatan Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Alat Produksi per Kecamatan</h3>
        <p class="text-sm text-gray-600 mt-1">Distribusi ketersediaan alat produksi per wilayah</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Kecamatan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Contoh Alat</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Jenis Alat</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Total Unit</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($alatPerKecamatan as $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $data->kecamatan }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600 max-w-xs truncate" title="{{ $data->daftar_alat }}">
                            {{ $data->daftar_alat ?: 'Tidak ada data' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-blue-600">{{ $data->jenis_alat }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-orange-600">{{ $data->total_alat }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($data->total_alat >= 10)
                            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Tinggi</span>
                        @elseif($data->total_alat >= 5)
                            <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Sedang</span>
                        @else
                            <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Rendah</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data alat produksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Tools Added -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Alat Produksi Terbaru</h3>
        <p class="text-sm text-gray-600 mt-1">10 alat produksi yang baru didaftarkan</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama Alat</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">UMKM</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Kecamatan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Kondisi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Terdaftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentTools as $tool)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $tool->nama_alat }}</div>
                        <div class="text-xs text-gray-500">{{ $tool->jenis }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $tool->nama_usaha }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600">{{ $tool->kecamatan }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($tool->kondisi === 'baik')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Baik</span>
                        @elseif($tool->kondisi === 'rusak ringan')
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Rusak Ringan</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">{{ ucfirst($tool->kondisi) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($tool->created_at)->diffForHumans() }}</div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Tools Distribution Chart
const distributionCtx = document.getElementById('toolsDistributionChart').getContext('2d');
new Chart(distributionCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($alatPerKecamatan->pluck('kecamatan')) !!},
        datasets: [{
            label: 'Total Alat',
            data: {!! json_encode($alatPerKecamatan->pluck('total_alat')) !!},
            backgroundColor: 'rgba(251, 146, 60, 0.8)',
            borderColor: 'rgba(251, 146, 60, 1)',
            borderWidth: 1,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});

// Top Tools Chart
const topToolsCtx = document.getElementById('topToolsChart').getContext('2d');
new Chart(topToolsCtx, {
    type: 'horizontalBar',
    data: {
        labels: {!! json_encode($topAlat->pluck('nama_alat')) !!},
        datasets: [{
            label: 'Jumlah',
            data: {!! json_encode($topAlat->pluck('total')) !!},
            backgroundColor: 'rgba(59, 130, 246, 0.8)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});
</script>
@endpush
