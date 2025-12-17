<?php

namespace App\Filament\Resources\ProductionClusters;

use App\Filament\Resources\ProductionClusters\Pages\CreateProductionCluster;
use App\Filament\Resources\ProductionClusters\Pages\EditProductionCluster;
use App\Filament\Resources\ProductionClusters\Pages\ListProductionClusters;
use App\Filament\Resources\ProductionClusters\Schemas\ProductionClusterForm;
use App\Filament\Resources\ProductionClusters\Tables\ProductionClustersTable;
use App\Models\ProductionCluster;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductionClusterResource extends Resource
{
    protected static ?string $model = ProductionCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?string $navigationLabel = 'Sentra Produksi';

    protected static ?string $modelLabel = 'Sentra Produksi';

    protected static ?string $pluralModelLabel = 'Sentra Produksi';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ProductionClusterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductionClustersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductionClusters::route('/'),
            'create' => CreateProductionCluster::route('/create'),
            'edit' => EditProductionCluster::route('/{record}/edit'),
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
