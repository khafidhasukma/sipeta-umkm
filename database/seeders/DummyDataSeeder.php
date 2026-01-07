<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UmkmProfile;
use App\Models\ProductionTool;
use App\Models\RawMaterial;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all existing production tools and raw materials
        ProductionTool::truncate();
        RawMaterial::truncate();

        // Update all UMKM users to have 13-digit NIB
        $users = User::where('role', 'umkm')->get();
        foreach ($users as $index => $user) {
            // Generate 13-digit NIB: 8712345 + 6 digit index
            $nib = '8712345' . str_pad($index + 1, 6, '0', STR_PAD_LEFT);
            $user->update(['nib' => $nib]);
        }

        // Add production tools to all UMKM profiles
        $umkmProfiles = UmkmProfile::all();
        
        $productionToolsData = [
            ['nama_alat' => 'Mesin Jahit', 'jenis' => 'Mesin Produksi', 'kapasitas' => '2 unit', 'kondisi' => 'baik', 'status_kepemilikan' => 'milik sendiri'],
            ['nama_alat' => 'Mesin Obras', 'jenis' => 'Mesin Produksi', 'kapasitas' => '1 unit', 'kondisi' => 'baik', 'status_kepemilikan' => 'milik sendiri'],
            ['nama_alat' => 'Gunting Kain', 'jenis' => 'Alat Manual', 'kapasitas' => '5 unit', 'kondisi' => 'baik', 'status_kepemilikan' => 'milik sendiri'],
            ['nama_alat' => 'Meja Potong', 'jenis' => 'Peralatan', 'kapasitas' => '2 unit', 'kondisi' => 'baik', 'status_kepemilikan' => 'milik sendiri'],
        ];

        $rawMaterialsData = [
            ['nama_bahan' => 'Kain Katun', 'kebutuhan_per_bulan' => 100, 'satuan' => 'meter', 'asal_supplier' => 'Toko Kain Lokal'],
            ['nama_bahan' => 'Benang', 'kebutuhan_per_bulan' => 50, 'satuan' => 'roll', 'asal_supplier' => 'Toko Jahit'],
            ['nama_bahan' => 'Kancing', 'kebutuhan_per_bulan' => 200, 'satuan' => 'pack', 'asal_supplier' => 'Supplier Online'],
            ['nama_bahan' => 'Resleting', 'kebutuhan_per_bulan' => 150, 'satuan' => 'unit', 'asal_supplier' => 'Toko Jahit'],
        ];

        foreach ($umkmProfiles as $umkm) {
            // Add production tools
            foreach ($productionToolsData as $tool) {
                ProductionTool::create([
                    'umkm_profile_id' => $umkm->id,
                    'nama_alat' => $tool['nama_alat'],
                    'jenis' => $tool['jenis'],
                    'kapasitas' => $tool['kapasitas'],
                    'kondisi' => $tool['kondisi'],
                    'status_kepemilikan' => $tool['status_kepemilikan'],
                ]);
            }

            // Add raw materials
            foreach ($rawMaterialsData as $material) {
                RawMaterial::create([
                    'umkm_profile_id' => $umkm->id,
                    'nama_bahan' => $material['nama_bahan'],
                    'kebutuhan_per_bulan' => $material['kebutuhan_per_bulan'],
                    'satuan' => $material['satuan'],
                    'asal_supplier' => $material['asal_supplier'],
                ]);
            }
        }

        $this->command->info('Dummy data seeded successfully!');
        $this->command->info('NIB updated for ' . $users->count() . ' users');
        $this->command->info('Production tools and raw materials added to ' . $umkmProfiles->count() . ' UMKM profiles');
    }
}
