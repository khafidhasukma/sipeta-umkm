

<?php $__env->startSection('title', 'Detail Pengguna'); ?>
<?php $__env->startSection('page-title', 'Detail Pengguna - ' . $user->name); ?>

<?php $__env->startSection('content'); ?>
<!-- Action Buttons -->
<div class="flex items-center justify-between mb-6">
    <a href="<?php echo e(route('admin.users.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
    <div class="flex space-x-2">
        <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit
        </a>
    </div>
</div>

<!-- User Info Card -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
    <div class="flex items-start space-x-6 mb-6">
        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-4xl flex-shrink-0">
            <?php echo e(substr($user->name, 0, 1)); ?>

        </div>
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2"><?php echo e($user->name); ?></h2>
            <div class="flex items-center space-x-4 mb-2">
                <?php if($user->role === 'admin'): ?>
                    <span class="px-3 py-1 text-sm font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400 rounded-full">
                        Administrator
                    </span>
                <?php else: ?>
                    <span class="px-3 py-1 text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 rounded-full">
                        UMKM
                    </span>
                <?php endif; ?>
                
                <?php if($user->is_active): ?>
                    <span class="px-3 py-1 text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 rounded-full inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Aktif
                    </span>
                <?php else: ?>
                    <span class="px-3 py-1 text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400 rounded-full">
                        Nonaktif
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
            <p class="text-gray-900 dark:text-white"><?php echo e($user->email); ?></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">NIB</label>
            <p class="text-gray-900 dark:text-white font-mono"><?php echo e($user->nib ?? '-'); ?></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Terdaftar Sejak</label>
            <p class="text-gray-900 dark:text-white"><?php echo e($user->created_at->format('d M Y')); ?></p>
        </div>
    </div>
</div>

<!-- UMKM Profile (if user is UMKM) -->
<?php if($user->role === 'umkm' && $user->umkmProfile): ?>
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Profil UMKM</h3>
        <a href="<?php echo e(route('admin.umkm.show', $user->umkmProfile)); ?>" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
            Lihat Detail Lengkap →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Usaha</label>
            <p class="text-gray-900 dark:text-white font-medium"><?php echo e($user->umkmProfile->nama_usaha); ?></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi</label>
            <p class="text-gray-900 dark:text-white"><?php echo e($user->umkmProfile->kecamatan); ?></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status Verifikasi</label>
            <?php if($user->umkmProfile->is_verified): ?>
                <span class="px-3 py-1 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 rounded-full">
                    Terverifikasi
                </span>
            <?php else: ?>
                <span class="px-3 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400 rounded-full">
                    Pending
                </span>
            <?php endif; ?>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tenaga Kerja</label>
            <p class="text-lg font-bold text-gray-900 dark:text-white"><?php echo e(number_format($user->umkmProfile->jumlah_tenaga_kerja, 0, ',', '.')); ?> orang</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Omzet Bulanan</label>
            <p class="text-lg font-bold text-green-600 dark:text-green-400">Rp <?php echo e(number_format($user->umkmProfile->omzet_bulanan, 0, ',', '.')); ?></p>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($user->role === 'umkm' && !$user->umkmProfile): ?>
<div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-6">
    <div class="flex items-start">
        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        <div>
            <h4 class="text-yellow-800 dark:text-yellow-400 font-semibold mb-1">Profil UMKM Belum Lengkap</h4>
            <p class="text-yellow-700 dark:text-yellow-300 text-sm">Pengguna ini belum melengkapi profil UMKM-nya.</p>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/admin/users/show.blade.php ENDPATH**/ ?>