@extends('layouts.app')

@section('title', 'Dashboard UMKM')

@section('content')
<div class="container py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Dashboard UMKM</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola profil dan data usaha Anda</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg" role="alert">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">Profil Usaha</h2>
                    <button 
                        @click="editMode = !editMode" 
                        class="btn btn-secondary"
                        x-data="{ editMode: false }"
                    >
                        <span x-text="editMode ? 'Batal' : 'Edit'"></span>
                    </button>
                </div>

                <form action="{{ route('umkm.dashboard.update') }}" method="POST" x-data="{ editMode: false }">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Usaha -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Usaha
                            </label>
                            <input 
                                type="text" 
                                name="nama_usaha" 
                                value="{{ old('nama_usaha', $umkm->nama_usaha) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                            >
                            @error('nama_usaha')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIB -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                NIB
                            </label>
                            <input 
                                type="text" 
                                name="nib" 
                                value="{{ old('nib', $umkm->nib) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                            >
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Alamat
                            </label>
                            <textarea 
                                name="alamat" 
                                rows="3" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                            >{{ old('alamat', $umkm->alamat) }}</textarea>
                        </div>

                        <!-- Kecamatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Kecamatan
                            </label>
                            <input 
                                type="text" 
                                name="kecamatan" 
                                value="{{ old('kecamatan', $umkm->kecamatan) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                            >
                        </div>

                        <!-- Kelurahan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Kelurahan
                            </label>
                            <input 
                                type="text" 
                                name="kelurahan" 
                                value="{{ old('kelurahan', $umkm->kelurahan) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                            >
                        </div>

                        <!-- Latitude -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Latitude
                            </label>
                            <input 
                                type="text" 
                                name="latitude" 
                                value="{{ old('latitude', $umkm->latitude) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                                step="any"
                            >
                        </div>

                        <!-- Longitude -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Longitude
                            </label>
                            <input 
                                type="text" 
                                name="longitude" 
                                value="{{ old('longitude', $umkm->longitude) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                                step="any"
                            >
                        </div>

                        <!-- Omzet Bulanan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Omzet Bulanan (Rp)
                            </label>
                            <input 
                                type="number" 
                                name="omzet_bulanan" 
                                value="{{ old('omzet_bulanan', $umkm->omzet_bulanan) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                            >
                        </div>

                        <!-- Jumlah Tenaga Kerja -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Jumlah Tenaga Kerja
                            </label>
                            <input 
                                type="number" 
                                name="jumlah_tenaga_kerja" 
                                value="{{ old('jumlah_tenaga_kerja', $umkm->jumlah_tenaga_kerja) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                                :readonly="!editMode"
                            >
                        </div>
                    </div>

                    <div class="mt-6" x-show="editMode">
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Sidebar -->
        <div class="space-y-6">
            <!-- Stats Cards -->
            <div class="card">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Statistik Usaha</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Alat Produksi</p>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $productionToolsCount }}</p>
                        </div>
                        <div class="text-4xl">🔧</div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Bahan Baku</p>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $rawMaterialsCount }}</p>
                        </div>
                        <div class="text-4xl">📦</div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Status</p>
                            <p class="text-sm font-semibold {{ $umkm->is_verified ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ $umkm->is_verified ? 'Terverifikasi' : 'Belum Verifikasi' }}
                            </p>
                        </div>
                        <div class="text-4xl">{{ $umkm->is_verified ? '✅' : '⏳' }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Aksi Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ route('map') }}" class="block w-full text-center btn btn-secondary">
                        Lihat di Peta
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block w-full text-center btn btn-secondary">
                        Edit Profil Akun
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
