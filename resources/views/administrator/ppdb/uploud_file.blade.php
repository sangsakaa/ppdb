<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dokument') }}
            </h2>
            <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Star on Github</span>
            </x-button>
        </div>
    </x-slot>

    <div class=" grid grid-cols-1 gap-2">
        <div class=" grid grid-cols-1 sm:grid-cols-1 gap-2">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class=" grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <x-button
                            href="form-pendaftaran/"
                            variant="purple"
                            class="items-center max-w-xs gap-2">
                            <x-icons.add class="w-6 h-6" aria-hidden="true" />
                            <span>Formulir Pendaftaran</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
        <div class=" grid grid-cols-1 sm:grid-cols-2 gap-2">
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

                    <!-- In your blade view (your-blade-view.blade.php) -->
                    <table class="w-full table-auto border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">File Type</th>
                                <th class="px-4 py-2 text-left">Status <br>Dokument</th>
                                <th class="px-4 py-2 text-left">Action</th>
                                @role('administrator')
                                <th class="px-4 py-2 text-left">Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataDokument as $file)
                            <tr class="border-t hover:bg-gray-50">

                                <td class="px-4 py-2 uppercase text-xs">{{ $file->file_type }}</td>
                                <td class="px-4 py-2 uppercase text-xs">{{ $file->status_pendaftaran }}</td>
                                <td class="px-4 py-2">
                                    <!-- Assuming the file is stored in the 'public/uploads' folder -->
                                    <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="text-blue-500 hover:underline">Download</a>
                                </td>

                                @role('administrator')
                                <td class="">
                                    <!-- Pastikan Anda sudah mengatur route untuk fungsi updateStatus -->

                                    <form action="/uploud-file-status/{{$formulir_ppdb_1}}" method="POST" enctype="multipart/form-data" class="">
                                        @csrf
                                        <!-- Input untuk user_id -->
                                        <input type="hidden" name="user_id" value="{{ $file->user_id }}">
                                        <input type="hidden" name="file_type" value="{{ $file->file_type }}">
                                        <!-- Tombol untuk setujui -->
                                        <button
                                            class=" bg-green-800  text-white px-2 py-1  rounded-md"
                                            variant="success"
                                            type="submit"
                                            name="status_pendaftaran"
                                            value="disetujui">
                                            <span>
                                                <x-icons.check class="h-4 w-4"></x-icons.check>
                                            </span>
                                        </button>

                                        <!-- Tombol untuk tolak -->
                                        <button
                                            class=" bg-red-500  text-white px-2 py-1  rounded-md"
                                            variant="danger"
                                            type="submit" name="status_pendaftaran" value="ditolak" class="">
                                            <span>
                                                <x-icons.error class="h-4 w-4"></x-icons.error>
                                            </span>
                                        </button>

                                        <!-- Tombol untuk menunggu -->
                                        <button
                                            class=" bg-yellow-400   px-2 py-1  rounded-md"
                                            variant="warning"
                                            type="submit" name="status_pendaftaran" value="menunggu" class="">
                                            <span>
                                                <x-icons.arrow-circle class="h-4 w-4"></x-icons.arrow-circle>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>