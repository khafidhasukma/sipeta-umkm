# 🗄️ Database Schema - SIPETA-UMKM

## 📊 Entity Relationship Diagram (ERD)

```
┌─────────────────────────┐
│       users             │
│─────────────────────────│
│ id (UUID) PK            │◄───────────┐
│ name                    │            │ 1:1
│ email (unique)          │            │
│ password                │            │
│ role (enum)             │            │
│ nib (unique, nullable)  │            │
│ is_active (boolean)     │            │
│ created_at              │            │
│ updated_at              │            │
└─────────────────────────┘            │
                                       │
┌──────────────────────────────────────┴────┐
│         umkm_profiles                     │
│───────────────────────────────────────────│
│ id (UUID) PK                              │◄───────┐
│ user_id (UUID) FK UNIQUE                  │        │
│ nama_usaha (indexed)                      │        │ 1:M
│ alamat_lengkap                            │        │
│ kecamatan (indexed)                       │        │
│ kelurahan                                 │        │
│ latitude (decimal 10,8)                   │        │
│ longitude (decimal 11,8)                  │        │
│ omzet_bulanan (decimal 15,2)              │        │
│ jumlah_tenaga_kerja (integer)             │        │
│ is_verified (boolean)                     │        │
│ verified_at (timestamp)                   │        │
│ created_at                                │        │
│ updated_at                                │        │
└───────────────────────────────────────────┘        │
                                                     │
        ┌────────────────────────────────────────────┤
        │                                            │
        │                                            │
        ▼                                            ▼
┌────────────────────────────────┐    ┌────────────────────────────────┐
│    production_tools            │    │     raw_materials              │
│────────────────────────────────│    │────────────────────────────────│
│ id (UUID) PK                   │    │ id (UUID) PK                   │
│ umkm_profile_id (UUID) FK      │    │ umkm_profile_id (UUID) FK      │
│ nama_alat                      │    │ nama_bahan                     │
│ jenis                          │    │ kebutuhan_per_bulan (decimal)  │
│ kapasitas                      │    │ satuan                         │
│ kondisi (enum)                 │    │ asal_supplier                  │
│ status_kepemilikan (enum)      │    │ created_at                     │
│ created_at                     │    │ updated_at                     │
│ updated_at                     │    │                                │
└────────────────────────────────┘    └────────────────────────────────┘


┌──────────────────────────────────────┐
│    production_clusters               │
│──────────────────────────────────────│
│ id (UUID) PK                         │
│ nama_sentra (indexed)                │
│ jenis_komoditas (indexed)            │
│ polygon_json (longText)              │
│ total_member (integer)               │
│ created_at                           │
│ updated_at                           │
└──────────────────────────────────────┘
(Standalone - untuk analisis spasial)
```

---

## 📋 Daftar Tabel

### 1. users

**Deskripsi**: Tabel autentikasi dan otorisasi pengguna sistem.

| Kolom             | Tipe      | Constraint       | Deskripsi              |
| ----------------- | --------- | ---------------- | ---------------------- |
| id                | uuid      | PRIMARY KEY      | Unique identifier      |
| name              | string    | NOT NULL         | Nama lengkap pengguna  |
| email             | string    | UNIQUE, NOT NULL | Email login            |
| password          | string    | NOT NULL         | Password hash          |
| role              | enum      | DEFAULT 'umkm'   | Role: 'admin', 'umkm'  |
| nib               | string    | UNIQUE, NULLABLE | Nomor Induk Berusaha   |
| is_active         | boolean   | DEFAULT true     | Status aktif pengguna  |
| email_verified_at | timestamp | NULLABLE         | Waktu verifikasi email |
| remember_token    | string    | NULLABLE         | Token remember me      |
| created_at        | timestamp | NOT NULL         | Waktu dibuat           |
| updated_at        | timestamp | NOT NULL         | Waktu diupdate         |

**Indexes**:

-   PRIMARY: `id`
-   UNIQUE: `email`, `nib`

---

### 2. umkm_profiles

**Deskripsi**: Profil lengkap UMKM (One-to-One dengan users).

| Kolom               | Tipe          | Constraint          | Deskripsi            |
| ------------------- | ------------- | ------------------- | -------------------- |
| id                  | uuid          | PRIMARY KEY         | Unique identifier    |
| user_id             | uuid          | FOREIGN KEY, UNIQUE | Relasi ke users      |
| nama_usaha          | string        | NOT NULL, INDEXED   | Nama usaha/brand     |
| alamat_lengkap      | text          | NOT NULL            | Alamat detail        |
| kecamatan           | string        | NOT NULL, INDEXED   | Nama kecamatan       |
| kelurahan           | string        | NOT NULL            | Nama kelurahan       |
| latitude            | decimal(10,8) | NULLABLE            | Koordinat lintang    |
| longitude           | decimal(11,8) | NULLABLE            | Koordinat bujur      |
| omzet_bulanan       | decimal(15,2) | NULLABLE            | Omzet per bulan (Rp) |
| jumlah_tenaga_kerja | integer       | DEFAULT 0           | Jumlah karyawan      |
| is_verified         | boolean       | DEFAULT false       | Status verifikasi    |
| verified_at         | timestamp     | NULLABLE            | Waktu diverifikasi   |
| created_at          | timestamp     | NOT NULL            | Waktu dibuat         |
| updated_at          | timestamp     | NOT NULL            | Waktu diupdate       |

