<?php

namespace App\Filament\Resources\UmkmProfiles\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UmkmProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('user.name'),
                TextEntry::make('nama_usaha'),
                TextEntry::make('kecamatan'),
                TextEntry::make('kelurahan'),
                TextEntry::make('latitude')
                    ->numeric(),
                TextEntry::make('longitude')
                    ->numeric(),
                TextEntry::make('omzet_bulanan')
                    ->numeric(),
                TextEntry::make('jumlah_tenaga_kerja')
                    ->numeric(),
                IconEntry::make('is_verified')
                    ->boolean(),
                TextEntry::make('verified_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
