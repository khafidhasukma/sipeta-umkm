@extends('layouts.umkm')

@section('title', 'Profil UMKM')

@section('content')
<div class="space-y-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Profil UMKM</h1>
        <p class="text-gray-600 mt-1">Informasi lengkap tentang UMKM Anda</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('umkm.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Data Usaha -->
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Data Usaha</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Usaha</label>
                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $profile ? $profile->nama_usaha : '') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Usaha</label>
                    <input type="text" value="{{ $profile ? $profile->jenis_usaha : '' }}" class="w-full rounded-lg border-gray-300 bg-gray-50 text-gray-500 cursor-not-allowed" readonly title="Hubungi admin untuk ubah jenis usaha">
                    <p class="text-xs text-gray-500 mt-1">*Jenis usaha tidak dapat diubah sembarangan</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Omzet Bulanan (Rp)</label>
                    <input type="number" name="omzet_bulanan" value="{{ old('omzet_bulanan', $profile ? $profile->omzet_bulanan : 0) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required min="0">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tenaga Kerja</label>
                    <input type="number" name="jumlah_tenaga_kerja" value="{{ old('jumlah_tenaga_kerja', $profile ? $profile->jumlah_tenaga_kerja : 1) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required min="1">
                </div>
            </div>

            <!-- Lokasi -->
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Lokasi Usaha</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required>{{ old('alamat_lengkap', $profile ? $profile->alamat_lengkap : '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $profile ? $profile->kecamatan : '') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                    <input type="text" name="kelurahan" value="{{ old('kelurahan', $profile ? $profile->kelurahan : '') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                    <input type="text" name="latitude" value="{{ old('latitude', $profile ? $profile->latitude : '') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="-7.250445">
                    <p class="text-xs text-gray-500 mt-1">*Opsional, untuk tampil di peta</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                    <input type="text" name="longitude" value="{{ old('longitude', $profile ? $profile->longitude : '') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" placeholder="112.768845">
                    <p class="text-xs text-gray-500 mt-1">*Opsional, untuk tampil di peta</p>
                </div>
            </div>

            <div class="flex items-center justify-end pt-6 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
