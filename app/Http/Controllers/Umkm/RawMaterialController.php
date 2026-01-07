<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RawMaterialController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'kebutuhan_per_bulan' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'asal_supplier' => 'required|string|max:255',
        ]);

        $profile = Auth::user()->umkmProfile;

        if (!$profile) {
            return back()->with('error', 'Silakan lengkapi profil UMKM terlebih dahulu.');
        }

        $profile->rawMaterials()->create($validated);

        return back()->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function update(Request $request, RawMaterial $rawMaterial)
    {
        // Ensure ownership
        if ($rawMaterial->umkm_profile_id !== Auth::user()->umkmProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'kebutuhan_per_bulan' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'asal_supplier' => 'required|string|max:255',
        ]);

        $rawMaterial->update($validated);

        return back()->with('success', 'Bahan baku berhasil diperbarui.');
    }

    public function destroy(RawMaterial $rawMaterial)
    {
        // Ensure ownership
        if ($rawMaterial->umkm_profile_id !== Auth::user()->umkmProfile->id) {
            abort(403);
        }

        $rawMaterial->delete();

        return back()->with('success', 'Bahan baku berhasil dihapus.');
    }
}
