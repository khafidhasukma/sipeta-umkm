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
        Schema::create('production_clusters', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Informasi Sentra/Cluster
            $table->string('nama_sentra')->index();
            $table->string('jenis_komoditas')->index()->comment('Jenis produk/komoditas unggulan');
            $table->longText('polygon_json')->nullable()->comment('Data GeoJSON polygon area sentra');
            $table->integer('total_member')->default(0)->comment('Jumlah UMKM anggota sentra');

            $table->timestamps();

            // Index untuk pencarian dan analisis
            $table->index(['jenis_komoditas', 'total_member']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_clusters');
    }
};
