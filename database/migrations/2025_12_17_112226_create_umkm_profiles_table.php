<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkm_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->cascadeOnDelete();

            // Informasi Usaha
            $table->string('nama_usaha')->index();
            $table->text('alamat_lengkap');
            $table->string('kecamatan')->index();
            $table->string('kelurahan');

            // Data GIS
            $table->decimal('latitude', 10, 8)->nullable()->comment('Koordinat Latitude');
            $table->decimal('longitude', 11, 8)->nullable()->comment('Koordinat Longitude');

            // Data Ekonomi
            $table->decimal('omzet_bulanan', 15, 2)->nullable()->comment('Omzet per bulan dalam Rupiah');
            $table->integer('jumlah_tenaga_kerja')->default(0)->comment('Jumlah karyawan/tenaga kerja');

            // Status Verifikasi
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            // Index untuk performa pencarian
            $table->index(['kecamatan', 'kelurahan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_profiles');
    }
};
