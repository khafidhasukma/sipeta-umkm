

<?php $__env->startSection('title', 'Analisis Sentra/Klaster'); ?>
<?php $__env->startSection('page-title', 'Analisis Sentra/Klaster UMKM'); ?>

<?php $__env->startPush('styles'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Header & Description -->
<div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl p-6 mb-8 border border-purple-200">
    <div class="flex items-start">
        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4 shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Analisis Klaster Cerdas</h2>
            <p class="text-gray-700">
                Identifikasi sentra produksi berdasarkan <strong>similarity alat & jenis usaha</strong> per kecamatan untuk penetapan sentra yang efektif.
            </p>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Total Kecamatan</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($umkmPerKecamatan->count()); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Wilayah terdata</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Jenis Usaha</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($topJenisUsaha->count()); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Kategori usaha</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Potensi Klaster</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($sentraData->count()); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Kombinasi wilayah-jenis usaha</p>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- UMKM Distribution Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Distribusi UMKM per Kecamatan</h3>
        <div style="height: 300px;">
            <canvas id="umkmDistributionChart"></canvas>
        </div>
    </div>

    <!-- Top Business Types -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Top 10 Jenis Usaha</h3>
        <div style="height: 300px;">
            <canvas id="businessTypesChart"></canvas>
        </div>
    </div>
</div>

<!-- Sentra Clustering Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Analisis Klaster: Kecamatan × Jenis Usaha</h3>
        <p class="text-sm text-gray-600 mt-1">Rekomendasi penetapan sentra berdasarkan konsentrasi jenis usaha per wilayah</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Kecamatan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Jenis Usaha</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Jumlah UMKM</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Status Sentra</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $sentraData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sentra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900"><?php echo e($sentra->kecamatan); ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900"><?php echo e($sentra->jenis_usaha); ?></div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-blue-600"><?php echo e($sentra->total_umkm); ?></span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <?php if($sentra->total_umkm >= 5): ?>
                            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                Potensial Tinggi
                            </span>
                        <?php elseif($sentra->total_umkm >= 3): ?>
                            <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                Potensial Sedang
                            </span>
                        <?php else: ?>
                            <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                Emerging
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data untuk analisis klaster
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Production Tools Clustering -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Distribusi Alat Produksi per Kecamatan</h3>
                <p class="text-sm text-gray-600 mt-1">Untuk identifikasi sentra berdasarkan similarity alat produksi</p>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Kecamatan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama Alat</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">UMKM Pemilik</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $alatPerKecamatan->take(20); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900"><?php echo e($alat->kecamatan); ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900"><?php echo e($alat->nama_alat); ?></div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-purple-600"><?php echo e($alat->jumlah_umkm); ?> UMKM</span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data alat produksi
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($alatPerKecamatan->count() > 20): ?>
    <div class="p-4 bg-gray-50 text-center">
        <p class="text-sm text-gray-600">Menampilkan 20 data teratas dari <?php echo e($alatPerKecamatan->count()); ?> total kombinasi</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// UMKM Distribution Chart
const distributionCtx = document.getElementById('umkmDistributionChart').getContext('2d');
new Chart(distributionCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($umkmPerKecamatan->pluck('kecamatan')); ?>,
        datasets: [{
            label: 'Jumlah UMKM',
            data: <?php echo json_encode($umkmPerKecamatan->pluck('total')); ?>,
            backgroundColor: 'rgba(147, 51, 234, 0.8)',
            borderColor: 'rgba(147, 51, 234, 1)',
            borderWidth: 1,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});

// Business Types Chart
const businessCtx = document.getElementById('businessTypesChart').getContext('2d');
new Chart(businessCtx, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($topJenisUsaha->pluck('jenis_usaha')); ?>,
        datasets: [{
            data: <?php echo json_encode($topJenisUsaha->pluck('total')); ?>,
            backgroundColor: [
                'rgba(59, 130, 246, 0.8)', 'rgba(16, 185, 129, 0.8)', 'rgba(251, 146, 60, 0.8)',
                'rgba(147, 51, 234, 0.8)', 'rgba(236, 72, 153, 0.8)', 'rgba(14, 165, 233, 0.8)',
                'rgba(132, 204, 22, 0.8)', 'rgba(248, 113, 113, 0.8)', 'rgba(163, 230, 53, 0.8)',
                'rgba(194, 65, 12, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/admin/analisis-sentra.blade.php ENDPATH**/ ?>