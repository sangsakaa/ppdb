<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="text-xl font-semibold leading-tight">
        {{ __('Dashboard') }}
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
        target="_blank"
        onclick="printSection('printSection')"
        href="/user-management"
        variant="info"
        class="items-center max-w-xs gap-2">
        <x-icons.print class="w-6 h-6" aria-hidden="true" />
        <span>Cetak</span>
      </x-button>
    </div>
    <div id="" class="p-4  overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
      <div class="max-w-4xl mx-auto bg-white  p-8">
        <div>
          <p style="text-align: center; ">
            PUSAT KEGIATAN BELAJAR MASYARAKAT (PKBM) <br>
            <span style="font-size: 18px;">KARYA MANDIRI</span> <br>
            NPSN: P2961645 TERAKREDITASI <br>
            KB-PAUD-KF-TBM-KESETARAAN-TPA-LIFE SKILL-KURSUS <br>
            <span style="font-size: 16px;">Program Paket A Setara SD, Paket B Setara SMP, Dan Paket C Setara SMA</span> <br>
            Alamat: Jl. Negara Km.180 Desa Muara Langon Kecamatan Muara Komam Kabupaten Paser
          </p>
          <style>
            hr {
              border: 2px;
            }
          </style>
          <hr style="margin: 0; border: 1px solid #000;">
        </div>
        <div class="mt-6 text-center">
          <h2 style="text-align: center;" class="text-lg text-center font-bold underline"></h2>
          <p style="text-align: center;">
            SURAT PERNYATAAN <br>
            Nomor: 0001/PPDB-KM/ /2025
          </p>
        </div>

        <div class="mt-6">
          <p class="font-semibold">Yang bertanda tangan di bawah ini:</p>

          <style>
            .flex-container {
              flex: auto;
            }

            .flex-item {
              flex: auto;
            }
          </style>
          <div style="font-size: 14px;">
            <div class="form-container" style="display: flex; align-items: center;">
              <div class="flex-item" style="width: 50px;">Nama</div>
              <div class="flex-item" style="margin-left: 4px; margin-top: 10px; flex-grow:1;">: ............................................................................................</div>
            </div>
            <div class="form-container" style="display: flex; align-items: center;">
              <div class="flex-item" style="width: 50px;">Tempat/Tanggal Lahir</div>
              <div class="flex-item" style="margin-left: 4px; margin-top: 10px; flex-grow: 1;">: ............................................................................................</div>
            </div>
            <div class="form-container" style="display: flex; align-items: center;">
              <div class="flex-item" style="width: 50px;">Alamat</div>
              <div class="flex-item" style="margin-left: 4px; margin-top: 10px; flex-grow: 1;">: ............................................................................................</div>
            </div>
            <div class="form-container" style="display: flex; align-items: center;">
              <div class="flex-item" style="width: 50px;">No. Telepon/HP</div>
              <div class="flex-item" style="margin-left: 4px; margin-top: 10px; flex-grow: 1;">: ............................................................................................</div>
            </div>
            <div class="form-container" style="display: flex; align-items: center;">
              <div class="flex-item" style="width: 50px;">Program Kesetaraan</div>
              <div class="flex-item" style="margin-left: 4px; margin-top: 10px; flex-grow: 1;">: ............................................................................................ </div>
            </div>
          </div>
        </div>
        <div>
          <p style="font-size: 14px; text-align: justify; line-height: 1.5;">
            Dengan ini saya menyatakan bahwa : <br>
            Saya bersedia menaati Anggaran Dasar dan Anggaran Rumah Tangga (AD-ART) PKBM Karya Mandiri. Saya bersedia membayar semua biaya kegiatan PKBM Karya Mandiri seperti : <br>
          </p>
          <ul style="margin-left: 20px; font-size: 14px;">
            <li>Sosialisasi</li>
            <li>Pendataan</li>
            <li>Belajar</li>
            <li>Praktek</li>
            <li>Keterampilan</li>
            <li>Ujian</li>
            <li>Kegiatan outdoor</li>
            <li>Perpisahan, dan kegiatan lainnya</li>
          </ul>
          <p style="text-align: justify; line-height: 1.5; font-size: 14px; ">Apabila saya Mengundurkan Diri, Tidak Melanjutkan Sekolah Paket, atau tidak mengikuti kegiatan ujian akhir sehingga mengakibatkan tidak lulus, saya tidak akan menarik kembali uang yang telah saya bayarkan dan tidak aka memperkarakan hal tersebut dengan PKBM Karya Mandiri.</p>
          <p style="font-size: 14px;">Demikian surat pernyataan ini saya buat dengan penuh kesadaran dan tanggung jawab.</p>
        </div>

        <div style="font-size: 14px;">
          <p>Muara Langon, ..................2025</p>
          <p class="mt-8">Yang membuat pernyataan,</p>
          <p class="mt-16">........................................................</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>