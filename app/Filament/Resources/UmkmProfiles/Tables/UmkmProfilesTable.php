<?php

namespace App\Filament\Resources\UmkmProfiles\Tables;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UmkmProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_usaha')
                    ->label('Nama Usaha')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->user?->name ?? 'Pemilik belum terdaftar'),

                TextColumn::make('kecamatan')
                    ->label('Kecamatan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                IconColumn::make('is_verified')
                    ->label('Terverifikasi')
                    ->boolean()
                    ->trueIcon(Heroicon::CheckBadge)
                    ->falseIcon(Heroicon::XCircle)
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                TextColumn::make('omzet_bulanan')
                    ->label('Omzet Bulanan')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('jumlah_tenaga_kerja')
                    ->label('Tenaga Kerja')
                    ->numeric()
                    ->suffix(' orang')
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('verified_at')
                    ->label('Tanggal Verifikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('kecamatan')
                    ->label('Kecamatan')
                    ->searchable()
                    ->options(fn () => \App\Models\UmkmProfile::query()
                        ->distinct()
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Filter::make('is_verified')
                    ->label('Sudah Diverifikasi')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('is_verified', true)),

                Filter::make('belum_verified')
                    ->label('Belum Diverifikasi')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('is_verified', false)),

                TrashedFilter::make(),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::Dropdown)
            ->deferFilters()
            ->persistFiltersInSession()
            ->recordActions([
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon(Heroicon::CheckBadge)
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_verified)
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi UMKM')
                    ->modalDescription(fn ($record) => "Apakah Anda yakin ingin memverifikasi UMKM '{$record->nama_usaha}'?")
                    ->modalSubmitActionLabel('Ya, Verifikasi')
                    ->action(function ($record) {
                        $record->update([
                            'is_verified' => true,
                            'verified_at' => now(),
                        ]);

                        Notification::make()
                            ->success()
                            ->title('UMKM Terverifikasi')
                            ->body("UMKM '{$record->nama_usaha}' berhasil diverifikasi.")
                            ->send();
                    }),

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
            ->defaultSort('created_at', 'desc');
    }
}
