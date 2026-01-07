

<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard Overview'); ?>

<?php $__env->startPush('styles'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total UMKM -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Total UMKM</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['total_umkm'], 0, ',', '.')); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Total UMKM terdaftar</p>
    </div>

    <!-- Verified UMKM -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Terverifikasi</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['verified_umkm'], 0, ',', '.')); ?></h3>
        <p class="text-xs text-gray-500 mt-1">
            <?php echo e($stats['total_umkm'] > 0 ? number_format(($stats['verified_umkm'] / $stats['total_umkm']) * 100, 1) : 0); ?>% dari total
        </p>
    </div>

    <!-- Total Workers -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Total Tenaga Kerja</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['total_workers'], 0, ',', '.')); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Pekerja di seluruh UMKM</p>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 font-medium">Total Omzet Bulanan</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-2">
            <?php if($stats['total_revenue'] >= 1000000000): ?>
                Rp <?php echo e(number_format($stats['total_revenue']/1000000000, 1, ',', '.')); ?>M
            <?php else: ?>
                Rp <?php echo e(number_format($stats['total_revenue']/1000000, 1, ',', '.')); ?>Jt
            <?php endif; ?>
        </h3>
        <p class="text-xs text-gray-500 mt-1">Omzet kumulatif per bulan</p>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- UMKM per Kecamatan Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">UMKM per Kecamatan</h3>
        <div style="height: 300px;">
            <canvas id="umkmPerKecamatanChart"></canvas>
        </div>
    </div>

    <!-- Verification Status Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Status Verifikasi</h3>
        <div style="height: 300px;">
            <canvas id="verificationChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent UMKM Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">UMKM Terbaru</h3>
            <a href="<?php echo e(route('admin.umkm.index')); ?>" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                Lihat Semua →
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Usaha</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kecamatan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Terdaftar</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $recentUmkm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900"><?php echo e($umkm->nama_usaha); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-600"><?php echo e($umkm->user->name); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-600"><?php echo e($umkm->kecamatan); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($umkm->is_verified): ?>
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Terverifikasi</span>
                        <?php else: ?>
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <?php echo e($umkm->created_at->diffForHumans()); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?php echo e(route('admin.umkm.show', $umkm)); ?>" class="text-blue-600 hover:text-blue-700">Detail</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data UMKM
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// UMKM per Kecamatan Chart
const kecamatanCtx = document.getElementById('umkmPerKecamatanChart').getContext('2d');
new Chart(kecamatanCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($umkmByKecamatan->pluck('kecamatan')); ?>,
        datasets: [{
            label: 'Jumlah UMKM',
            data: <?php echo json_encode($umkmByKecamatan->pluck('total')); ?>,
            backgroundColor: 'rgba(59, 130, 246, 0.8)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 1,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});

// Verification Status Chart
const verificationCtx = document.getElementById('verificationChart').getContext('2d');
const verifiedCount = <?php echo e($stats['verified_umkm']); ?>;
const pendingCount = <?php echo e($stats['total_umkm'] - $stats['verified_umkm']); ?>;

new Chart(verificationCtx, {
    type: 'doughnut',
    data: {
        labels: ['Terverifikasi', 'Pending'],
        datasets: [{
            data: [verifiedCount, pendingCount],
            backgroundColor: [
                'rgba(34, 197, 94, 0.8)',
                'rgba(251, 146, 60, 0.8)'
            ],
            borderColor: [
                'rgba(34, 197, 94, 1)',
                'rgba(251, 146, 60, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>