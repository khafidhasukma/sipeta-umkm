<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmProfile;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_umkm' => UmkmProfile::count(),
            'verified_umkm' => UmkmProfile::where('is_verified', true)->count(),
            'total_workers' => UmkmProfile::sum('jumlah_tenaga_kerja'),
            'total_revenue' => UmkmProfile::sum('omzet_bulanan'),
        ];

        $umkmByKecamatan = UmkmProfile::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->get();

        $recentUmkm = UmkmProfile::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Check database driver for date formatting
        $driver = config('database.default');
        $connection = config("database.connections.{$driver}.driver");
        
        if ($connection === 'sqlite') {
            $monthlyRevenue = UmkmProfile::select(
                DB::raw("strftime('%Y-%m', created_at) as month"),
                DB::raw('SUM(omzet_bulanan) as total')
            )
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(6)
                ->get()
                ->reverse();
        } else {
            $monthlyRevenue = UmkmProfile::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(omzet_bulanan) as total')
            )
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(6)
                ->get()
                ->reverse();
        }

        return view('admin.dashboard', compact('stats', 'umkmByKecamatan', 'recentUmkm', 'monthlyRevenue'));
    }

    public function analisisSentra()
    {
        // Analisis klaster berdasarkan kecamatan dan jenis usaha
        $sentraData = UmkmProfile::select('kecamatan', 'jenis_usaha', DB::raw('count(*) as total_umkm'))
            ->where('is_verified', true)
            ->whereNotNull('jenis_usaha')
            ->where('jenis_usaha', '!=', '')
            ->groupBy('kecamatan', 'jenis_usaha')
            ->orderBy('total_umkm', 'desc')
            ->get();

        // Distribusi UMKM per kecamatan
        $umkmPerKecamatan = UmkmProfile::select('kecamatan', DB::raw('count(*) as total'))
            ->where('is_verified', true)
            ->whereNotNull('kecamatan')
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->get();

        // Top 10 jenis usaha
        $topJenisUsaha = UmkmProfile::select('jenis_usaha', DB::raw('count(*) as total'))
            ->where('is_verified', true)
            ->whereNotNull('jenis_usaha')
            ->where('jenis_usaha', '!=', '')
            ->groupBy('jenis_usaha')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Analisis alat produksi per kecamatan (untuk clustering)
        $alatPerKecamatan = DB::table('production_tools')
            ->join('umkm_profiles', 'production_tools.umkm_profile_id', '=', 'umkm_profiles.id')
            ->select(
                'umkm_profiles.kecamatan',
                'production_tools.nama_alat',
                DB::raw('count(*) as jumlah_umkm')
            )
            ->where('umkm_profiles.is_verified', true)
            ->whereNotNull('production_tools.nama_alat')
            ->groupBy('umkm_profiles.kecamatan', 'production_tools.nama_alat')
            ->orderBy('jumlah_umkm', 'desc')
            ->get();

        return view('admin.analisis-sentra', compact('sentraData', 'umkmPerKecamatan', 'topJenisUsaha', 'alatPerKecamatan'));
    }

    public function monitoringAlat()
    {
        // Get all alat with kecamatan info
        $allTools = DB::table('production_tools')
            ->join('umkm_profiles', 'production_tools.umkm_profile_id', '=', 'umkm_profiles.id')
            ->select('umkm_profiles.kecamatan', 'production_tools.nama_alat')
            ->where('umkm_profiles.is_verified', true)
            ->whereNotNull('production_tools.nama_alat')
            ->get();

        // Group by kecamatan and aggregate
        $alatPerKecamatan = $allTools->groupBy('kecamatan')->map(function ($items, $kecamatan) {
            return (object)[
                'kecamatan' => $kecamatan,
                'jenis_alat' => $items->pluck('nama_alat')->unique()->count(),
                'total_alat' => $items->count(),
                'daftar_alat' => $items->pluck('nama_alat')->unique()->values()->take(5)->implode(', ')
            ];
        })->sortByDesc('total_alat')->values();

        // Top 10 alat produksi paling banyak
        $topAlat = DB::table('production_tools')
            ->select('nama_alat', DB::raw('count(*) as total'))
            ->whereNotNull('nama_alat')
            ->groupBy('nama_alat')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Bahan baku per kecamatan
        $bahanPerKecamatan = DB::table('raw_materials')
            ->join('umkm_profiles', 'raw_materials.umkm_profile_id', '=', 'umkm_profiles.id')
            ->select(
                'umkm_profiles.kecamatan',
                DB::raw('count(DISTINCT raw_materials.nama_bahan) as jenis_bahan')
            )
            ->where('umkm_profiles.is_verified', true)
            ->whereNotNull('raw_materials.nama_bahan')
            ->groupBy('umkm_profiles.kecamatan')
            ->orderBy('jenis_bahan', 'desc')
            ->get();

        // Recent production tools added
        $recentTools = DB::table('production_tools')
            ->join('umkm_profiles', 'production_tools.umkm_profile_id', '=', 'umkm_profiles.id')
            ->select('production_tools.*', 'umkm_profiles.nama_usaha', 'umkm_profiles.kecamatan')
            ->whereNotNull('production_tools.nama_alat')
            ->orderBy('production_tools.created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.monitoring-alat', compact('alatPerKecamatan', 'topAlat', 'bahanPerKecamatan', 'recentTools'));
    }
}
