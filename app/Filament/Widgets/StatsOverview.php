<?php

namespace App\Filament\Widgets;

use App\Models\ProductionCluster;
use App\Models\UmkmProfile;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalUmkm = UmkmProfile::count();
        $verifiedUmkm = UmkmProfile::whereNotNull('verified_at')
            ->where('is_verified', true)
            ->count();
        $pendingUmkm = UmkmProfile::where('is_verified', false)
            ->orWhereNull('verified_at')
            ->count();
        $totalClusters = ProductionCluster::count();

        $verificationRate = $totalUmkm > 0 
            ? round(($verifiedUmkm / $totalUmkm) * 100, 1) 
            : 0;

        return [
            Stat::make('Total UMKM Terdaftar', $totalUmkm)
                ->color('primary')
                ->chart([7, 12, 15, 18, 22, 25, $totalUmkm]),

            Stat::make('UMKM Terverifikasi', $verifiedUmkm)
                ->color('success')
                ->chart([5, 8, 12, 15, 18, 20, $verifiedUmkm]),

            Stat::make('Menunggu Verifikasi', $pendingUmkm)
                ->color($pendingUmkm > 0 ? 'warning' : 'gray')
                ->url($pendingUmkm > 0 ? route('filament.admin.resources.umkm-profiles.index', [
                    'tableFilters[is_verified][value]' => false
                ]) : null),

            Stat::make('Total Sentra Produksi', $totalClusters)
                ->color('info')
                ->url(route('filament.admin.resources.production-clusters.index')),
        ];
    }
}
