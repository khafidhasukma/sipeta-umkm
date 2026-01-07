 <?php $__env->startSection('title', 'Edit UMKM'); ?> <?php $__env->startSection('page-title', 'Edit Data UMKM'); ?> <?php $__env->startSection('content'); ?> <!-- Action Buttons --> <div class="flex items-center justify-between mb-6"> <a href="<?php echo e(route('admin.umkm.show', $umkm)); ?>" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"> <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/> </svg> Kembali </a> </div> <!-- Edit Form --> <form method="POST" action="<?php echo e(route('admin.umkm.update', $umkm)); ?>" class="space-y-6"> <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?> <!-- Basic Information --> <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6"> <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Dasar</h3> <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> <div> <label for="nama_usaha" class="block text-sm font-medium text-gray-700 mb-2"> Nama Usaha <span class="text-red-500">*</span> </label> <input type="text" name="nama_usaha" id="nama_usaha" value="<?php echo e(old('nama_usaha', $umkm->nama_usaha)); ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['nama_usaha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['nama_usaha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <div> <label for="jenis_usaha" class="block text-sm font-medium text-gray-700 mb-2"> Jenis Usaha <span class="text-red-500">*</span> </label> <input type="text" name="jenis_usaha" id="jenis_usaha" value="<?php echo e(old('jenis_usaha', $umkm->jenis_usaha)); ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['jenis_usaha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['jenis_usaha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <div class="md:col-span-2"> <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2"> Alamat <span class="text-red-500">*</span> </label> <textarea name="alamat" id="alamat" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('alamat', $umkm->alamat)); ?></textarea> <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <div> <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2"> Kecamatan <span class="text-red-500">*</span> </label> <select name="kecamatan" id="kecamatan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <option value="">Pilih Kecamatan</option> <?php $__currentLoopData = $kecamatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($kec); ?>" <?php echo e(old('kecamatan', $umkm->kecamatan) == $kec ? 'selected' : ''); ?>><?php echo e($kec); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> </div> </div> <!-- Business Details --> <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6"> <h3 class="text-lg font-semibold text-gray-900 mb-6">Detail Usaha</h3> <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> <div> <label for="jumlah_tenaga_kerja" class="block text-sm font-medium text-gray-700 mb-2"> Jumlah Tenaga Kerja <span class="text-red-500">*</span> </label> <input type="number" name="jumlah_tenaga_kerja" id="jumlah_tenaga_kerja" value="<?php echo e(old('jumlah_tenaga_kerja', $umkm->jumlah_tenaga_kerja)); ?>" min="1" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['jumlah_tenaga_kerja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['jumlah_tenaga_kerja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <div> <label for="omzet_bulanan" class="block text-sm font-medium text-gray-700 mb-2"> Omzet Bulanan (Rp) <span class="text-red-500">*</span> </label> <input type="number" name="omzet_bulanan" id="omzet_bulanan" value="<?php echo e(old('omzet_bulanan', $umkm->omzet_bulanan)); ?>" min="0" step="0.01" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['omzet_bulanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['omzet_bulanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> </div> </div> <!-- Location --> <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6"> <h3 class="text-lg font-semibold text-gray-900 mb-6">Koordinat Lokasi</h3> <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> <div> <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2"> Latitude </label> <input type="text" name="latitude" id="latitude" value="<?php echo e(old('latitude', $umkm->latitude)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <div> <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2"> Longitude </label> <input type="text" name="longitude" id="longitude" value="<?php echo e(old('longitude', $umkm->longitude)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> </div> </div> <!-- Verification Status --> <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6"> <h3 class="text-lg font-semibold text-gray-900 mb-6">Status Verifikasi</h3> <div class="flex items-center"> <input type="checkbox" name="is_verified" id="is_verified" value="1" <?php echo e(old('is_verified', $umkm->is_verified) ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500:ring-blue-600"> <label for="is_verified" class="ml-2 text-sm font-medium text-gray-700"> UMKM telah diverifikasi </label> </div> </div> <!-- Submit Button --> <div class="flex justify-end space-x-3"> <a href="<?php echo e(route('admin.umkm.show', $umkm)); ?>" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"> Batal </a> <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"> Simpan Perubahan </button> </div> </form> <?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/admin/umkm/edit.blade.php ENDPATH**/ ?>