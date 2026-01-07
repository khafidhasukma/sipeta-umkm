<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center bg-gradient-to-br from-blue-50 via-white to-slate-50">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-slate-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
    </div>

    <div class="container relative z-10 py-20">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-left" x-data x-intersect="$el.classList.add('animate-fade-in')">
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-2 bg-blue-50 border border-blue-200 px-4 py-2 rounded-full text-blue-700 mb-6">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Decision Support System</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 mb-6 leading-tight">
                        SIPETA UMKM
                        <span class="block text-blue-600 mt-2">Kota Semarang</span>
                    </h1>
                    
                    <p class="text-xl text-gray-600 mb-4 leading-relaxed max-w-xl font-semibold">
                        Sistem Informasi Pemetaan dan Analisis Sentra Produksi UMKM
                    </p>

                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-xl">
                        Platform GIS berbasis Evidence-Based Policy untuk transformasi ekosistem UMKM Kota Semarang
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo e(route('map.index')); ?>" class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Peta Geospasial
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        
                        <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('register')); ?>" class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-blue-600 bg-white border-2 border-blue-600 rounded-xl hover:bg-blue-50 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Daftar UMKM
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- Trust Badges -->
                    <div class="mt-10 flex flex-wrap items-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>GIS Real-Time</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Analisis Klaster</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Dashboard Eksekutif</span>
                        </div>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="hidden lg:block" x-data x-intersect="$el.classList.add('animate-fade-in')">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-200 rounded-3xl transform rotate-6 scale-95 opacity-20"></div>
                        <div class="relative bg-white rounded-2xl shadow-2xl p-8 border border-gray-200">
                            <div class="space-y-4">
                                <!-- Map Preview -->
                                <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="font-semibold text-gray-900">Pemetaan Geospasial</h3>
                                        <span class="px-3 py-1 bg-blue-600 text-white text-xs rounded-full">Live</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="bg-white rounded-lg p-4 border border-blue-100">
                                            <div class="text-2xl font-bold text-blue-600"><?php echo e(\App\Models\UmkmProfile::count()); ?></div>
                                            <div class="text-xs text-gray-600 mt-1">Total UMKM</div>
                                        </div>
                                        <div class="bg-white rounded-lg p-4 border border-blue-100">
                                            <div class="text-2xl font-bold text-green-600"><?php echo e(\App\Models\UmkmProfile::where('is_verified', true)->count()); ?></div>
                                            <div class="text-xs text-gray-600 mt-1">Terverifikasi</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Features List -->
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-gray-700">Analisis Data Berbasis AI</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-gray-700">Fasilitasi Kolaborasi</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-gray-700">Data Aman & Valid</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Problem Statement -->
<section class="py-20 bg-white">
    <div class="container">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16" x-data x-intersect="$el.classList.add('animate-fade-in')">
                <span class="inline-block px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold mb-4 border border-red-200">
                    Tantangan Saat Ini
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Mengapa SIPETA Dibutuhkan?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pemkot Semarang menghadapi kendala signifikan dalam pemberdayaan UMKM
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Problem 1 -->
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6" x-data x-intersect="$el.classList.add('animate-fade-in')">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0 mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Blind Spot Data Kapasitas Produksi</h3>
                            <p class="text-sm text-gray-700">Pemkot tidak memiliki data mengenai alat produksi, bahan baku, dan kapasitas riil setiap UMKM.</p>
                        </div>
                    </div>
                </div>

                <!-- Problem 2 -->
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6" x-data x-intersect="$el.classList.add('animate-fade-in')" style="animation-delay: 0.1s;">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0 mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Bantuan Program Tidak Tepat Sasaran</h3>
                            <p class="text-sm text-gray-700">Kebijakan bersifat generalis karena tidak berbasis data riil kondisi lapangan setiap wilayah.</p>
                        </div>
                    </div>
                </div>

                <!-- Problem 3 -->
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6" x-data x-intersect="$el.classList.add('animate-fade-in')" style="animation-delay: 0.2s;">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0 mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Penetapan Sentra Tidak Efektif</h3>
                            <p class="text-sm text-gray-700">Sentra produksi ditetapkan tanpa analisis klaster, sehingga tidak mencerminkan potensi riil wilayah.</p>
                        </div>
                    </div>
                </div>

                <!-- Problem 4 -->
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6" x-data x-intersect="$el.classList.add('animate-fade-in')" style="animation-delay: 0.3s;">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0 mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">UMKM Bekerja Silo & Inefisien</h3>
                            <p class="text-sm text-gray-700">Tidak ada kolaborasi: satu UMKM kekurangan alat, yang lain punya alat idle tapi tidak terkoneksi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Solution (4 Pillars) -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container">
        <div class="text-center mb-16" x-data x-intersect="$el.classList.add('animate-fade-in')">
            <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold mb-4 border border-green-200">
                Solusi Strategis
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                4 Pilar SIPETA-UMKM
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Sistem komprehensif untuk transformasi ekosistem UMKM Kota Semarang
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
                $pillars = [
                    [
                        'number' => '1',
                        'title' => 'Pemetaan Geospasial',
                        'description' => 'Visualisasi lokasi dan profil mendalam seluruh UMKM dalam format GIS',
                        'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',
                        'color' => 'blue'
                    ],
                    [
                        'number' => '2',
                        'title' => 'Analisis Klaster Cerdas',
                        'description' => 'Algoritma AI untuk identifikasi sentra berdasarkan similaritas alat & bahan baku',
                        'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
                        'color' => 'green'
                    ],
                    [
                        'number' => '3',
                        'title' => 'Fasilitasi Kolaborasi',
                        'description' => 'Matchmaking UMKM untuk resource sharing alat produksi dan bahan baku',
                        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        'color' => 'purple'
                    ],
                    [
                        'number' => '4',
                        'title' => 'Dashboard Eksekutif',
                        'description' => 'Monitoring omzet, tenaga kerja, dan evaluasi program berbasis data terukur',
                        'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'color' => 'orange'
                    ]
                ];
            ?>

            <?php $__currentLoopData = $pillars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group" x-data x-intersect="$el.classList.add('animate-fade-in')" style="animation-delay: <?php echo e($index * 0.1); ?>s;">
                <div class="h-full bg-white rounded-2xl p-8 border-2 border-gray-100 hover:border-<?php echo e($pillar['color']); ?>-200 hover:shadow-xl transition-all duration-300 group-hover:-translate-y-1">
                    <div class="w-14 h-14 bg-<?php echo e($pillar['color']); ?>-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-<?php echo e($pillar['color']); ?>-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="<?php echo e($pillar['icon']); ?>"/>
                        </svg>
                    </div>
                    <div class="w-10 h-10 bg-<?php echo e($pillar['color']); ?>-600 rounded-full flex items-center justify-center mb-4">
                        <span class="text-white font-bold text-lg"><?php echo e($pillar['number']); ?></span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        <?php echo e($pillar['title']); ?>

                    </h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        <?php echo e($pillar['description']); ?>

                    </p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-white relative">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
                $stats = [
                    [
                        'value' => \App\Models\UmkmProfile::count(),
                        'label' => 'Total UMKM',
                        'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                        'bgColor' => 'bg-blue-50',
                        'iconColor' => 'text-blue-600',
                        'valueColor' => 'text-blue-600'
                    ],
                    [
                        'value' => \App\Models\UmkmProfile::where('is_verified', true)->count(),
                        'label' => 'Terverifikasi',
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'bgColor' => 'bg-green-50',
                        'iconColor' => 'text-green-600',
                        'valueColor' => 'text-green-600'
                    ],
                    [
                        'value' => number_format(\App\Models\UmkmProfile::sum('jumlah_tenaga_kerja')),
                        'label' => 'Tenaga Kerja',
                        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        'bgColor' => 'bg-purple-50',
                        'iconColor' => 'text-purple-600',
                        'valueColor' => 'text-purple-600'
                    ],
                    [
                        'value' => 'Rp ' . number_format(\App\Models\UmkmProfile::sum('omzet_bulanan')/1000000000, 1) . 'M',
                        'label' => 'Total Omzet',
                        'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        'bgColor' => 'bg-orange-50',
                        'iconColor' => 'text-orange-600',
                        'valueColor' => 'text-orange-600'
                    ]
                ];
            ?>

            <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group" x-data x-intersect="$el.classList.add('animate-fade-in')" style="animation-delay: <?php echo e($index * 0.1); ?>s;">
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-<?php echo e(str_replace('bg-', '', str_replace('-50', '-200', $stat['bgColor']))); ?> group-hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 <?php echo e($stat['bgColor']); ?> rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 <?php echo e($stat['iconColor']); ?>" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="<?php echo e($stat['icon']); ?>"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold <?php echo e($stat['valueColor']); ?> mb-2">
                        <?php echo e($stat['value']); ?>

                    </h3>
                    <p class="text-gray-600 text-sm font-medium"><?php echo e($stat['label']); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative py-24 bg-gradient-to-br from-blue-600 to-blue-700 overflow-hidden">
    <!-- Decorative Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="container relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white" x-data x-intersect="$el.classList.add('animate-fade-in')">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Daftarkan UMKM Anda Sekarang
            </h2>
            <p class="text-xl text-blue-100 mb-10 leading-relaxed max-w-2xl mx-auto">
                Jadilah bagian dari transformasi ekosistem UMKM Kota Semarang yang terintegrasi dan berbasis data
            </p>
            
            <?php if(auth()->guard()->guest()): ?>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-blue-600 bg-white rounded-xl hover:bg-gray-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5">
                    Daftar Sekarang - Gratis
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="<?php echo e(route('about')); ?>" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-transparent border-2 border-white rounded-xl hover:bg-white/10 transition-all backdrop-blur-sm">
                    Pelajari Lebih Lanjut
                </a>
            </div>
            <?php else: ?>
            <a href="<?php echo e(auth()->user()->role === 'admin' ? route('admin.dashboard') : route('umkm.dashboard')); ?>" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-blue-600 bg-white rounded-xl hover:bg-gray-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5">
                Ke Dashboard
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
            <?php endif; ?>

            <!-- Trust Indicators -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-3xl font-bold mb-2">100%</div>
                    <div class="text-blue-100 text-sm">Berbasis Data Riil</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-3xl font-bold mb-2">Real-Time</div>
                    <div class="text-blue-100 text-sm">Update Langsung</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="text-3xl font-bold mb-2">AI-Powered</div>
                    <div class="text-blue-100 text-sm">Analisis Klaster Cerdas</div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes blob {
    0%, 100% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/welcome.blade.php ENDPATH**/ ?>