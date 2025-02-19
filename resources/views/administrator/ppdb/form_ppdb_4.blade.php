<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Form PPDB' )
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Riwayat Pendidikan') }}
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
                    <x-icons.sarjana class="w-6 h-6" aria-hidden="true" />
                    <span> | Riwayat Pendidikan</span>
                </x-button>
                @elserole('calon_peserta')
                <x-button>
                    <x-icons.sarjana class="w-6 h-6" aria-hidden="true" />
                    <span> | Riwayat Pendidikan</span>
                </x-button>
            </div>
            @endrole
        </div>
        <div class="p-2  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h3 class="text-sm sm:text-2xl font-bold mb-2 text-left capitalize">Riwayat Pendidikan</h3>
            <form action="/form-riwayat-pendidikan/{{$formulir_ppdb_1}}" method="post">
                @csrf
                <input type="hidden" value="{{$form1->id}}" name="formulir_ppdb_1_id" id="formulir_ppdb_1_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="hidden" value="{{$form1->user_id}}" name="user_id" id="user_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class=" grid grid-cols-2 gap-1">
                        <div class="mb-2">
                            <label for="npsn_sekolah" class="block text-gray-700 font-medium">NPSN Sekolah</label>
                            <input oninput="limitDigitsNPSN(this)" type="text" id="npsn_sekolah" value="{{ old('npsn_sekolah', $form4->npsn_sekolah ?? '') }}" name="npsn_sekolah" placeholder="Nama Sekolah sesuai ijazah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        </div>
                        <div class="mb-2">
                            <label for="nisn" class="block text-gray-700 font-medium">NISN</label>
                            <input oninput="limitDigits(this)" type="text" id="nisn" value="{{ old('nisn', $form4->nisn ?? '') }}" name="nisn" placeholder="Nama Sekolah sesuai ijazah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        </div>
                        <script>
                            function limitDigits(input) {
                                if (input.value.length > 10) {
                                    input.value = input.value.slice(0, 10);
                                }
                            }

                            function limitDigitsNPSN(input) {
                                if (input.value.length > 8) {
                                    input.value = input.value.slice(0, 8);
                                }
                            }

                            function tahunLulus(input) {
                                if (input.value.length > 4) {
                                    input.value = input.value.slice(0, 4);
                                }
                            }
                        </script>
                    </div>
                    <div class="mb-2">
                        <label for="nama_sekolah" class="block text-gray-700 font-medium">Nama Sekolah</label>
                        <input type="text" id="nama_sekolah" value="{{ old('nama_sekolah', $form4->nama_sekolah ?? '') }}" name="nama_sekolah" placeholder="Nama Sekolah sesuai ijazah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    </div>
                    <div class=" grid grid-cols-2 gap-1">
                        <div class="mb-2">
                            <label for="jenjang_sekolah" class="block text-gray-700 font-medium">Jenjang Sekolah</label>
                            <select id="jenjang_sekolah" name="jenjang_sekolah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                                <option value="sd" {{ ($form4->jenjang_sekolah ?? '') == 'sd' ? 'selected' : '' }}>SD/MI</option>
                                <option value="smp" {{ ($form4->jenjang_sekolah ?? '') == 'smp' ? 'selected' : '' }}>SMP/MTS</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="status_sekolah" class="block text-gray-700 font-medium">Status Sekolah</label>
                            <select id="status_sekolah" name="status_sekolah" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                                <option value="negeri" {{ ($form4->status_sekolah ?? '') == 'negeri' ? 'selected' : '' }}>Negeri</option>
                                <option value="swasta" {{ ($form4->status_sekolah ?? '') == 'swasta' ? 'selected' : '' }}>Swasta</option>
                            </select>
                        </div>

                    </div>
                    <div class="mb-2">
                        <label for="tahun_lulus" class="block text-gray-700 font-medium">Tahun Lulus</label>
                        <input type="text" id="tahun_lulus" value="{{ old('tahun_lulus', $form4->tahun_lulus ?? '') }}" name="tahun_lulus" placeholder="2025" class="w-full border border-gray-300 rounded-lg p-2 mt-1" oninput="tahunLulus(this)">
                    </div>
                </div>
                <div class="mb-2">
                    <label for="alamat" class="block text-gray-700 font-medium">Alamat Sekolah</label>
                    <textarea id="alamat" name="alamat" class="w-full border border-gray-300 rounded-lg p-2 mt-1" rows="3" required>{{ old('alamat', $form4->alamat ?? '') }}</textarea>
                </div>

                @role('administrator')
                <div class="mb-2">
                    <label for="status_pendaftaran" class="block text-gray-700 font-medium">Status Pendaftaran</label>
                    <select id="status_pendaftaran" name="status_pendaftaran" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        <option value="menunggu" {{ ($form4->status_pendaftaran ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ ($form4->status_pendaftaran ?? '') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ ($form4->status_pendaftaran ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                    @if($form4 ?? '')
                    <x-button href="/form-keterangan-orang-tua/{{$formulir_ppdb_1}}">
                        Lanjutkan
                    </x-button>

                </div>
        </div>
        </form>
    </div>
</x-app-layout>