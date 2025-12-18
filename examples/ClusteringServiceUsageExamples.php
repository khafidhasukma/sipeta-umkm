<?php

// Contoh Penggunaan ClusteringService & Widget di berbagai konteks

namespace Examples;

// ============================================
// 1. CONTROLLER API - REST Endpoint
// ============================================
class MapApiController
{
    public function __construct(
        private \App\Services\ClusteringService $clusteringService
    ) {}

    /**
     * GET /api/map/geojson
     */
    public function getGeoJson()
    {
        $data = $this->clusteringService->getMapData();
        
        return response()->json($data);
    }

    /**
     * GET /api/map/statistics
     */
    public function getStatistics()
    {
        $stats = $this->clusteringService->getStatistics();
        
        return response()->json($stats);
    }

    /**
     * POST /api/map/analyze
     */
    public function runAnalysis()
    {
        $result = $this->clusteringService->analyze();
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }
}

// ============================================
// 2. LIVEWIRE COMPONENT - Standalone Map
// ============================================
class StandaloneMapComponent extends \Livewire\Component
{
    public array $mapData = [];
    public ?string $selectedKecamatan = null;

    public function mount(\App\Services\ClusteringService $service)
    {
        $this->mapData = $service->getMapData();
    }

    public function filterByKecamatan(?string $kecamatan)
    {
        $this->selectedKecamatan = $kecamatan;
        
        $service = app(\App\Services\ClusteringService::class);
        $fullData = $service->getMapData();
        
        if ($kecamatan) {
            $this->mapData = [
                'type' => 'FeatureCollection',
                'features' => collect($fullData['features'])
                    ->filter(function ($feature) use ($kecamatan) {
                        if ($feature['geometry']['type'] === 'Point') {
                            return $feature['properties']['kecamatan'] === $kecamatan;
                        }
                        return str_contains($feature['properties']['nama_sentra'] ?? '', $kecamatan);
                    })
                    ->values()
                    ->toArray(),
            ];
        } else {
            $this->mapData = $fullData;
        }
    }

    public function render()
    {
        return view('livewire.standalone-map');
    }
}

// ============================================
// 3. WIDGET DI ADMIN PANEL
// ============================================
class AdminDashboardWidget extends \Filament\Widgets\Widget
{
    protected static string $view = 'filament.admin.widgets.map-widget';
    protected int|string|array $columnSpan = 'full';

    public function getMapData(): array
    {
        return app(\App\Services\ClusteringService::class)->getMapData();
    }
}

// ============================================
// 4. COMMAND SCHEDULED
// ============================================
// File: routes/console.php
/*
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:analyze-clusters')
    ->daily()
    ->at('02:00')
    ->emailOutputOnFailure('admin@example.com');

Schedule::command('app:analyze-clusters')
    ->weekly()
    ->mondays()
    ->at('01:00');
*/

// ============================================
// 5. EVENT LISTENER - Auto Update
// ============================================
class UmkmUpdatedListener
{
    public function __construct(
        private \App\Services\ClusteringService $clusteringService
    ) {}

    public function handle(\App\Events\UmkmProfileUpdated $event)
    {
        // Auto re-analyze ketika UMKM baru ditambahkan
        if ($event->umkm->wasRecentlyCreated) {
            $this->clusteringService->analyze();
        }
    }
}

// ============================================
// 6. BLADE COMPONENT - Public Map
// ============================================
/*
<!-- File: resources/views/components/public-map.blade.php -->
<div x-data="publicMap()" x-init="initMap()">
    <div id="public-map" class="w-full h-96"></div>
</div>

<script>
function publicMap() {
    return {
        async initMap() {
            // Fetch dari API
            const response = await fetch('/api/map/geojson');
            const data = await response.json();
            
            // Render map
            const map = L.map('public-map').setView([-7.0051, 110.4381], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            
            // Add markers
            data.features.forEach(feature => {
                if (feature.geometry.type === 'Point') {
                    L.marker([
                        feature.geometry.coordinates[1],
                        feature.geometry.coordinates[0]
                    ]).addTo(map);
                }
            });
        }
    }
}
</script>
*/

