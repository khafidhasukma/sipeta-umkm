@extends(request()->has('admin') && auth()->check() && auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Peta Persebaran UMKM')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<style>
    #map {
        height: calc(100vh - 64px);
        width: 100%;
    }
    @if(request()->has('admin') && auth()->check() && auth()->user()->role === 'admin')
    #map {
        height: calc(100vh - 80px);
    }
    @endif
    .leaflet-popup-content {
        margin: 16px;
        min-width: 250px;
    }
    .map-controls {
        position: absolute;
        top: 80px;
        left: 16px;
        z-index: 1000;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        padding: 16px;
        max-width: 320px;
    }
    .dark .map-controls {
        background: rgb(31, 41, 55);
        border: 1px solid rgb(55, 65, 81);
    }
    .map-controls h3 {
        color: rgb(17, 24, 39);
    }
    .dark .map-controls h3 {
        color: rgb(243, 244, 246);
    }
    .map-controls input,
    .map-controls select {
        background: white;
        color: rgb(17, 24, 39);
    }
    .dark .map-controls input,
    .dark .map-controls select {
        background: rgb(55, 65, 81);
        color: rgb(243, 244, 246);
        border-color: rgb(75, 85, 99);
    }
    @media (max-width: 768px) {
        .map-controls {
            top: 70px;
            left: 8px;
            right: 8px;
            max-width: none;
        }
    }
</style>
@endpush

@section('content')
<div class="relative">
    <!-- Map Controls Panel -->
    <div class="map-controls" x-data="{ open: true }">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Filter UMKM</h3>
            <button @click="open = !open" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                <svg class="w-5 h-5" x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                </svg>
                <svg class="w-5 h-5" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
        
        <div x-show="open" x-collapse>
            <div class="space-y-3">
                <!-- Search -->
                <div>
                    <input type="text" id="searchInput" placeholder="Cari nama UMKM..." class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Kecamatan Filter -->
                <div>
                    <select id="kecamatanFilter" class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Kecamatan</option>
                    </select>
                </div>

                <!-- Kategori/Jenis Usaha Filter -->
                <div>
                    <select id="kategoriFilter" class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <select id="statusFilter" class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="verified">Terverifikasi</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <!-- Stats -->
                <div class="pt-3 border-t border-gray-200">
                    <div class="grid grid-cols-2 gap-2 text-center">
                        <div class="bg-blue-50 rounded-lg p-2">
                            <div class="text-xl font-bold text-blue-600" id="totalCount">0</div>
                            <div class="text-xs text-gray-600">Total</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-2">
                            <div class="text-xl font-bold text-green-600" id="verifiedCount">0</div>
                            <div class="text-xs text-gray-600">Verified</div>
                        </div>
                    </div>
                </div>

                <!-- Legend -->
                <div class="pt-3 border-t border-gray-200">
                    <p class="text-xs font-semibold text-gray-700 mb-2">Legend:</p>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            <span class="text-gray-600">Terverifikasi</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                            <span class="text-gray-600">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div id="map"></div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script>
let map;
let markers = L.markerClusterGroup({
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true
});
let allUmkm = [];
let kecamatanSet = new Set();
let kategoriSet = new Set();

// Initialize map
function initMap() {
    map = L.map('map').setView([-7.250445, 112.768845], 13); // Surabaya coordinates
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);
    
    map.addLayer(markers);
    
    // Load UMKM data
    loadUmkmData();
}

