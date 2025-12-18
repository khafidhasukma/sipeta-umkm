# 🎭 SISTEM ROLE & FITUR SIPETA-UMKM

> **Status**: ✅ Direvisi & Diimplementasi  
> **Tanggal**: 18 Desember 2025  
> **Priority**: HIGH - Deadline Hari Ini

---

## ⚡ KOREKSI FATAL: Logika Bisnis yang Benar

Aplikasi ini memiliki **2 role utama** dengan akses yang telah diperbaiki sesuai kebutuhan bisnis:

```sql
enum('role', ['admin', 'umkm']) DEFAULT 'umkm'
```

---

## 🔐 1. ROLE: ADMIN (Pemkot Semarang)

### **Akses Panel**

-   **URL**: `/admin`
-   **Login**: admin@sipeta.com / password
-   **Panel Color**: Amber (Kuning)
-   **Panel Provider**: `AdminPanelProvider`

### **Dashboard Admin** ✅

**Widgets yang Ditampilkan**:

-   ✅ **AccountWidget** - Info akun admin
-   ✅ **StatsOverview** - Statistik global UMKM
    -   Total UMKM Terdaftar
    -   UMKM Terverifikasi
    -   Menunggu Verifikasi (dengan link langsung)
    -   Total Sentra Produksi
-   ✅ **UmkmDistributionMap** ⚡ **CRITICAL** - Peta sebaran semua UMKM
    -   Filter berdasarkan jenis sentra/komoditas
    -   Marker interaktif dengan popup info UMKM
    -   Area polygon untuk sentra produksi
    -   Legend dan total UMKM counter
-   ✅ **FilamentInfoWidget** - Info sistem Filament

> **ALASAN PENTING**: Admin Pemkot adalah pengguna utama fitur GIS/pemetaan untuk:
>
> -   Monitoring distribusi geografis UMKM
> -   Analisis spasial untuk clustering
> -   Perencanaan pembinaan berbasis lokasi
> -   Laporan visual untuk stakeholder

---

### **Resources & Fitur**

#### **A. UMKM Profiles Management** ✅

**Resource**: `UmkmProfileResource`  
**Path**: `/admin/umkm-profiles`

**CRUD Operations**:

-   ✅ **List All UMKM** - Lihat semua UMKM (Full Access)
-   ✅ **Create UMKM** - Buat profil UMKM baru
-   ✅ **View Detail UMKM** - Lihat detail lengkap
-   ✅ **Edit UMKM** - Edit data UMKM
-   ✅ **Delete UMKM** - Hapus profil UMKM
-   ✅ **Verify/Reject** - Approve/reject status verifikasi UMKM
-   ✅ **View Map Location** - Lihat koordinat di peta

**RelationManagers** ⚡ **SUDAH DIIMPLEMENTASI**:

1. **ProductionToolsRelationManager**

    - Tab "Alat Produksi" di detail UMKM
    - View semua alat produksi milik UMKM
    - Create/Edit/Delete alat untuk validasi
    - Badge status kondisi (Baik, Rusak Ringan, Rusak Berat)
    - Filter berdasarkan kondisi & status kepemilikan
    - **JUSTIFIKASI**: Admin perlu cek kelengkapan inventaris sebelum verifikasi

2. **RawMaterialsRelationManager**
    - Tab "Bahan Baku" di detail UMKM
    - View semua bahan baku milik UMKM
    - Create/Edit/Delete bahan untuk validasi
    - Info kebutuhan per bulan & asal supplier
    - Filter berdasarkan satuan
    - **JUSTIFIKASI**: Data bahan baku diperlukan untuk analisis sentra

**Actions**:

-   Bulk verify multiple UMKM
-   Export to Excel/CSV
-   Print UMKM report

---

#### **B. Production Clusters Management** ✅

**Resource**: `ProductionClusterResource`  
**Path**: `/admin/production-clusters`

**Operations**:

-   ✅ **List All Clusters** - Lihat semua klaster/sentra
-   ✅ **Create Cluster** - Buat sentra baru (manual/otomatis)
-   ✅ **View Detail** - Detail sentra + polygon area
-   ✅ **Edit Cluster** - Edit data sentra
-   ✅ **Delete Cluster** - Hapus sentra
-   ✅ **Run K-means Analysis** - Jalankan clustering algorithm

**Fields**:

-   Nama Sentra
-   Jenis Komoditas
-   Algoritma (K-means)
-   Parameter clustering
-   Centroid coordinates
-   Polygon geometry (GeoJSON)
-   Status aktif

**RelationManager** (Recommended):

-   **UmkmMembersRelationManager** - List UMKM anggota sentra
    -   View profil anggota
    -   Quick link to detail UMKM
    -   Export member list

---

#### **C. User Management** 🔄 (Opsional)

**Resource**: `UserResource` (Belum dibuat)

**Operations**:

-   Create/Edit/Delete user accounts
-   Manage roles (Admin/UMKM)
-   Activate/Deactivate accounts
-   Reset passwords
-   View login history

---

