<x-filament-widgets::widget>
    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>

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
            x-data="umkmMapWidget_{{ $this->getId() }}()"
            x-init="$nextTick(() => { if (typeof L !== 'undefined') { initMap(); } else { loadLeaflet(); } })"
            @map-data-updated.window="updateMapData($event.detail.mapData)"
            wire:ignore
        >
            <!-- Map Container -->
            <div 
                x-ref="mapContainer" 
                id="umkm-map-{{ $this->getId() }}" 
                class="w-full h-150 rounded-lg border border-gray-200 dark:border-gray-700"
                style="z-index: 0;"
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

    <!-- Leaflet.js Script -->
    <script>
        // Load Leaflet if not already loaded
        if (typeof L === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
            script.integrity = 'sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=';
            script.crossOrigin = '';
            document.head.appendChild(script);
        }

        function umkmMapWidget_{{ $this->getId() }}() {
            return {
                map: null,
                mapData: @js($mapData),
                selectedCluster: @js($selectedCluster),
                markers: [],
                polygons: [],
                totalUmkm: 0,
                leafletLoaded: false,

                loadLeaflet() {
                    // Wait for Leaflet to load
                    const checkLeaflet = setInterval(() => {
                        if (typeof L !== 'undefined') {
                            clearInterval(checkLeaflet);
                            this.leafletLoaded = true;
                            this.initMap();
                        }
                    }, 100);
                },

                initMap() {
                    // Initialize Leaflet map centered on Semarang
                    this.map = L.map(this.$refs.mapContainer).setView([-7.0051, 110.4381], 12);

                    // Add OpenStreetMap tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19,
                    }).addTo(this.map);

                    // Render initial data
                    this.renderMapData();

                    // Listen for Livewire updates
                    window.addEventListener('mapDataUpdated', (event) => {
                        this.mapData = event.detail.mapData;
                        this.renderMapData();
                    });
                },

                renderMapData() {
                    // Clear existing markers and polygons
                    this.clearMap();

                    if (!this.mapData || !this.mapData.features) return;

                    let bounds = [];
                    let umkmCount = 0;

                    this.mapData.features.forEach(feature => {
                        if (feature.geometry.type === 'Point') {
                            this.renderUmkmMarker(feature);
                            bounds.push(feature.geometry.coordinates.slice().reverse());
                            umkmCount++;
                        } else if (feature.geometry.type === 'Polygon') {
                            this.renderClusterPolygon(feature);
                        }
                    });

                    this.totalUmkm = umkmCount;

                    // Fit map to bounds if markers exist
                    if (bounds.length > 0) {
                        this.map.fitBounds(bounds, { padding: [50, 50] });
                    }
                },

                renderUmkmMarker(feature) {
                    const coords = feature.geometry.coordinates;
                    const props = feature.properties;

                    // Determine marker color based on whether it's in a cluster
                    const isInCluster = props.raw_materials && props.raw_materials.length > 0;
                    const markerColor = isInCluster ? 'green' : 'blue';

                    const marker = L.circleMarker([coords[1], coords[0]], {
                        radius: 8,
                        fillColor: markerColor,
                        color: '#fff',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).addTo(this.map);

                    // Create popup content
                    const popupContent = `
                        <div class="p-2 min-w-[200px]">
                            <h3 class="font-bold text-base mb-2 text-gray-900">${props.nama_usaha}</h3>
                            <div class="space-y-1 text-sm">
                                <p class="text-gray-600">
                                    <strong>Lokasi:</strong> ${props.kelurahan}, ${props.kecamatan}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Omzet:</strong> Rp ${this.formatCurrency(props.omzet_bulanan)}
                                </p>
                                ${props.raw_materials && props.raw_materials.length > 0 ? `
                                    <p class="text-gray-600">
                                        <strong>Bahan Baku:</strong><br>
                                        ${props.raw_materials.join(', ')}
                                    </p>
                                ` : ''}
                            </div>
                            <a href="/umkm/umkm-profiles/${props.id}" 
                               class="inline-block mt-3 px-3 py-1.5 bg-primary-600 text-white text-xs rounded hover:bg-primary-700 transition">
                                Lihat Detail →
                            </a>
                        </div>
                    `;

                    marker.bindPopup(popupContent, {
                        maxWidth: 300,
                        className: 'custom-popup'
                    });

                    this.markers.push(marker);
                },

                renderClusterPolygon(feature) {
                    const coords = feature.geometry.coordinates[0];
                    const props = feature.properties;

                    // Convert coordinates to Leaflet format
                    const latlngs = coords.map(coord => [coord[1], coord[0]]);

                    const polygon = L.polygon(latlngs, {
                        color: '#ef4444',
                        weight: 2,
                        fillColor: '#ef4444',
                        fillOpacity: 0.2
                    }).addTo(this.map);

                    // Polygon popup
                    const popupContent = `
                        <div class="p-2">
                            <h3 class="font-bold text-base mb-2 text-gray-900">${props.nama_sentra}</h3>
                            <div class="space-y-1 text-sm">
                                <p class="text-gray-600">
                                    <strong>Komoditas:</strong> ${props.jenis_komoditas}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Anggota:</strong> ${props.total_member} UMKM
                                </p>
                            </div>
                        </div>
                    `;

                    polygon.bindPopup(popupContent);

                    this.polygons.push(polygon);
                },

                clearMap() {
                    this.markers.forEach(marker => this.map.removeLayer(marker));
                    this.polygons.forEach(polygon => this.map.removeLayer(polygon));
                    this.markers = [];
                    this.polygons = [];
                },

                formatCurrency(amount) {
                    if (!amount) return '0';
                    return new Intl.NumberFormat('id-ID').format(amount);
                },

                updateMapData(newMapData) {
                    this.mapData = newMapData;
                    if (this.map) {
                        this.renderMapData();
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Leaflet popup styling */
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

        /* Fix z-index issues with Filament */
        .leaflet-pane {
            z-index: 400 !important;
        }
        
        .leaflet-top,
        .leaflet-bottom {
            z-index: 450 !important;
        }
    </style>
</x-filament-widgets::widget>
        }

        /* Fix z-index issues with Filament */
        .leaflet-pane {
            z-index: 400 !important;
        }
        
        .leaflet-top,
        .leaflet-bottom {
            z-index: 450 !important;
        }
    </style>
</x-filament-widgets::widget>
