<?php

namespace App\Filament\Umkm\Resources\ProductionTools\Pages;

use App\Filament\Umkm\Resources\ProductionTools\ProductionToolResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductionTool extends EditRecord
{
    protected static string $resource = ProductionToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
