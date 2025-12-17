<?php

namespace App\Filament\Resources\UmkmProfiles\RelationManagers;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProductionToolsRelationManager extends RelationManager
{
    protected static string $relationship = 'productionTools';

    protected static ?string $title = 'Alat Produksi';

    protected static ?string $label = 'Alat Produksi';

    protected static ?string $pluralLabel = 'Alat Produksi';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_alat')
                    ->label('Nama Alat')
                    ->required()
                    ->maxLength(255),

                TextInput::make('jenis')
                    ->label('Jenis')
                    ->maxLength(255),

                Select::make('kondisi')
                    ->label('Kondisi')
                    ->options([
                        'baik' => 'Baik',
                        'rusak ringan' => 'Rusak Ringan',
                        'rusak berat' => 'Rusak Berat',
                        'perlu perbaikan' => 'Perlu Perbaikan',
                    ])
                    ->required(),

                Select::make('status_kepemilikan')
                    ->label('Status Kepemilikan')
                    ->options([
                        'milik sendiri' => 'Milik Sendiri',
                        'sewa' => 'Sewa',
                        'pinjam' => 'Pinjam',
                        'hibah' => 'Hibah',
                    ])
                    ->required(),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull()
                    ->rows(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_alat')
            ->columns([
                Tables\Columns\TextColumn::make('nama_alat')
                    ->label('Nama Alat')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baik' => 'success',
                        'rusak ringan' => 'warning',
                        'rusak berat' => 'danger',
                        'perlu perbaikan' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'baik' => 'Baik',
                        'rusak ringan' => 'Rusak Ringan',
                        'rusak berat' => 'Rusak Berat',
                        'perlu perbaikan' => 'Perlu Perbaikan',
                    }),

                Tables\Columns\TextColumn::make('status_kepemilikan')
                    ->label('Status Kepemilikan')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'milik sendiri' => 'Milik Sendiri',
                        'sewa' => 'Sewa',
                        'pinjam' => 'Pinjam',
                        'hibah' => 'Hibah',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kondisi')
                    ->label('Kondisi')
                    ->options([
                        'baik' => 'Baik',
                        'rusak ringan' => 'Rusak Ringan',
                        'rusak berat' => 'Rusak Berat',
                        'perlu perbaikan' => 'Perlu Perbaikan',
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
