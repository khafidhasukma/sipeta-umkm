<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmProfile;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UmkmProfile::with('user');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Kecamatan filter
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('is_verified', $request->status === 'verified');
        }

        $umkmList = $query->latest()->paginate(15);
        
        $kecamatanList = UmkmProfile::distinct()->pluck('kecamatan')->filter()->sort()->values();
        $verifiedCount = UmkmProfile::where('is_verified', true)->count();
        $pendingCount = UmkmProfile::where('is_verified', false)->count();

        return view('admin.umkm.index', compact('umkmList', 'kecamatanList', 'verifiedCount', 'pendingCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UmkmProfile $umkm)
    {
        $umkm->load(['user', 'productionTools', 'rawMaterials']);
        
        return view('admin.umkm.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UmkmProfile $umkm)
    {
        $umkm->load('user');
        $kecamatanList = UmkmProfile::distinct()->pluck('kecamatan')->filter()->sort()->values();
        
        return view('admin.umkm.edit', compact('umkm', 'kecamatanList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UmkmProfile $umkm)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'jumlah_tenaga_kerja' => 'required|integer|min:1',
            'omzet_bulanan' => 'required|numeric|min:0',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_verified' => 'boolean',
        ]);

        $umkm->update($validated);

        return redirect()->route('admin.umkm.show', $umkm)
            ->with('success', 'Data UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
