<?php

namespace App\Filament\Resources\ProductionClusters\Pages;

use App\Filament\Resources\ProductionClusters\ProductionClusterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductionCluster extends CreateRecord
{
    protected static string $resource = ProductionClusterResource::class;
}
