<?php

namespace App\Filament\Umkm\Resources\ProductionTools\Pages;

use App\Filament\Umkm\Resources\ProductionTools\ProductionToolResource;
use Filament\Resources\Pages\ListRecords;

class ListProductionTools extends ListRecords
{
    protected static string $resource = ProductionToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
