<?php

namespace App\Filament\Resources\ProductionClusters\Tables;

use Filament\Actions;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductionClustersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_sentra')
                    ->label('Nama Sentra')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->kelurahan ? "Kel. {$record->kelurahan}" : null),

                TextColumn::make('jenis_komoditas')
                    ->label('Jenis Komoditas')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                TextColumn::make('total_member')
                    ->label('Total Anggota')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->suffix(' UMKM'),

                IconColumn::make('polygon_json')
                    ->label('Data Polygon')
                    ->boolean()
                    ->trueIcon(Heroicon::CheckCircle)
                    ->falseIcon(Heroicon::XCircle)
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->getStateUsing(fn ($record) => !empty($record->polygon_json))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('jenis_komoditas')
                    ->label('Jenis Komoditas')
                    ->options(fn () => \App\Models\ProductionCluster::query()
                        ->distinct()
                        ->pluck('jenis_komoditas', 'jenis_komoditas')
                        ->toArray()
                    ),

                Filter::make('has_polygon')
                    ->label('Ada Data Polygon')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => 
                        $query->whereNotNull('polygon_json')
                              ->where('polygon_json', '!=', '')
                    ),

                Filter::make('no_polygon')
                    ->label('Belum Ada Polygon')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => 
                        $query->where(function ($q) {
                            $q->whereNull('polygon_json')
                              ->orWhere('polygon_json', '');
                        })
                    ),

                TrashedFilter::make(),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->persistFiltersInSession()
            ->recordActions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                    Actions\ForceDeleteBulkAction::make(),
                    Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('total_member', 'desc');
    }
}
