@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
<style>
    .leaflet-popup-content-wrapper {
        border-radius: 8px;
        box-shadow: 0 3px 14px rgba(0,0,0,0.2);
    }
    .leaflet-popup-content {
        margin: 0;
        padding: 0;
    }
    .custom-popup .leaflet-popup-content-wrapper {
        background: white;
    }
    .leaflet-pane {
        z-index: 400 !important;
    }
    .leaflet-top,
    .leaflet-bottom {
        z-index: 450 !important;
    }
</style>
@endpush

<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Peta Sebaran UMKM & Sentra Produksi
        </x-slot>

        <x-slot name="description">
            Visualisasi geografis distribusi UMKM dan klaster sentra produksi di Kota Semarang
        </x-slot>

        <x-slot name="headerEnd">
            <div class="w-64">
                {{ $this->form }}
            </div>
        </x-slot>

        <div 
            x-data="{
                map: null,
                mapData: @js($mapData),
                markers: [],
                polygons: [],
                totalUmkm: 0,
                leafletLoaded: false,
                init() {
                    console.log('Alpine init, mapData:', this.mapData);
                    this.loadLeaflet();
                },
                loadLeaflet() {
                    if (typeof L !== 'undefined') {
                        console.log('Leaflet already loaded');
                        this.leafletLoaded = true;
                        this.initMap();
                        return;
                    }
                    
                    console.log('Loading Leaflet dynamically...');
                    const link = document.createElement('link');
                    link.rel = 'stylesheet';
                    link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                    link.integrity = 'sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=';
                    link.crossOrigin = '';
                    document.head.appendChild(link);
                    
                    const script = document.createElement('script');
                    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                    script.integrity = 'sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=';
                    script.crossOrigin = '';
                    script.onload = () => {
                        console.log('Leaflet script loaded');
                        this.leafletLoaded = true;
                        this.initMap();
                    };
                    script.onerror = () => {
                        console.error('Failed to load Leaflet');
                    };
                    document.head.appendChild(script);
                },
                waitForLeaflet() {
                    if (typeof L !== 'undefined') {
                        console.log('Leaflet loaded, initializing map');
                        this.initMap();
                    } else {
                        console.log('Waiting for Leaflet...');
                        setTimeout(() => this.waitForLeaflet(), 100);
                    }
                },
                initMap() {
                    if (!this.$refs.mapContainer) {
                        console.error('Map container ref not found');
                        return;
                    }
                    console.log('Map container found, creating map');
                    try {
                        this.map = L.map(this.$refs.mapContainer).setView([-7.0051, 110.4381], 12);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors',
                            maxZoom: 19
                        }).addTo(this.map);
                        console.log('Map created, rendering data');
                        this.renderMapData();
                        console.log('Map initialization complete');
                    } catch (e) {
                        console.error('Map error:', e);
                    }
                },
                renderMapData() {
                    console.log('Rendering map data, features:', this.mapData?.features?.length || 0);
                    this.clearMap();
                    if (!this.mapData || !this.mapData.features) {
                        console.warn('No map data or features');
                        return;
                    }
                    let bounds = [];
                    let count = 0;
                    this.mapData.features.forEach(f => {
                        if (f.geometry.type === 'Point') {
                            this.addMarker(f);
                            bounds.push([f.geometry.coordinates[1], f.geometry.coordinates[0]]);
                            count++;
                        } else if (f.geometry.type === 'Polygon') {
                            this.addPolygon(f);
                        }
                    });
                    this.totalUmkm = count;
                    console.log('Total UMKM markers:', count);
                    if (bounds.length > 0) {
                        this.map.fitBounds(bounds, { padding: [50, 50] });
                    }
                },
                addMarker(feature) {
                    const coords = feature.geometry.coordinates;
                    const p = feature.properties;
                    const color = (p.raw_materials && p.raw_materials.length > 0) ? 'green' : 'blue';
                    const marker = L.circleMarker([coords[1], coords[0]], {
                        radius: 8,
                        fillColor: color,
                        color: '#fff',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).addTo(this.map);
                    let html = '<div class=&quot;p-2 min-w-[200px]&quot;>';
                    html += '<h3 class=&quot;font-bold text-base mb-2&quot;>' + p.nama_usaha + '</h3>';
                    html += '<div class=&quot;space-y-1 text-sm&quot;>';
                    html += '<p><strong>Lokasi:</strong> ' + p.kelurahan + ', ' + p.kecamatan + '</p>';
                    html += '<p><strong>Omzet:</strong> Rp ' + new Intl.NumberFormat('id-ID').format(p.omzet_bulanan || 0) + '</p>';
                    if (p.raw_materials && p.raw_materials.length > 0) {
                        html += '<p><strong>Bahan Baku:</strong><br>' + p.raw_materials.join(', ') + '</p>';
                    }
                    html += '</div>';
                    html += '<a href=&quot;/admin/umkm-profiles/' + p.id + '&quot; class=&quot;inline-block mt-3 px-3 py-1.5 bg-amber-600 text-white text-xs rounded hover:bg-amber-700&quot;>Detail →</a>';
                    html += '</div>';
                    marker.bindPopup(html, { maxWidth: 300 });
                    this.markers.push(marker);
                },
                addPolygon(feature) {
                    const coords = feature.geometry.coordinates[0];
                    const p = feature.properties;
                    const latlngs = coords.map(c => [c[1], c[0]]);
                    const polygon = L.polygon(latlngs, {
                        color: '#ef4444',
                        weight: 2,
                        fillColor: '#ef4444',
                        fillOpacity: 0.2
                    }).addTo(this.map);
                    let html = '<div class=&quot;p-2&quot;>';
                    html += '<h3 class=&quot;font-bold text-base mb-2&quot;>' + p.nama_sentra + '</h3>';
                    html += '<p><strong>Komoditas:</strong> ' + p.jenis_komoditas + '</p>';
                    html += '<p><strong>Anggota:</strong> ' + p.total_member + ' UMKM</p>';
                    html += '</div>';
                    polygon.bindPopup(html);
                    this.polygons.push(polygon);
                },
                clearMap() {
                    if (this.map) {
                        this.markers.forEach(m => this.map.removeLayer(m));
                        this.polygons.forEach(p => this.map.removeLayer(p));
                        this.markers = [];
                        this.polygons = [];
                    }
                }
            }"
            wire:ignore
        >
            <!-- Map Container -->
            <div 
                x-ref="mapContainer" 
                id="umkm-map-{{ $this->getId() }}" 
                class="w-full rounded-lg border border-gray-200 dark:border-gray-700"
                style="height: 600px; z-index: 0;"
            ></div>

            <!-- Map Legend -->
            <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Legenda:</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-full bg-blue-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400">UMKM Individual</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-full bg-green-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400">UMKM dalam Sentra</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-3 bg-red-500 opacity-30 border border-red-600"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400">Area Sentra Produksi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                            Total UMKM: <span x-text="totalUmkm">0</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>