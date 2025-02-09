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
                <form action="" method="get" class="">
                    <div class=" flex gap-2 mb-2">
                        <input type="search" name="search" placeholder="cari kata kunci" id="search" class=" rounded-md  px-2 py-1 w-1/4">
                    </div>
                </form>
                <script>
                    document.getElementById('search').addEventListener('input', function() {
                        const searchValue = this.value.toLowerCase();
                        const rows = document.querySelectorAll('#data-table tr');
                        let hasVisibleRow = false;

                        rows.forEach(row => {
                            const cells = Array.from(row.getElementsByTagName('td'));
                            const text = cells.map(cell => cell.textContent.toLowerCase()).join(' ');

                            if (text.includes(searchValue)) {
                                row.style.display = '';
                                hasVisibleRow = true;
                            } else {
                                row.style.display = 'none';
                            }
                        });

                        // Menampilkan pesan jika tidak ada data yang cocok
                        let noDataRow = document.getElementById('no-data-row');
                        if (!hasVisibleRow) {
                            if (!noDataRow) {
                                noDataRow = document.createElement('tr');
                                noDataRow.id = 'no-data-row';
                                noDataRow.innerHTML = `
                    <td colspan="6" class="text-center text-gray-500">Data tidak ditemukan</td>
                `;
                                document.getElementById('data-table').appendChild(noDataRow);
                            }
                        } else if (noDataRow) {
                            noDataRow.remove();
                        }
                    });
                </script>

                <table class="table text-sm border w-full capitalize">
                    <thead>
                        <tr class=" border  bg-purple-500 text-white able-auto w-full border-collapse ">
                            <th class=" py-2">Periode</th>
                            <th class=" py-2 text-left">Nama</th>
                            <th class=" py-2">Jenjang</th>
                            <th class=" py-2">Status </th>
                            <th class=" py-2">Timeline</th>
                            <th class=" py-2">Hub</th>
                        </tr>
                    </thead>
                    <tbody id="data-table">
                        @if($dataCalon != null && $dataCalon->isNotEmpty())
                        @foreach ($dataCalon as $user)
                        <tr class="border py-1 hover:bg-purple-100  even:bg-purple-200">
                            <td class="px-1 text-center">
                                <a href="form-pendaftaran/{{$user->user_id}}">
                                    {{ $user->periode }} {{$user->semester}}
                                </a>
                            </td>
                            <td class=" px-1">
                                <a href="form-pendaftaran/{{$user->user_id}}" title="{{$user->email}}">
                                    {{ $user->nama_lengkap }} <br>
                                    <!-- <small style="margin:0;">{{$user->email}}</small> -->
                                </a>
                            </td>
                            <td class=" px-1 text-center">
                                <a href="form-pendaftaran/{{$user->user_id}}">
                                    {{ $user->jenjang ??'-' }}
                                </a>
                            </td>

                            <td class="px-1  text-center">
                                <div class=" flex grid-cols-1 gap-1 justify-center">
                                    @php
                                    $statuses = [
                                    1 => 'form-pendaftaran',
                                    2 => 'form-keterangan-tempat-tinggal',
                                    3 => 'form-pilih-jenjang',
                                    4 => 'form-riwayat-pendidikan',
                                    5 => 'form-keterangan-orang-tua',
                                    ];
                                    @endphp

                                    @foreach ($statuses as $key => $route)
                                    @php
                                    $status = $user->{'status_'.$key} ?? null;
                                    $colors = [
                                    'disetujui' => 'bg-green-700 text-white',
                                    'ditolak' => 'bg-red-700 text-white',
                                    'menunggu' => 'bg-yellow-400 text-black',
                                    null => 'bg-gray-200 text-white',
                                    ];
                                    $color = $colors[$status] ?? $colors[null];
                                    @endphp

                                    <div class="mb-2">
                                        <button class="{{ $color }} w-5 h-5 rounded-full flex items-center justify-center" title="{{ ucfirst($status) ?: 'Belum Mendaftar' }}">
                                            <!-- Tambahkan konten tombol, seperti ikon atau teks -->
                                            @if ($status !== null && $status !== 'belum mendaftar')
                                            <a href="{{ $route }}/{{ $user->user_id }}">
                                                {{ $key }}
                                            </a>
                                            @else
                                            {{ $key }}
                                            @endif

                                        </button>


                                    </div>
                                    @endforeach

                                    @if (!$user->status_1 && !$user->status_2 && !$user->status_3 && !$user->status_4)
                                    <button class="bg-gray-200 px-1 py-1 rounded-md text-white" title="Belum Mendaftar">
                                        Belum Mendaftar
                                    </button>
                                    @endif

                                </div>
                            </td>
                            <td class="px-1 text-center">
                                {{$user->created_at->diffForHumans()}}
                            </td>
                            <td class=" text-center">
                                <div class=" flex gap-2">
                                    <a target="_blank" href="https://wa.me/{{$user->nomor_telepon}}" class=" text-center">
                                        <x-icons.telp class="w-4 h-4" aria-hidden="true" />
                                    </a>
                                    <a target="_blank" href="/generate-pdf/{{$user->user_id}}" class=" text-center" title="cetak Formulir">
                                        <x-icons.print class="w-4 h-4" aria-hidden="true" />
                                    </a>
                                    <!-- Pastikan SweetAlert2 sudah terinclude -->
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                    <!-- Form Delete -->
                                    <form id="deleteForm-{{ $user->user_id }}" action="/delete-formulir/{{ $user->user_id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="confirmDelete({{ $user->user_id }})">
                                            <x-icons.trash class="w-4 h-4" aria-hidden="true" />
                                        </button>
                                    </form>
                                    <script>
                                        function confirmDelete(userId) {
                                            Swal.fire({
                                                title: 'Apakah Anda yakin?',
                                                text: "Data yang dihapus tidak dapat dikembalikan!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ya, hapus!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // Submit form jika pengguna mengkonfirmasi penghapusan
                                                    document.getElementById('deleteForm-' + userId).submit();
                                                }
                                            });
                                        }
                                    </script>

                                    </a>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class=" text-center">
                                tidak ada data ditemukan pada periode ini
                            </td>
                        </tr>
                        @endif
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