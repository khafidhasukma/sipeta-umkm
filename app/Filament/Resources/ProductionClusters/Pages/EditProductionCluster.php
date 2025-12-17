<?php

namespace App\Filament\Resources\ProductionClusters\Pages;

use App\Filament\Resources\ProductionClusters\ProductionClusterResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProductionCluster extends EditRecord
{
    protected static string $resource = ProductionClusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
