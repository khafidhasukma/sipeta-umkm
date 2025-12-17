# 🚀 Database Migration Quick Reference

## ✅ Migration Status

**Status**: ✅ ALL MIGRATIONS COMPLETE & VERIFIED

### Migration Files Created

1. ✅ `0001_01_01_000000_create_users_table.php` - Updated with UUID + role
2. ✅ `2025_12_17_112226_create_umkm_profiles_table.php` - UMKM Profile (One-to-One)
3. ✅ `2025_12_17_112233_create_production_tools_table.php` - Alat Produksi (One-to-Many)
4. ✅ `2025_12_17_112239_create_raw_materials_table.php` - Bahan Baku (One-to-Many)
5. ✅ `2025_12_17_112243_create_production_clusters_table.php` - Sentra Produksi (Standalone)

---

## 📋 Tabel yang Telah Dibuat

### 1. users (Updated)

```php
- id (UUID) PRIMARY KEY
- name, email (unique), password
- role (enum: 'admin', 'umkm') DEFAULT 'umkm'
- nib (unique, nullable) - Nomor Induk Berusaha
- is_active (boolean) DEFAULT true
- timestamps
```

### 2. umkm_profiles (NEW)

```php
- id (UUID) PRIMARY KEY
- user_id (UUID) FK UNIQUE → users.id CASCADE DELETE
- nama_usaha (indexed), alamat_lengkap
- kecamatan (indexed), kelurahan
- latitude (decimal 10,8), longitude (decimal 11,8)
- omzet_bulanan (decimal 15,2), jumlah_tenaga_kerja (int)
- is_verified (boolean), verified_at (timestamp)
- timestamps
- COMPOSITE INDEX: (kecamatan, kelurahan)
```

### 3. production_tools (NEW)

```php
- id (UUID) PRIMARY KEY
- umkm_profile_id (UUID) FK → umkm_profiles.id CASCADE DELETE
- nama_alat, jenis, kapasitas
- kondisi (enum: baik, rusak ringan, rusak berat, perlu perbaikan)
- status_kepemilikan (enum: milik sendiri, sewa, pinjam, hibah)
- timestamps
- INDEX: umkm_profile_id
- COMPOSITE INDEX: (umkm_profile_id, jenis)
```

### 4. raw_materials (NEW)

```php
- id (UUID) PRIMARY KEY
- umkm_profile_id (UUID) FK → umkm_profiles.id CASCADE DELETE
- nama_bahan, kebutuhan_per_bulan (decimal), satuan, asal_supplier
- timestamps
- INDEX: umkm_profile_id
- COMPOSITE INDEX: (umkm_profile_id, nama_bahan)
```

### 5. production_clusters (NEW)

```php
- id (UUID) PRIMARY KEY
- nama_sentra (indexed), jenis_komoditas (indexed)
- polygon_json (longText), total_member (int)
- timestamps
- COMPOSITE INDEX: (jenis_komoditas, total_member)
```

---

## 🔗 Database Relationships

```
users (1) ←──→ (1) umkm_profiles
                    │
                    ├──→ (M) production_tools
                    └──→ (M) raw_materials

production_clusters (standalone)
```

---

## 🎯 Quick Commands

### Run Migrations

```bash
# Run all pending migrations
php artisan migrate

# Reset and re-run all migrations
php artisan migrate:fresh

# Reset + seed
php artisan migrate:fresh --seed
```

### Rollback Migrations

```bash
# Rollback last batch
php artisan migrate:rollback

# Rollback last 3 batches
php artisan migrate:rollback --step=3

# Reset all migrations
php artisan migrate:reset
```

### Check Migration Status

```bash
# Show migration status
php artisan migrate:status

# Show database info
php artisan db:show

# Show specific table
php artisan db:table users
```

---

## 📝 Data Seeding

### Admin User Seeder (Already exists)

```bash
php artisan db:seed --class=AdminUserSeeder
```

**Creates**:

-   Email: admin@sipeta.com
-   Password: password
-   Role: admin

---

## 🛠️ Next Steps: Create Models

### 1. Create UmkmProfile Model

```bash
php artisan make:model UmkmProfile
```

