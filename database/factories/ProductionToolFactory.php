<?php

namespace Database\Factories;

use App\Models\ProductionTool;
use App\Models\UmkmProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionToolFactory extends Factory
{
    protected $model = ProductionTool::class;

    // Alat produksi berdasarkan kategori UMKM
    private static $tools = [
        'Makanan & Minuman' => [
            ['nama' => 'Kompor Gas', 'jumlah' => [1, 5]],
            ['nama' => 'Wajan Besar', 'jumlah' => [2, 10]],
            ['nama' => 'Oven', 'jumlah' => [1, 3]],
            ['nama' => 'Mixer', 'jumlah' => [1, 2]],
            ['nama' => 'Kulkas', 'jumlah' => [1, 3]],
            ['nama' => 'Freezer', 'jumlah' => [1, 2]],
            ['nama' => 'Blender', 'jumlah' => [1, 3]],
            ['nama' => 'Pisau Set', 'jumlah' => [1, 5]],
            ['nama' => 'Panci Besar', 'jumlah' => [2, 8]],
            ['nama' => 'Mesin Espresso', 'jumlah' => [1, 2]],
        ],
        'Fashion & Konveksi' => [
            ['nama' => 'Mesin Jahit', 'jumlah' => [2, 20]],
            ['nama' => 'Mesin Obras', 'jumlah' => [1, 5]],
            ['nama' => 'Mesin Bordir', 'jumlah' => [1, 3]],
            ['nama' => 'Mesin Sablon', 'jumlah' => [1, 5]],
            ['nama' => 'Gunting Kain', 'jumlah' => [5, 20]],
            ['nama' => 'Meja Potong', 'jumlah' => [1, 5]],
            ['nama' => 'Setrika Uap', 'jumlah' => [1, 10]],
        ],
        'Kerajinan' => [
            ['nama' => 'Mesin Ukir', 'jumlah' => [1, 3]],
            ['nama' => 'Gerinda', 'jumlah' => [1, 5]],
            ['nama' => 'Mesin Bor', 'jumlah' => [1, 3]],
            ['nama' => 'Pahat Set', 'jumlah' => [1, 10]],
            ['nama' => 'Amplas Mesin', 'jumlah' => [1, 3]],
            ['nama' => 'Kompressor', 'jumlah' => [1, 2]],
        ],
        'Jasa' => [
            ['nama' => 'Mesin Cuci', 'jumlah' => [1, 5]],
            ['nama' => 'Mesin Pengering', 'jumlah' => [1, 3]],
            ['nama' => 'Setrika', 'jumlah' => [1, 10]],
            ['nama' => 'Printer', 'jumlah' => [1, 3]],
            ['nama' => 'Komputer', 'jumlah' => [1, 5]],
            ['nama' => 'Kamera DSLR', 'jumlah' => [1, 3]],
        ],
        'Perdagangan' => [
            ['nama' => 'Rak Display', 'jumlah' => [5, 20]],
            ['nama' => 'Kasir', 'jumlah' => [1, 3]],
            ['nama' => 'Timbangan Digital', 'jumlah' => [1, 5]],
            ['nama' => 'Kulkas Display', 'jumlah' => [1, 5]],
        ],
    ];

    public function definition(): array
    {
        $kategori = fake()->randomElement(array_keys(self::$tools));
        $tool = fake()->randomElement(self::$tools[$kategori]);
        [$min, $max] = $tool['jumlah'];
        
        $jumlah = fake()->numberBetween($min, $max);
        $kondisiOptions = ['baik', 'rusak ringan', 'rusak berat', 'perlu perbaikan'];
        $kepemilikanOptions = ['milik sendiri', 'sewa', 'pinjam', 'hibah'];

        return [
            'umkm_profile_id' => UmkmProfile::factory(),
            'nama_alat' => $tool['nama'],
            'jenis' => $kategori,
            'kapasitas' => $jumlah . ' unit/hari',
            'kondisi' => fake()->randomElement($kondisiOptions),
            'status_kepemilikan' => fake()->randomElement($kepemilikanOptions),
        ];
    }
}
