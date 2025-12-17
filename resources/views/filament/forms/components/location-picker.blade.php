@php
    $state = $getState() ?? ['latitude' => -6.966667, 'longitude' => 110.416664];
    $latitude = data_get($state, 'latitude', -6.966667);
    $longitude = data_get($state, 'longitude', 110.416664);
@endphp

<div
    x-data="{
        map: null,
        marker: null,
        latitude: @js($latitude),
        longitude: @js($longitude),
        
        init() {
            // Load Leaflet CSS & JS
            if (!document.getElementById('leaflet-css')) {
                const link = document.createElement('link');
                link.id = 'leaflet-css';
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                document.head.appendChild(link);
            }
            
            if (!window.L) {
                const script = document.createElement('script');
                script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                script.onload = () => this.initMap();
                document.head.appendChild(script);
            } else {
                this.initMap();
            }
        },
        
        initMap() {
            setTimeout(() => {
                // Batasan wilayah Kota Semarang
                const semarangBounds = [
                    [-7.051, 110.33],  // Southwest corner
                    [-6.88, 110.54]    // Northeast corner
                ];
                
                this.map = L.map(this.$refs.map, {
                    maxBounds: semarangBounds,
                    maxBoundsViscosity: 1.0,
                    minZoom: 11
                }).setView([this.latitude, this.longitude], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19,
                }).addTo(this.map);
                
                // Tambahkan rectangle untuk menandai batas Kota Semarang
                L.rectangle(semarangBounds, {
                    color: '#3b82f6',
                    weight: 2,
                    fillOpacity: 0.1
                }).addTo(this.map);
                
                this.marker = L.marker([this.latitude, this.longitude], {
                    draggable: true
                }).addTo(this.map);
                
                this.marker.on('dragend', (event) => {
                    const position = event.target.getLatLng();
                    // Validasi bahwa marker masih di dalam bounds Kota Semarang
                    if (this.isInBounds(position.lat, position.lng, semarangBounds)) {
                        this.updateLocation(position.lat, position.lng);
                    } else {
                        // Kembalikan marker ke posisi sebelumnya
                        this.marker.setLatLng([this.latitude, this.longitude]);
                        alert('Lokasi harus berada di dalam wilayah Kota Semarang!');
                    }
                });
                
                this.map.on('click', (event) => {
                    const { lat, lng } = event.latlng;
                    // Validasi bahwa klik masih di dalam bounds Kota Semarang
                    if (this.isInBounds(lat, lng, semarangBounds)) {
                        this.marker.setLatLng([lat, lng]);
                        this.updateLocation(lat, lng);
                    } else {
                        alert('Lokasi harus berada di dalam wilayah Kota Semarang!');
                    }
                });
            }, 100);
        },
        
        isInBounds(lat, lng, bounds) {
            const [[minLat, minLng], [maxLat, maxLng]] = bounds;
            return lat >= minLat && lat <= maxLat && lng >= minLng && lng <= maxLng;
        },
        
        updateLocation(lat, lng) {
            this.latitude = lat;
            this.longitude = lng;
            
            // Update form fields
            @this.set('data.latitude', lat.toFixed(6));
            @this.set('data.longitude', lng.toFixed(6));
        }
    }"
    x-init="init()"
    wire:ignore
>
    <div class="rounded-lg overflow-hidden border border-gray-300 dark:border-gray-600">
        <div 
            x-ref="map" 
            style="height: 400px; width: 100%;"
            class="z-0"
        ></div>
    </div>
    
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
        <strong>Petunjuk:</strong> Klik pada peta atau geser marker untuk memilih lokasi usaha Anda.
        <span class="text-blue-600 dark:text-blue-400 font-semibold">Lokasi harus berada di dalam wilayah Kota Semarang</span> (ditandai dengan kotak biru).
        Koordinat akan otomatis terisi di field Latitude dan Longitude di bawah.
    </p>
</div>
