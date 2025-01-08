<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __(' Management Calon Peserta') }}
                @section('title', ' | User Management' )
            </h2>

        </div>
    </x-slot>
    <div class=" grid grid-cols-1  gap-3">
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

            <x-button
                href="form-pendaftaran/{{Auth::id()}}"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.add-user class="w-6 h-6" aria-hidden="true" />
                <span>Formulir Pendaftaran</span>
            </x-button>
            <a href="/data-valid-peserta">
                <x-button>

                    <x-icons.print class="w-6 h-6" aria-hidden="true" />

                </x-button>
            </a>
        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class=" overflow-auto">
                <table class="table text-sm border w-full capitalize">
                    <thead>
                        <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                            <th class=" py-2">Periode Pendaftaran</th>
                            <th class=" py-2">Nama</th>
                            <th class=" py-2">Status </th>
                            <th class=" py-2">Timeline</th>
                            <th class=" py-2">Hub</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataCalon as $user)
                        <tr class="border py-1 hover:bg-purple-100  even:bg-gray-200">
                            <td class="px-1 text-center">
                                <a href="form-pendaftaran/{{$user->user_id}}">
                                    {{ $user->periode }} {{$user->semester}}

                                </a>
                            </td>
                            <td class=" px-1">
                                <a href="form-pendaftaran/{{$user->user_id}}">
                                    {{ $user->nama_lengkap }}
                                </a>
                            </td>

                            <td class="px-1 text-center">
                                <div class=" flex grid-cols-1 gap-1">

                                    @if ($user->status_1)
                                    <div class="mb-2">
                                        @if ($user->status_1 == 'disetujui')
                                        <button class="bg-green-700 px-2 py-1 rounded-md  text-white" title="Diterima">
                                            <a href="form-pendaftaran/{{$user->user_id}}">
                                                1
                                            </a>
                                        </button>
                                        @elseif ($user->status_1 == 'ditolak')
                                        <button class="bg-red-700 px-2 py-1 rounded-md  text-white" title="Ditolak">
                                            <a href="form-pendaftaran/{{$user->user_id}}">
                                                1
                                            </a>
                                        </button>
                                        @elseif ($user->status_1 == 'menunggu')
                                        <button class="bg-yellow-400 px-2 py-1 rounded-md  text-black" title="Menunggu">
                                            <a href="form-pendaftaran/{{$user->user_id}}">
                                                1
                                            </a>
                                        </button>
                                        @else
                                        <button class=" bg-gray-300 px-2 py-1 rounded-md  text-white" title="belum mendaftar">
                                            <a href="form-pendaftaran/{{$user->user_id}}">
                                                1
                                            </a>

                                        </button>
                                        @endif
                                    </div>
                                    @endif

                                    @if ($user->status_2)
                                    <div class="mb-2">
                                        @if ($user->status_2 == 'disetujui')
                                        <button class="bg-green-700 px-2 py-1 rounded-md  text-white" title="Diterima">
                                            <a href="form-keterangan-tempat-tinggal/{{$user->user_id}}">
                                                2
                                            </a>
                                        </button>
                                        @elseif ($user->status_2 == 'ditolak')
                                        <button class="bg-red-700 px-2 py-1 rounded-md  text-white" title="Ditolak">
                                            <a href="form-keterangan-tempat-tinggal/{{$user->user_id}}">
                                                2
                                            </a>
                                        </button>
                                        @elseif ($user->status_2 == 'menunggu')
                                        <button class="bg-yellow-400 px-2 py-1 rounded-md  text-black" title="Menunggu">
                                            <a href="form-keterangan-tempat-tinggal/{{$user->user_id}}">
                                                2
                                            </a>

                                        </button>
                                        @else
                                        <button class=" bg-gray-300 px-2 py-1 rounded-md  text-white" title="belum mendaftar">
                                            2
                                        </button>
                                        @endif
                                    </div>
                                    @endif

                                    @if ($user->status_3)
                                    <div class="mb-2">
                                        @if ($user->status_3 == 'disetujui')
                                        <button class="bg-green-700 px-2 rounded-md py-1  text-white" title="Diterima">
                                            3
                                        </button>
                                        @elseif ($user->status_3 == 'ditolak')
                                        <button class="bg-red-700 px-2 rounded-md py-1  text-white" title="Ditolak">
                                            <a href="form-pilih-jenjang/{{$user->user_id}}">
                                                3
                                            </a>
                                        </button>
                                        @elseif ($user->status_3 == 'menunggu')
                                        <button class="bg-yellow-400 px-2 rounded-md py-1  text-black" title="Menunggu">
                                            <a href="form-pilih-jenjang/{{$user->user_id}}">
                                                3
                                            </a>
                                        </button>
                                        @else
                                        <button class=" bg-green-700 px-2 rounded-md py-1  text-white" title="Diterima">
                                            <a href="form-pilih-jenjang/{{$user->user_id}}">
                                                3
                                            </a>
                                        </button>
                                        @endif
                                    </div>
                                    @endif
                                    @if (!$user->status_1 && !$user->status_2 && !$user->status_3)
                                    <button class=" bg-gray-300 px-1 rounded-md py-1 text-white" title="Belum Mendaftar">
                                        3
                                    </button>
                                    @endif
                                </div>


                            </td>

                            <td class="px-1 text-center">
                                {{$user->created_at->diffForHumans()}}

                            </td>
                            <td class=" text-center">
                                <div class=" flex gap-2">
                                    <a target="_blank" href="https://wa.me/{{$user->phone_number}}" class=" text-center">
                                        <x-icons.telp class="w-4 h-4" aria-hidden="true" />
                                    </a>
                                    <a target="_blank" href="/generate-pdf/{{$user->user_id}}" class=" text-center" title="cetak Formulir">
                                        <x-icons.print class="w-4 h-4" aria-hidden="true" />
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class=" px-1">
                                <p>{{ $dataCalon->links() }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        </div>

    </div>
</x-app-layout>