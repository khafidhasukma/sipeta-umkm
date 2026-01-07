 <?php $__env->startSection('title', 'Edit Profil'); ?> <?php $__env->startSection('content'); ?> <div class="container py-12"> <div class="max-w-2xl mx-auto"> <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Profil</h1> <?php if(session('success')): ?> <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg" role="alert"> <p class="font-medium"><?php echo e(session('success')); ?></p> </div> <?php endif; ?> <!-- Update Profile Form --> <div class="card mb-6"> <h2 class="text-xl font-bold text-gray-800 mb-6">Informasi Akun</h2> <form action="<?php echo e(route('profile.update')); ?>" method="POST"> <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?> <div class="space-y-6"> <!-- Name --> <div> <label for="name" class="block text-sm font-medium text-gray-700 mb-2"> Nama Lengkap </label> <input type="text" id="name" name="name" value="<?php echo e(old('name', auth()->user()->name)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent " required > <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <!-- Email --> <div> <label for="email" class="block text-sm font-medium text-gray-700 mb-2"> Email </label> <input type="email" id="email" name="email" value="<?php echo e(old('email', auth()->user()->email)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent " required > <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <div class="pt-4"> <button type="submit" class="btn btn-primary"> Simpan Perubahan </button> </div> </div> </form> </div> <!-- Update Password Form --> <div class="card"> <h2 class="text-xl font-bold text-gray-800 mb-6">Ubah Password</h2> <form action="<?php echo e(route('profile.password')); ?>" method="POST"> <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?> <div class="space-y-6"> <!-- Current Password --> <div> <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2"> Password Saat Ini </label> <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent " required > <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <!-- New Password --> <div> <label for="password" class="block text-sm font-medium text-gray-700 mb-2"> Password Baru </label> <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent " required > <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </div> <!-- Confirm Password --> <div> <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2"> Konfirmasi Password Baru </label> <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent " required > </div> <div class="pt-4"> <button type="submit" class="btn btn-primary"> Ubah Password </button> </div> </div> </form> </div> <!-- Back Button --> <div class="mt-6"> <a href="<?php echo e(auth()->user()->role === 'admin' ? route('admin.dashboard') : route('umkm.dashboard')); ?>" class="text-blue-600 hover:text-blue-700"> ← Kembali ke Dashboard </a> </div> </div> </div> <?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/profile/edit.blade.php ENDPATH**/ ?>