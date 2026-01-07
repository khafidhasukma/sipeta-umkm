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

        return view('umkm.dashboard', compact('user', 'profile', 'nearbyUmkms', 'potentialPartners'));
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
