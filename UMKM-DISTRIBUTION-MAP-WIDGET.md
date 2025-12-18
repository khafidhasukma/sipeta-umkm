# Widget Peta Distribusi UMKM (GIS)

## Deskripsi

Widget Filament untuk visualisasi geografis distribusi UMKM dan sentra produksi menggunakan Leaflet.js yang terintegrasi dengan Alpine.js dan Livewire untuk interaktivitas real-time.

## Lokasi File

### Widget Class

-   **Path**: [app/Filament/Umkm/Widgets/UmkmDistributionMap.php](app/Filament/Umkm/Widgets/UmkmDistributionMap.php)

### View Blade

-   **Path**: [resources/views/filament/umkm/widgets/umkm-distribution-map.blade.php](resources/views/filament/umkm/widgets/umkm-distribution-map.blade.php)

### Dashboard Page

-   **Path**: [app/Filament/Umkm/Pages/Dashboard.php](app/Filament/Umkm/Pages/Dashboard.php)

## Fitur Utama

### 1. **Visualisasi Peta Interaktif**

-   ✅ Peta dasar OpenStreetMap centered di Kota Semarang
-   ✅ Zoom & pan controls
-   ✅ Responsive design (600px height)
-   ✅ Dark mode support

### 2. **Marker UMKM**

-   🔵 **Biru**: UMKM individual (tidak dalam sentra)
-   🟢 **Hijau**: UMKM yang tergabung dalam sentra
-   **Popup** berisi:
    -   Nama usaha
    -   Lokasi (kelurahan, kecamatan)
    -   Omzet bulanan (formatted)
    -   Daftar bahan baku
    -   Link ke detail page

### 3. **Polygon Sentra Produksi**

-   🔴 **Merah**: Area sentra dengan opacity 20%
-   Border merah solid
-   **Popup** berisi:
    -   Nama sentra
    -   Jenis komoditas
    -   Jumlah anggota UMKM

### 4. **Filter Interaktif**

-   Dropdown Filament Select Component
-   Filter berdasarkan jenis sentra/komoditas
-   **Livewire Reactivity**: Update peta tanpa reload halaman
-   Reset filter dengan memilih "Semua Sentra"

### 5. **Legenda Peta**

-   Penjelasan warna marker
-   Penjelasan polygon
-   Counter total UMKM yang ditampilkan (real-time)

## Teknologi Stack

### Frontend

-   **Leaflet.js 1.9.4**: Library peta open-source
-   **Alpine.js**: JavaScript reactivity (included with Livewire)
-   **Tailwind CSS 4**: Styling

### Backend

-   **Livewire 3**: Real-time updates
-   **Filament 4**: Panel framework
-   **ClusteringService**: Data provider

## Data Flow

```
┌─────────────────────────────────────────┐
│   ClusteringService::getMapData()       │
│   Returns GeoJSON FeatureCollection     │
└──────────────┬──────────────────────────┘
               │
               ▼
┌─────────────────────────────────────────┐
│   UmkmDistributionMap Widget            │
│   - Filters data                         │
│   - Manages Livewire state              │
└──────────────┬──────────────────────────┘
               │
               ▼
┌─────────────────────────────────────────┐
│   Blade View (Alpine.js)                │
│   - Renders Leaflet map                 │
│   - Handles user interactions           │
│   - Updates on Livewire events          │
└─────────────────────────────────────────┘
```

## Penggunaan

### Akses Dashboard

```
URL: http://your-app.test/umkm
```

Widget akan otomatis tampil di dashboard panel UMKM (full-width).

### Filter Sentra

1. Klik dropdown "Filter Jenis Sentra" di kanan atas
2. Pilih komoditas (e.g., "Fashion & Tekstil")
3. Peta akan langsung ter-update menampilkan:
    - Hanya UMKM yang menggunakan bahan baku tersebut
    - Hanya polygon sentra dengan komoditas tersebut

### Interaksi Peta

