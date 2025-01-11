<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Form PPDB' )
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Jenjang Pendaftaran') }}
            </h2>
        </div>
    </x-slot>
    <div class=" grid grid-cols-1  gap-3">
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            @role('administrator')
            <x-button
                href="/form-pendaftaran/{{$formulir_ppdb_1}}"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.arrow-back class="w-6 h-6" aria-hidden="true" />
                <span>Back</span>
            </x-button>
            <x-button>
                <x-icons.sarjana class="w-6 h-6" aria-hidden="true" />
                <span> | Jenjang Pendidikan</span>
            </x-button>
            @endrole
        </div>
        <div class="p-2  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h3 class="text-sm sm:text-2xl font-bold mb-2 text-left capitalize">Jenjang Pendaftaran</h3>
            <form action="/form-pilih-jenjang/{{$formulir_ppdb_1}}" method="post">
                @csrf

                <input type="hidden" value="{{$form1->id}}" name="formulir_ppdb_1_id" id="formulir_ppdb_1_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                <input type="hidden" value="{{$form1->user_id}}" name="user_id" id="user_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class="mb-2">
                        <label for="jenjang" class="block text-gray-700 font-medium">Pilih Jenjang Pendidikan</label>
                        <select id="jenjang" name="jenjang" class="w-full border border-gray-300 rounded-lg p-2 mt-1 capitalize">
                            <option value="">Pilih Jenjang Pendidikan</option>
                            <option value="Paket A" {{ ($form3->jenjang ?? '') == 'Paket A' ? 'selected' : '' }}>Paket A</option>
                            <option value="Paket B" {{ ($form3->jenjang ?? '') == 'Paket B' ? 'selected' : '' }}>Paket B</option>
                            <option value="Paket C" {{ ($form3->jenjang ?? '') == 'Paket C' ? 'selected' : '' }}>Paket c</option>

                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="status" class="block text-gray-700 font-medium">Pilih Status Pendaftar</label>
                        <select id="status" name="status" class="w-full border border-gray-300 rounded-lg p-2 mt-1 capitalize">
                            <option value="">Pilih Status Pendaftar</option>
                            <option value="Siswa Baru" {{ ($form3->status ?? '') == 'Siswa Baru' ? 'selected' : '' }}>Siswa Baru</option>
                            <option value="Mutasi" {{ ($form3->status ?? '') == 'Mutasi' ? 'selected' : '' }}>Mutasi</option>
                        </select>
                    </div>
                </div>
                @role('administrator')
                <div class="mb-2">
                    <label for="status_pendaftaran" class="block text-gray-700 font-medium">Status Pendaftaran</label>
                    <select id="status_pendaftaran" name="status_pendaftaran" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        <option value="menunggu" {{ ($form3->status_pendaftaran ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ ($form3->status_pendaftaran ?? '') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ ($form3->status_pendaftaran ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="catatan" class="block text-gray-700 font-medium">Catatan</label>
                    <textarea id="catatan" name="catatan" class="w-full border border-gray-300 rounded-lg p-2 mt-1" rows="3">{{ old('catatan', $form3->catatan ?? '') }}</textarea>
                </div>
                @endrole
                <!-- Province ID -->
                <div class="mt-2">
                    <x-button href="/form-keterangan-tempat-tinggal/{{$formulir_ppdb_1}}">
                        <span>Kembali</span>
                    </x-button>
                    <x-button>simpan</x-button>
                    <x-button href="/form-riwayat-pendidikan/{{$formulir_ppdb_1}}">
                        Lanjutkan
                    </x-button>
                </div>
        </div>
        </form>
    </div>
</x-app-layout>