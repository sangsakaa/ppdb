<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Validasi Formulir Pendaftaran' )
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Validasi Formulir Pendaftaran') }}
            </h2>
            <x-button variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>{{$periode_pendidikan_id->periode}}</span>
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
            @if ($dataCalon && $dataCalon->status_pendaftaran)
            @if ($dataCalon->status_pendaftaran == 'disetujui')
            <x-button
                href="/daftar-calon-peserta"
                variant="success"
                class="items-center max-w-xs gap-2">
                <x-icons.check class="w-6 h-6" aria-hidden="true" />
                <span>Approved</span>
            </x-button>
            @elseif ($dataCalon->status_pendaftaran == 'ditolak')
            <x-button
                href="/daftar-calon-peserta"
                variant="danger"
                class="items-center max-w-xs gap-2">
                <x-icons.error class="w-6 h-6" aria-hidden="true" />
                <span>Ditolak</span>
            </x-button>
            @elseif ($dataCalon->status_pendaftaran == 'menunggu')
            <x-button
                href="/daftar-calon-peserta"
                variant="warning"
                class="items-center max-w-xs gap-2">
                <x-icons.loading class="w-6 h-6" aria-hidden="true" />
                <span>Menunggu</span>
            </x-button>
            @else
            <p>Status Pendaftaran: Belum Terdaftar</p>
            @endif
            @else
            <p>Status Pendaftaran: Data tidak ditemukan</p>
            @endif


        </div>
        <div class="p-6  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h2 class="text-2xl font-bold mb-6 text-center">Validasi Pendaftaran Pendaftaran</h2>

            <form action="/validasi-calon-peserta/{{$dataCalon->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <!-- Kode Pendaftaran -->
                <div class="mb-4">
                    <label for="kode_pendaftaran" class="block text-gray-700 font-medium">Kode Pendaftaran</label>
                    <input readonly type="text" id="kode_pendaftaran" value="{{$dataCalon->kode_pendaftaran}}" name="kode_pendaftaran" class="w-full border  rounded-lg p-2 mt-1">
                </div>

                <!-- Data Pribadi Siswa -->
                <h3 class="text-lg font-semibold mt-8">Data Pribadi Siswa</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="nama_lengkap" class="block text-gray-700 font-medium">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" value="{{$dataCalon->nama_lengkap}}" name="nama_lengkap" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="jenis_kelamin" class="block text-gray-700 font-medium">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
                            <option value="">Pilih</option>
                            <option value="male" {{ $dataCalon->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ $dataCalon->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>


                    </div>
                </div>
                <div class="mb-4">
                    <label for="status_pendaftaran" class="block text-gray-700 font-medium">Status Pendaftaran</label>
                    <select id="status_pendaftaran" name="status_pendaftaran" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
                        <option value="">Pilih</option>
                        <option value="menunggu" {{ $dataCalon->status_pendaftaran == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="ditolak" {{ $dataCalon->status_pendaftaran == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="disetujui" {{ $dataCalon->status_pendaftaran == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    </select>
                </div>
                @if ($dataCalon->status_pendaftaran == 'ditolak')
                <label for="registration_status" class="block text-gray-700 font-medium">Catatan</label>
                <input type="text" id="notes" value="{{$dataCalon->notes}}" name="notes" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
                @endif
                <!-- Submit Button -->
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700">Update</button>

                </div>
            </form>
            <form action="/update-registration-status" method="POST">
                @csrf
                <!-- Kolom user_id atau registration_code yang sesuai, untuk mengidentifikasi record -->
                <input type="hidden" name="user_id" value="{{$dataCalon->user_id}}">
                <div class=" flex gap-2 justify-center mt-4">
                    <button type="submit" name="status_pendaftaran" value="disetujui" class="  bg-green-600 px-1 rounded-md py-1 text-white  w-32 ">
                        <span>disetujui</span>
                    </button>
                    <button type="submit" name="status_pendaftaran" value="ditolak" class=" bg-red-600 px-1 rounded-md py-1 text-white w-32">

                        <span>Ditolak</span>
                    </button>
                    <button type="submit" name="status_pendaftaran" value="menunggu" class=" bg-yellow-400 px-1 rounded-md py-1 w-32">

                        <span>menunggu</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

    </div>
</x-app-layout>