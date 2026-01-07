<nav x-data="{ mobileMenuOpen: false }" class="bg-white border-b border-gray-200 fixed w-full top-0 z-[1000]">
    <div class="container">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <a href="<?php echo e(url('/')); ?>" class="text-xl font-bold text-gray-900">
                    SIPETA UMKM
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="<?php echo e(url('/')); ?>" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                    Beranda
                </a>
                <a href="<?php echo e(route('map.index')); ?>" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                    Peta Persebaran
                </a>
                <a href="<?php echo e(route('about')); ?>" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                    Tentang
                </a>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                            Dashboard Admin
                        </a>
                    <?php elseif(auth()->user()->role === 'umkm'): ?>
                        <a href="<?php echo e(route('umkm.dashboard')); ?>" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                            Dashboard UMKM
                        </a>
                    <?php endif; ?>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors font-medium">
                            <span><?php echo e(auth()->user()->name); ?></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-200">
                            <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
                                Profil Saya
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                        Masuk
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">
                        Daftar
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-white border-t border-gray-200">
        <div class="container py-4 space-y-3">
            <a href="<?php echo e(url('/')); ?>" class="block text-gray-700 hover:text-blue-600 transition-colors">
                Beranda
            </a>
            <a href="<?php echo e(route('map.index')); ?>" class="block text-gray-700 hover:text-blue-600 transition-colors">
                Peta Persebaran
            </a>
            <a href="<?php echo e(route('about')); ?>" class="block text-gray-700 hover:text-blue-600 transition-colors">
                Tentang
            </a>

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="block text-gray-700 hover:text-blue-600 transition-colors">
                        Dashboard Admin
                    </a>
                <?php elseif(auth()->user()->role === 'umkm'): ?>
                    <a href="<?php echo e(route('umkm.dashboard')); ?>" class="block text-gray-700 hover:text-blue-600 transition-colors">
                        Dashboard UMKM
                    </a>
                <?php endif; ?>

                <a href="<?php echo e(route('profile.edit')); ?>" class="block text-gray-700 hover:text-blue-600 transition-colors">
                    Profil Saya
                </a>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left text-gray-700 hover:text-blue-600 transition-colors">
                        Keluar
                    </button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="block text-gray-700 hover:text-blue-600 transition-colors">
                    Masuk
                </a>
                <a href="<?php echo e(route('register')); ?>" class="block btn btn-primary text-center">
                    Daftar
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>