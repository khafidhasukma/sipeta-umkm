<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->umkmProfile()->with(['productionTools', 'rawMaterials'])->first();

        // Data for Collaboration Feature
        $nearbyUmkms = collect();
        $potentialPartners = collect();

        // Stats for charts
        $stats = [
            'total_production_tools' => $profile ? $profile->productionTools()->count() : 0,
            'total_raw_materials' => $profile ? $profile->rawMaterials()->count() : 0,
            'omzet_bulanan' => $profile ? $profile->omzet_bulanan : 0,
            'tenaga_kerja' => $profile ? $profile->jumlah_tenaga_kerja : 0,
        ];

        // Monthly revenue trend (last 6 months - mock data for now)
        $monthlyTrend = [
            'labels' => ['Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            'data' => [
                $stats['omzet_bulanan'] * 0.7,
                $stats['omzet_bulanan'] * 0.8,
                $stats['omzet_bulanan'] * 0.75,
                $stats['omzet_bulanan'] * 0.9,
                $stats['omzet_bulanan'] * 0.95,
                $stats['omzet_bulanan'],
            ],
        ];

        // Production tools by condition
        $toolsByCondition = [];
        if ($profile) {
            $toolsByCondition = $profile->productionTools()
                ->selectRaw('kondisi, COUNT(*) as total')
                ->groupBy('kondisi')
                ->get()
                ->pluck('total', 'kondisi')
                ->toArray();
        }

        // Raw materials by supplier location
        $materialsBySupplier = [];
        if ($profile) {
            $materialsBySupplier = $profile->rawMaterials()
                ->selectRaw('asal_supplier, COUNT(*) as total')
                ->groupBy('asal_supplier')
                ->limit(5)
                ->get()
                ->pluck('total', 'asal_supplier')
                ->toArray();
        }

        if ($profile && $profile->kecamatan) {
            // UMKM in the same kecamatan (excluding self)
            $nearbyUmkms = \App\Models\UmkmProfile::with('user')
                ->where('kecamatan', $profile->kecamatan)
                ->where('id', '!=', $profile->id)
                ->where('is_verified', true)
                ->limit(6)
                ->get();

            // Simple partners logic: Different business type in same area
            $potentialPartners = \App\Models\UmkmProfile::with('user')
                ->where('kecamatan', $profile->kecamatan)
                ->where('id', '!=', $profile->id)
                ->where('jenis_usaha', '!=', $profile->jenis_usaha)
                ->where('is_verified', true)
                ->limit(4)
                ->get();
        }

        return view('umkm.dashboard', compact(
            'user',
            'profile',
            'nearbyUmkms',
            'potentialPartners',
            'stats',
            'monthlyTrend',
            'toolsByCondition',
            'materialsBySupplier'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->umkmProfile;

        $validated = $request->validate([
            'nama_usaha' => ['required', 'string', 'max:255'],
            'alamat_lengkap' => ['required', 'string'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'kelurahan' => ['required', 'string', 'max:100'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'omzet_bulanan' => ['required', 'numeric', 'min:0'],
            'jumlah_tenaga_kerja' => ['required', 'integer', 'min:1'],
        ]);

        if ($profile) {
            $profile->update($validated);
        } else {
            $user->umkmProfile()->create($validated);
        }

        return back()->with('success', 'Profil UMKM berhasil diperbarui!');
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->umkmProfile;

        return view('umkm.profile', compact('user', 'profile'));
    }

    public function productionTools()
    {
        $user = Auth::user();
        $profile = $user->umkmProfile()->with('productionTools')->first();

        return view('umkm.production-tools', compact('user', 'profile'));
    }

    public function rawMaterials()
    {
        $user = Auth::user();
        $profile = $user->umkmProfile()->with('rawMaterials')->first();

        return view('umkm.raw-materials', compact('user', 'profile'));
    }

    public function collaboration()
    {
        $user = Auth::user();
        $profile = $user->umkmProfile;

        $nearbyUmkms = collect();
        $potentialPartners = collect();

        if ($profile && $profile->kecamatan) {
            $nearbyUmkms = \App\Models\UmkmProfile::with('user')
                ->where('kecamatan', $profile->kecamatan)
                ->where('id', '!=', $profile->id)
                ->where('is_verified', true)
                ->limit(6)
                ->get();

            $potentialPartners = \App\Models\UmkmProfile::with('user')
                ->where('kecamatan', $profile->kecamatan)
                ->where('id', '!=', $profile->id)
                ->where('jenis_usaha', '!=', $profile->jenis_usaha)
                ->where('is_verified', true)
                ->limit(4)
                ->get();
        }

        return view('umkm.collaboration', compact('user', 'profile', 'nearbyUmkms', 'potentialPartners'));
    }
}
