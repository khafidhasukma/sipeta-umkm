<?php

namespace App\Filament\Widgets;

use App\Services\ClusteringService;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Widgets\Widget;

class UmkmDistributionMap extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static ?string $heading = 'Peta Sebaran UMKM & Sentra Produksi';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 3;

    protected string $view = 'filament.widgets.umkm-distribution-map';

    public ?string $selectedCluster = null;

    public array $mapData = [];

    public function mount(ClusteringService $clusteringService): void
    {
        $this->mapData = $clusteringService->getMapData();
        $this->form->fill([
            'cluster_filter' => $this->selectedCluster,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cluster_filter')
                    ->label('Filter Jenis Sentra')
                    ->placeholder('Semua Sentra')
                    ->options($this->getClusterOptions())
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function ($state) {
                        $this->selectedCluster = $state;
                        $this->updateMapData();
                    }),
            ]);
    }

    public function updateMapData(): void
    {
        $clusteringService = app(ClusteringService::class);
        $fullData = $clusteringService->getMapData();

        if ($this->selectedCluster) {
            // Filter features based on selected cluster
            $this->mapData = [
                'type' => 'FeatureCollection',
                'features' => collect($fullData['features'])
                    ->filter(function ($feature) {
                        // Keep all UMKM points that have the selected material
                        if ($feature['geometry']['type'] === 'Point') {
                            return in_array(
                                $this->selectedCluster,
                                $feature['properties']['raw_materials'] ?? []
                            );
                        }

                        // Keep polygons that match the selected commodity
                        if ($feature['geometry']['type'] === 'Polygon') {
                            return ($feature['properties']['jenis_komoditas'] ?? null) === $this->selectedCluster;
                        }

                        return false;
                    })
                    ->values()
                    ->toArray(),
            ];
        } else {
            $this->mapData = $fullData;
        }

        $this->dispatch('mapDataUpdated', mapData: $this->mapData);
    }

    protected function getClusterOptions(): array
    {
        $clusteringService = app(ClusteringService::class);
        $mapData = $clusteringService->getMapData();

        $commodities = collect($mapData['features'])
            ->filter(fn ($feature) => $feature['geometry']['type'] === 'Polygon')
            ->pluck('properties.jenis_komoditas')
            ->unique()
            ->sort()
            ->values();

        return $commodities->mapWithKeys(fn ($commodity) => [$commodity => $commodity])->toArray();
    }

    public function getMapDataProperty(): array
    {
        return $this->mapData;
    }

    protected function getViewData(): array
    {
        return [
            'mapData' => $this->mapData,
            'selectedCluster' => $this->selectedCluster,
        ];
    }
}