1. **Klik Marker UMKM**:
    - Popup muncul dengan detail
    - Klik "Lihat Detail →" untuk ke halaman resource
2. **Klik Polygon Sentra**:

    - Popup muncul dengan info sentra
    - Menunjukkan total anggota

3. **Zoom/Pan**:
    - Scroll untuk zoom
    - Drag untuk pan
    - Auto-fit bounds ketika filter berubah

## Konfigurasi

### Mengubah Center Point Peta

Edit koordinat default di view Blade:

```javascript
this.map = L.map(this.$refs.mapContainer).setView(
    [-7.0051, 110.4381], // [latitude, longitude]
    12 // zoom level
);
```

### Mengubah Warna Marker

Edit di method `renderUmkmMarker()`:

```javascript
const markerColor = isInCluster ? "green" : "blue";
// Ubah menjadi warna lain: 'red', 'orange', 'yellow', dll
```

### Mengubah Tinggi Peta

Edit di Blade view:

```blade
<div
    x-ref="mapContainer"
    class="w-full h-[600px]"  <!-- Ubah 600px sesuai kebutuhan -->
>
```

### Menambah Widget ke Dashboard Lain

Edit file Dashboard page:

```php
public function getWidgets(): array
{
    return [
        UmkmDistributionMap::class,
        // ... widget lain
    ];
}
```

## Event Livewire

### Dispatch Event (dari Widget)

```php
$this->dispatch('mapDataUpdated', mapData: $this->mapData);
```

### Listen Event (di Alpine.js)

```javascript
@map-data-updated.window="updateMapData($event.detail.mapData)"
```

## Troubleshooting

### Map tidak muncul

1. Pastikan CDN Leaflet.js terload:

    ```html
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    ```

2. Check console browser untuk error JavaScript

### Marker tidak muncul

1. Pastikan UMKM memiliki koordinat valid (latitude & longitude)
2. Cek data dengan:
    ```bash
    php artisan tinker
    >>> App\Models\UmkmProfile::whereNotNull('latitude')->count()
    ```

### Filter tidak berfungsi

1. Pastikan Livewire property `$selectedCluster` public
2. Check method `updateMapData()` di-trigger saat filter berubah
3. Verify event `mapDataUpdated` di-dispatch

### Polygon tidak terlihat

1. Pastikan ada data di `production_clusters`
2. Jalankan analisis clustering:
    ```bash
    php artisan app:analyze-clusters
    ```
3. Polygon kosong jika koordinat tidak valid

## Pengembangan Lebih Lanjut

### 1. Heatmap Layer

Tambahkan Leaflet.heat plugin untuk density visualization:

```javascript
L.heatLayer(coordinates, { radius: 25 }).addTo(this.map);
```

### 2. Clustering Markers

Gunakan Leaflet.markercluster untuk group markers:

```javascript
var markers = L.markerClusterGroup();
```

### 3. Export Map

Tambahkan tombol export ke PNG/PDF:

```javascript
leaflet-image atau html2canvas
```

### 4. Search Box

Tambahkan autocomplete search untuk cari UMKM:

```javascript
L.Control.geocoder().addTo(this.map);
```

### 5. Layer Control

Toggle multiple layers (UMKM, Sentra, Heatmap):

```javascript
L.control.layers(baseMaps, overlays).addTo(this.map);
```

## Performance Tips

1. **Lazy Loading**: Widget hanya load ketika dashboard dibuka
2. **Caching**: Cache GeoJSON data di ClusteringService jika perlu
3. **Pagination**: Jika >1000 markers, gunakan clustering atau viewport filtering
4. **CDN**: Leaflet.js loaded dari CDN (fast delivery)

## Lisensi & Credits

-   **Leaflet.js**: BSD 2-Clause License
-   **OpenStreetMap**: Open Data Commons Open Database License (ODbL)
-   **Filament**: MIT License

---

**Dibuat pada**: 17 Desember 2025  
**Update Terakhir**: 17 Desember 2025  
**Versi**: 1.0.0
