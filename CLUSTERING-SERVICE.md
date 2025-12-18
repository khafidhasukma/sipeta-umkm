# Clustering Service - Analisis Sentra Produksi

## Deskripsi

ClusteringService adalah service untuk menganalisis dan mengidentifikasi sentra produksi berdasarkan bahan baku yang digunakan oleh UMKM di setiap kecamatan.

## Logika Bisnis

### 1. Analisis Clustering (`analyze()`)

-   Mengambil data `raw_materials` dari seluruh UMKM
-   Melakukan grouping berdasarkan `kecamatan` dan `nama_bahan`
-   **Aturan Threshold**: Jika di satu kecamatan terdapat ≥15 UMKM yang menggunakan bahan baku yang sama, maka kecamatan tersebut diidentifikasi sebagai "Kandidat Sentra"
-   Membuat polygon area sentra menggunakan algoritma Convex Hull
-   Menyimpan hasil ke tabel `production_clusters`

### 2. Data GeoJSON (`getMapData()`)

-   Mengembalikan data dalam format GeoJSON
-   Berisi:
    -   **Point Features**: Koordinat setiap UMKM
    -   **Polygon Features**: Area sentra produksi
-   Siap digunakan untuk visualisasi peta (Leaflet, Mapbox, Google Maps, dll)

### 3. Statistik (`getStatistics()`)

-   Total sentra produksi
-   Total UMKM dalam sentra
-   Top 5 komoditas berdasarkan jumlah UMKM

## Penggunaan

### Via Artisan Command

```bash
php artisan app:analyze-clusters
```

Output:

```
🔍 Memulai analisis sentra produksi...

   INFO  Analisis selesai!

+-----------------------+--------+
| Metrik                | Jumlah |
+-----------------------+--------+
| Sentra Baru Dibuat    | 3      |
| Sentra Diperbarui     | 2      |
| Total Kandidat Sentra | 5      |
+-----------------------+--------+

   INFO  Statistik Clustering:

Total Sentra Produksi: 8
Total UMKM dalam Sentra: 127
Threshold Minimum: 15 UMKM
```

### Via Controller/Service

```php
use App\Services\ClusteringService;

class ClusterController
{
    public function __construct(private ClusteringService $clusteringService)
    {
    }

    public function analyze()
    {
        $result = $this->clusteringService->analyze();

        return response()->json([
            'message' => 'Analisis berhasil',
            'data' => $result,
        ]);
    }

    public function mapData()
    {
        $geoJson = $this->clusteringService->getMapData();

        return response()->json($geoJson);
    }

    public function statistics()
    {
        $stats = $this->clusteringService->getStatistics();

        return response()->json($stats);
    }
}
```

### Contoh Response GeoJSON

```json
{
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [110.4203, -7.7956]
            },
            "properties": {
                "id": 1,
                "nama_usaha": "Batik Kusuma",
                "kecamatan": "Laweyan",
                "raw_materials": ["Kain Mori", "Pewarna Alami"]
            }
        },
        {
            "type": "Feature",
            "geometry": {
                "type": "Polygon",
                "coordinates": [
                    [
                        [110.41, -7.79],
                        [110.42, -7.79],
                        [110.42, -7.8],
                        [110.41, -7.8]
                    ]
                ]
            },
            "properties": {
                "id": 1,
                "nama_sentra": "Laweyan - Kain Batik",
                "jenis_komoditas": "Kain Batik",
                "total_member": 23
            }
        }
    ]
}
```

## Algoritma

### Convex Hull (Gift Wrapping)

Service menggunakan algoritma Gift Wrapping untuk membuat polygon dari sekumpulan titik koordinat UMKM. Algoritma ini:

1. Mencari titik paling kiri (longitude terkecil)
2. Membuat hull dengan memilih titik yang membentuk sudut counter-clockwise
3. Menghasilkan polygon yang melingkupi semua titik UMKM

## Threshold Configuration

Default threshold adalah **15 UMKM**. Untuk mengubah, edit konstanta di `ClusteringService`:

```php
private const CLUSTER_THRESHOLD = 15; // Ubah sesuai kebutuhan
```

## Scheduled Task (Opsional)

Untuk menjalankan analisis secara otomatis, tambahkan ke `routes/console.php`:

```php
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:analyze-clusters')->daily();
```

## Catatan

-   Sentra hanya dibuat jika memiliki minimal 3 UMKM dengan koordinat valid
-   Data yang sama akan di-update, bukan duplikat
-   Polygon disimpan dalam format GeoJSON standar untuk kompatibilitas dengan berbagai library peta