// ============================================
// 7. EXPORT TO FILE
// ============================================
class MapExportController
{
    public function exportGeoJson(\App\Services\ClusteringService $service)
    {
        $data = $service->getMapData();
        $filename = 'umkm-map-' . now()->format('Y-m-d') . '.geojson';
        
        return response()->json($data)
            ->header('Content-Type', 'application/geo+json')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function exportKml(\App\Services\ClusteringService $service)
    {
        $data = $service->getMapData();
        
        // Convert GeoJSON to KML (menggunakan library seperti geoPHP)
        $kml = $this->convertToKml($data);
        
        return response($kml)
            ->header('Content-Type', 'application/vnd.google-earth.kml+xml')
            ->header('Content-Disposition', 'attachment; filename="umkm-map.kml"');
    }

    private function convertToKml(array $geojson): string
    {
        // Implementation dengan geoPHP atau library lain
        return '<?xml version="1.0" encoding="UTF-8"?><kml>...</kml>';
    }
}

// ============================================
// 8. WEBHOOK - Push Updates
// ============================================
class MapWebhookController
{
    public function notify(\App\Services\ClusteringService $service)
    {
        $stats = $service->getStatistics();
        
        // Send to external service
        Http::post('https://external-api.com/webhook', [
            'event' => 'cluster_updated',
            'data' => $stats,
            'timestamp' => now()->toIso8601String(),
        ]);
        
        return response()->json(['success' => true]);
    }
}

// ============================================
// 9. FILAMENT ACTION - Manual Trigger
// ============================================
/*
// Di Resource atau Page
use Filament\Actions\Action;

public function getHeaderActions(): array
{
    return [
        Action::make('analyze_clusters')
            ->label('Analisis Ulang Sentra')
            ->icon('heroicon-o-arrow-path')
            ->color('warning')
            ->action(function () {
                $service = app(\App\Services\ClusteringService::class);
                $result = $service->analyze();
                
                \Filament\Notifications\Notification::make()
                    ->title('Analisis Selesai')
                    ->body("Dibuat: {$result['created']}, Diperbarui: {$result['updated']}")
                    ->success()
                    ->send();
            }),
    ];
}
*/

// ============================================
// 10. CUSTOM FILTER - Advanced
// ============================================
class AdvancedMapFilter
{
    public function filterByMultipleCriteria(
        \App\Services\ClusteringService $service,
        ?string $kecamatan = null,
        ?string $commodity = null,
        ?float $minOmzet = null
    ): array {
        $fullData = $service->getMapData();
        
        $filtered = collect($fullData['features'])
            ->filter(function ($feature) use ($kecamatan, $commodity, $minOmzet) {
                if ($feature['geometry']['type'] === 'Point') {
                    $props = $feature['properties'];
                    
                    // Filter by kecamatan
                    if ($kecamatan && $props['kecamatan'] !== $kecamatan) {
                        return false;
                    }
                    
                    // Filter by commodity
                    if ($commodity && !in_array($commodity, $props['raw_materials'] ?? [])) {
                        return false;
                    }
                    
                    // Filter by minimum omzet
                    if ($minOmzet && ($props['omzet_bulanan'] ?? 0) < $minOmzet) {
                        return false;
                    }
                    
                    return true;
                }
                
                // Keep polygons if they match commodity
                if ($commodity && $feature['geometry']['type'] === 'Polygon') {
                    return ($feature['properties']['jenis_komoditas'] ?? null) === $commodity;
                }
                
                return true;
            })
            ->values();
        
        return [
            'type' => 'FeatureCollection',
            'features' => $filtered->toArray(),
        ];
    }
}
