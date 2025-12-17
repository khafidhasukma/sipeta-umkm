<?php

namespace App\Filament\Resources\ProductionClusters\Pages;

use App\Filament\Resources\ProductionClusters\ProductionClusterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductionClusters extends ListRecords
{
    protected static string $resource = ProductionClusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
