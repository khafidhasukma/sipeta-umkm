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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('umkm_profile_id')->constrained('umkm_profiles')->cascadeOnDelete();

            // Informasi Bahan Baku
            $table->string('nama_bahan');
            $table->decimal('kebutuhan_per_bulan', 12, 2)->comment('Jumlah kebutuhan per bulan');
            $table->string('satuan')->comment('Satuan ukuran (kg, liter, pcs, dll)');
            $table->string('asal_supplier')->nullable()->comment('Nama atau lokasi supplier');

            $table->timestamps();

            // Index untuk query optimization
            $table->index('umkm_profile_id');
            $table->index(['umkm_profile_id', 'nama_bahan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
