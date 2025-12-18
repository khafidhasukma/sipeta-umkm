<?php

namespace App\Filament\Umkm\Pages;

use App\Filament\Umkm\Widgets\UmkmDistributionMap;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            UmkmDistributionMap::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 1;
    }
}
