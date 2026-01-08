@extends('layouts.umkm')

@section('title', 'Bahan Baku')

@section('content')
<div class="space-y-6" x-data="{
    showModal: false,
    editMode: false,
    actionUrl: '{{ route('umkm.raw-materials.store') }}',
    form: {
        nama_bahan: '',
        kebutuhan_per_bulan: '',
        satuan: '',
        asal_supplier: ''
    },
    openAdd() {
        this.editMode = false;
        this.actionUrl = '{{ route('umkm.raw-materials.store') }}';
        this.form = {
            nama_bahan: '',
            kebutuhan_per_bulan: '',
            satuan: '',
            asal_supplier: ''
        };
        this.showModal = true;
    },
    openEdit(data, url) {
        this.editMode = true;
        this.actionUrl = url;
        this.form = {
            nama_bahan: data.nama_bahan,
            kebutuhan_per_bulan: data.kebutuhan_per_bulan,
            satuan: data.satuan,
            asal_supplier: data.asal_supplier
        };
        this.showModal = true;
    }
}">
    <!-- Header Banner -->
    <div class="flex items-start justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Bahan Baku</h2>
            <p class="text-gray-700">Kelola dan pantau kebutuhan bahan baku untuk proses produksi Anda.</p>
        </div>
       
        <button @click="openAdd()" class="px-4 py-2 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors shadow-sm flex items-center shrink-0">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Bahan
        </button>
    </div>
   

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Bahan Baku</h3>
            <p class="text-sm text-gray-600 mt-1">Total {{ $profile ? $profile->rawMaterials()->count() : 0 }} jenis bahan baku terdaftar</p>
        </div>
        @if($profile && $profile->rawMaterials()->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Bahan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kebutuhan/Bulan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Supplier</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($profile->rawMaterials as $material)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $material->nama_bahan }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ number_format($material->kebutuhan_per_bulan, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full">
                                        {{ $material->satuan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $material->asal_supplier }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button @click="openEdit({{ json_encode($material) }}, '{{ route('umkm.raw-materials.update', $material->id) }}')" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <form action="{{ route('umkm.raw-materials.destroy', $material->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data bahan baku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <div class="inline-flex w-16 h-16 bg-orange-100 rounded-full items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Bahan Baku</h4>
                <p class="text-gray-600 mb-4">Mulai catat kebutuhan bahan baku produksi Anda</p>
                <button @click="openAdd()" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Bahan Pertama
                </button>
            </div>
        @endif
    </div>

    <!-- Modal Form -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <form :action="actionUrl" method="POST">
                    @csrf
                    <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="editMode ? 'Edit Bahan Baku' : 'Tambah Bahan Baku'"></h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bahan</label>
                                <input type="text" name="nama_bahan" x-model="form.nama_bahan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Kain Katun">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kebutuhan per Bulan</label>
                                <input type="number" name="kebutuhan_per_bulan" x-model="form.kebutuhan_per_bulan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required min="0" placeholder="100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                                <input type="text" name="satuan" x-model="form.satuan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Meter, Kg, Liter">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Asal Supplier</label>
                                <input type="text" name="asal_supplier" x-model="form.asal_supplier" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Toko Bahan Jaya">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
