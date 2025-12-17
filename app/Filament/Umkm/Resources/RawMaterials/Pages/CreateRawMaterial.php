<?php

namespace App\Filament\Umkm\Resources\RawMaterials\Pages;

use App\Filament\Umkm\Resources\RawMaterials\RawMaterialResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRawMaterial extends CreateRecord
{
    protected static string $resource = RawMaterialResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
