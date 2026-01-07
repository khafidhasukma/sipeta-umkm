@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-blue-50 to-slate-100 py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div class="inline-flex items-center space-x-2 bg-blue-100 border border-blue-200 px-4 py-2 rounded-full text-blue-700 mb-6" x-show="show" x-transition>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium">Tentang SIPETA-UMKM</span>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-bold mb-6 text-gray-900" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 transform translate-y-8" x-transition:enter-end="opacity-100 transform translate-y-0">
                Transformasi Digital<br/>Ekosistem UMKM Semarang
            </h1>
            <p class="text-xl md:text-2xl text-gray-700 leading-relaxed" x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 transform translate-y-8" x-transition:enter-end="opacity-100 transform translate-y-0">
                Dari pendataan manual menuju sistem cerdas berbasis <strong>Evidence-Based Policy</strong> untuk pemberdayaan UMKM yang tepat sasaran
            </p>
        </div>
    </div>
</div>

<!-- Background Context -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16" x-data="{ show: false }" x-intersect="show = true">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-4 border border-blue-200" x-show="show" x-transition>
                    Latar Belakang
                </span>
                <h2 class="text-4xl font-bold text-gray-900 mb-6" x-show="show" x-transition>
                    Mengapa SIPETA-UMKM Dibangun?
                </h2>
            </div>

            <div class="prose prose-lg max-w-none">
                <div class="bg-blue-50 border-l-4 border-blue-600 rounded-r-xl p-8 mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tantangan Pemberdayaan UMKM</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Pemerintah Kota Semarang telah menetapkan arah kebijakan yang jelas: <strong>memperkuat fondasi ekonomi kerakyatan melalui pemberdayaan UMKM</strong>. Sektor ini dipandang sebagai tulang punggung ketahanan ekonomi kota yang mampu menyerap tenaga kerja lokal secara masif.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Namun, visi besar ini menghadapi tantangan operasional yang kompleks. <strong>Intervensi dan program bantuan yang digulirkan pemerintah sering kali kurang optimal</strong> karena tidak berbasis pada data kondisi riil kapasitas produksi pelaku usaha.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white border-2 border-red-200 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-900">Blind Spot Terbesar</h4>
                        </div>
                        <p class="text-gray-700 text-sm">
                            <strong>Ketiadaan data terintegrasi</strong> mengenai kepemilikan alat produksi dan penggunaan bahan baku di setiap UMKM. Tanpa mengetahui siapa memiliki mesin apa atau siapa membutuhkan bahan baku jenis apa, pemerintah kesulitan menentukan kebijakan yang presisi.
                        </p>
                    </div>

                    <div class="bg-white border-2 border-red-200 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-900">Inefisiensi Produksi</h4>
                        </div>
                        <p class="text-gray-700 text-sm">
                            UMKM di Semarang <strong>cenderung berjalan sendiri-sendiri (silo)</strong>. Sering terjadi kasus di mana satu UMKM kekurangan alat produksi, sementara UMKM lain di wilayah yang sama memiliki alat idle. Karena tidak ada jembatan informasi, peluang kolaborasi menjadi hilang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Solution Approach -->
