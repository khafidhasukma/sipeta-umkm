# 🚀 Quick Start Commands - SIPETA-UMKM

## 📋 Commands yang Sudah Dijalankan

```bash
✅ composer require filament/filament:"^4.0" -W --no-interaction
✅ php artisan make:filament-panel admin --no-interaction
✅ php artisan make:filament-panel umkm --no-interaction
✅ php artisan migrate:fresh
✅ php artisan db:seed --class=AdminUserSeeder
✅ vendor/bin/pint
```

---

## 🎯 Next Commands untuk Development

### 1️⃣ Start Development Server

```bash
# Opsi 1: Gunakan composer script (Recommended)
composer run dev

# Opsi 2: Manual (3 terminal terpisah)
# Terminal 1
php artisan serve

# Terminal 2
npm run dev

# Terminal 3 (optional - untuk queue)
php artisan queue:listen
```

### 2️⃣ Akses Aplikasi

-   **Admin Panel**: http://localhost:8000/admin
-   **UMKM Panel**: http://localhost:8000/umkm
-   **Login**: admin@sipeta.com / password

---

## 🛠️ Development Commands

### Membuat Model & Migration (dengan UUID)

```bash
# Buat model + migration
php artisan make:model NamaModel -m

# Buat model + migration + factory + seeder
php artisan make:model NamaModel -mfs

# Contoh: Buat model Umkm
php artisan make:model Umkm -mfs
```

### Membuat Filament Resource

#### Untuk Admin Panel

```bash
# Basic resource
php artisan make:filament-resource NamaResource

# Resource dengan generate otomatis (dari model existing)
php artisan make:filament-resource NamaResource --generate

# Contoh: Buat resource Umkm untuk Admin
php artisan make:filament-resource Umkm --generate
```

#### Untuk UMKM Panel

```bash
# Resource untuk panel tertentu
php artisan make:filament-resource NamaResource --panel=umkm

# Dengan generate
php artisan make:filament-resource NamaResource --panel=umkm --generate

# Contoh: Buat resource Produk untuk UMKM Panel
php artisan make:filament-resource Produk --panel=umkm --generate
```

### Membuat Filament Pages

```bash
# Untuk Admin Panel
php artisan make:filament-page NamaPage

# Untuk UMKM Panel
php artisan make:filament-page NamaPage --panel=umkm
```

### Membuat Filament Widgets

```bash
# Untuk Admin Panel
php artisan make:filament-widget NamaWidget

# Untuk UMKM Panel
php artisan make:filament-widget NamaWidget --panel=umkm

# Stats widget
php artisan make:filament-widget StatsOverview --type=stats --panel=admin

# Chart widget
php artisan make:filament-widget UmkmChart --type=chart --panel=admin
```

---

## 🗄️ Database Commands

```bash
# Jalankan migration
php artisan migrate

# Rollback migration terakhir
php artisan migrate:rollback

# Reset database (hapus semua & migrate ulang)
php artisan migrate:fresh

# Reset + seed
php artisan migrate:fresh --seed

# Buat migration baru
php artisan make:migration create_nama_table

# Buat seeder
php artisan make:seeder NamaSeeder

# Jalankan seeder tertentu
php artisan db:seed --class=NamaSeeder
```

---

## 🧪 Testing Commands

```bash
# Jalankan semua test
php artisan test

# Jalankan test dengan coverage
php artisan test --coverage

# Filter test tertentu
php artisan test --filter=testNamaMethod

# Buat test baru (Pest)
php artisan make:test NamaTest --pest

# Buat unit test
php artisan make:test NamaTest --pest --unit
```

---

## 🧹 Maintenance Commands

```bash
# Clear semua cache
php artisan optimize:clear

# Cache individual
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan optimize

# Format code dengan Pint
vendor/bin/pint

# Check Pint tanpa fix
vendor/bin/pint --test
```

---

## 📊 Informasi & Monitoring

```bash
# List semua route
php artisan route:list

# Filter route tertentu
php artisan route:list --path=admin
php artisan route:list --path=umkm

# List semua command artisan
php artisan list

# Informasi aplikasi
php artisan about

# Tinker (Laravel REPL)
php artisan tinker
```

---

## 🔧 Filament Specific Commands

```bash
# List semua panel
php artisan filament:list-panels

# Optimize Filament
php artisan filament:optimize

# Clear Filament cache
php artisan filament:cache-components

# Upgrade Filament (jika ada update)
php artisan filament:upgrade

# Assets publish
php artisan filament:assets
```

---

## 📦 Composer Commands

```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Dump autoload
composer dump-autoload

# Require package baru
composer require vendor/package
```

---

## 🎨 NPM Commands

```bash
# Install dependencies
npm install

# Development mode (watch)
npm run dev

# Build untuk production
npm run build

# Lint
npm run lint
```

---

## 🔐 Security & Permission (Coming Soon)

```bash
# Install Spatie Permission (jika nanti digunakan)
composer require spatie/laravel-permission

# Publish config
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Create permission migration
php artisan make:migration create_permission_tables
```

---

## 📝 Workflow Pengembangan Fitur Baru

### Contoh: Membuat Modul "Produk UMKM"

```bash
# 1. Buat Model + Migration + Factory + Seeder
php artisan make:model Produk -mfs

# 2. Edit migration (gunakan UUID!)
# database/migrations/xxxx_create_produks_table.php

# 3. Jalankan migration
php artisan migrate

# 4. Buat Resource untuk Admin Panel
php artisan make:filament-resource Produk --generate

# 5. Buat Resource untuk UMKM Panel
php artisan make:filament-resource Produk --panel=umkm --generate

# 6. Seed data dummy
php artisan db:seed --class=ProdukSeeder

# 7. Test
php artisan test --filter=Produk

# 8. Format code
vendor/bin/pint

# 9. Cek di browser
# Admin: http://localhost:8000/admin/produks
# UMKM: http://localhost:8000/umkm/produks
```

---

## 🚨 Troubleshooting Quick Fixes

```bash
# Error: Class not found
composer dump-autoload

# Error: Mix manifest not found
npm run build

# Error: Permission denied (storage/logs)
# Windows PowerShell (as Administrator):
icacls "storage" /grant Users:F /t
icacls "bootstrap/cache" /grant Users:F /t

# Error: Database connection
# Check .env file, pastikan DB sudah running

# Panel tidak muncul
php artisan optimize:clear
composer dump-autoload
```

---

## 🎯 Production Deployment (Nanti)

```bash
# 1. Optimize aplikasi
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 2. Build assets
npm run build

# 3. Migration (tanpa drop)
php artisan migrate --force

# 4. Set permission
# (sesuai server environment)

# 5. Restart services
# (sesuai server environment)
```

---

**Last Updated**: 17 Desember 2025  
**Status**: Development Ready ✅
