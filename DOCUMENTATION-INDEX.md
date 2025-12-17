# 📚 Dokumentasi SIPETA-UMKM - Index

Selamat datang di dokumentasi lengkap sistem SIPETA-UMKM!

---

## 🗂️ Daftar Dokumentasi

### 1. 📖 [README.md](README.md) - Main Documentation

**Deskripsi**: Overview proyek, quick start, dan informasi umum.  
**Baca jika**: Anda baru pertama kali membuka proyek ini.

**Isi**:

-   Tentang proyek
-   Tech stack
-   Quick start guide
-   Fitur utama
-   Struktur folder
-   Contributing guidelines

---

### 2. 🚀 [SETUP-GUIDE.md](SETUP-GUIDE.md) - Complete Setup Guide

**Deskripsi**: Panduan instalasi dan konfigurasi lengkap step-by-step.  
**Baca jika**: Anda ingin setup proyek dari awal atau troubleshooting.

**Isi**:

-   Status instalasi
-   Struktur Panel Filament
-   Konfigurasi UUID
-   Database migrations
-   Langkah-langkah setup
-   Environment configuration
-   Next steps
-   Troubleshooting

---

### 3. 🔑 [UUID-REFERENCE.md](UUID-REFERENCE.md) - UUID Best Practices

**Deskripsi**: Referensi lengkap penggunaan UUID sebagai Primary Key.  
**Baca jika**: Anda ingin membuat model, migration, atau resource baru.

**Isi**:

-   Konsep UUID
-   Template model dengan UUID
-   Template migration dengan UUID
-   Factory & seeder examples
-   Eloquent relationships
-   Routing dengan UUID
-   Filament resource dengan UUID
-   Testing dengan UUID
-   DO's and DON'Ts
-   Troubleshooting

---

### 4. ⚡ [COMMANDS.md](COMMANDS.md) - Command Reference

**Deskripsi**: Daftar lengkap command artisan dan quick references.  
**Baca jika**: Anda mencari command tertentu atau workflow development.

**Isi**:

-   Commands yang sudah dijalankan
-   Development commands
-   Membuat model & migration
-   Membuat Filament resources
-   Database commands
-   Testing commands
-   Maintenance commands
-   Filament specific commands
-   Workflow pengembangan fitur
-   Troubleshooting quick fixes
-   Production deployment

---

### 5. ✅ [SETUP-COMPLETED.md](SETUP-COMPLETED.md) - Setup Summary

**Deskripsi**: Ringkasan setup yang telah dikonfigurasi dan next steps.  
**Baca jika**: Anda ingin tahu apa saja yang sudah dikonfigurasi dan apa yang harus dilakukan selanjutnya.

**Isi**:

-   Status completion checklist
-   Yang telah dikonfigurasi
-   Cara menjalankan aplikasi
-   Next steps untuk development
-   Command reference cepat
-   Struktur file penting
-   Hal penting yang harus diingat
-   Workflow development
-   Troubleshooting
-   Status checklist

---

### 6. 🏗️ [ARCHITECTURE.md](ARCHITECTURE.md) - System Architecture

**Deskripsi**: Diagram arsitektur sistem, request flow, dan teknologi.  
**Baca jika**: Anda ingin memahami bagaimana sistem bekerja secara keseluruhan.

**Isi**:

-   Diagram arsitektur
-   Request flow (Admin & UMKM panel)
-   Directory structure detail
-   Authentication & authorization flow
-   Data access patterns
-   Database relationship diagram
-   Technology stack layers
-   Deployment architecture
-   Performance considerations
-   Development workflow

---

### 7. 💡 [TIPS.md](TIPS.md) - Tips & Best Practices

**Deskripsi**: Best practices, tips, dan common pitfalls.  
**Baca jika**: Anda ingin menulis code yang lebih baik dan menghindari kesalahan umum.

**Isi**:

-   Laravel best practices
-   Filament best practices
-   Testing best practices
-   Security best practices
-   Code organization
-   Database tips
-   UI/UX tips
-   Performance tips
-   Debugging tips
-   Git commit conventions
-   Quick command shortcuts
-   Learning resources
-   Common pitfalls
-   Pro tips

---

## 🎯 Mulai Dari Mana?

### Jika Anda Baru di Proyek Ini:

1. Baca [README.md](README.md) untuk overview
2. Ikuti [SETUP-GUIDE.md](SETUP-GUIDE.md) untuk instalasi
3. Lihat [SETUP-COMPLETED.md](SETUP-COMPLETED.md) untuk status

### Jika Anda Ingin Develop Fitur Baru:

1. Baca [UUID-REFERENCE.md](UUID-REFERENCE.md) untuk template
2. Gunakan [COMMANDS.md](COMMANDS.md) sebagai reference
3. Ikuti [TIPS.md](TIPS.md) untuk best practices

### Jika Anda Ingin Memahami Sistem:

1. Baca [ARCHITECTURE.md](ARCHITECTURE.md) untuk overview sistem
2. Lihat [README.md](README.md) untuk struktur folder
3. Eksplorasi code dengan panduan dari docs

### Jika Anda Menemukan Masalah:

1. Cek troubleshooting di [SETUP-GUIDE.md](SETUP-GUIDE.md)
2. Lihat common pitfalls di [TIPS.md](TIPS.md)
3. Debug dengan tips dari [TIPS.md](TIPS.md)

---

## 📁 File-File Penting dalam Proyek

### Models

-   `app/Models/BaseModel.php` - Template untuk semua model (UUID)
-   `app/Models/User.php` - User authentication model

### Panel Providers

-   `app/Providers/Filament/AdminPanelProvider.php` - Admin panel config
-   `app/Providers/Filament/UmkmPanelProvider.php` - UMKM panel config

### Migrations

-   `database/migrations/0001_01_01_000000_create_users_table.php` - Users table (UUID)

### Seeders

-   `database/seeders/AdminUserSeeder.php` - Default admin user

### Configuration

-   `bootstrap/providers.php` - Service providers registration
-   `.env` - Environment variables
-   `composer.json` - PHP dependencies
-   `package.json` - NPM dependencies

---

## 🔗 Quick Links

### Development

-   Start server: `composer run dev`
-   Run tests: `php artisan test`
-   Format code: `vendor/bin/pint`

### Access URLs (after `composer run dev`)

-   Admin Panel: http://localhost:8000/admin
-   UMKM Panel: http://localhost:8000/umkm
-   Login: admin@sipeta.com / password

### External Documentation

-   [Laravel 12 Docs](https://laravel.com/docs/12.x)
-   [FilamentPHP v4 Docs](https://filamentphp.com/docs/4.x)
-   [Tailwind CSS v4 Docs](https://tailwindcss.com/docs)
-   [Pest PHP Docs](https://pestphp.com/docs)

---

## 📝 Version Information

-   **Project**: SIPETA-UMKM v1.0.0
-   **Laravel**: 12.x
-   **FilamentPHP**: 4.0.0
-   **Tailwind CSS**: 4.x
-   **PHP**: 8.2+
-   **Database**: MySQL / PostgreSQL

---

## 🤝 Contributing

Sebelum contribute, pastikan membaca:

1. [README.md](README.md) - Contributing guidelines
2. [TIPS.md](TIPS.md) - Best practices
3. [UUID-REFERENCE.md](UUID-REFERENCE.md) - UUID patterns

---

## 📞 Support & Questions

Jika ada pertanyaan:

1. Check dokumentasi yang relevan
2. Cek troubleshooting sections
3. Buka issue di repository

---

**Last Updated**: 17 Desember 2025  
**Status**: Complete & Ready for Development ✅

**Happy Coding! 🚀**
