<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmProfile;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = UmkmProfile::with('user')->where('is_verified', false);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $pendingUmkm = $query->latest()->paginate(15);

        return view('admin.verification', compact('pendingUmkm'));
    }

    public function verify(UmkmProfile $umkm)
    {
        $umkm->update(['is_verified' => true]);

        return back()->with('success', 'UMKM berhasil diverifikasi!');
    }

    public function reject(UmkmProfile $umkm)
    {
        $umkm->update(['is_verified' => false]);

        return back()->with('success', 'Verifikasi UMKM ditolak!');
    }
}
