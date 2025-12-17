<?php

namespace App\Filament\Umkm\Resources\ProductionTools;

use App\Filament\Umkm\Resources\ProductionTools\Pages\CreateProductionTool;
use App\Filament\Umkm\Resources\ProductionTools\Pages\EditProductionTool;
use App\Filament\Umkm\Resources\ProductionTools\Pages\ListProductionTools;
use App\Models\ProductionTool;
use BackedEnum;
use UnitEnum;
use Filament\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductionToolResource extends Resource
{
    protected static ?string $model = ProductionTool::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static ?string $navigationLabel = 'Alat Produksi';

    protected static ?string $modelLabel = 'Alat Produksi';

    protected static ?string $pluralModelLabel = 'Alat Produksi';

    protected static ?int $navigationSort = 2;

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

                Grid::make(2)
                    ->schema([
                        TextInput::make('nama_alat')
                            ->label('Nama Alat')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        TextInput::make('jenis')
                            ->label('Jenis Alat')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: Mesin, Manual, Elektronik'),

                        Select::make('kondisi')
                            ->label('Kondisi')
                            ->options([
                                'baik' => 'Baik',
                                'rusak ringan' => 'Rusak Ringan',
                                'rusak berat' => 'Rusak Berat',
                            ])
                            ->required()
                            ->native(false),

                        Select::make('status_kepemilikan')
                            ->label('Status Kepemilikan')
                            ->options([
                                'milik sendiri' => 'Milik Sendiri',
                                'sewa' => 'Sewa',
                                'pinjam' => 'Pinjam',
                                'hibah' => 'Hibah',
                            ])
                            ->required()
                            ->native(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_alat')
                    ->label('Nama Alat')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->searchable(),

                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baik' => 'success',
                        'rusak ringan' => 'warning',
                        'rusak berat' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('status_kepemilikan')
                    ->label('Status')
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kondisi')
                    ->options([
                        'baik' => 'Baik',
                        'rusak ringan' => 'Rusak Ringan',
                        'rusak berat' => 'Rusak Berat',
                    ]),

                Tables\Filters\SelectFilter::make('status_kepemilikan')
                    ->label('Status Kepemilikan')
                    ->options([
                        'milik sendiri' => 'Milik Sendiri',
                        'sewa' => 'Sewa',
                        'pinjam' => 'Pinjam',
                        'hibah' => 'Hibah',
                    ]),
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
            ->emptyStateHeading('Belum ada alat produksi')
            ->emptyStateDescription('Tambahkan alat produksi yang Anda gunakan untuk usaha.')
            ->emptyStateIcon(Heroicon::OutlinedWrenchScrewdriver);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductionTools::route('/'),
            'create' => CreateProductionTool::route('/create'),
            'edit' => EditProductionTool::route('/{record}/edit'),
        ];
    }
}
