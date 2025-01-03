<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Form PPDB' )
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Formulir Pendaftaran') }}
            </h2>
            <x-button variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span></span>
            </x-button>
        </div>
    </x-slot>
    <div class=" grid grid-cols-1  gap-3">
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            @role('administrator')
            <x-button
                href="/daftar-calon-peserta"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.arrow-back class="w-6 h-6" aria-hidden="true" />
                <span>Back</span>
            </x-button>
            @endrole
        </div>
        <div class="p-6  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h2 class="text-sm sm:text-2xl font-bold mb-6 text-center">Data Diri </h2>
            <form action="/form-pendaftaran/{{ $formulir_ppdb_1->user_id ?? Auth::id() }}" method="POST" enctype="multipart/form-data">

                @csrf
                <!-- Kode Pendaftaran -->
                <div class="mb-4">
                    <label for="kode_pendaftaran" class="block text-gray-700 font-medium">Kode Pendaftaran</label>
                    <input readonly type="text" value="{{old('kode_pendaftaran',$formulir_ppdb_1->kode_pendaftaran ?? '') }}" id="kode_pendaftaran" name="kode_pendaftaran" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    <small>Generate Otomatis</small>
                    <input hidden readonly type="text" value="{{old('periode_pendidikan_id',$periode_pendidikan_id->id ?? '') }}" id="periode_pendidikan_id" name="periode_pendidikan_id" class="w-full border border-gray-300 rounded-lg p-2 mt-1">

                    <input hidden readonly type="text" value="{{old('periode_pendidikan_id',$periode_pendidikan_id->id ?? '') }}" id="user_id" name="user_id" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                </div>
                <!-- Data Pribadi Siswa -->
                <h3 class="text-lg font-semibold mt-8">Data Pribadi Siswa</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="nomor_identitas_kependudukan" class="block text-gray-700 font-medium">NIK</label>
                        <input type="text" id="nomor_identitas_kependudukan" value="{{ old('nomor_identitas_kependudukan', $formulir_ppdb_1->nomor_identitas_kependudukan ?? '') }}" name="nomor_identitas_kependudukan" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    </div>
                    <div class="mb-4">
                        <label for="nama_lengkap" class="block text-gray-700 font-medium">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" value="{{ old('nama_lengkap', $formulir_ppdb_1->nama_lengkap ?? '') }}" name="nama_lengkap" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="jenis_kelamin" class="block text-gray-700 font-medium">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="laki-laki" {{ old('jenis_kelamin',$formulir_ppdb_1->jenis_kelamin ?? '') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin',$formulir_ppdb_1->jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="agama" class="block text-gray-700 font-medium capitalize">Agama</label>
                        <select id="agama" name="agama" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="islam" {{ old('agama',$formulir_ppdb_1->agama ?? '') == 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="kristen" {{ old('agama',$formulir_ppdb_1->agama ?? '') == 'kristen' ? 'selected' : '' }}>Kristen</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="tempat_lahir" class="block text-gray-700 font-medium">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" value="{{ old('tempat_lahir', $formulir_ppdb_1->tempat_lahir ?? '') }}" name="tempat_lahir" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    </div>
                    <div class="mb-4">
                        <label for="tanggal_lahir" class="block text-gray-700 font-medium">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" value="{{ old('tanggal_lahir', $formulir_ppdb_1->tanggal_lahir ?? '') }}" name="tanggal_lahir" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="mb-4">
                        <label for="nomor_telepon" class="block text-gray-700 font-medium">Nomor Telepon</label>
                        <input type="text" id="nomor_telepon" value="{{ old('nomor_telepon', $formulir_ppdb_1->nomor_telepon ?? '') }}" name="nomor_telepon" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    </div>
                    <div class="mb-4">
                        <label for="kewarganegaraan" class="block text-gray-700 font-medium capitalize">Kewarganegaraan</label>
                        <select id="kewarganegaraan" name="kewarganegaraan" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                            <option value="">Pilih kewarganegaraan</option>
                            <option value="indonesia" {{old('kewarganegaraan',$formulir_ppdb_1->kewarganegaraan ?? '') == 'indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="WNA" {{old('kewarganegaraan',$formulir_ppdb_1->kewarganegaraan ?? '') == 'WNA' ? 'selected' : '' }}>Warga Negara Asing </option>
                        </select>
                    </div>
                </div>


                @role('administrator')
                <div class="mb-4">
                    <label for="status_pendaftaran" class="block text-gray-700 font-medium">Status Pendaftaran</label>
                    <select id="status_pendaftaran" name="status_pendaftaran" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        <option value="menunggu" {{ ($formulir_ppdb_1->status_pendaftaran ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ ($formulir_ppdb_1->status_pendaftaran ?? '') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ ($formulir_ppdb_1->status_pendaftaran ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="catatan" class="block text-gray-700 font-medium">Catatan</label>
                    <textarea id="catatan" name="catatan" class="w-full border border-gray-300 rounded-lg p-2 mt-1" rows="3">{{ old('catatan', $formulir_ppdb_1->catatan ?? '') }}</textarea>
                </div>
                @endrole

                <!-- Submit Button -->
                <div class="mt-6 text-center">
                    <x-button href="/daftar-calon-peserta">
                        Kembali
                    </x-button>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg">Submit</button>
                    @if($formulir_ppdb_1 ?? '')
                    <x-button href="/form-keterangan-tempat-tinggal/{{$formulir_ppdb_1->user_id ?? Auth::id()}}">
                        Lanjutkan
                    </x-button>
                    @endif

                </div>
            </form>


        </div>

    </div>

    </div>
</x-app-layout>