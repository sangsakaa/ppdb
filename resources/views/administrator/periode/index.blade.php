<x-app-layout>
    <x-slot name="header">
        @section('title', ' | Management Periode' )
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Management Periode') }}
            </h2>
            <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Star on Github</span>
            </x-button>
        </div>
    </x-slot>
    <div class=" grid grid-cols-1  gap-3">
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

            <x-button
                href="/add-periode-pendidikan"
                variant="purple"
                class="items-center max-w-xs gap-2">
                <x-icons.add class="w-6 h-6" aria-hidden="true" />
                <span>Periode</span>
            </x-button>
        </div>
        <div class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <table class="table border w-full">
                <thead>
                    <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                        <th class=" py-2">Periode Pendidikan</th>

                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periodePendidikan as $periode)
                    <tr class="border py-1 hover:bg-purple-100">
                        <td class=" py-1 px-1 text-center">
                            {{ $periode->periode }} {{ $periode->semester }}
                        </td>
                        <td class=" py-1 px-1 text-center">
                            {{ $periode->tanggal_mulai }}
                        </td>
                        <td class=" py-1 px-1 text-center">
                            {{ $periode->tanggal_akhir }}
                        </td>
                        <td class=" py-1 px-1 text-center">
                            <script src="//unpkg.com/alpinejs" defer></script>
                            <!-- <form action="/management-periode-pendidikan/{{$periode->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <x-icons.trash></x-icons.trash>
                                </button>
                            </form> -->
                            <div x-data="{ showModal: false }">
                                <!-- Tombol Delete -->
                                <button @click="showModal = true">
                                    <x-icons.trash></x-icons.trash>
                                </button>

                                <!-- Pop-up Konfirmasi -->
                                <div x-show="showModal" class="fixed inset-0 flex items-center justify-center ">
                                    <div class="bg-white p-6 rounded-lg shadow-lg">
                                        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
                                        <p>Apakah Anda yakin ingin menghapus data ini?</p>

                                        <div class="mt-4 flex justify-end space-x-2">
                                            <button @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded">Batal</button>

                                            <form action="/management-periode-pendidikan/{{$periode->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>