**Add to Model**:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UmkmProfile extends BaseModel
{
    protected $fillable = [
        'user_id', 'nama_usaha', 'alamat_lengkap', 'kecamatan', 'kelurahan',
        'latitude', 'longitude', 'omzet_bulanan', 'jumlah_tenaga_kerja',
        'is_verified', 'verified_at'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'omzet_bulanan' => 'decimal:2',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productionTools(): HasMany
    {
        return $this->hasMany(ProductionTool::class);
    }

    public function rawMaterials(): HasMany
    {
        return $this->hasMany(RawMaterial::class);
    }
}
```

### 2. Create ProductionTool Model

```bash
php artisan make:model ProductionTool
```

**Add to Model**:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionTool extends BaseModel
{
    protected $fillable = [
        'umkm_profile_id', 'nama_alat', 'jenis', 'kapasitas',
        'kondisi', 'status_kepemilikan'
    ];

    public function umkmProfile(): BelongsTo
    {
        return $this->belongsTo(UmkmProfile::class);
    }
}
```

### 3. Create RawMaterial Model

```bash
php artisan make:model RawMaterial
```

**Add to Model**:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RawMaterial extends BaseModel
{
    protected $fillable = [
        'umkm_profile_id', 'nama_bahan', 'kebutuhan_per_bulan',
        'satuan', 'asal_supplier'
    ];

    protected $casts = [
        'kebutuhan_per_bulan' => 'decimal:2',
    ];

    public function umkmProfile(): BelongsTo
    {
        return $this->belongsTo(UmkmProfile::class);
    }
}
```

### 4. Create ProductionCluster Model

```bash
php artisan make:model ProductionCluster
```

**Add to Model**:

```php
<?php

namespace App\Models;

class ProductionCluster extends BaseModel
{
    protected $fillable = [
        'nama_sentra', 'jenis_komoditas', 'polygon_json', 'total_member'
    ];

    protected $casts = [
        'polygon_json' => 'array',
    ];
}
```

### 5. Update User Model

Add to `app/Models/User.php`:

```php
use Illuminate\Database\Eloquent\Relations\HasOne;

public function umkmProfile(): HasOne
{
    return $this->hasOne(UmkmProfile::class);
}
```

---

## 📊 Sample Data Insertion

### Example: Create Complete UMKM

```php
use App\Models\User;
use App\Models\UmkmProfile;

// Create User
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => bcrypt('password'),
    'role' => 'umkm',
    'nib' => '1234567890123456',
    'is_active' => true,
]);

// Create UMKM Profile
$profile = UmkmProfile::create([
    'user_id' => $user->id,
    'nama_usaha' => 'Batik Surabaya',
    'alamat_lengkap' => 'Jl. Raya Darmo No. 123',
    'kecamatan' => 'Gubeng',
    'kelurahan' => 'Airlangga',
    'latitude' => -7.2754,
    'longitude' => 112.7368,
    'omzet_bulanan' => 50000000,
    'jumlah_tenaga_kerja' => 10,
    'is_verified' => false,
]);

// Add Production Tool
$profile->productionTools()->create([
    'nama_alat' => 'Mesin Jahit Industrial',
    'jenis' => 'Mesin Jahit',
    'kapasitas' => '100 pcs/hari',
    'kondisi' => 'baik',
    'status_kepemilikan' => 'milik sendiri',
]);

// Add Raw Material
$profile->rawMaterials()->create([
    'nama_bahan' => 'Kain Katun',
    'kebutuhan_per_bulan' => 500,
    'satuan' => 'meter',
    'asal_supplier' => 'Pasar Kapasan',
]);
```

---

## 🔍 Example Queries

### Get All UMKM with Relations

```php
UmkmProfile::with(['user', 'productionTools', 'rawMaterials'])->get();
```

### Filter by Kecamatan

```php
UmkmProfile::where('kecamatan', 'Gubeng')
    ->where('is_verified', true)
    ->get();
```

### Get UMKM with High Omzet

```php
UmkmProfile::where('omzet_bulanan', '>', 100000000)
    ->orderBy('omzet_bulanan', 'desc')
    ->get();
```

### Count Production Tools per UMKM

```php
UmkmProfile::withCount('productionTools')->get();
```

---

## ⚡ Performance Tips

### 1. Eager Loading (Prevent N+1)

```php
// ✅ GOOD
$umkms = UmkmProfile::with('user', 'productionTools')->get();

// ❌ BAD
$umkms = UmkmProfile::all();
foreach ($umkms as $umkm) {
    $umkm->user; // N+1 query!
}
```

### 2. Use Indexes

Indexes sudah dibuat pada:

-   `nama_usaha`, `kecamatan` (umkm_profiles)
-   `umkm_profile_id` (production_tools, raw_materials)
-   Composite indexes untuk query optimization

### 3. Pagination

```php
UmkmProfile::paginate(25);
```

---

## 🎯 Database ERD Reference

Lihat detail ERD di: [DATABASE-SCHEMA.md](DATABASE-SCHEMA.md)

---

## ✅ Verification Checklist

-   [x] All migrations created with UUID
-   [x] Foreign keys using foreignUuid()
-   [x] Indexes on searchable columns
-   [x] Cascade delete configured
-   [x] All migrations tested and verified
-   [x] Admin user seeded
-   [x] Code formatted with Pint

---

**Migration Version**: 1.0  
**Date**: 17 Desember 2025  
**Status**: ✅ PRODUCTION READY

**Next**: Create Models & Filament Resources
