<?php

namespace App\Filament\Resources\ProductionClusters\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductionClusterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Sentra')
                    ->description('Data dasar sentra produksi')
                    ->schema([
                        TextInput::make('nama_sentra')
                            ->label('Nama Sentra')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('jenis_komoditas')
                                    ->label('Jenis Komoditas')
                                    ->required()
                                    ->maxLength(100)
                                    ->disabled()
                                    ->dehydrated()
                                    ->helperText('Field ini read-only, diisi otomatis dari analisis'),

                                TextInput::make('total_member')
                                    ->label('Total Anggota UMKM')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->disabled()
                                    ->dehydrated()
                                    ->suffix('UMKM')
                                    ->helperText('Field ini read-only, diisi otomatis dari analisis'),

                                TextInput::make('kecamatan')
                                    ->label('Kecamatan')
                                    ->maxLength(100)
                                    ->disabled()
                                    ->dehydrated(),

                                TextInput::make('kelurahan')
                                    ->label('Kelurahan/Desa')
                                    ->maxLength(100)
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                    ]),

                Section::make('Area Geografis')
                    ->description('Data polygon dan koordinat sentra')
                    ->collapsed()
                    ->schema([
                        Textarea::make('polygon_json')
                            ->label('Data Polygon (GeoJSON)')
                            ->rows(5)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Data polygon geografis dalam format JSON')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