**Indexes**:

-   PRIMARY: `id`
-   UNIQUE: `user_id`
-   INDEX: `nama_usaha`, `kecamatan`
-   COMPOSITE INDEX: `(kecamatan, kelurahan)`

**Foreign Keys**:

-   `user_id` → `users.id` (CASCADE DELETE)

---

### 3. production_tools

**Deskripsi**: Data alat produksi UMKM (One-to-Many dengan umkm_profiles).

| Kolom              | Tipe      | Constraint              | Deskripsi                                        |
| ------------------ | --------- | ----------------------- | ------------------------------------------------ |
| id                 | uuid      | PRIMARY KEY             | Unique identifier                                |
| umkm_profile_id    | uuid      | FOREIGN KEY             | Relasi ke umkm_profiles                          |
| nama_alat          | string    | NOT NULL                | Nama alat produksi                               |
| jenis              | string    | NOT NULL                | Kategori alat                                    |
| kapasitas          | string    | NULLABLE                | Kapasitas produksi                               |
| kondisi            | enum      | DEFAULT 'baik'          | baik, rusak ringan, rusak berat, perlu perbaikan |
| status_kepemilikan | enum      | DEFAULT 'milik sendiri' | milik sendiri, sewa, pinjam, hibah               |
| created_at         | timestamp | NOT NULL                | Waktu dibuat                                     |
| updated_at         | timestamp | NOT NULL                | Waktu diupdate                                   |

**Indexes**:

-   PRIMARY: `id`
-   INDEX: `umkm_profile_id`
-   COMPOSITE INDEX: `(umkm_profile_id, jenis)`

**Foreign Keys**:

-   `umkm_profile_id` → `umkm_profiles.id` (CASCADE DELETE)

---

### 4. raw_materials

**Deskripsi**: Data bahan baku UMKM (One-to-Many dengan umkm_profiles).

| Kolom               | Tipe          | Constraint  | Deskripsi                      |
| ------------------- | ------------- | ----------- | ------------------------------ |
| id                  | uuid          | PRIMARY KEY | Unique identifier              |
| umkm_profile_id     | uuid          | FOREIGN KEY | Relasi ke umkm_profiles        |
| nama_bahan          | string        | NOT NULL    | Nama bahan baku                |
| kebutuhan_per_bulan | decimal(12,2) | NOT NULL    | Jumlah kebutuhan/bulan         |
| satuan              | string        | NOT NULL    | Satuan ukuran (kg, liter, pcs) |
| asal_supplier       | string        | NULLABLE    | Nama/lokasi supplier           |
| created_at          | timestamp     | NOT NULL    | Waktu dibuat                   |
| updated_at          | timestamp     | NOT NULL    | Waktu diupdate                 |

**Indexes**:

-   PRIMARY: `id`
-   INDEX: `umkm_profile_id`
-   COMPOSITE INDEX: `(umkm_profile_id, nama_bahan)`

**Foreign Keys**:

-   `umkm_profile_id` → `umkm_profiles.id` (CASCADE DELETE)

---

### 5. production_clusters

**Deskripsi**: Data sentra/cluster produksi untuk analisis spasial.

| Kolom           | Tipe      | Constraint        | Deskripsi            |
| --------------- | --------- | ----------------- | -------------------- |
| id              | uuid      | PRIMARY KEY       | Unique identifier    |
| nama_sentra     | string    | NOT NULL, INDEXED | Nama sentra/cluster  |
| jenis_komoditas | string    | NOT NULL, INDEXED | Komoditas unggulan   |
| polygon_json    | longText  | NULLABLE          | GeoJSON polygon area |
| total_member    | integer   | DEFAULT 0         | Jumlah anggota UMKM  |
| created_at      | timestamp | NOT NULL          | Waktu dibuat         |
| updated_at      | timestamp | NOT NULL          | Waktu diupdate       |

**Indexes**:

-   PRIMARY: `id`
-   INDEX: `nama_sentra`, `jenis_komoditas`
-   COMPOSITE INDEX: `(jenis_komoditas, total_member)`

**Note**: Tabel standalone untuk analisis, tidak memiliki foreign key.

---

## 🔗 Relasi Antar Tabel

### One-to-One

-   `users` ←→ `umkm_profiles`
    -   1 User memiliki 1 UMKM Profile
    -   1 UMKM Profile dimiliki oleh 1 User
    -   Cascade: DELETE user → DELETE umkm_profile

### One-to-Many

