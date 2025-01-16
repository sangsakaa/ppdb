<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <x-button variant="purple"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>{{$user->name}}</span>
            </x-button>
        </div>
    </x-slot>
    @role('administrator')
    <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
            <div class=" w-full  grid grid-cols-1">
                <div class="flex grid-cols-2 bg-blue-100 px-2 py-1 gap-2 rounded-md shadow-lg">
                    <!-- Icon User Circle Section -->
                    <div class=" grid place-items-center ">
                        <x-icons.user-circle class="w-20 h-20 text-blue-800" aria-hidden="true" />
                    </div>
                    <!-- User Information Section -->
                    <div class="w-full flex justify-end px-4">
                        <div class="grid grid-cols-1">
                            <div class=" grid place-items-center ">
                                <span class="text-blue-800" style="font-size: 50px;">{{$jumlahUser}}</span>
                            </div>
                            <!-- <div class="">
                                <span class="text-blue-800" style="font-size: 10px;">Usermanagement</span>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Link to User Management Page -->
                <a href="/user-management">
                    <div class="grid grid-cols-2 justify-end  bg-blue-400">
                        <span class=" px-4 text-white text-sm">View Details</span>
                        <span class=" flex justify-end bg-red-100">
                            <x-icons.arrow-right class=" h-5 text-blue-800 justify-end flex w-full" aria-hidden="true" />
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endrole
    @role('calon_peserta')
    <div class="">
        <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">

            <div class="mb-2 w-full grid grid-cols-2 gap-2">
                @foreach ($StatusPendaftaran as $user)
                <!-- Kolom Periode dan Semester -->
                @php
                $statuses = [
                1 => 'form-pendaftaran',
                2 => 'form-keterangan-tempat-tinggal',
                3 => 'form-pilih-jenjang',
                4 => 'form-riwayat-pendidikan',
                5 => 'form-keterangan-orang-tua',
                ];

                $statusColors = [
                'disetujui' => 'bg-green-700 text-white',
                'ditolak' => 'bg-red-700 text-white',
                'menunggu' => 'bg-yellow-400 text-black',
                null => 'bg-gray-200 text-white',
                ];
                @endphp

                @foreach ($statuses as $key => $route)
                @php
                $status = $user->{'status_'.$key} ?? null;
                $color = $statusColors[$status] ?? $statusColors[null];
                @endphp

                <span class="{{ $color }} px-2 capitalize " title="{{ ucfirst($status) ?: 'Belum Mendaftar' }}">
                    @if ($status !== null && $status !== 'belum mendaftar')
                    <a href="{{ $route }}/{{ $user->user_id }}">
                        {{ $key }} {{$route}}
                    </a>
                    @else
                    {{ $key }}
                    @endif
                </span>
                @endforeach
                <!-- Tombol Jika Semua Status Kosong -->
                @if (!$user->status_1 && !$user->status_2 && !$user->status_3 && !$user->status_4)
                <button class="bg-gray-200 px-1 py-1 rounded-md text-white" title="Belum Mendaftar">
                    Belum Mendaftar
                </button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    </div>
    @endrole
</x-app-layout>