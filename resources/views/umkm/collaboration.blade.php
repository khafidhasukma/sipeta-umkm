@extends('layouts.umkm')

@section('title', 'Kolaborasi & Jejaring')

@section('content')
<div class="space-y-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Kolaborasi & Jejaring</h1>
        <p class="text-gray-600 mt-1">Temukan mitra potensial di sekitar lokasi Anda</p>
    </div>

    <!-- Stats/Status -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
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
                        <div class="mt-3 flex items-center justify-between">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                {{ $neighbor->jumlah_tenaga_kerja }} Pekerja
                            </div>
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