## 👤 2. ROLE: UMKM (Pelaku Usaha)

### **Akses Panel**

-   **URL**: `/umkm`
-   **Login**: Email UMKM (contoh: budi@example.com / password)
-   **Panel Color**: Blue (Biru)
-   **Panel Provider**: `UmkmPanelProvider`
-   **Brand Name**: "SIPETA UMKM"
-   **Navigation**: Collapsible sidebar

### **Dashboard UMKM** ✅

**Widgets**:

-   ✅ **AccountWidget** - Info akun UMKM
-   ✅ **Personal Stats** (Recommended) - Stats pribadi:
    -   Total alat produksi
    -   Total bahan baku
    -   Omzet bulanan
    -   Status verifikasi
-   ✅ **UmkmDistributionMap** (Opsional) - Peta read-only untuk lihat UMKM sekitar

---

### **Pages & Resources**

#### **A. My Profile** ✅

**Custom Page**: `MyProfile.php`  
**Path**: `/umkm/my-profile`

**Features**:

-   ✅ View profil UMKM sendiri
-   ✅ Edit data usaha
-   ✅ Create profile (jika belum punya)
-   ✅ Map Picker untuk set lokasi
-   ❌ Tidak bisa lihat/edit profil UMKM lain
-   ❌ Status verifikasi read-only (hanya admin yang bisa)

**Editable Fields**:

-   Nama Usaha
-   Alamat Lengkap
-   Kecamatan, Kelurahan
-   Koordinat (via Map Picker)
-   Jumlah Tenaga Kerja
-   Omzet Bulanan

**Data Scoping**:

```php
$umkmProfile = auth()->user()->umkmProfile;
// Hanya bisa edit profil sendiri
```

---

#### **B. Production Tools (Alat Produksi)** ✅

**Resource**: `ProductionToolResource` (UMKM Panel)  
**Navigation Group**: "Inventaris"  
**Path**: `/umkm/production-tools`

**CRUD Operations** (Scoped):

-   ✅ List alat produksi sendiri
-   ✅ Create alat baru
-   ✅ Edit alat sendiri
-   ✅ Delete alat sendiri
-   ❌ Tidak bisa lihat alat UMKM lain

**Fields**:

-   Nama Alat
-   Jenis Alat
-   Kondisi (baik, rusak ringan, rusak berat, perlu perbaikan)
-   Status Kepemilikan (milik sendiri, sewa, pinjam, hibah)
-   Keterangan

**Query Scoping**:

```php
public static function getEloquentQuery(): Builder
{
    $umkmProfile = auth()->user()->umkmProfile;
    return parent::getEloquentQuery()
        ->where('umkm_profile_id', $umkmProfile?->id);
}
```

---

#### **C. Raw Materials (Bahan Baku)** ✅

**Resource**: `RawMaterialResource` (UMKM Panel)  
**Navigation Group**: "Inventaris"  
**Path**: `/umkm/raw-materials`

**CRUD Operations** (Scoped):

-   ✅ List bahan baku sendiri
-   ✅ Create bahan baru
-   ✅ Edit bahan sendiri
-   ✅ Delete bahan sendiri
-   ❌ Tidak bisa lihat bahan UMKM lain

**Fields**:

-   Nama Bahan
-   Kebutuhan per Bulan
-   Satuan (kg, liter, pcs, dll)
-   Harga per Satuan
-   Asal Supplier
-   Keterangan

---

## 📊 PERBANDINGAN AKSES DATA (REVISED)

| **Fitur/Data**          | **Admin (Pemkot)**                       | **UMKM (Pelaku Usaha)**       |
| ----------------------- | ---------------------------------------- | ----------------------------- |
| **UMKM Profiles**       | ✅ Semua UMKM (Full CRUD)                | ✅ Profil sendiri (Edit only) |
| **Production Tools**    | ✅ **Semua alat** (via RelationManager)  | ✅ Alat sendiri (Full CRUD)   |
| **Raw Materials**       | ✅ **Semua bahan** (via RelationManager) | ✅ Bahan sendiri (Full CRUD)  |
| **Production Clusters** | ✅ Full CRUD + Analysis                  | ❌ Tidak ada akses            |
| **Cluster Members**     | ✅ View member list                      | ❌ Tidak ada akses            |
| **Verifikasi UMKM**     | ✅ Approve/Reject                        | ❌ Read-only status           |
| **Create/Edit User**    | ✅ Bisa (via UserResource)               | ❌ Tidak bisa                 |
| **Delete UMKM**         | ✅ Bisa                                  | ❌ Tidak bisa                 |
| **Dashboard Stats**     | ✅ **Global** (semua UMKM)               | ✅ Personal saja              |
| **GIS Map Widget**      | ✅ **Primary user** (monitoring)         | ✅ View only (read-only)      |
| **Export Data**         | ✅ Export semua                          | ✅ Export data sendiri        |

---

## 🔒 MEKANISME AUTHORIZATION

### **Admin Panel - Full Access**

