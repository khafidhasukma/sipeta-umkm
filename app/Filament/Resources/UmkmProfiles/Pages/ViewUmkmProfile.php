<?php

namespace App\Filament\Resources\UmkmProfiles\Pages;

use App\Filament\Resources\UmkmProfiles\UmkmProfileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUmkmProfile extends ViewRecord
{
    protected static string $resource = UmkmProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
