# SIPETA-UMKM - Panduan Setup & Konfigurasi

## ✅ Status Instalasi

### Telah Dikonfigurasi:

-   ✅ Laravel 12 terinstal
-   ✅ FilamentPHP v4 terinstal
-   ✅ 2 Panel Filament dibuat (Admin & UMKM)
-   ✅ UUID dikonfigurasi pada Model User
-   ✅ Migration users table menggunakan UUID
-   ✅ BaseModel dibuat dengan UUID trait

---

## 📁 Struktur Panel Filament

### 1. Admin Panel

-   **Path**: `/admin`
-   **Provider**: `App\Providers\Filament\AdminPanelProvider`
-   **Resources**: `app/Filament/Resources/`
-   **Pages**: `app/Filament/Pages/`
-   **Widgets**: `app/Filament/Widgets/`
-   **Untuk**: Pemkot (Dinas/Admin)

### 2. UMKM Panel

-   **Path**: `/umkm`
-   **Provider**: `App\Providers\Filament\UmkmPanelProvider`
-   **Resources**: `app/Filament/Umkm/Resources/`
-   **Pages**: `app/Filament/Umkm/Pages/`
-   **Widgets**: `app/Filament/Umkm/Widgets/`
-   **Untuk**: User UMKM

---

## 🔑 Konfigurasi UUID (Primary Key)

### BaseModel (Template untuk Semua Model)

Lokasi: `app/Models/BaseModel.php`

**Cara Penggunaan:**
Semua model baru harus extend `BaseModel` untuk otomatis menggunakan UUID:

```php
<?php

namespace App\Models;

class NamaModel extends BaseModel
{
    // Model Anda otomatis menggunakan UUID sebagai primary key
    protected $fillable = [
        // field-field Anda
    ];
}
```

### Model User

Sudah dikonfigurasi dengan:

-   ✅ Trait `HasUuids`
-   ✅ Primary key type: `string`
-   ✅ Non-incrementing

---

## 🗄️ Database Migrations

### Contoh Migration dengan UUID

Semua migration baru harus menggunakan pattern ini:

```php
Schema::create('nama_tabel', function (Blueprint $table) {
    $table->uuid('id')->primary(); // UUID sebagai Primary Key

    // Foreign Key ke tabel lain (jika ada)
    $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();

    // Field lainnya
    $table->string('nama');

    $table->timestamps();
});
```

**⚠️ PENTING**:

-   Gunakan `uuid('id')->primary()` untuk primary key
-   Gunakan `foreignUuid('nama_kolom')` untuk foreign key yang mereferensi tabel dengan UUID

---

## 🚀 Langkah-Langkah Setup

### 1. Jalankan Migration

```bash
php artisan migrate
```

### 2. Buat User Admin (Manual - Pilih salah satu)

#### Opsi A: Via Tinker

```bash
php artisan tinker
```

Kemudian jalankan:

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@sipeta.com',
    'password' => bcrypt('password'),
]);
```

#### Opsi B: Via Seeder

Buat file seeder:

```bash
php artisan make:seeder AdminUserSeeder
```

Edit `database/seeders/AdminUserSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SIPETA',
            'email' => 'admin@sipeta.com',
            'password' => bcrypt('password'),
        ]);
    }
}
```

Jalankan seeder:

```bash
php artisan db:seed --class=AdminUserSeeder
```

### 3. Jalankan Development Server

```bash
composer run dev
```

Atau manual:

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

### 4. Akses Panel Filament

-   **Admin Panel**: http://localhost:8000/admin
-   **UMKM Panel**: http://localhost:8000/umkm

**Login Credentials** (setelah membuat user):

-   Email: `admin@sipeta.com`
-   Password: `password`

---

## 📝 Membuat Resource Baru

### Untuk Admin Panel

```bash
php artisan make:filament-resource NamaResource --generate
```

Resource akan dibuat di: `app/Filament/Resources/`

### Untuk UMKM Panel

```bash
php artisan make:filament-resource NamaResource --panel=umkm --generate
```

Resource akan dibuat di: `app/Filament/Umkm/Resources/`

---

## 🎨 Tailwind CSS v4

Konfigurasi Tailwind menggunakan CSS-first approach. File theme terletak di:

-   `resources/css/app.css`

Tidak perlu `tailwind.config.js` tradisional. Gunakan `@theme` directive di CSS untuk customization.

---

## 🧪 Testing

```bash
# Jalankan semua test
php artisan test

# Jalankan test tertentu
php artisan test --filter=TestName
```

---

## 📦 Command Artisan Berguna

```bash
# Lihat semua route
php artisan route:list

# Lihat command artisan yang tersedia
php artisan list

# Clear cache
php artisan optimize:clear

# Format code dengan Pint
vendor/bin/pint
```

---

## 🔧 Konfigurasi Environment

Pastikan file `.env` sudah dikonfigurasi dengan benar:

```env
APP_NAME="SIPETA-UMKM"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipeta_umkm
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🎯 Next Steps (Pengembangan Selanjutnya)

1. ✅ Setup selesai
2. 📝 Buat model dan migration untuk entitas UMKM
3. 📝 Buat resource Filament untuk Admin Panel
4. 📝 Buat resource Filament untuk UMKM Panel
5. 🔐 Implementasi Role & Permission
6. 📊 Buat dashboard widgets

---

## 📞 Troubleshooting

### Error: "Class not found"

```bash
composer dump-autoload
```

### Error: Frontend tidak update

```bash
npm run build
# atau
npm run dev
```

### Error: Migration failed

```bash
php artisan migrate:fresh
```

---

**Dibuat pada**: 17 Desember 2025  
**Laravel Version**: 12.x  
**FilamentPHP Version**: 4.x  
**Tailwind CSS Version**: 4.x
