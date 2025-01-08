<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __(' Management Calon Peserta') }}
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

        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class=" overflow-auto">
                <table class="table text-sm border w-full capitalize">
                    <thead>
                        <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                            <th class=" py-2">Periode Pendaftaran</th>
                            <th class=" py-2">Nama</th>
                            <th class=" py-2">Status </th>
                            <th class=" py-2">Approved</th>
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
                                @if ($user->status_pendaftaran == 'disetujui')
                                <button class="  bg-green-700 px-1 rounded-md py-1 text-white" title="{{$user->status_pendaftaran}}">
                                    <x-icons.check class="w-4 h-4" aria-hidden="true" />
                                </button>
                                @elseif ($user->status_pendaftaran == 'ditolak')
                                <button class="  bg-red-700 py-1 px-1 rounded-md  text-white" title="{{$user->status_pendaftaran}}">
                                    <x-icons.error class="w-4 h-4" aria-hidden="true" />
                                </button>

                                @elseif ($user->status_pendaftaran == 'menunggu')
                                <button class="  bg-yellow-400  py-1 px-1 rounded-md  text-black" title="{{$user->status_pendaftaran}}">
                                    <x-icons.loading class="w-4 h-4" aria-hidden="true" />
                                </button>
                                @else
                                <p>Status Pendaftaran : Belum Terdaftar</p>
                                @endif
                            </td>
                            <td class="px-1 text-center">
                                <form action="/update-registration-status" method="POST">
                                    @csrf
                                    <!-- Kolom user_id atau registration_code yang sesuai, untuk mengidentifikasi record -->
                                    <!-- <input type="hidden" name="user_id" value="{{$user->user_id}}">
                                    <button type="submit" name="status_pendaftaran" value="disetujui" class="bg-green-600 px-1 rounded-md py-1 text-white">
                                        <x-icons.check class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    <button type="submit" name="status_pendaftaran" value="ditolak" class="bg-red-600 px-1 rounded-md py-1 text-white">
                                        <x-icons.error class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    <button type="submit" name="status_pendaftaran" value="menunggu" class="bg-yellow-400 px-1 rounded-md py-1">
                                        <x-icons.loading class="w-4 h-4" aria-hidden="true" />
                                    </button> -->
                                    <input type="hidden" name="user_id" value="{{$user->user_id}}">

                                    @if ($user->status_pendaftaran === 'disetujui')
                                    <!-- Tampilkan tombol "Menunggu" dan "Ditolak" -->
                                    <button type="submit" name="status_pendaftaran" value="menunggu" class="bg-yellow-400 px-1 rounded-md py-1">
                                        <x-icons.loading class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    <button type="submit" name="status_pendaftaran" value="ditolak" class="bg-red-600 px-1 rounded-md py-1 text-white">
                                        <x-icons.error class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    @elseif ($user->status_pendaftaran === 'ditolak')
                                    <!-- Tampilkan tombol "Menunggu" dan "Disetujui" -->
                                    <button type="submit" name="status_pendaftaran" value="menunggu" class="bg-yellow-400 px-1 rounded-md py-1">
                                        <x-icons.loading class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    <button type="submit" name="status_pendaftaran" value="disetujui" class="bg-green-600 px-1 rounded-md py-1 text-white">
                                        <x-icons.check class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    @elseif ($user->status_pendaftaran === 'menunggu')
                                    <!-- Tampilkan tombol "Disetujui" dan "Ditolak" -->
                                    <button type="submit" name="status_pendaftaran" value="disetujui" class="bg-green-600 px-1 rounded-md py-1 text-white">
                                        <x-icons.check class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    <button type="submit" name="status_pendaftaran" value="ditolak" class="bg-red-600 px-1 rounded-md py-1 text-white">
                                        <x-icons.error class="w-4 h-4" aria-hidden="true" />
                                    </button>
                                    @endif

                                </form>
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

                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        </div>

    </div>
</x-app-layout>