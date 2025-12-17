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
        Schema::create('production_tools', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('umkm_profile_id')->constrained('umkm_profiles')->cascadeOnDelete();

            // Informasi Alat Produksi
            $table->string('nama_alat');
            $table->string('jenis')->comment('Kategori/jenis alat produksi');
            $table->string('kapasitas')->nullable()->comment('Kapasitas produksi per satuan waktu');
            $table->enum('kondisi', ['baik', 'rusak ringan', 'rusak berat', 'perlu perbaikan'])->default('baik');
            $table->enum('status_kepemilikan', ['milik sendiri', 'sewa', 'pinjam', 'hibah'])->default('milik sendiri');

            $table->timestamps();

            // Index untuk query optimization
            $table->index('umkm_profile_id');
            $table->index(['umkm_profile_id', 'jenis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_tools');
    }
};
