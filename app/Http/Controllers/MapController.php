<?php

namespace App\Http\Controllers;

use App\Models\UmkmProfile;

class MapController extends Controller
{
    public function index()
    {
        return view('map.index');
    }

    public function getData()
    {
        $umkm = UmkmProfile::with('user')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($profile) {
                return [
                    'id' => $profile->id,
                    'nama_usaha' => $profile->nama_usaha,
                    'alamat' => $profile->alamat_lengkap,
                    'kecamatan' => $profile->kecamatan,
                    'kelurahan' => $profile->kelurahan,
                    'latitude' => (float) $profile->latitude,
                    'longitude' => (float) $profile->longitude,
                    'omzet_bulanan' => $profile->omzet_bulanan,
                    'jumlah_tenaga_kerja' => $profile->jumlah_tenaga_kerja,
                    'is_verified' => (bool) $profile->is_verified,
                    'owner' => $profile->user->name,
                ];
            });

        return response()->json($umkm);
    }
}