// Load UMKM data from API
async function loadUmkmData() {
    try {
        const response = await fetch('{{ route('map.data') }}');
        const data = await response.json();
        allUmkm = data;
        
        // Extract unique kecamatan and kategori
        data.forEach(umkm => {
            if (umkm.kecamatan) {
                kecamatanSet.add(umkm.kecamatan);
            }
            if (umkm.jenis_usaha) {
                kategoriSet.add(umkm.jenis_usaha);
            }
        });
        
        // Populate kecamatan dropdown
        const kecamatanFilter = document.getElementById('kecamatanFilter');
        Array.from(kecamatanSet).sort().forEach(kec => {
            const option = document.createElement('option');
            option.value = kec;
            option.textContent = kec;
            kecamatanFilter.appendChild(option);
        });
        
        // Populate kategori dropdown
        const kategoriFilter = document.getElementById('kategoriFilter');
        Array.from(kategoriSet).sort().forEach(kat => {
            const option = document.createElement('option');
            option.value = kat;
            option.textContent = kat.charAt(0).toUpperCase() + kat.slice(1);
            kategoriFilter.appendChild(option);
        });
        
        // Display all markers
        displayMarkers(data);
        updateStats(data);
    } catch (error) {
        console.error('Error loading UMKM data:', error);
    }
}

// Display markers on map
function displayMarkers(umkmList) {
    markers.clearLayers();
    
    umkmList.forEach(umkm => {
        if (umkm.latitude && umkm.longitude) {
            const icon = L.divIcon({
                className: 'custom-marker',
                html: `<div style="background-color: ${umkm.is_verified ? '#22c55e' : '#eab308'}; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
                iconSize: [12, 12]
            });
            
            const marker = L.marker([umkm.latitude, umkm.longitude], { icon })
                .bindPopup(createPopupContent(umkm));
            
            markers.addLayer(marker);
        }
    });
    
    // Fit bounds if there are markers
    if (markers.getLayers().length > 0) {
        map.fitBounds(markers.getBounds(), { padding: [50, 50] });
    }
}

// Create popup content
function createPopupContent(umkm) {
    const statusBadge = umkm.is_verified 
        ? '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Terverifikasi</span>'
        : '<span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>';
    
    return `
        <div class="space-y-2">
            <div>
                <h4 class="font-bold text-gray-900 text-base mb-1">${umkm.nama_usaha}</h4>
                ${statusBadge}
            </div>
            <div class="text-sm text-gray-600 space-y-1">
                <div class="flex items-start">
                    <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>${umkm.kelurahan}, ${umkm.kecamatan}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>${umkm.jumlah_tenaga_kerja} Tenaga Kerja</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Rp ${new Intl.NumberFormat('id-ID').format(umkm.omzet_bulanan)}/bulan</span>
                </div>
            </div>
            @auth
                @if(auth()->user()->role === 'admin')
                <div class="pt-2 border-t border-gray-200">
                    <a href="/admin/umkm/${umkm.id}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Detail →
                    </a>
                </div>
                @endif
            @endauth
        </div>
    `;
}

// Filter markers
function filterMarkers() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const kecamatan = document.getElementById('kecamatanFilter').value;
    const kategori = document.getElementById('kategoriFilter').value;
    const status = document.getElementById('statusFilter').value;
    
    const filtered = allUmkm.filter(umkm => {
        const matchSearch = !search || umkm.nama_usaha.toLowerCase().includes(search);
        const matchKecamatan = !kecamatan || umkm.kecamatan === kecamatan;
        const matchKategori = !kategori || umkm.jenis_usaha === kategori;
        const matchStatus = !status || 
            (status === 'verified' && umkm.is_verified) || 
            (status === 'pending' && !umkm.is_verified);
        
        return matchSearch && matchKecamatan && matchKategori && matchStatus;
    });
    
    displayMarkers(filtered);
    updateStats(filtered);
}

// Update stats
function updateStats(umkmList) {
    const total = umkmList.length;
    const verified = umkmList.filter(u => u.is_verified).length;
    
    document.getElementById('totalCount').textContent = total;
    document.getElementById('verifiedCount').textContent = verified;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    initMap();
    
    document.getElementById('searchInput').addEventListener('input', filterMarkers);
    document.getElementById('kecamatanFilter').addEventListener('change', filterMarkers);
    document.getElementById('kategoriFilter').addEventListener('change', filterMarkers);
    document.getElementById('statusFilter').addEventListener('change', filterMarkers);
});
</script>
@endpush
