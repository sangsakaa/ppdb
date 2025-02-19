<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dokument') }}
            </h2>

        </div>
    </x-slot>

    <div class=" grid grid-cols-1 gap-2">
        <div class=" grid grid-cols-1 sm:grid-cols-1 gap-2">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class=" grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
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
                                <span> | Upload Dokumen Pendaftaran</span>
                            </x-button>
                            @elserole('calon_peserta')
                            <x-button>
                                <!-- <x-icons.sarjana class="w-6 h-6 text-xs" aria-hidden="true" /> -->
                                <span> | Upload Dokumen Pendaftaran</span>
                            </x-button>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
        <div class=" grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class=" grid grid-cols-1 sm:grid-cols-1 gap-2 w-full">
                    <div class=" w-full">
                        <div class="bg-white p-6 rounded-lg shadow-md w-full ">
                            <h2 class="text-2xl font-bold mb-4 text-gray-700">Upload File</h2>
                            <form action="/uploud-file/{{$formulir_ppdb_1}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div>
                                    <input type="hidden" value="{{$form1->id}}" name="formulir_ppdb_1_id" id="formulir_ppdb_1_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <input type="hidden" value="{{$form1->user_id}}" name="user_id" id="user_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <label for="file" class="block text-sm font-medium text-gray-700">Choose File</label>
                                    <input
                                        type="file"
                                        id="file"
                                        name="file_path"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <input
                                        type="hidden"
                                        id="file"
                                        name="file_name"
                                        value="{{$form1->nama_lengkap}}"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <div>
                                        <label for="file_type" class="block text-sm font-medium text-gray-700">File Type</label>

                                        @php
                                        $usedFileTypes = $dataDokument->pluck('file_type')->toArray(); // Mengambil daftar file_type yang sudah ada
                                        @endphp

                                        <select
                                            id="file_type"
                                            name="file_type"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            @foreach (['kk' => 'Kartu Keluarga', 'ktp' => 'Kartu Tanda Penduduk', 'ijazah' => 'Ijazah', 'akte' => 'Akte Kelahiran','ktp_ibu'=>'KTP Ibu','foto'=>'Foto | Wajib jpeg','ket_mutasi'=>'Surat keterangan Mutasi'] as $key => $label)
                                            @if (!in_array($key, $usedFileTypes)) <!-- Sembunyikan opsi jika file_type sudah digunakan -->
                                            <option value="{{ $key }}">{{ $label }}</option>
                                            @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="flex mt-2 justify-end">
                                        <button
                                            type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            Upload
                                        </button>
                                    </div>
                            </form>


                            @if (session('success'))
                            <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="mt-4 p-4 bg-red-100 text-red-800 rounded-lg">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class=" grid grid-cols-1 sm:grid-cols-1 gap-2">
                <div>
                    <table class="w-full table-auto border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">File Type</th>
                                <th class="px-4 py-2 text-left">Status <br>Dokument</th>
                                <th class="px-4 py-2 text-left">Preview</th>
                                <th class="px-4 py-2 text-left">Action</th>
                                <th class="px-4 py-2 text-left">
                                    @role('administrator')
                                    Action
                                    @elserole('calon_peserta')
                                    Action
                                    @endrole
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataDokument as $file)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2 uppercase text-xs">{{ $file->file_type }}</td>
                                <td class="px-4 py-2 uppercase text-xs">{{ $file->status_pendaftaran }}</td>
                                <td class="px-4 py-2 relative">
                                    @if(in_array(pathinfo($file->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <div class="relative">
                                        <img id="preview-{{ $file->id }}" src="{{ Storage::url($file->file_path) }}" alt="Preview" class="w-16 h-16 object-cover transition-transform">
                                        <div class="mt-1 flex space-x-2 ">

                                        </div>
                                    </div>
                                    @else
                                    <img src="/path/to/default-icon.png" alt="No Preview" class="w-16 h-16 object-cover">
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="text-blue-500 hover:underline">Download</a>
                                </td>
                                <td class="">
                                    @role('administrator')
                                    <form action="/uploud-file-status/{{$formulir_ppdb_1}}" method="POST" enctype="multipart/form-data" class="">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $file->user_id }}">
                                        <input type="hidden" name="file_type" value="{{ $file->file_type }}">
                                        <button class="bg-green-800 text-white px-2 py-1 rounded-md" type="submit" name="status_pendaftaran" value="disetujui">
                                            <x-icons.check class="h-4 w-4"></x-icons.check>
                                        </button>
                                        <button class="bg-red-500 text-white px-2 py-1 rounded-md" type="submit" name="status_pendaftaran" value="ditolak">
                                            <x-icons.error class="h-4 w-4"></x-icons.error>
                                        </button>
                                        <button class="bg-yellow-400 px-2 py-1 rounded-md" type="submit" name="status_pendaftaran" value="menunggu">
                                            <x-icons.arrow-circle class="h-4 w-4"></x-icons.arrow-circle>
                                        </button>
                                    </form>
                                    <form action="/delete-file/{{$file->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="bg-red-700 text-white px-2 py-1 rounded-md" type="submit">
                                            <x-icons.trash class="h-4 w-4"></x-icons.trash>
                                        </button>
                                    </form>
                                    @elserole('calon_peserta')
                                    <form action="/delete-file/{{$file->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="bg-red-700 text-white px-2 py-1 rounded-md" type="submit">
                                            <x-icons.trash class="h-4 w-4"></x-icons.trash>
                                        </button>
                                    </form>
                                    <button onclick="rotateImage('{{ $file->id }}')" class=" bg-blue-500 text-white  rounded-md">
                                        <x-icons.rotasi class=" h-4 w-4  "></x-icons.rotasi>
                                    </button>
                                    <button onclick="flipImage('{{ $file->id }}')" class="bg-gray-500 text-white  rounded-md  ">
                                        <x-icons.flip class=""></x-icons.flip>
                                    </button>
                                    @endrole
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        function rotateImage(id) {
                            let img = document.getElementById(`preview-${id}`);
                            let currentRotation = img.style.transform.match(/rotate\((\d+)deg\)/);
                            let newRotation = currentRotation ? (parseInt(currentRotation[1]) + 90) % 360 : 90;
                            img.style.transform = `rotate(${newRotation}deg)`;
                        }

                        function flipImage(id) {
                            let img = document.getElementById(`preview-${id}`);
                            let currentScale = img.style.transform.match(/scaleX\((-?\d+)\)/);
                            let newScale = currentScale ? -parseInt(currentScale[1]) : -1;
                            img.style.transform = `scaleX(${newScale})`;
                        }
                    </script>



                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>