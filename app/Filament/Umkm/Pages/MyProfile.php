<?php

namespace App\Filament\Umkm\Pages;

use App\Models\UmkmProfile;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class MyProfile extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected string $view = 'filament.umkm.pages.my-profile';

    protected static ?string $navigationLabel = 'Profil Usaha Saya';

    protected static ?string $title = 'Profil Usaha Saya';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $umkmProfile = auth()->user()->umkmProfile;

        if (!$umkmProfile) {
            // Jika belum punya profile, buat data kosong
            $this->form->fill([
                'nama_usaha' => '',
                'alamat_lengkap' => '',
                'kecamatan' => '',
                'kelurahan' => '',
                'latitude' => null,
                'longitude' => null,
                'omzet_bulanan' => null,
                'jumlah_tenaga_kerja' => 1,
            ]);
        } else {
            $this->form->fill($umkmProfile->toArray());
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Usaha')
                    ->description('Data dasar usaha Anda')
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

                Section::make('Lokasi Usaha')
                    ->description('Pilih lokasi usaha Anda di peta')
                    ->schema([
                        ViewField::make('location_picker')
                            ->label('Pilih Lokasi di Peta')
                            ->view('filament.forms.components.location-picker')
                            ->afterStateHydrated(function ($component, $state) {
                                $component->state([
                                    'latitude' => $this->data['latitude'] ?? -6.966667,
                                    'longitude' => $this->data['longitude'] ?? 110.416664,
                                ]);
                            })
                            ->dehydrated(false)
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->required()
                                    ->numeric()
                                    ->step(0.000001)
                                    ->reactive()
                                    ->minValue(-7.051)
                                    ->maxValue(-6.88)
                                    ->placeholder('Contoh: -6.966667')
                                    ->helperText('Koordinat harus berada di wilayah Kota Semarang'),

                                TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->required()
                                    ->numeric()
                                    ->step(0.000001)
                                    ->reactive()
                                    ->minValue(110.33)
                                    ->maxValue(110.54)
                                    ->placeholder('Contoh: 110.416664')
                                    ->helperText('Koordinat harus berada di wilayah Kota Semarang'),
                            ]),
                    ]),

                Section::make('Data Ekonomi')
                    ->description('Informasi omzet dan tenaga kerja')
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
                                    ->minValue(1)
                                    ->suffix('orang'),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $umkmProfile = auth()->user()->umkmProfile;

            if ($umkmProfile) {
                $umkmProfile->update($data);
            } else {
                auth()->user()->umkmProfile()->create($data);
            }

            Notification::make()
                ->success()
                ->title('Profil Berhasil Disimpan')
                ->body('Data profil usaha Anda telah berhasil disimpan.')
                ->send();
        } catch (Halt $exception) {
            return;
        }
    }
}
