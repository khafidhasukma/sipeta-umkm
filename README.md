# SIPETA-UMKM

<p align="center">
<img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
<img src="https://img.shields.io/badge/FilamentPHP-4.x-FDAE4B?style=for-the-badge&logo=php&logoColor=white" alt="FilamentPHP 4">
<img src="https://img.shields.io/badge/Tailwind-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS 4">
<img src="https://img.shields.io/badge/UUID-Primary_Key-4285F4?style=for-the-badge" alt="UUID">
</p>

## 📋 Tentang Proyek

**SIPETA-UMKM** adalah Sistem Informasi Pendataan dan Pelaporan Terpadu untuk UMKM yang dibangun dengan arsitektur Monolith menggunakan Laravel 12 dan FilamentPHP v4. Sistem ini memiliki 2 panel terpisah untuk Admin Pemkot dan User UMKM.

## 🛠️ Tech Stack

-   **Framework**: Laravel 12.x
-   **Admin Interface**: FilamentPHP v4.x
-   **Styling**: Tailwind CSS v4
-   **Database**: MySQL/PostgreSQL (dengan UUID sebagai Primary Key)
-   **Testing**: Pest PHP
-   **Code Style**: Laravel Pint

## 🏗️ Arsitektur

### Panel Filament

1. **Admin Panel** (`/admin`)

    - Untuk: Pemkot (Dinas/Admin)
    - Path: `/admin`
    - Provider: `AdminPanelProvider`

2. **UMKM Panel** (`/umkm`)
    - Untuk: User UMKM
    - Path: `/umkm`
    - Provider: `UmkmPanelProvider`

### Database Design

-   ✅ **UUID Primary Keys** - Semua tabel menggunakan UUID
-   ✅ **BaseModel** - Template model dengan UUID trait
-   ✅ **Migration Templates** - Standard UUID migration patterns

## 🚀 Quick Start

### 1. Clone & Install

```bash
# Clone repository
git clone <repository-url>
cd sipeta-umkm

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
```

### 2. Database Setup

```bash
# Buat database
# Edit .env file dengan kredensial database Anda

# Jalankan migration
php artisan migrate

# Seed admin user
php artisan db:seed --class=AdminUserSeeder
```

### 3. Run Development Server

```bash
# Opsi 1: Menggunakan composer script
composer run dev

# Opsi 2: Manual
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

### 4. Akses Aplikasi

-   **Admin Panel**: http://localhost:8000/admin
-   **UMKM Panel**: http://localhost:8000/umkm

**Default Login:**

-   Email: `admin@sipeta.com`
-   Password: `password`

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di:

-   **[SETUP-GUIDE.md](SETUP-GUIDE.md)** - Panduan instalasi dan konfigurasi lengkap
-   **[UUID-REFERENCE.md](UUID-REFERENCE.md)** - Referensi penggunaan UUID di seluruh sistem
-   **[COMMANDS.md](COMMANDS.md)** - Daftar command artisan dan quick references

## 🎯 Fitur Utama

-   ✅ Multi-panel Filament (Admin & UMKM)
-   ✅ UUID sebagai Primary Key
-   ✅ Authentication & Authorization
-   ✅ Dashboard & Widgets
-   🚧 CRUD UMKM (Coming Soon)
-   🚧 Manajemen Produk (Coming Soon)
-   🚧 Pelaporan & Statistik (Coming Soon)

## 🧪 Testing

```bash
# Jalankan semua test
php artisan test

# Test dengan coverage
php artisan test --coverage

# Filter test tertentu
php artisan test --filter=TestName
```

## 🧹 Code Quality

```bash
# Format code dengan Laravel Pint
vendor/bin/pint

# Check tanpa fix
vendor/bin/pint --test
```

## 📁 Struktur Folder Penting

```
app/
├── Filament/              # Admin Panel Resources
│   ├── Resources/
│   ├── Pages/
│   └── Widgets/
├── Filament/Umkm/         # UMKM Panel Resources
│   ├── Resources/
│   ├── Pages/
│   └── Widgets/
├── Models/
│   ├── BaseModel.php      # Base model dengan UUID trait
│   └── User.php
└── Providers/
    └── Filament/
        ├── AdminPanelProvider.php
        └── UmkmPanelProvider.php

database/
├── factories/
├── migrations/
│   └── 0001_01_01_000000_create_users_table.php  # UUID migration
└── seeders/
    └── AdminUserSeeder.php

resources/
├── css/
│   └── app.css            # Tailwind v4 config
├── js/
└── views/
```

## 🔐 Security

-   UUID Primary Keys (tidak predictable)
-   CSRF Protection
-   Password Hashing (bcrypt)
-   Session Management
-   Input Validation

## 🤝 Contributing

1. Fork repository
2. Buat feature branch (`git checkout -b feature/NamaFitur`)
3. Commit changes (`git commit -m 'Add: Deskripsi fitur'`)
4. Push ke branch (`git push origin feature/NamaFitur`)
5. Buat Pull Request

### Coding Standards

-   Follow PSR-12 (enforced by Laravel Pint)
-   Extend `BaseModel` untuk semua model baru
-   Gunakan UUID untuk semua primary keys
-   Tulis test untuk fitur baru
-   Gunakan Pest untuk testing

## 📝 Changelog

### Version 1.0.0 (2025-12-17)

-   ✅ Initial setup Laravel 12
-   ✅ FilamentPHP v4 integration
-   ✅ Dual panel setup (Admin & UMKM)
-   ✅ UUID implementation
-   ✅ BaseModel dengan UUID trait
-   ✅ Admin user seeder
-   ✅ Documentation

## 📞 Support

Untuk pertanyaan dan dukungan, silakan buka issue di repository ini.

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
