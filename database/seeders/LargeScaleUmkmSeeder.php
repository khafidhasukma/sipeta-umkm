<?php

namespace Database\Seeders;

use App\Models\ProductionTool;
use App\Models\RawMaterial;
use App\Models\UmkmProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LargeScaleUmkmSeeder extends Seeder
{
    /**
     * Seed 5000+ UMKM untuk analisis Walikota Semarang
     */
    public function run(): void
    {
        $this->command->info('🚀 Memulai seeding 5000+ UMKM untuk Kota Semarang...');

        // Disable foreign key checks (support untuk SQLite dan MySQL)
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        }

        // Truncate existing data
        $this->command->info('🗑️  Membersihkan data lama...');
        ProductionTool::truncate();
        RawMaterial::truncate();
        UmkmProfile::truncate();
        User::where('role', 'umkm')->delete();

        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }

        // Target: 5000 UMKM
        $totalUmkm = 5000;
        $batchSize = 500; // Process dalam batch untuk efisiensi memory
        $batches = ceil($totalUmkm / $batchSize);

        $this->command->info("📊 Target: {$totalUmkm} UMKM dalam {$batches} batch");

        $progressBar = $this->command->getOutput()->createProgressBar($totalUmkm);
        $progressBar->start();

        for ($batch = 0; $batch < $batches; $batch++) {
            $currentBatchSize = min($batchSize, $totalUmkm - ($batch * $batchSize));
            
            $this->command->newLine();
            $this->command->info("Batch " . ($batch + 1) . "/{$batches}: Creating {$currentBatchSize} UMKM...");

            // Buat users dalam batch
            $users = User::factory()
                ->count($currentBatchSize)
                ->create([
                    'role' => 'umkm',
                    'password' => Hash::make('password123'),
                ]);

            // Buat UMKM profiles untuk setiap user
            $users->each(function ($user) use ($progressBar) {
                // Buat UMKM profile
                $umkmProfile = UmkmProfile::factory()->create([
                    'user_id' => $user->id,
                ]);

                // Tambahkan 2-5 alat produksi untuk setiap UMKM
                $toolCount = rand(2, 5);
                ProductionTool::factory()
                    ->count($toolCount)
                    ->create([
                        'umkm_profile_id' => $umkmProfile->id,
                    ]);

                // Tambahkan 3-7 bahan baku untuk setiap UMKM
                $materialCount = rand(3, 7);
                RawMaterial::factory()
                    ->count($materialCount)
                    ->create([
                        'umkm_profile_id' => $umkmProfile->id,
                    ]);

                $progressBar->advance();
            });

            // Free memory
            unset($users);
            
            if (($batch + 1) % 3 === 0) {
                $this->command->newLine();
                $this->command->info('💾 Checkpoint: ' . (($batch + 1) * $batchSize) . ' UMKM telah dibuat');
            }
        }

        $progressBar->finish();
        $this->command->newLine(2);

        // Statistik akhir
        $totalCreated = UmkmProfile::count();
        $totalVerified = UmkmProfile::where('is_verified', true)->count();
        $totalPending = UmkmProfile::where('is_verified', false)->count();
        $totalTools = ProductionTool::count();
        $totalMaterials = RawMaterial::count();

        $this->command->info('✅ Seeding selesai!');
        $this->command->newLine();
        $this->command->table(
            ['Metric', 'Jumlah'],
            [
                ['Total UMKM', number_format($totalCreated)],
                ['UMKM Terverifikasi', number_format($totalVerified) . ' (' . round(($totalVerified/$totalCreated)*100, 1) . '%)'],
                ['UMKM Pending', number_format($totalPending) . ' (' . round(($totalPending/$totalCreated)*100, 1) . '%)'],
                ['Total Alat Produksi', number_format($totalTools)],
                ['Total Bahan Baku', number_format($totalMaterials)],
                ['Rata-rata Alat per UMKM', number_format($totalTools/$totalCreated, 1)],
                ['Rata-rata Bahan per UMKM', number_format($totalMaterials/$totalCreated, 1)],
            ]
        );

        $this->command->newLine();
        $this->command->info('📍 Distribusi per Kecamatan:');
        $distribution = UmkmProfile::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->get();

        $distTable = $distribution->map(fn($d) => [
            $d->kecamatan,
            number_format($d->total),
            round(($d->total / $totalCreated) * 100, 1) . '%'
        ])->toArray();

        $this->command->table(['Kecamatan', 'Jumlah UMKM', 'Persentase'], $distTable);

        $this->command->newLine();
        $this->command->info('🎯 Dataset siap untuk analisis Walikota Semarang!');
        $this->command->info('💡 Default password semua akun UMKM: password123');
    }
}
