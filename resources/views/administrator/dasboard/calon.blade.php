<div>

  <div class=" grid grid-cols-1 gap-2">
    <!-- awal header -->
    <div>
      <div class="p-4 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class=" flex gap-1 grid-cols-1">
          <div>
            <a class="sm:text-center    rounded-full text-white" target="_blank" href="https://whatsapp.com/channel/0029Vaz9EHo4tRrqJxfYFJ1U">
              <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/wa.png'))) }}" alt="Watermark"
                style="width: 40px; height: auto;">
            </a>
          </div>
          <div>
            <x-button
              href="form-pendaftaran/{{$user->id}}"
              variant="purple"
              class="items-center max-w-xs gap-2">
              <x-icons.add class="w-6 h-6" aria-hidden="true" />
              <span>Formulir Pendaftaran</span>
            </x-button>
          </div>
        </div>

      </div>
    </div>
    <!-- akhir header -->
    <div>
      <div class="p-4 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @foreach ($StatusPendaftaran as $user)
        <h6 class="text-center  font-semibold">Tahan Pengisian Formulir</h6>
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
  <!-- batas akhir content -->

  <!-- awal footer -->

  <!-- akhir footer -->
</div>
<div class=" mt-2">
  <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <p>keterangan</p>
    <p class=" capitalize text-xs sm:text-sm">1. untuk melakukan tahab pendaftaran <br><span class=" pl-4"> hubungi nomor Bisa hubungi <span class=" underline font-bold">+62 821-4801-2621 (ADMIN PKBM)</span></span> </p>
    <p class=" capitalize text-xs sm:text-sm">2. jika ada formulir yang kurang dimengerti hubungi <span class=" font-bold">ADMIN PKBM</span> </p>
    <p class=" capitalize text-xs sm:text-sm">3. jika ada formulir yang kurang dimengerti bisa join dan follow hubungi nomor Bisa hubungi +62 821-4801-2621(ADMINPKBM) </p>
  </div>
</div>