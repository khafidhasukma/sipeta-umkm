<?php

namespace Database\Factories;

use App\Models\RawMaterial;
use App\Models\UmkmProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class RawMaterialFactory extends Factory
{
    protected $model = RawMaterial::class;

    // Bahan baku berdasarkan kategori UMKM
    private static $materials = [
        'Makanan & Minuman' => [
            'Beras', 'Tepung Terigu', 'Gula Pasir', 'Garam', 'Minyak Goreng',
            'Telur', 'Ayam', 'Daging Sapi', 'Ikan', 'Sayuran',
            'Bumbu Dapur', 'Santan', 'Kopi Bubuk', 'Teh', 'Susu',
            'Bandeng', 'Tepung Ketan', 'Kelapa', 'Cabai', 'Bawang',
        ],
        'Fashion & Konveksi' => [
            'Kain Katun', 'Kain Polyester', 'Kain Jeans', 'Benang Jahit',
            'Kancing', 'Resleting', 'Kain Furing', 'Dakron', 'Busa',
            'Lem Tekstil', 'Cat Sablon', 'Screen Sablon', 'Tinta Bordir',
        ],
        'Kerajinan' => [
            'Kayu Jati', 'Kayu Mahoni', 'Rotan', 'Bambu', 'Kulit Sintetis',
            'Kulit Asli', 'Lem Kayu', 'Cat Kayu', 'Pernis', 'Amplas',
            'Paku', 'Baut', 'Tanah Liat', 'Pewarna', 'Manik-manik',
        ],
        'Jasa' => [
            'Deterjen', 'Pewangi', 'Pelembut', 'Pemutih', 'Kertas HVS',
            'Tinta Printer', 'Shampoo', 'Hair Dye', 'Oli Mesin', 'Spare Part',
        ],
        'Perdagangan' => [
            'Produk Consumer Goods', 'Alat Tulis', 'Elektronik',
            'Sembako', 'Minuman Kemasan', 'Snack', 'Obat-obatan',
        ],
    ];

    public function definition(): array
    {
        $kategori = fake()->randomElement(array_keys(self::$materials));
        $material = fake()->randomElement(self::$materials[$kategori]);

        // Satuan yang realistis
        $satuan = match($material) {
            'Beras', 'Tepung Terigu', 'Gula Pasir', 'Garam' => 'Kg',
            'Telur' => 'Butir',
            'Ayam', 'Daging Sapi', 'Ikan', 'Bandeng' => 'Kg',
            'Kain Katun', 'Kain Polyester', 'Kain Jeans' => 'Meter',
            'Kayu Jati', 'Kayu Mahoni' => 'Kubik',
            'Benang Jahit' => 'Gulung',
            'Cat Kayu', 'Pernis', 'Lem Kayu' => 'Liter',
            'Tinta Printer' => 'Botol',
            default => 'Unit',
        };

        // Kebutuhan per bulan yang realistis
        $kebutuhan = match($satuan) {
            'Kg' => fake()->numberBetween(50, 2000),
            'Meter' => fake()->numberBetween(100, 5000),
            'Kubik' => fake()->numberBetween(5, 50),
            'Liter' => fake()->numberBetween(20, 500),
            'Gulung' => fake()->numberBetween(50, 1000),
            'Botol' => fake()->numberBetween(20, 200),
            'Butir' => fake()->numberBetween(200, 2000),
            default => fake()->numberBetween(50, 1000),
        };

        // Supplier realistis untuk Semarang
        $suppliers = [
            'Pasar Johar', 'Pasar Bulu', 'Pasar Peterongan', 'Pasar Karimata',
            'Toko Lokal Semarang', 'Distributor Jateng', 'Supplier Jakarta',
            'Importir', 'Produsen Lokal', 'Koperasi UMKM', 'Grosir Semawis',
        ];

        return [
            'umkm_profile_id' => UmkmProfile::factory(),
            'nama_bahan' => $material,
            'kebutuhan_per_bulan' => $kebutuhan,
            'satuan' => $satuan,
            'asal_supplier' => fake()->randomElement($suppliers),
        ];
    }
}
