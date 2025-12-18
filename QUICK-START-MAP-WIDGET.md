# Quick Start - Widget Peta Distribusi UMKM

## Langkah Setup & Testing

### 1. Pastikan Data Tersedia

```bash
# Cek jumlah UMKM dengan koordinat
php artisan tinker --execute="echo App\Models\UmkmProfile::whereNotNull('latitude')->count();"

# Jika belum ada data, jalankan seeder
php artisan db:seed
```

### 2. Generate Sentra Produksi

```bash
# Jalankan analisis clustering
php artisan app:analyze-clusters
```

Output yang diharapkan:

```
🔍 Memulai analisis sentra produksi...

   INFO  Analisis selesai!

+-----------------------+--------+
| Metrik                | Jumlah |
+-----------------------+--------+
| Sentra Baru Dibuat    | X      |
| Sentra Diperbarui     | X      |
| Total Kandidat Sentra | X      |
+-----------------------+--------+
```

### 3. Jalankan Development Server

```bash
# Jalankan server Laravel
php artisan serve

# Atau jika menggunakan Laragon
# http://sipeta-umkm.test
```

### 4. Login ke Panel UMKM

```
URL: http://localhost:8000/umkm
atau: http://sipeta-umkm.test/umkm

Credentials:
- Gunakan user yang sudah dibuat via seeder
- Atau register user baru
```

### 5. Akses Dashboard

Setelah login, Anda akan langsung masuk ke dashboard yang menampilkan:

-   ✅ Widget Peta Distribusi UMKM (full-width)
-   ✅ Marker UMKM (biru/hijau)
-   ✅ Polygon Sentra Produksi (merah)
-   ✅ Filter dropdown di kanan atas

### 6. Test Fitur Interaktif

#### A. Klik Marker UMKM

-   Popup akan muncul dengan detail UMKM
-   Klik "Lihat Detail →" untuk masuk ke halaman resource

#### B. Klik Polygon Sentra

-   Popup menampilkan info sentra produksi
-   Nama sentra, komoditas, jumlah anggota

#### C. Gunakan Filter

1. Klik dropdown "Filter Jenis Sentra"
2. Pilih salah satu komoditas (e.g., "Fashion & Tekstil")
3. Peta akan langsung update tanpa reload
4. Hanya UMKM & sentra terkait yang ditampilkan

#### D. Reset Filter

-   Pilih "Semua Sentra" atau kosongkan filter
-   Semua data akan tampil kembali

### 7. Debugging (Jika Ada Masalah)

#### Peta tidak muncul

```bash
# Clear cache
php artisan optimize:clear

# Check Filament cache
php artisan filament:clear-cached-components
```

#### JavaScript error

-   Buka Developer Console (F12)
-   Cek apakah Leaflet.js terload
-   Pastikan tidak ada conflict dengan library lain

#### Data tidak muncul

```bash
# Verify data di ClusteringService
php artisan tinker
>>> use App\Services\ClusteringService;
>>> $service = new ClusteringService;
>>> $data = $service->getMapData();
>>> echo count($data['features']);
```

#### Widget tidak terdaftar

```bash
# Clear Filament cache
php artisan filament:optimize-clear

# Rebuild assets
npm run build
```

## Verifikasi Lengkap

Jalankan checklist ini untuk memastikan semua berfungsi:

-   [ ] Dashboard `/umkm` bisa diakses
-   [ ] Widget "Peta Sebaran UMKM & Sentra Produksi" tampil
-   [ ] Peta Leaflet ter-render dengan benar
-   [ ] Marker UMKM muncul di peta
-   [ ] Polygon sentra muncul (jika ada)
-   [ ] Popup marker berfungsi saat diklik
-   [ ] Dropdown filter tampil di header widget
-   [ ] Filter bisa dipilih dan mengupdate peta
-   [ ] Legenda ditampilkan dengan benar
-   [ ] Counter "Total UMKM" update real-time
-   [ ] Link "Lihat Detail" mengarah ke resource yang benar
-   [ ] Zoom & pan peta berfungsi normal

## Troubleshooting Cepat

| Masalah              | Solusi                                       |
| -------------------- | -------------------------------------------- |
| Peta putih/blank     | Cek console untuk error Leaflet.js           |
| Marker tidak ada     | Pastikan UMKM punya latitude/longitude       |
| Polygon kosong       | Jalankan `php artisan app:analyze-clusters`  |
| Filter tidak reaktif | Clear browser cache, pastikan Livewire aktif |
| Style berantakan     | Jalankan `npm run build`                     |

## Next Steps

Setelah widget berfungsi dengan baik:

1. **Customize Styling**: Edit warna, ukuran sesuai branding
2. **Tambah Layer**: Heatmap, clustering, dll
3. **Export Feature**: Tambahkan tombol export map
4. **Analytics**: Integrasikan dengan widget statistik lain
5. **Performance**: Optimize untuk data dalam jumlah besar

---

**Need Help?**  
Lihat dokumentasi lengkap di [UMKM-DISTRIBUTION-MAP-WIDGET.md](UMKM-DISTRIBUTION-MAP-WIDGET.md)
