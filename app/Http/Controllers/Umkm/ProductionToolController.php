<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\ProductionTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductionToolController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kapasitas' => 'nullable|string|max:255',
            'kondisi' => 'required|in:baik,rusak ringan,rusak berat,perlu perbaikan',
            'status_kepemilikan' => 'required|in:milik sendiri,sewa,pinjam,hibah',
        ]);

        $profile = Auth::user()->umkmProfile;

        if (!$profile) {
            return back()->with('error', 'Silakan lengkapi profil UMKM terlebih dahulu.');
        }

        $profile->productionTools()->create($validated);

        return back()->with('success', 'Alat produksi berhasil ditambahkan.');
    }

    public function update(Request $request, ProductionTool $productionTool)
    {
        // Ensure data ownership
        if ($productionTool->umkm_profile_id !== Auth::user()->umkmProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kapasitas' => 'nullable|string|max:255',
            'kondisi' => 'required|in:baik,rusak ringan,rusak berat,perlu perbaikan',
            'status_kepemilikan' => 'required|in:milik sendiri,sewa,pinjam,hibah',
        ]);

        $productionTool->update($validated);

        return back()->with('success', 'Alat produksi berhasil diperbarui.');
    }

    public function destroy(ProductionTool $productionTool)
    {
        // Ensure data ownership
        if ($productionTool->umkm_profile_id !== Auth::user()->umkmProfile->id) {
            abort(403);
        }

        $productionTool->delete();

        return back()->with('success', 'Alat produksi berhasil dihapus.');
    }
}