<div class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold mb-4 border border-green-200">
                    Solusi Strategis
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Respons Transformatif</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pergeseran paradigma dari pendataan manual menuju sistem cerdas berbasis teknologi
                </p>
            </div>

            <div class="bg-blue-600 text-white rounded-2xl p-8 md:p-12 mb-12">
                <h3 class="text-3xl font-bold mb-6">SIPETA-UMKM: Bukan Sekadar Aplikasi Pendaftaran</h3>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-xl font-semibold mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Sistem Cerdas
                        </h4>
                        <p class="text-blue-100 leading-relaxed">
                            Mampu memetakan lokasi <strong>sekaligus mengidentifikasi klaster-klaster produksi secara otomatis</strong> menggunakan algoritma AI.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Decision Support System
                        </h4>
                        <p class="text-blue-100 leading-relaxed">
                            Menjawab pertanyaan strategis seperti: <em>"Di mana lokasi terbaik untuk mendirikan gudang bahan baku bersama?"</em> atau <em>"Wilayah mana yang memiliki konsentrasi penjahit dengan mesin high-speed terbanyak?"</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4 Core Capabilities -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold mb-4 border border-purple-200">
                    Kemampuan Teknis
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Melampaui Aplikasi Pendataan Biasa
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Capability 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border-2 border-blue-200">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mr-4 shrink-0">
                            <span class="text-white font-bold text-xl">1</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Pemetaan Geospasial Komprehensif</h3>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Menyajikan data lokasi dan profil mendalam seluruh kategori UMKM dalam format <strong>Sistem Informasi Geografis (GIS)</strong>.
                            </p>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-sm text-gray-600">
                                    <strong>Benefit:</strong> Visualisasi yang jelas bagi pengambil kebijakan mengenai densitas usaha di setiap kelurahan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Capability 2 -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 border-2 border-green-200">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center mr-4 shrink-0">
                            <span class="text-white font-bold text-xl">2</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Analisis Klaster Cerdas</h3>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Mengimplementasikan <strong>algoritma analisis data</strong> untuk mengelompokkan wilayah menjadi "Sentra" berdasarkan kemiripan bahan baku dan alat produksi.
                            </p>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-sm text-gray-600">
                                    <strong>Benefit:</strong> Bukan sekadar kedekatan lokasi fisik, tapi clustering based on <em>production similarity</em>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Capability 3 -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 border-2 border-purple-200">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mr-4 shrink-0">
                            <span class="text-white font-bold text-xl">3</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Fasilitasi Kolaborasi (Matchmaking)</h3>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Fitur inovatif yang menghubungkan UMKM yang membutuhkan alat atau bahan tertentu dengan UMKM lain atau penyedia di sekitarnya.
                            </p>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-sm text-gray-600">
                                    <strong>Benefit:</strong> Efisiensi produksi melalui mekanisme <em>resource sharing</em>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Capability 4 -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8 border-2 border-orange-200">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center mr-4 shrink-0">
                            <span class="text-white font-bold text-xl">4</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Dashboard Eksekutif</h3>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Menyediakan instrumen monitoring bagi Pemkot untuk memantau pertumbuhan omzet dan penyerapan tenaga kerja di setiap sentra yang terbentuk.
                            </p>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-sm text-gray-600">
                                    <strong>Benefit:</strong> Evaluasi program bantuan dapat dilakukan secara terukur.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Expected Transformation -->
<div class="py-20 bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold mb-4 border border-green-200">
                    Dampak yang Diharapkan
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Transformasi Ekosistem UMKM
                </h2>
                <p class="text-xl text-gray-600">
                    Dari isolasi menuju integrasi, dari generalis menuju presisi
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl p-8 shadow-lg border-l-4 border-red-500">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </span>
                        Kondisi SEBELUM
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start text-gray-700">
                            <span class="text-red-500 mr-2">•</span>
                            <span>UMKM berjalan sendiri-sendiri (silo)</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <span class="text-red-500 mr-2">•</span>
                            <span>Data tidak akurat & tidak terpetakan</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <span class="text-red-500 mr-2">•</span>
                            <span>Bantuan pemerintah generalis & salah sasaran</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <span class="text-red-500 mr-2">•</span>
                            <span>Sentra produksi tidak efektif</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-8 shadow-lg border-l-4 border-green-500">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        Kondisi SESUDAH
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start text-gray-700">
                            <span class="text-green-500 mr-2">✓</span>
                            <span><strong>Terintegrasi:</strong> Sentra produksi yang terkoneksi</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <span class="text-green-500 mr-2">✓</span>
                            <span><strong>Valid & Real-Time:</strong> Data geospasial akurat</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <span class="text-green-500 mr-2">✓</span>
                            <span><strong>Tepat Sasaran:</strong> Bantuan berbasis evidence</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <span class="text-green-500 mr-2">✓</span>
                            <span><strong>Efisien:</strong> Resource sharing & kolaborasi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission & Vision -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Vision -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border-2 border-blue-200" x-data="{ show: false }" x-intersect="show = true">
                <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6" x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-50" x-transition:enter-end="opacity-100 transform scale-100">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Visi Kami</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Menjadi <strong>platform Decision Support System terdepan</strong> dalam pemetaan dan analisis UMKM Kota Semarang, mendorong pertumbuhan ekonomi yang inklusif dan berkelanjutan melalui <strong>Evidence-Based Policy</strong>.
                </p>
            </div>

            <!-- Mission -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 border-2 border-green-200" x-data="{ show: false }" x-intersect="show = true">
                <div class="w-16 h-16 bg-green-600 rounded-xl flex items-center justify-center mb-6" x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-50" x-transition:enter-end="opacity-100 transform scale-100">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Misi Kami</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Menyediakan <strong>data geospasial akurat dan terperinci</strong>, menciptakan <strong>platform penghubung untuk memperkuat rantai pasok lokal</strong>, dan memfasilitasi <strong>kolaborasi berbasis data</strong> untuk meningkatkan daya saing UMKM.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 bg-blue-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Bergabunglah dalam Transformasi Digital</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Jadilah bagian dari ekosistem UMKM Kota Semarang yang <strong>terintegrasi, efisien, dan memiliki daya saing tinggi</strong>
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                Daftar UMKM Sekarang
            </a>
            <a href="{{ route('map.index') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-xl font-semibold hover:bg-white/10 transition-all duration-300">
                Lihat Peta Geospasial
            </a>
        </div>
    </div>
</div>
@endsection
