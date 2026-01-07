<footer class="bg-gray-900 text-gray-300 py-12">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">SIPETA UMKM</span>
                </div>
                <p class="text-gray-400 mb-4 max-w-md">
                    Sistem Informasi Peta UMKM membantu memvisualisasikan dan mengelola data UMKM di Indonesia untuk mendukung pertumbuhan ekonomi lokal.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h3 class="text-white font-semibold mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo e(url('/')); ?>" class="hover:text-blue-400 transition-colors">Beranda</a></li>
                    <li><a href="<?php echo e(route('map.index')); ?>" class="hover:text-blue-400 transition-colors">Peta Persebaran</a></li>
                    <li><a href="#tentang" class="hover:text-blue-400 transition-colors">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-white font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2">
                    <li class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>info@sipetaumkm.id</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>021-1234-5678</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; <?php echo e(date('Y')); ?> SIPETA UMKM. All rights reserved.</p>
        </div>
    </div>
</footer>
<?php /**PATH D:\laragon\www\sipeta-umkm\resources\views/layouts/partials/footer.blade.php ENDPATH**/ ?>