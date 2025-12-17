<?php

namespace App\Filament\Resources\UmkmProfiles\RelationManagers;

use Filament\Actions;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class RawMaterialsRelationManager extends RelationManager
{
    protected static string $relationship = 'rawMaterials';

    protected static ?string $title = 'Bahan Baku';

    protected static ?string $label = 'Bahan Baku';

    protected static ?string $pluralLabel = 'Bahan Baku';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_bahan')
                    ->label('Nama Bahan')
                    ->required()
                    ->maxLength(255),

                Grid::make(2)
                    ->schema([
                        TextInput::make('kebutuhan_per_bulan')
                            ->label('Kebutuhan per Bulan')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->step(0.01),

                        TextInput::make('satuan')
                            ->label('Satuan')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Kg, Liter, Pcs, dll'),
                    ]),

                TextInput::make('asal_supplier')
                    ->label('Asal Supplier')
                    ->maxLength(255),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull()
                    ->rows(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_bahan')
            ->columns([
                Tables\Columns\TextColumn::make('nama_bahan')
                    ->label('Nama Bahan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('kebutuhan_per_bulan')
                    ->label('Kebutuhan/Bulan')
                    ->numeric(decimalPlaces: 2)
                    ->suffix(fn ($record) => ' '.$record->satuan)
                    ->sortable(),

                Tables\Columns\TextColumn::make('satuan')
                    ->label('Satuan')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga_per_satuan')
                    ->label('Harga/Satuan')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('asal_supplier')
                    ->label('Asal Supplier')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('satuan')
                    ->label('Satuan')
                    ->options(fn () => \App\Models\RawMaterial::query()
                        ->distinct()
                        ->pluck('satuan', 'satuan')
                        ->toArray()
                    ),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