-   `umkm_profiles` → `production_tools`

    -   1 UMKM Profile memiliki banyak Alat Produksi
    -   Cascade: DELETE umkm_profile → DELETE production_tools

-   `umkm_profiles` → `raw_materials`
    -   1 UMKM Profile memiliki banyak Bahan Baku
    -   Cascade: DELETE umkm_profile → DELETE raw_materials

### Standalone

-   `production_clusters`
    -   Tidak memiliki relasi langsung
    -   Digunakan untuk analisis spasial dan clustering

---

## 📊 Contoh Query

### Query UMKM berdasarkan Kecamatan

```sql
SELECT
    u.name,
    up.nama_usaha,
    up.kecamatan,
    up.omzet_bulanan
FROM umkm_profiles up
JOIN users u ON up.user_id = u.id
WHERE up.kecamatan = 'Sukolilo'
  AND up.is_verified = 1;
```

### Query Alat Produksi per UMKM

```sql
SELECT
    up.nama_usaha,
    pt.nama_alat,
    pt.kondisi,
    pt.status_kepemilikan
FROM production_tools pt
JOIN umkm_profiles up ON pt.umkm_profile_id = up.id
WHERE up.nama_usaha LIKE '%Batik%';
```

### Query Kebutuhan Bahan Baku

```sql
SELECT
    up.nama_usaha,
    rm.nama_bahan,
    rm.kebutuhan_per_bulan,
    rm.satuan,
    rm.asal_supplier
FROM raw_materials rm
JOIN umkm_profiles up ON rm.umkm_profile_id = up.id
WHERE up.kecamatan = 'Gubeng'
ORDER BY rm.kebutuhan_per_bulan DESC;
```

### Query Clustering Berdasarkan Komoditas

```sql
SELECT
    jenis_komoditas,
    COUNT(*) as jumlah_sentra,
    SUM(total_member) as total_umkm
FROM production_clusters
GROUP BY jenis_komoditas
ORDER BY total_umkm DESC;
```

---

## 🎯 Use Cases

### 1. Registrasi UMKM Baru

```
1. Create User (role: 'umkm')
2. Create UMKM Profile (one-to-one)
3. Add Production Tools (optional)
4. Add Raw Materials (optional)
```

### 2. Verifikasi UMKM oleh Admin

```
1. Update umkm_profiles:
   - is_verified = true
   - verified_at = now()
```

### 3. Analisis Spasial

```
1. Ambil semua umkm_profiles dengan latitude/longitude
2. Clustering berdasarkan jenis komoditas
3. Create/Update production_clusters dengan polygon area
```

### 4. Laporan Kebutuhan Bahan Baku

```
1. Join umkm_profiles + raw_materials
2. Group by kecamatan atau jenis bahan
3. Aggregate kebutuhan per bulan
```

---

## ⚡ Performance Optimization

### Indexes yang Sudah Dibuat

1. **users**: `email`, `nib`
2. **umkm_profiles**: `nama_usaha`, `kecamatan`, `(kecamatan, kelurahan)`
3. **production_tools**: `umkm_profile_id`, `(umkm_profile_id, jenis)`
4. **raw_materials**: `umkm_profile_id`, `(umkm_profile_id, nama_bahan)`
5. **production_clusters**: `nama_sentra`, `jenis_komoditas`, `(jenis_komoditas, total_member)`

### Query Optimization Tips

-   ✅ Gunakan eager loading untuk relasi (Eloquent)
-   ✅ Index pada kolom yang sering di-WHERE atau JOIN
-   ✅ Composite index untuk query multi-kolom
-   ✅ Pagination untuk dataset besar
-   ✅ Cache query yang sering diakses

---

## 🔐 Data Security

### Cascade Delete Protection

-   DELETE user → CASCADE DELETE umkm_profile
-   DELETE umkm_profile → CASCADE DELETE production_tools
-   DELETE umkm_profile → CASCADE DELETE raw_materials

**⚠️ Warning**: Hapus user akan menghapus semua data terkait!

### Soft Delete (Future Enhancement)

Pertimbangkan menambahkan `deleted_at` untuk:

-   users
-   umkm_profiles
-   production_tools
-   raw_materials

---

## 📝 Migration Files

Migration telah dibuat di:

-   `0001_01_01_000000_create_users_table.php`
-   `2025_12_17_112226_create_umkm_profiles_table.php`
-   `2025_12_17_112233_create_production_tools_table.php`
-   `2025_12_17_112239_create_raw_materials_table.php`
-   `2025_12_17_112243_create_production_clusters_table.php`

**Jalankan Migration**:

```bash
php artisan migrate
```

**Reset Migration**:

```bash
php artisan migrate:fresh
```

---

## 🎓 Next Steps

1. Buat Model untuk setiap tabel
2. Define relationships di Model
3. Buat Factory & Seeder untuk testing
4. Buat Filament Resources
5. Implement validasi & authorization

---

**Database Version**: 1.0  
**Created**: 17 Desember 2025  
**Status**: ✅ Verified & Tested
