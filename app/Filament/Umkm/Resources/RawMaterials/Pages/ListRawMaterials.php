<?php

namespace App\Filament\Umkm\Resources\RawMaterials\Pages;

use App\Filament\Umkm\Resources\RawMaterials\RawMaterialResource;
use Filament\Resources\Pages\ListRecords;

class ListRawMaterials extends ListRecords
{
    protected static string $resource = RawMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
