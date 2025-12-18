<?php

namespace App\Console\Commands;

use App\Services\ClusteringService;
use Illuminate\Console\Command;

class AnalyzeClusters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:analyze-clusters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Analisis sentra produksi berdasarkan bahan baku UMKM';

    /**
     * Execute the console command.
     */
    public function handle(ClusteringService $clusteringService): int
    {
        $this->info('🔍 Memulai analisis sentra produksi...');
        $this->newLine();

        try {
            // Jalankan analisis
            $result = $clusteringService->analyze();

            // Tampilkan hasil
            $this->components->info('Analisis selesai!');
            $this->table(
                ['Metrik', 'Jumlah'],
                [
                    ['Sentra Baru Dibuat', $result['created']],
                    ['Sentra Diperbarui', $result['updated']],
                    ['Total Kandidat Sentra', $result['total_candidates']],
                ]
            );

            $this->newLine();

            // Tampilkan statistik
            $stats = $clusteringService->getStatistics();
            $this->components->info('Statistik Clustering:');
            $this->line("Total Sentra Produksi: <fg=green>{$stats['total_clusters']}</>");
            $this->line("Total UMKM dalam Sentra: <fg=green>{$stats['total_umkm_in_clusters']}</>");
            $this->line("Threshold Minimum: <fg=yellow>{$stats['cluster_threshold']} UMKM</>");

            $this->newLine();

            // Tampilkan top komoditas
            if ($stats['top_commodities']->isNotEmpty()) {
                $this->components->info('Top 5 Komoditas:');
                $this->table(
                    ['Komoditas', 'Total UMKM'],
                    $stats['top_commodities']->map(fn ($item) => [
                        $item->jenis_komoditas,
                        $item->total,
                    ])->toArray()
                );
            }

            $this->newLine();
            $this->components->success('✅ Analisis berhasil diselesaikan!');

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->components->error('Terjadi kesalahan: ' . $e->getMessage());
            $this->error($e->getTraceAsString());

            return self::FAILURE;
        }
    }
}
