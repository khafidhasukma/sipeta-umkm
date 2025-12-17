<?php

namespace App\Filament\Resources\UmkmProfiles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UmkmProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pemilik')
                    ->description('Data pemilik UMKM')
                    ->collapsed()
                    ->schema([
                        Select::make('user_id')
                            ->label('Pemilik UMKM')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),
                                
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->unique('users', 'email')
                                    ->maxLength(255),
                                
                                TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->required()
                                    ->minLength(8),
                                
                                TextInput::make('nib')
                                    ->label('NIB (Nomor Induk Berusaha)')
                                    ->maxLength(13)
                                    ->unique('users', 'nib'),
                            ]),
                    ]),

                Section::make('Informasi Usaha')
                    ->description('Detail usaha dan kontak')
                    ->collapsed()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nama_usaha')
                                    ->label('Nama Usaha')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),

                                Textarea::make('alamat_lengkap')
                                    ->label('Alamat Lengkap')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpan(2),

                                TextInput::make('kecamatan')
                                    ->label('Kecamatan')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('kelurahan')
                                    ->label('Kelurahan/Desa')
                                    ->required()
                                    ->maxLength(100),
                            ]),
                    ]),

                Section::make('Lokasi GIS')
                    ->description('Koordinat geografis lokasi usaha')
                    ->collapsed()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric()
                                    ->step(0.000001)
                                    ->minValue(-7.051)
                                    ->maxValue(-6.88)
                                    ->placeholder('Contoh: -6.966667')
                                    ->helperText('Koordinat harus berada di wilayah Kota Semarang'),

                                TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric()
                                    ->step(0.000001)
                                    ->minValue(110.33)
                                    ->maxValue(110.54)
                                    ->placeholder('Contoh: 110.416664')
                                    ->helperText('Koordinat harus berada di wilayah Kota Semarang'),
                            ]),
                    ]),

                Section::make('Data Ekonomi')
                    ->description('Informasi omzet dan tenaga kerja')
                    ->collapsed()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('omzet_bulanan')
                                    ->label('Omzet Bulanan (Rp)')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->placeholder('0'),

                                TextInput::make('jumlah_tenaga_kerja')
                                    ->label('Jumlah Tenaga Kerja')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(0)
                                    ->suffix('orang'),
                            ]),
                    ]),

                Section::make('Status Verifikasi')
                    ->description('Status verifikasi UMKM oleh admin')
                    ->collapsed()
                    ->schema([
                        Toggle::make('is_verified')
                            ->label('Terverifikasi')
                            ->default(false)
                            ->inline(false)
                            ->helperText('Aktifkan untuk memverifikasi UMKM ini'),

                        DateTimePicker::make('verified_at')
                            ->label('Tanggal Verifikasi')
                            ->displayFormat('d M Y H:i')
                            ->seconds(false)
                            ->disabled()
                            ->dehydrated(false)
                            ->visible(fn ($get) => $get('is_verified')),
                    ]),
            ]);
    }
}
