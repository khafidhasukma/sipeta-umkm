<?php

namespace Database\Seeders;

use App\Models\ProductionCluster;
use App\Models\ProductionTool;
use App\Models\RawMaterial;
use App\Models\UmkmProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create UMKM users
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => bcrypt('password'),
                'role' => 'umkm',
                'nib' => '1234567890123',
                'is_active' => true,
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@example.com',
                'password' => bcrypt('password'),
                'role' => 'umkm',
                'nib' => '9876543210123',
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'password' => bcrypt('password'),
                'role' => 'umkm',
                'nib' => '5555666677778',
                'is_active' => true,
            ],
        ];

        $umkmProfiles = [
            [
                'nama_usaha' => 'Keripik Singkong Melati',
                'kecamatan' => 'Semarang Tengah',
                'kelurahan' => 'Kauman',
                'alamat_lengkap' => 'Jl. Pemuda No. 123, Kauman, Semarang Tengah',
                'latitude' => -6.9667,
                'longitude' => 110.4167,
                'jumlah_tenaga_kerja' => 5,
                'omzet_bulanan' => 15000000,
                'is_verified' => true,
                'verified_at' => now(),
            ],
            [
                'nama_usaha' => 'Batik Tradisional Nusantara',
                'kecamatan' => 'Semarang Utara',
                'kelurahan' => 'Bandarharjo',
                'alamat_lengkap' => 'Jl. Batik No. 45, Bandarharjo, Semarang Utara',
                'latitude' => -6.9503,
                'longitude' => 110.4131,
                'jumlah_tenaga_kerja' => 8,
                'omzet_bulanan' => 25000000,
                'is_verified' => true,
                'verified_at' => now(),
            ],
            [
                'nama_usaha' => 'Furniture Jati Asli',
                'kecamatan' => 'Semarang Selatan',
                'kelurahan' => 'Mugassari',
                'alamat_lengkap' => 'Jl. Industri No. 78, Mugassari, Semarang Selatan',
                'latitude' => -7.0051,
                'longitude' => 110.4203,
                'jumlah_tenaga_kerja' => 12,
                'omzet_bulanan' => 45000000,
                'is_verified' => false,
            ],
        ];

        foreach ($users as $index => $userData) {
            $user = User::create($userData);

            $profileData = $umkmProfiles[$index];
            $profileData['user_id'] = $user->id;

            $profile = UmkmProfile::create($profileData);

            // Add production tools
            if ($index === 0) {
                // Keripik Singkong
                ProductionTool::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_alat' => 'Mesin Pengupas Singkong',
                    'jenis' => 'Mesin Produksi',
                    'kondisi' => 'baik',
                    'status_kepemilikan' => 'milik sendiri',
                ]);
                ProductionTool::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_alat' => 'Mesin Pemotong',
                    'jenis' => 'Mesin Produksi',
                    'kondisi' => 'rusak ringan',
                    'status_kepemilikan' => 'milik sendiri',
                ]);

                // Add raw materials
                RawMaterial::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_bahan' => 'Singkong',
                    'kebutuhan_per_bulan' => 500,
                    'satuan' => 'Kg',
                    'asal_supplier' => 'Petani Lokal Semarang',
                ]);
                RawMaterial::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_bahan' => 'Minyak Goreng',
                    'kebutuhan_per_bulan' => 100,
                    'satuan' => 'Liter',
                    'asal_supplier' => 'Toko Grosir ABC',
                ]);
            } elseif ($index === 1) {
                // Batik
                ProductionTool::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_alat' => 'Canting Batik',
                    'jenis' => 'Alat Manual',
                    'kondisi' => 'baik',
                    'status_kepemilikan' => 'milik sendiri',
                ]);
                ProductionTool::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_alat' => 'Kompor Malam',
                    'jenis' => 'Alat Pemanas',
                    'kondisi' => 'baik',
                    'status_kepemilikan' => 'milik sendiri',
                ]);

                RawMaterial::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_bahan' => 'Kain Mori',
                    'kebutuhan_per_bulan' => 200,
                    'satuan' => 'Meter',
                    'asal_supplier' => 'Supplier Tekstil Jakarta',
                ]);
                RawMaterial::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_bahan' => 'Pewarna Batik',
                    'kebutuhan_per_bulan' => 50,
                    'satuan' => 'Kg',
                    'asal_supplier' => 'Toko Kimia Batik',
                ]);
            } elseif ($index === 2) {
                // Furniture
                ProductionTool::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_alat' => 'Mesin Serut Kayu',
                    'jenis' => 'Mesin Produksi',
                    'kondisi' => 'baik',
                    'status_kepemilikan' => 'milik sendiri',
                ]);
                ProductionTool::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_alat' => 'Gergaji Mesin',
                    'jenis' => 'Mesin Potong',
                    'kondisi' => 'baik',
                    'status_kepemilikan' => 'sewa',
                ]);

                RawMaterial::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_bahan' => 'Kayu Jati',
                    'kebutuhan_per_bulan' => 5,
                    'satuan' => 'Kubik',
                    'asal_supplier' => 'Perhutani',
                ]);
                RawMaterial::create([
                    'umkm_profile_id' => $profile->id,
                    'nama_bahan' => 'Cat Kayu',
                    'kebutuhan_per_bulan' => 30,
                    'satuan' => 'Liter',
                    'asal_supplier' => 'Toko Cat Sentosa',
                ]);
            }
        }

        // Create production clusters
        ProductionCluster::create([
            'nama_sentra' => 'Sentra Keripik Singkong Kauman',
            'jenis_komoditas' => 'Makanan Ringan',
            'total_member' => 15,
            'polygon_json' => json_encode([
                'type' => 'Polygon',
                'coordinates' => [
                    [
                        [110.4167, -6.9667],
                        [110.4200, -6.9667],
                        [110.4200, -6.9700],
                        [110.4167, -6.9700],
                        [110.4167, -6.9667],
                    ],
                ],
            ]),
        ]);

        ProductionCluster::create([
            'nama_sentra' => 'Sentra Batik Bandarharjo',
            'jenis_komoditas' => 'Fashion & Tekstil',
            'total_member' => 22,
            'polygon_json' => json_encode([
                'type' => 'Polygon',
                'coordinates' => [
                    [
                        [110.4131, -6.9503],
                        [110.4170, -6.9503],
                        [110.4170, -6.9540],
                        [110.4131, -6.9540],
                        [110.4131, -6.9503],
                    ],
                ],
            ]),
        ]);

        ProductionCluster::create([
            'nama_sentra' => 'Sentra Mebel Mugassari',
            'jenis_komoditas' => 'Mebel & Furniture',
            'total_member' => 18,
            'polygon_json' => null,
        ]);
    }
}
