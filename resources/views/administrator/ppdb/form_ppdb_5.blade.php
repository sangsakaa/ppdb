<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Form PPDB' )
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Keterangan Orang Tua') }}
            </h2>
        </div>
    </x-slot>
    <div class=" grid grid-cols-1  gap-3">
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            @role('administrator')
            <div class=" flex grid-cols-1   gap-2">
                <x-button
                    href="/form-pendaftaran/{{$formulir_ppdb_1}}"
                    variant="purple"
                    class="items-center max-w-xs gap-2">
                    <x-icons.arrow-back class="w-6 h-6" aria-hidden="true" />
                    <span>Back</span>
                </x-button>
                <x-button>
                    <!-- <x-icons.sarjana class="w-6 h-6 text-xs" aria-hidden="true" /> -->
                    <span> | Keterangan Orang Tua</span>
                </x-button>
            </div>
            @endrole
        </div>
        <div class="p-2  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h3 class="text-sm sm:text-2xl font-bold  text-left capitalize">Keterangan Orang Tua</h3>

            <form action="/form-keterangan-orang-tua/{{$formulir_ppdb_1}}" method="post">
                @csrf
                <input type="hidden" value="{{$form1->id}}" name="formulir_ppdb_1_id" id="formulir_ppdb_1_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="hidden" value="{{$form1->user_id}}" name="user_id" id="user_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <div class="mb-2">
                            <label for="nama_ayah" class="block text-gray-700 font-medium">Nama Ayah</label>
                            <input required type="text" id="nama_ayah" value="{{ old('nama_ayah', $form5->nama_ayah ?? '') }}" name="nama_ayah" placeholder="Nama Sekolah sesuai ijazah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        </div>
                        <div class="mb-2">
                            <label for="agama_ayah" class="block text-gray-700 font-medium">Agama</label>
                            <select id="agama_ayah" name="agama_ayah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                                <option value="islam" {{ ($form5->agama_ayah ?? '') == 'islam' ? 'selected' : '' }}>Islam</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="pendidikan_ayah" class="block text-gray-700 font-medium">Pendidikan Ayah</label>
                            <select id="pendidikan_ayah" name="pendidikan_ayah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                                <option value="sd" {{ ($form5->pendidikan_ayah ?? '') == 'sd' ? 'selected' : '' }}>SD</option>
                                <option value="smp" {{ ($form5->pendidikan_ayah ?? '') == 'smp' ? 'selected' : '' }}>SMP</option>
                                <option value="sma" {{ ($form5->pendidikan_ayah ?? '') == 'sma' ? 'selected' : '' }}>SMA</option>
                                <option value="s1" {{ ($form5->pendidikan_ayah ?? '') == 's1' ? 'selected' : '' }}>S1</option>
                                <option value="s2" {{ ($form5->pendidikan_ayah ?? '') == 's2' ? 'selected' : '' }}>S2</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2">
                            <label for="nama_ibu" class="block text-gray-700 font-medium">Nama Ibu</label>
                            <input required type="text" id="nama_ibu" value="{{ old('nama_ibu', $form5->nama_ibu ?? '') }}" name="nama_ibu" placeholder="Nama Sekolah sesuai ijazah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        </div>
                        <div class="mb-2">
                            <label for="agama_ibu" class="block text-gray-700 font-medium">Agama</label>
                            <select id="agama_ibu" name="agama_ibu" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                                <option value="islam" {{ ($form5->agama_ibu ?? '') == 'islam' ? 'selected' : '' }}>Islam</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="pendidikan_ibu" class="block text-gray-700 font-medium">Pendidikan Ayah</label>
                            <select id="pendidikan_ibu" name="pendidikan_ibu" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                                <option value="sd" {{ ($form5->pendidikan_ayah ?? '') == 'sd' ? 'selected' : '' }}>SD</option>
                                <option value="smp" {{ ($form5->pendidikan_ayah ?? '') == 'smp' ? 'selected' : '' }}>SMP</option>
                                <option value="sma" {{ ($form5->pendidikan_ayah ?? '') == 'sma' ? 'selected' : '' }}>SMA</option>
                                <option value="s1" {{ ($form5->pendidikan_ayah ?? '') == 's1' ? 'selected' : '' }}>S1</option>
                                <option value="s2" {{ ($form5->pendidikan_ayah ?? '') == 's2' ? 'selected' : '' }}>S2</option>
                            </select>
                        </div>
                    </div>
                </div>


                @role('administrator')
                <div class="mb-2">
                    <label for="status_pendaftaran" class="block text-gray-700 font-medium">Status Pendaftaran</label>
                    <select id="status_pendaftaran" name="status_pendaftaran" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        <option value="menunggu" {{ ($form5->status_pendaftaran ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ ($form5->status_pendaftaran ?? '') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ ($form5->status_pendaftaran ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="catatan" class="block text-gray-700 font-medium">Catatan</label>
                    <textarea id="catatan" name="catatan" class="w-full border border-gray-300 rounded-lg p-2 mt-1" rows="3">{{ old('catatan', $form4->catatan ?? '') }}</textarea>
                </div>
                @endrole
                <!-- Province ID -->
                <div class="mt-2">
                    <x-button href="/form-keterangan-tempat-tinggal/{{$formulir_ppdb_1}}">
                        <span>Kembali</span>
                    </x-button>
                    <x-button>simpan</x-button>
                </div>
        </div>
        </form>
    </div>
</x-app-layout>