<?php

namespace App\Filament\Umkm\Resources\RawMaterials;

use App\Filament\Umkm\Resources\RawMaterials\Pages\CreateRawMaterial;
use App\Filament\Umkm\Resources\RawMaterials\Pages\EditRawMaterial;
use App\Filament\Umkm\Resources\RawMaterials\Pages\ListRawMaterials;
use App\Models\RawMaterial;
use BackedEnum;
use UnitEnum;
use Filament\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RawMaterialResource extends Resource
{
    protected static ?string $model = RawMaterial::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCube;

    protected static ?string $navigationLabel = 'Bahan Baku';

    protected static ?string $modelLabel = 'Bahan Baku';

    protected static ?string $pluralModelLabel = 'Bahan Baku';

    protected static ?int $navigationSort = 3;

    protected static UnitEnum|string|null $navigationGroup = 'Inventaris';

    public static function getEloquentQuery(): Builder
    {
        $umkmProfile = auth()->user()->umkmProfile;
        
        if (!$umkmProfile) {
            return parent::getEloquentQuery()->whereRaw('1 = 0'); // Return empty query
        }
        
        return parent::getEloquentQuery()
            ->where('umkm_profile_id', $umkmProfile->id);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Hidden::make('umkm_profile_id')
                    ->default(fn () => auth()->user()->umkmProfile?->id)
                    ->required(),

                TextInput::make('nama_bahan')
                    ->label('Nama Bahan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                Grid::make(2)
                    ->schema([
                        TextInput::make('kebutuhan_per_bulan')
                            ->label('Kebutuhan per Bulan')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->step(0.01)
                            ->placeholder('0'),

                        TextInput::make('satuan')
                            ->label('Satuan')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Kg, Liter, Pcs, dll'),
                    ]),

                TextInput::make('asal_supplier')
                    ->label('Asal Supplier')
                    ->maxLength(255)
                    ->placeholder('Nama atau lokasi supplier')
                    ->columnSpan(2),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3)
                    ->columnSpan(2)
                    ->placeholder('Keterangan tambahan tentang bahan baku'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_bahan')
                    ->label('Nama Bahan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('kebutuhan_per_bulan')
                    ->label('Kebutuhan/Bulan')
                    ->numeric(decimalPlaces: 2)
                    ->suffix(fn ($record) => ' ' . $record->satuan)
                    ->sortable(),

                TextColumn::make('satuan')
                    ->label('Satuan')
                    ->badge()
                    ->searchable(),

                TextColumn::make('asal_supplier')
                    ->label('Supplier')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada bahan baku')
            ->emptyStateDescription('Tambahkan bahan baku yang Anda gunakan untuk produksi.')
            ->emptyStateIcon(Heroicon::OutlinedCube);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRawMaterials::route('/'),
            'create' => CreateRawMaterial::route('/create'),
            'edit' => EditRawMaterial::route('/{record}/edit'),
        ];
    }
}
