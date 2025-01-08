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
        @php
        $statuses = collect($status_pendaftaran)->flatMap(function ($item) {
        return collect([
        ['status' => $item->status_pendaftaran_1, 'user' => $item->user1, 'label' => 'Data Diri'],
        ['status' => $item->status_pendaftaran_2, 'user' => $item->user2, 'label' => 'Keterangan Tempat Tinggal'],
        ['status' => $item->status_pendaftaran_3, 'user' => $item->user3, 'label' => 'Status Pendaftar'],
        ])->filter(function ($status) {
        return !is_null($status['status']);
        });
        });
        @endphp
        <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="w-full grid grid-cols-1 sm:grid-cols-4  gap-4">
                @foreach ($statuses as $status)
                @php
                switch ($status['status']) {
                case 'menunggu':
                $color = 'bg-yellow-500';
                $statusText = 'Menunggu';
                break;
                case 'disetujui':
                $color = 'bg-green-500';
                $statusText = 'Diterima';
                break;
                case 'ditolak':
                $color = 'bg-red-700';
                $statusText = 'Ditolak';
                break;
                default:
                $color = 'bg-blue-500';
                $statusText = 'Belum Ada Status';
                break;
                }
                @endphp
                <div class="card {{ $color }} text-white p-4 rounded shadow">
                    <p class="text-xs font-bold">{{ $status['label'] }}</p>
                    <p class="text-sm">{{ $statusText }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endrole
</x-app-layout>