```php
// TIDAK ADA SCOPING - Akses penuh

// List semua UMKM
UmkmProfile::all();

// List semua cluster + members
ProductionCluster::with('members')->get();

// Di UmkmProfileResource, via RelationManager:
$umkmProfile->productionTools; // Semua alat UMKM ini
$umkmProfile->rawMaterials;    // Semua bahan UMKM ini
```

### **UMKM Panel - Strict Scoping**

```php
// STRICT SCOPING - Hanya data sendiri

// Get current user's profile
$myProfile = auth()->user()->umkmProfile;

// Di ProductionToolResource (UMKM Panel)
ProductionTool::where('umkm_profile_id', $myProfile->id)->get();

// Di RawMaterialResource (UMKM Panel)
RawMaterial::where('umkm_profile_id', $myProfile->id)->get();

// BLOCKED - Tidak bisa akses data UMKM lain
UmkmProfile::where('id', '!=', $myProfile->id)->get(); // ❌
```

---

## ✅ VALIDASI LOGIKA BISNIS

| **Use Case**                           | **Admin**      | **UMKM**   | **Alasan**                                      |
| -------------------------------------- | -------------- | ---------- | ----------------------------------------------- |
| Monitoring distribusi UMKM via peta    | ✅ Ya          | ✅ Ya (RO) | Admin: analisis spasial. UMKM: lihat kompetitor |
| Validasi inventaris sebelum verifikasi | ✅ Ya          | ❌ Tidak   | Admin cek kelengkapan data sebelum approve      |
| Analisis sentra (clustering)           | ✅ Ya          | ❌ Tidak   | Butuh akses semua data UMKM + alat + bahan      |
| Export data per sentra                 | ✅ Ya          | ❌ Tidak   | Untuk laporan stakeholder/Kemendagri            |
| Input/update inventaris sendiri        | ❌ Tidak perlu | ✅ Ya      | UMKM lebih tahu kondisi alat mereka             |

---

## 🎯 IMPLEMENTASI STATUS

### ✅ Sudah Diimplementasi

1. **Dashboard Map Widget** ⚡ **PRIORITY 1**

    - ✅ `UmkmDistributionMap` widget di Admin panel
    - ✅ `StatsOverview` widget di Admin dashboard
    - ✅ Leaflet.js integration
    - ✅ Filter by commodity/cluster
    - ✅ Interactive markers & polygons
    - ✅ Legend & UMKM counter

2. **RelationManagers untuk Admin** ⚡ **PRIORITY 2**

    - ✅ `ProductionToolsRelationManager` di UmkmProfileResource
    - ✅ `RawMaterialsRelationManager` di UmkmProfileResource
    - ✅ Full CRUD operations
    - ✅ Filters & search
    - ✅ Badge styling

3. **Data Scoping untuk UMKM**
    - ✅ ProductionToolResource (scoped)
    - ✅ RawMaterialResource (scoped)
    - ✅ MyProfile page (scoped)

### 🔄 Recommended (Opsional)

1. **UmkmMembersRelationManager** di ProductionClusterResource
    - List UMKM anggota per sentra
    - Quick access to member details
2. **UserResource** di Admin panel

    - Manage user accounts
    - Role management
    - Activate/deactivate

3. **Personal Stats Widget** di UMKM dashboard
    - Total alat produksi
    - Total bahan baku
    - Omzet tracking

---

## 🚀 CARA AKSES

### **Admin Panel**

```
URL: http://localhost:8000/admin
Login: admin@sipeta.com
Password: password
```

**Fitur Utama**:

1. Dashboard → Lihat peta & statistik
2. UMKM → List semua UMKM
3. Klik UMKM → Tab "Alat Produksi" & "Bahan Baku"
4. Production Clusters → Analisis sentra

### **UMKM Panel**

```
URL: http://localhost:8000/umkm
Login: budi@example.com (atau email UMKM lain)
Password: password
```

**Fitur Utama**:

1. Dashboard → Stats pribadi & peta
2. My Profile → Edit profil & lokasi
3. Inventaris → Alat Produksi
4. Inventaris → Bahan Baku

---

## 📝 NOTES

1. **Map Widget Critical**: Map widget adalah fitur krusial untuk deadline hari ini
2. **RelationManagers**: Sudah implemented dan berfungsi penuh
3. **Data Scoping**: Sudah proper untuk UMKM panel
4. **Performance**: Map widget optimized dengan Leaflet.js
5. **Security**: Authorization sudah proper di level query

---

## 🎓 KESIMPULAN

✅ **Admin memiliki akses PENUH** ke semua data UMKM, termasuk:

-   Inventaris (alat & bahan) via RelationManagers
-   Peta distribusi sebaran UMKM
-   Analisis clustering/sentra
-   Verifikasi & validasi data

✅ **UMKM hanya akses data sendiri**:

-   Profil pribadi
-   Inventaris sendiri
-   View-only untuk peta umum

✅ **Logika bisnis sudah BENAR** sesuai kebutuhan Pemkot Semarang untuk monitoring & pembinaan UMKM.
