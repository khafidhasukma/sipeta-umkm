<?php

namespace App\Filament\Umkm\Resources\ProductionTools\Pages;

use App\Filament\Umkm\Resources\ProductionTools\ProductionToolResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductionTool extends CreateRecord
{
    protected static string $resource = ProductionToolResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
