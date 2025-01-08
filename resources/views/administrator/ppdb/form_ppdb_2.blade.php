<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Form PPDB' )
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Formulir Pendaftaran') }}
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
            @endrole
        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

            <form action="/form-keterangan-tempat-tinggal/{{$formulir_ppdb_1}}" method="post">
                @csrf
                <div class="mb-2">
                    <!-- user_id -->

                    <!-- formulir_ppdb_1 -->
                    <input type="hidden" value="{{$form1->id}}" name="formulir_ppdb_1_id" id="formulir_ppdb_1_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <input type="hidden" value="{{$form1->user_id}}" name="user_id" id="user_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <h3 class="text-lg font-semibold mt-2 capitalize">keterangan tempat tinggal</h3>
                <!-- Alamat -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class="mb-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input required placeholder="harus sesui KK" value="{{ old('alamat', $form2->alamat ?? '') }}" type="text" name="alamat" id="alamat" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Kode Pos -->
                    <div class="mb-2">
                        <label for="kode_pos" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                        <input value="{{ old('kode_pos', $form2->kode_pos ?? '') }}" type="number" name="kode_pos" id="kode_pos" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Jenis Tinggal -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class="mb-2">

                        <label for="jenis_tinggal" class="block text-gray-700 font-medium">Jenis Tinggal</label>
                        <select id="jenis_tinggal" name="jenis_tinggal" class="w-full border border-gray-300 rounded-lg p-2 mt-1 capitalize">
                            <option value="">Pilih</option>
                            <option value="orang_tua" {{ ($form2->jenis_tinggal ?? '') == 'orang_tua' ? 'selected' : '' }}>orang tua</option>
                            <option value="wali" {{ ($form2->jenis_tinggal ?? '') == 'wali' ? 'selected' : '' }}>wali</option>
                            <option value="kos" {{ ($form2->jenis_tinggal ?? '') == 'kos' ? 'selected' : '' }}>kos</option>
                            <option value="asrama" {{ ($form2->jenis_tinggal ?? '') == 'asrama' ? 'selected' : '' }}>asrama</option>
                        </select>
                    </div>
                    <!-- Province ID -->
                    <div class="mb-2">
                        <label for="province_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <select class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="provinces" name="province_id">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ (isset($form2->province_id) && $form2->province_id == $province->id) ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class="mb-2">
                        <label for="regency_id" class="block text-gray-700 font-medium">Kabupaten</label>
                        <select class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="regencies" name="regency_id">
                            <option value="">-- Pilih Kabupaten --</option>
                            @if(isset($form2->province_id))
                            @foreach ($regencies as $regency)
                            <option value="{{ $regency->id }}" {{ (isset($form2->regency_id) && $form2->regency_id == $regency->id) ? 'selected' : '' }}>
                                {{ $regency->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="district_id" class="block text-gray-700 font-medium">Kecamatan</label>
                        <select class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="districts" name="district_id">
                            <option value="">-- Pilih Kecamatan --</option>
                            @if(isset($form2->regency_id))
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ (isset($form2->district_id) && $form2->district_id == $district->id) ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="village_id" class="block text-gray-700 font-medium">Desa</label>
                    <select class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="villages" name="village_id">
                        <option value="">-- Pilih Desa --</option>
                        @if(isset($form2->district_id))
                        @foreach ($villages as $village)
                        <option value="{{ $village->id }}" {{ (isset($form2->village_id) && $form2->village_id == $village->id) ? 'selected' : '' }}>
                            {{ $village->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    @role('administrator')
                    <div class="mb-2">
                        <label for="status_pendaftaran" class="block text-gray-700 font-medium">Status Pendaftaran</label>
                        <select id="status_pendaftaran" name="status_pendaftaran" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                            <option value="menunggu" {{ ($form2->status_pendaftaran ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ ($form2->status_pendaftaran ?? '') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ ($form2->status_pendaftaran ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="catatan" class="block text-gray-700 font-medium">Catatan</label>
                        <textarea id="catatan" name="catatan" class="w-full border border-gray-300 rounded-lg p-2 mt-1" rows="3">{{ old('catatan', $form2->catatan ?? '') }}</textarea>
                    </div>
                    @endrole

                    <div class="mt-6">
                        <x-button href="/form-pendaftaran/{{$formulir_ppdb_1}}">
                            <span>Kembali</span>
                        </x-button>
                        <x-button>simpan</x-button>
                        <x-button href="/form-pilih-jenjang/{{$formulir_ppdb_1}}">
                            Lanjutkan
                        </x-button>
                    </div>

            </form>
        </div>
    </div>
    <script>
        document.getElementById('provinces').addEventListener('change', function() {
            const provinceId = this.value;
            fetch(`/get-regencies/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    const regenciesSelect = document.getElementById('regencies');
                    regenciesSelect.innerHTML = '<option value="">-- Select Regency --</option>';
                    data.forEach(regency => {
                        regenciesSelect.innerHTML += `<option value="${regency.id}">${regency.name}</option>`;
                    });
                });
        });

        document.getElementById('regencies').addEventListener('change', function() {
            const regencyId = this.value;
            fetch(`/get-districts/${regencyId}`)
                .then(response => response.json())
                .then(data => {
                    const districtsSelect = document.getElementById('districts');
                    districtsSelect.innerHTML = '<option value="">-- Select District --</option>';
                    data.forEach(district => {
                        districtsSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`;
                    });
                });
        });

        document.getElementById('districts').addEventListener('change', function() {
            const districtId = this.value;
            fetch(`/get-villages/${districtId}`)
                .then(response => response.json())
                .then(data => {
                    const villagesSelect = document.getElementById('villages');
                    villagesSelect.innerHTML = '<option value="">-- Select Village --</option>';
                    data.forEach(village => {
                        villagesSelect.innerHTML += `<option value="${village.id}">${village.name}</option>`;
                    });
                });
        });
    </script>







</x-app-layout>