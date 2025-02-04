<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

        </div>
    </x-slot>
    <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        @role('administrator')
        <!-- Konten untuk administrator -->
        @elserole('guru')
        <!-- Konten untuk guru -->
        @elserole('calon_peserta')
        <div class="">
            <h6 class=" text-center">Tahan Pengisian Formulir </h6>
            <div class="mb-2 w-full grid ">
                @foreach ($StatusPendaftaran as $user)
                <!-- Kolom Periode dan Semester -->
                @php
                $statuses = [
                1 => 'form-data-diri',
                2 => 'form-keterangan-tempat-tinggal',
                3 => 'form-pilih-jenjang',
                4 => 'form-riwayat-pendidikan',
                5 => 'form-keterangan-orang-tua',
                ];

                $statusColors = [
                'disetujui' => 'bg-green-700 text-white',
                'ditolak' => 'bg-red-700 text-white',
                'menunggu' => 'bg-yellow-400 text-black',
                null => 'bg-gray-200 text-black',
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
                        {{ $key }} {{ str_replace('-', ' ', $route) }}
                    </a>
                    @else
                    {{ $key }} {{ str_replace('-', ' ', $route) }}
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
    @else
    <div class="py-2">
        Selamat Datang : {{Auth::user()->name}} <br>
        Join Saluran Whatsapp : <br>

        <a class=" sm:text-center bg-green-500 px-2 py-1 rounded-full text-white" href="https://whatsapp.com/channel/0029Vaz9EHo4tRrqJxfYFJ1U">
            PKBM KARYA MANDIRI
        </a>

    </div>
    @endrole

    </div>
    </div>

</x-app-layout>