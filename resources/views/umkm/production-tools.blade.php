@extends('layouts.umkm')

@section('title', 'Alat Produksi')

@section('content')
<div class="space-y-6" x-data="{
    showModal: false,
    editMode: false,
    actionUrl: '{{ route('umkm.production-tools.store') }}',
    form: {
        nama_alat: '',
        jenis: '',
        kapasitas: '',
        kondisi: 'baik',
        status_kepemilikan: 'milik sendiri'
    },
    openAdd() {
        this.editMode = false;
        this.actionUrl = '{{ route('umkm.production-tools.store') }}';
        this.form = {
            nama_alat: '',
            jenis: '',
            kapasitas: '',
            kondisi: 'baik',
            status_kepemilikan: 'milik sendiri'
        };
        this.showModal = true;
    },
    openEdit(data, url) {
        this.editMode = true;
        this.actionUrl = url;
        this.form = {
            nama_alat: data.nama_alat,
            jenis: data.jenis,
            kapasitas: data.kapasitas,
            kondisi: data.kondisi,
            status_kepemilikan: data.status_kepemilikan
        };
        this.showModal = true;
    }
}">
    <!-- Header Banner -->
    <div class="flex items-start justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Alat Produksi</h2>
            <p class="text-gray-700">Kelola dan pantau alat produksi yang Anda miliki untuk operasional usaha.</p>
        </div>

        <button @click="openAdd()" class="px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors shadow-sm flex items-center shrink-0">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Alat
        </button>
    </div>
   
    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Alat Produksi</h3>
            <p class="text-sm text-gray-600 mt-1">Total {{ $profile ? $profile->productionTools()->count() : 0 }} alat produksi terdaftar</p>
        </div>
        @if($profile && $profile->productionTools()->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kapasitas</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kondisi</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kepemilikan</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($profile->productionTools as $tool)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $tool->nama_alat }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ ucwords($tool->jenis) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $tool->kapasitas ?: '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($tool->kondisi === 'baik')
                                        <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Baik</span>
                                    @elseif($tool->kondisi === 'rusak ringan')
                                        <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">Rusak Ringan</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">{{ ucfirst($tool->kondisi) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ ucwords(str_replace('-', ' ', $tool->status_kepemilikan)) }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button @click="openEdit({{ json_encode($tool) }}, '{{ route('umkm.production-tools.update', $tool->id) }}')" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <form action="{{ route('umkm.production-tools.destroy', $tool->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
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
                <div class="inline-flex w-16 h-16 bg-purple-100 rounded-full items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Alat Produksi</h4>
                <p class="text-gray-600 mb-4">Mulai tambahkan alat produksi Anda untuk monitoring dan kolaborasi</p>
                <button @click="openAdd()" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Alat Pertama
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
                            <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="editMode ? 'Edit Alat Produksi' : 'Tambah Alat Produksi'"></h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Alat</label>
                                <input type="text" name="nama_alat" x-model="form.nama_alat" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Mesin Jahit High-Speed">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Alat</label>
                                <input type="text" name="jenis" x-model="form.jenis" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Contoh: Mesin Jahit">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                                <input type="text" name="kapasitas" x-model="form.kapasitas" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Contoh: 100 pcs/hari">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                                <select name="kondisi" x-model="form.kondisi" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="baik">Baik</option>
                                    <option value="rusak ringan">Rusak Ringan</option>
                                    <option value="rusak berat">Rusak Berat</option>
                                    <option value="perlu perbaikan">Perlu Perbaikan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan</label>
                                <select name="status_kepemilikan" x-model="form.status_kepemilikan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="milik sendiri">Milik Sendiri</option>
                                    <option value="sewa">Sewa</option>
                                    <option value="pinjam">Pinjam</option>
                                    <option value="hibah">Hibah</option>
                                </select>
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
