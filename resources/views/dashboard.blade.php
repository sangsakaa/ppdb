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
            <h6 class="text-center">Tahan Pengisian Formulir</h6>
            <div class="mb-2 w-full grid">
                @foreach ($StatusPendaftaran as $user)
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
                null => 'text-gray-500',
                ];
                @endphp

                @foreach ($statuses as $key => $route)
                @php
                $status = $user->{'status_'.$key} ?? null;
                $color = $statusColors[$status] ?? $statusColors[null];
                $statusText = $status ? ucfirst($status) : 'Belum Mendaftar';
                $icon = $status === 'disetujui' ? 'check.png' : ($status === 'ditolak' ? 'error.png' : 'pending.png');
                @endphp
                <span class="{{ $color }} px-2 py-2 capitalize" title="{{ $statusText }}">
                    @if ($status !== null)
                    <div class="flex justify-between">
                        <div>
                            <a href="{{ url($route.'/'.$user->user_id) }}">
                                {{ $key }} {{ str_replace('-', ' ', $route) }}
                            </a>
                        </div>
                        {{$status === 'disetujui' ? '✅' : ($status === 'ditolak' ? '❌' : '⏳')}}
                    </div>

                    @else
                    {{ $key }} {{ str_replace('-', ' ', $route) }}
                    {{$status === 'NULL' ? '❌' : ($status === 'ditolak' ? '❌' : '❌')}}
                    @endif
                </span>
                @endforeach
                @if (!$user->status_1 && !$user->status_2 && !$user->status_3 && !$user->status_4 && !$user->status_5)
                <div>
                    <button class="px-2 py-1 rounded-md" title="Belum Mendaftar">
                        Belum Mendaftar
                    </button>
                </div>
                @endif
                @endforeach
            </div>

            @guest
            <div class="justify-center text-center py-2">
                Join Saluran Whatsapp <br>
                <a class="sm:text-center bg-green-500 px-2 py-1 rounded-full text-white" href="https://whatsapp.com/channel/0029Vaz9EHo4tRrqJxfYFJ1U">
                    PKBM KARYA MANDIRI
                </a>
            </div>
            @endguest

        </div>
        @endrole
    </div>
</x-app-layout>