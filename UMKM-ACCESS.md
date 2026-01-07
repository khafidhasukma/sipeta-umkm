# Akses Role UMKM

## Cara Mengakses Dashboard UMKM

### 1. **Registrasi Akun UMKM**

-   Kunjungi halaman registrasi: `/register`
-   Isi formulir dengan informasi berikut:
    -   Nama Lengkap
    -   Email (unik)
    -   Password
    -   Konfirmasi Password
-   Setelah registrasi berhasil, akun Anda otomatis memiliki role `umkm`

### 2. **Login ke Sistem**

-   Buka halaman login: `/login`
-   Masukkan email dan password yang telah didaftarkan
-   Klik "Masuk"

### 3. **Akses Dashboard**

-   Setelah login berhasil, Anda akan diarahkan ke:
    -   **Dashboard UMKM**: `/umkm/dashboard`
    -   Menu navigasi akan menampilkan "Dashboard UMKM"

## Fitur Dashboard UMKM

1. **Profil UMKM**

    - Kelola informasi usaha Anda
    - Update data kontak dan lokasi
    - Tambah/edit informasi produk

2. **Alat Produksi**

    - Daftar alat produksi yang dimiliki
    - Kelola kapasitas dan kondisi alat
    - Status kepemilikan (milik sendiri/sewa/pinjam)

3. **Bahan Baku**

    - Kelola daftar bahan baku
    - Kebutuhan per bulan
    - Informasi supplier

4. **Statistik & Laporan**
    - Lihat performa bisnis
    - Data omzet dan tenaga kerja
    - Laporan bulanan

## Kredensial Testing

Untuk testing, gunakan salah satu user UMKM yang sudah ada di database:

```
Email: umkm1@example.com (atau umkm{1-5000}@example.com)
Password: password
```

## Perbedaan Role

### Role: UMKM

-   Akses: Dashboard UMKM
-   Fitur: Kelola profil usaha, alat produksi, bahan baku
-   URL: `/umkm/dashboard`

### Role: Admin

-   Akses: Dashboard Admin
-   Fitur: Kelola semua UMKM, verifikasi, laporan
-   URL: `/admin/dashboard`

## NIB (Nomor Induk Berusaha)

Setiap user UMKM memiliki NIB 13 digit dengan format:

-   **8712345XXXXXX**
-   Contoh: 8712345000001, 8712345000002, dst.

NIB ini digunakan untuk identifikasi bisnis dan verifikasi data.
