<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

        </div>
    </x-slot>
    @role('administrator')
    <!-- Konten untuk administrator -->
    @elserole('guru')
    <!-- Konten untuk guru -->
    @elserole('calon_peserta')
    <!-- atas -->
    <div class=" grid grid-cols-1 gap-2">
        <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="">
                <div>
                    <div class="justify-center text-center ">
                        Join Saluran WhatsApp <br>
                        <a class="sm:text-center bg-green-500 px-2 py-1 rounded-full text-white" href="https://whatsapp.com/channel/0029Vaz9EHo4tRrqJxfYFJ1U">
                            PKBM KARYA MANDIRI
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="">
                    <h6 class="text-center  font-semibold">Tahan Pengisian Formulir</h6>
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
                    'disetujui' => ' text-black',
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
                    <div class="mb-2 w-full grid">
                        <span class="{{ $color }} px-2 py-2 capitalize" title="{{ $statusText }}">
                            @if ($status !== null)
                            <div class="flex justify-between">
                                <div>
                                    <a href="{{ url($route.'/'.$user->user_id) }}">
                                        {{ $key }} . {{ str_replace('-', ' ', $route) }}
                                    </a>
                                </div>
                                {{$status === 'disetujui' ? '✅' : ($status === 'ditolak' ? '❌' : '⏳')}}
                            </div>
                            @else
                            <div class="flex justify-between">
                                <div>
                                    {{ $key }} . {{ str_replace('-', ' ', $route) }}
                                </div>
                                {{$status === 'NULL' ? '❌' : ($status === 'ditolak' ? '❌' : '❌')}}
                                @endif
                            </div>
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
                </div>
            </div>
        </div>
        <div class=" mt-2">
            <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="">
                    <p>keterangan</p>
                    <p class=" capitalize text-xs sm:text-sm">1. jika ada formulir yang kurang dimengerti bisa join dan follow hubungi nomor yang tertera di saluran </p>
                </div>
            </div>
        </div>
    </div>
    <!-- bawah -->
    @endrole
</x-app-layout>