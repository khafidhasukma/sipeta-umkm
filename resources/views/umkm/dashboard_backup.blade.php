@extends('layouts.umkm')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Page -->
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dashboard Overview</h1>
                <p class="text-gray-600 mt-1">Selamat datang kembali, <span class="font-semibold">{{ $user->name }}</span>!</p>
            </div>
            @if($profile)
            <a href="{{ route('umkm.profile') }}" class="hidden sm:inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Profil
            </a>
            @endif
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 font-medium">Omzet Bulanan</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    @if($profile && $profile->omzet_bulanan)
                        Rp {{ number_format($profile->omzet_bulanan, 0, ',', '.') }}
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </p>
            </div>

            <!-- Stat Card 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 font-medium">Tenaga Kerja</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    @if($profile && $profile->jumlah_tenaga_kerja)
                        {{ $profile->jumlah_tenaga_kerja }} <span class="text-sm font-normal text-gray-500">Orang</span>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </p>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 font-medium">Alat Produksi</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    {{ $profile ? $profile->productionTools()->count() : 0 }} <span class="text-sm font-normal text-gray-500">Unit</span>
                </p>
            </div>

            <!-- Stat Card 4 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 font-medium">Bahan Baku</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    {{ $profile ? $profile->rawMaterials()->count() : 0 }} <span class="text-sm font-normal text-gray-500">Jenis</span>
                </p>
            </div>
        </div>

        @if(!$profile)
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="inline-flex w-20 h-20 bg-blue-100 rounded-full items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Lengkapi Profil UMKM Anda</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Isi data profil UMKM Anda untuk memaksimalkan penggunaan platform SIPETA
                </p>
                <a href="{{ route('umkm.profile') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Lengkapi Profil Sekarang
                </a>
            </div>
        @else
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <a href="{{ route('umkm.profile') }}" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 text-center">Profil</span>
                    </a>
                    <a href="{{ route('umkm.production-tools.index') }}" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 text-center">Alat Produksi</span>
                    </a>
                    <a href="{{ route('umkm.raw-materials.index') }}" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 text-center">Bahan Baku</span>
                    </a>
                    <a href="{{ route('umkm.collaboration') }}" class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 text-center">Kolaborasi</span>
                    </a>
                </div>
            </div>

            <!-- Business Info & Map -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Informasi Usaha
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Nama Usaha</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $profile->nama_usaha }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Jenis Usaha</p>
                            <p class="text-sm font-semibold text-gray-900">{{ ucwords($profile->jenis_usaha) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">NIB</p>
                            <p class="text-sm font-mono font-semibold text-gray-900">{{ $user->nib }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Lokasi</p>
                            <p class="text-sm font-semibold text-gray-900">{{ ucwords($profile->kelurahan) }}, {{ ucwords($profile->kecamatan) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Lokasi
                    </h3>
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-8 h-full flex items-center justify-center min-h-[160px]">
                        <a href="{{ route('map.index') }}" class="flex flex-col items-center text-center group">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-semibold group-hover:text-blue-600 transition-colors">
                                Lihat di Peta
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Collaboration Teaser -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4 shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">Perluas Jaringan Bisnis Anda</h4>
                            <p class="text-sm text-gray-700">
                                Sistem mendeteksi <strong>{{ $nearbyUmkms->count() }} UMKM</strong> lain di kecamatan Anda dan 
                                <strong>{{ $potentialPartners->count() }} mitra potensial</strong> untuk supply chain.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('umkm.collaboration') }}" class="w-full sm:w-auto px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg shadow-sm hover:bg-green-700 transition-colors text-center shrink-0">
                        Lihat Peluang
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Profile Page -->
    <div x-show="currentPage === 'profile'" x-transition class="space-y-6">
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
                        <input type="text" name="latitude" value="{{ old('latitude', $profile ? $profile->latitude : '') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude', $profile ? $profile->longitude : '') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
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

    <!-- Production Tools Page -->
    <div x-show="currentPage === 'production'" x-transition class="space-y-6">
        <div x-data="{
            showModal: false,
            editMode: false,
            actionUrl: '{{ route('umkm.production-tools.store') }}',
            form: {
                nama_alat: '',
                jenis: '',
                kapasitas: '',
                kondisi: 'baik',
                status_kepemilikan: 'milik sendiri'
            },
            openAdd() {
                this.editMode = false;
                this.actionUrl = '{{ route('umkm.production-tools.store') }}';
                this.form = {
                    nama_alat: '',
                    jenis: '',
                    kapasitas: '',
                    kondisi: 'baik',
                    status_kepemilikan: 'milik sendiri'
                };
                this.showModal = true;
            },
            openEdit(data, url) {
                this.editMode = true;
                this.actionUrl = url;
                this.form = {
                    nama_alat: data.nama_alat,
                    jenis: data.jenis,
                    kapasitas: data.kapasitas,
                    kondisi: data.kondisi,
                    status_kepemilikan: data.status_kepemilikan
                };
                this.showModal = true;
            }
        }">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl p-6 border border-purple-200">
                <div class="flex items-start justify-between">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4 shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Alat Produksi</h2>
                            <p class="text-gray-700">Kelola dan pantau alat produksi yang Anda miliki untuk operasional usaha.</p>
                        </div>
                    </div>
                    <button @click="openAdd()" class="px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors shadow-sm flex items-center shrink-0">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Alat
                    </button>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Alat Produksi</h3>
                    <p class="text-sm text-gray-600 mt-1">Total {{ $profile ? $profile->productionTools()->count() : 0 }} alat produksi terdaftar</p>
                </div>
                @if($profile && $profile->productionTools()->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Alat</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kapasitas</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kondisi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kepemilikan</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($profile->productionTools as $tool)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $tool->nama_alat }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">{{ ucwords($tool->jenis) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">{{ $tool->kapasitas ?: '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($tool->kondisi === 'baik')
                                                <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Baik</span>
                                            @elseif($tool->kondisi === 'rusak ringan')
                                                <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">Rusak Ringan</span>
                                            @else
                                                <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">{{ ucfirst($tool->kondisi) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">{{ ucwords(str_replace('-', ' ', $tool->status_kepemilikan)) }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end space-x-3">
                                                <button @click="openEdit({{ json_encode($tool) }}, '{{ route('umkm.production-tools.update', $tool->id) }}')" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                                    Edit
                                                </button>
                                                <form action="{{ route('umkm.production-tools.destroy', $tool->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="inline-flex w-16 h-16 bg-purple-100 rounded-full items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Alat Produksi</h4>
                        <p class="text-gray-600 mb-4">Mulai tambahkan alat produksi Anda untuk monitoring dan kolaborasi</p>
                        <button @click="openAdd()" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Alat Pertama
                        </button>
                    </div>
                @endif
            </div>

            <!-- Modal Form -->
            <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                        <form :action="actionUrl" method="POST">
                            @csrf
                            <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                            
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="mb-4">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="editMode ? 'Edit Alat Produksi' : 'Tambah Alat Produksi'"></h3>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Alat</label>
                                        <input type="text" name="nama_alat" x-model="form.nama_alat" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Mesin Jahit High-Speed">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Alat</label>
                                        <input type="text" name="jenis" x-model="form.jenis" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Mesin Jahit">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                                        <input type="text" name="kapasitas" x-model="form.kapasitas" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Contoh: 100 pcs/hari">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                                        <select name="kondisi" x-model="form.kondisi" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                            <option value="baik">Baik</option>
                                            <option value="rusak ringan">Rusak Ringan</option>
                                            <option value="rusak berat">Rusak Berat</option>
                                            <option value="perlu perbaikan">Perlu Perbaikan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan</label>
                                        <select name="status_kepemilikan" x-model="form.status_kepemilikan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                            <option value="milik sendiri">Milik Sendiri</option>
                                            <option value="sewa">Sewa</option>
                                            <option value="pinjam">Pinjam</option>
                                            <option value="hibah">Hibah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Simpan
                                </button>
                                <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Materials Page -->
    <div x-show="currentPage === 'materials'" x-transition class="space-y-6">
        <div x-data="{
            showModal: false,
            editMode: false,
            actionUrl: '{{ route('umkm.raw-materials.store') }}',
            form: {
                nama_bahan: '',
                kebutuhan_per_bulan: '',
                satuan: '',
                asal_supplier: ''
            },
            openAdd() {
                this.editMode = false;
                this.actionUrl = '{{ route('umkm.raw-materials.store') }}';
                this.form = {
                    nama_bahan: '',
                    kebutuhan_per_bulan: '',
                    satuan: '',
                    asal_supplier: ''
                };
                this.showModal = true;
            },
            openEdit(data, url) {
                this.editMode = true;
                this.actionUrl = url;
                this.form = {
                    nama_bahan: data.nama_bahan,
                    kebutuhan_per_bulan: data.kebutuhan_per_bulan,
                    satuan: data.satuan,
                    asal_supplier: data.asal_supplier
                };
                this.showModal = true;
            }
        }">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl p-6 border border-orange-200">
                <div class="flex items-start justify-between">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center mr-4 shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Bahan Baku</h2>
                            <p class="text-gray-700">Kelola dan pantau kebutuhan bahan baku untuk proses produksi Anda.</p>
                        </div>
                    </div>
                    <button @click="openAdd()" class="px-4 py-2 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors shadow-sm flex items-center shrink-0">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Bahan
                    </button>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Bahan Baku</h3>
                    <p class="text-sm text-gray-600 mt-1">Total {{ $profile ? $profile->rawMaterials()->count() : 0 }} jenis bahan baku terdaftar</p>
                </div>
                @if($profile && $profile->rawMaterials()->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Bahan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kebutuhan/Bulan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Satuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Supplier</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($profile->rawMaterials as $material)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $material->nama_bahan }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">{{ number_format($material->kebutuhan_per_bulan, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full">
                                                {{ $material->satuan }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600">{{ $material->asal_supplier }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end space-x-3">
                                                <button @click="openEdit({{ json_encode($material) }}, '{{ route('umkm.raw-materials.update', $material->id) }}')" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                                    Edit
                                                </button>
                                                <form action="{{ route('umkm.raw-materials.destroy', $material->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data bahan baku ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="inline-flex w-16 h-16 bg-orange-100 rounded-full items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Bahan Baku</h4>
                        <p class="text-gray-600 mb-4">Mulai catat kebutuhan bahan baku produksi Anda</p>
                        <button @click="openAdd()" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Bahan Pertama
                        </button>
                    </div>
                @endif
            </div>

            <!-- Modal Form -->
            <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                        <form :action="actionUrl" method="POST">
                            @csrf
                            <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                            
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="mb-4">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="editMode ? 'Edit Bahan Baku' : 'Tambah Bahan Baku'"></h3>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bahan</label>
                                        <input type="text" name="nama_bahan" x-model="form.nama_bahan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Kain Katun">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kebutuhan per Bulan</label>
                                        <input type="number" name="kebutuhan_per_bulan" x-model="form.kebutuhan_per_bulan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required min="0">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                                        <input type="text" name="satuan" x-model="form.satuan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Meter, Kg, Pcs">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                                        <input type="text" name="asal_supplier" x-model="form.asal_supplier" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Nama Supplier / Kota">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Simpan
                                </button>
                                <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collaboration Page -->
    <div x-show="currentPage === 'collaboration'" x-transition class="space-y-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Kolaborasi & Jejaring</h1>
            <p class="text-gray-600 mt-1">Temukan mitra potensial di sekitar lokasi Anda</p>
        </div>

        <!-- Stats/Status -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Status Kolaborasi: <span class="text-green-600">Aktif</span></h3>
                        <p class="text-gray-600 text-sm">Profil Anda terlihat oleh UMKM lain di Kec. {{ $profile ? $profile->kecamatan : '-' }}</p>
                    </div>
                </div>
                <button class="px-4 py-2 bg-white border border-green-200 text-green-700 font-medium rounded-lg hover:bg-green-50 transition-colors shadow-sm">
                    Atur Preferensi
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Nearby UMKMs -->
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    UMKM di Sekitar Anda
                </h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 divide-y divide-gray-100">
                    @forelse($nearbyUmkms as $neighbor)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center font-bold text-blue-600">
                                        {{ substr($neighbor->nama_usaha, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $neighbor->nama_usaha }}</h4>
                                        <p class="text-sm text-gray-500">{{ ucwords($neighbor->jenis_usaha) }}</p>
                                    </div>
                                </div>
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                                    {{ $neighbor->kelurahan }}
                                </span>
                            </div>
                            <div class="mt-3 flex items-center justify-end space-x-2">
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Profil</a>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            Belum ada UMKM lain yang terdaftar di kecamatan ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Potential Partners -->
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Potensi Mitra (Supply Chain)
                </h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 divide-y divide-gray-100">
                    @forelse($potentialPartners as $partner)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center font-bold text-purple-600">
                                        {{ substr($partner->nama_usaha, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $partner->nama_usaha }}</h4>
                                        <p class="text-sm text-gray-500">{{ ucwords($partner->jenis_usaha) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-xs text-gray-500 mb-2">Potensi Kerjasama:</p>
                                <div class="flex gap-2">
                                    <span class="text-xs border border-purple-200 text-purple-700 px-2 py-1 rounded bg-purple-50">
                                        Resource Sharing
                                    </span>
                                    <span class="text-xs border border-blue-200 text-blue-700 px-2 py-1 rounded bg-blue-50">
                                        Bahan Baku
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            Belum ditemukan potensi mitra spesifik saat ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
