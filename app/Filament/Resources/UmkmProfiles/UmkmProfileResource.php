<?php

namespace App\Filament\Resources\UmkmProfiles;

use App\Filament\Resources\UmkmProfiles\Pages\CreateUmkmProfile;
use App\Filament\Resources\UmkmProfiles\Pages\EditUmkmProfile;
use App\Filament\Resources\UmkmProfiles\Pages\ListUmkmProfiles;
use App\Filament\Resources\UmkmProfiles\Pages\ViewUmkmProfile;
use App\Filament\Resources\UmkmProfiles\RelationManagers\ProductionToolsRelationManager;
use App\Filament\Resources\UmkmProfiles\RelationManagers\RawMaterialsRelationManager;
use App\Filament\Resources\UmkmProfiles\Schemas\UmkmProfileForm;
use App\Filament\Resources\UmkmProfiles\Schemas\UmkmProfileInfolist;
use App\Filament\Resources\UmkmProfiles\Tables\UmkmProfilesTable;
use App\Models\UmkmProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UmkmProfileResource extends Resource
{
    protected static ?string $model = UmkmProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?string $navigationLabel = 'UMKM';

    protected static ?string $modelLabel = 'UMKM';

    protected static ?string $pluralModelLabel = 'UMKM';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return UmkmProfileForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UmkmProfileInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UmkmProfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ProductionToolsRelationManager::class,
            RawMaterialsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUmkmProfiles::route('/'),
            'create' => CreateUmkmProfile::route('/create'),
            'view' => ViewUmkmProfile::route('/{record}'),
            'edit' => EditUmkmProfile::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
