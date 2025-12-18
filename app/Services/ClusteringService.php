<?php

namespace App\Services;

use App\Models\ProductionCluster;
use App\Models\RawMaterial;
use App\Models\UmkmProfile;
use Illuminate\Support\Facades\DB;

class ClusteringService
{
    /**
     * Threshold minimum UMKM untuk membentuk sentra produksi
     */
    private const CLUSTER_THRESHOLD = 15;

    /**
     * Analisis sentra produksi berdasarkan bahan baku
     */
    public function analyze(): array
    {
        // Ambil data raw materials dengan grouping berdasarkan kecamatan dan nama_bahan
        $clusterCandidates = RawMaterial::query()
            ->select(
                'kecamatan',
                'nama_bahan',
                DB::raw('COUNT(DISTINCT umkm_profile_id) as total_umkm'),
                DB::raw('GROUP_CONCAT(DISTINCT umkm_profile_id) as umkm_ids')
            )
            ->join('umkm_profiles', 'raw_materials.umkm_profile_id', '=', 'umkm_profiles.id')
            ->whereNotNull('umkm_profiles.kecamatan')
            ->whereNotNull('raw_materials.nama_bahan')
            ->groupBy('kecamatan', 'nama_bahan')
            ->having('total_umkm', '>=', self::CLUSTER_THRESHOLD)
            ->get();

        $created = 0;
        $updated = 0;

        foreach ($clusterCandidates as $candidate) {
            $umkmIds = explode(',', $candidate->umkm_ids);

            // Ambil data UMKM untuk membuat polygon
            $umkmData = UmkmProfile::query()
                ->whereIn('id', $umkmIds)
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get(['id', 'latitude', 'longitude', 'nama_usaha']);

            // Skip jika tidak ada cukup data koordinat
            if ($umkmData->count() < 3) {
                continue;
            }

            // Generate polygon dari koordinat UMKM
            $polygon = $this->generatePolygon($umkmData);

            // Cek apakah sentra sudah ada
            $cluster = ProductionCluster::query()
                ->where('nama_sentra', $candidate->kecamatan.' - '.$candidate->nama_bahan)
                ->first();

            $clusterData = [
                'nama_sentra' => $candidate->kecamatan.' - '.$candidate->nama_bahan,
                'jenis_komoditas' => $candidate->nama_bahan,
                'polygon_json' => $polygon,
                'total_member' => $candidate->total_umkm,
            ];

            if ($cluster) {
                $cluster->update($clusterData);
                $updated++;
            } else {
                ProductionCluster::create($clusterData);
                $created++;
            }
        }

        return [
            'created' => $created,
            'updated' => $updated,
            'total_candidates' => $clusterCandidates->count(),
        ];
    }

    /**
     * Generate polygon dari kumpulan koordinat UMKM
     * Menggunakan convex hull sederhana
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $umkmData
     */
    private function generatePolygon($umkmData): array
    {
        $coordinates = $umkmData->map(function ($umkm) {
            return [
                'lat' => (float) $umkm->latitude,
                'lng' => (float) $umkm->longitude,
            ];
        })->toArray();

        // Convex Hull menggunakan Gift Wrapping Algorithm
        $hull = $this->convexHull($coordinates);

        return [
            'type' => 'Polygon',
            'coordinates' => [$hull],
        ];
    }

    /**
     * Algoritma Convex Hull (Gift Wrapping)
     */
    private function convexHull(array $points): array
    {
        $n = count($points);

        // Jika kurang dari 3 titik, tidak bisa membentuk polygon
        if ($n < 3) {
            return $points;
        }

        $hull = [];

        // Cari titik paling kiri
        $leftmost = 0;
        for ($i = 1; $i < $n; $i++) {
            if ($points[$i]['lng'] < $points[$leftmost]['lng']) {
                $leftmost = $i;
            }
        }

        $p = $leftmost;
        $q = 0;

        do {
            $hull[] = $points[$p];
            $q = ($p + 1) % $n;

            for ($i = 0; $i < $n; $i++) {
                if ($this->orientation($points[$p], $points[$i], $points[$q]) === 2) {
                    $q = $i;
                }
            }

            $p = $q;
        } while ($p !== $leftmost);

        return $hull;
    }

    /**
     * Hitung orientasi tiga titik
     * 0: Colinear, 1: Clockwise, 2: Counterclockwise
     */
    private function orientation(array $p, array $q, array $r): int
    {
        $val = ($q['lat'] - $p['lat']) * ($r['lng'] - $q['lng']) -
               ($q['lng'] - $p['lng']) * ($r['lat'] - $q['lat']);

        if ($val === 0.0) {
            return 0;
        }

        return ($val > 0) ? 1 : 2;
    }

    /**
     * Mengambil data GeoJSON untuk visualisasi peta
     */
    public function getMapData(): array
    {
        // Data UMKM sebagai point markers
        $umkmPoints = UmkmProfile::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->with('rawMaterials:umkm_profile_id,nama_bahan')
            ->get()
            ->map(function ($umkm) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [
                            (float) $umkm->longitude,
                            (float) $umkm->latitude,
                        ],
                    ],
                    'properties' => [
                        'id' => $umkm->id,
                        'nama_usaha' => $umkm->nama_usaha,
                        'kecamatan' => $umkm->kecamatan,
                        'kelurahan' => $umkm->kelurahan,
                        'omzet_bulanan' => $umkm->omzet_bulanan,
                        'raw_materials' => $umkm->rawMaterials->pluck('nama_bahan')->unique()->values(),
                    ],
                ];
            });

        // Data sentra produksi sebagai polygon
        $clusterPolygons = ProductionCluster::query()
            ->get()
            ->map(function ($cluster) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Polygon',
                        'coordinates' => [
                            collect($cluster->polygon_json['coordinates'][0] ?? [])
                                ->map(fn ($point) => [$point['lng'], $point['lat']])
                                ->toArray(),
                        ],
                    ],
                    'properties' => [
                        'id' => $cluster->id,
                        'nama_sentra' => $cluster->nama_sentra,
                        'jenis_komoditas' => $cluster->jenis_komoditas,
                        'total_member' => $cluster->total_member,
                    ],
                ];
            });

        return [
            'type' => 'FeatureCollection',
            'features' => [
                ...$umkmPoints->toArray(),
                ...$clusterPolygons->toArray(),
            ],
        ];
    }

    /**
     * Dapatkan statistik clustering
     */
    public function getStatistics(): array
    {
        $totalClusters = ProductionCluster::count();
        $totalUmkmInClusters = ProductionCluster::sum('total_member');

        $topCommodities = ProductionCluster::query()
            ->select('jenis_komoditas', DB::raw('SUM(total_member) as total'))
            ->groupBy('jenis_komoditas')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'total_clusters' => $totalClusters,
            'total_umkm_in_clusters' => $totalUmkmInClusters,
            'top_commodities' => $topCommodities,
            'cluster_threshold' => self::CLUSTER_THRESHOLD,
        ];
    }
}
