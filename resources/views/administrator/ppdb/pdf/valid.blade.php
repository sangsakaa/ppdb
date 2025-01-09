<style>
  /* Define the F4 page size */
  @page {
    size: 210mm 330mm;
    margin: 0;
  }

  body {
    /* font-family: Arial, sans-serif; */
    line-height: 1.5;
    margin: 0;
    margin-left: 40;
    margin-top: 20;
    margin-bottom: 20;
    margin-right: 20;
    padding: 0;
    /* background-color: #fff; */
  }

  .container {
    max-width: 100%;
    margin: 0 auto;
    margin-left: 55px;
    margin-right: 55px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
  }

  th,
  td {
    border: 1px solid #000;
    text-align: left;
    padding: 2px;
  }

  th {
    background-color: #f2f2f2;
    text-align: center;
  }

  .status-check {
    color: green;
    font-size: 20px;
  }

  .status-cross {
    color: red;
    font-size: 20px;
  }

  .highlighted-text {
    font-weight: bold;
    color: #007bff;
  }

  .smaller-text {
    margin: 0;
    font-size: 10px;
  }

  .full-width-border {
    margin-top: 15px;
  }

  .logo {
    width: 200px;
    height: auto;
  }

  .thin-line-cover1 {
    border-top: 1px solid #000;
    margin-top: 1px;
  }

  .thin-line-cover2 {
    border-top: 1px solid #000;
    margin-top: 1px;
  }

  .input {
    margin-left: 5px;
    text-transform: capitalize;
  }

  .info {
    font-size: 12px;
    line-height: 1.6;
  }

  .input {
    margin-left: 5px;
  }

  .image-container {
    position: relative;
    width: 100%;
    height: 100%;
    margin: 0px;

  }

  .image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .text-overlay {
    position: absolute;
    top: 2%;
    left: 47%;
    transform: translateX(-50%);
    /* text-align: center; */
    color: black;

    padding: 20px;
    width: 100%;
    margin: 0px;
  }

  .highlighted-text {
    font-size: 18px;

  }

  .smaller-text {
    font-size: 16px;
    text-align: center;
  }

  .watermark img {
    opacity: 100;
    pointer-events: none;
  }

  .full-width-border {
    width: 100%;
    border: 2px solid white;
    margin-top: 20px;
  }

  .thin-line-cover {
    width: 85%;
    margin-top: 0;
    border: 2px solid #000;
  }

  p {
    margin: 0px;
    margin-top: 30px;
    text-align: center;
  }

  .logo {
    margin-top: 10px;
    margin-bottom: 5px;
  }

  .info {
    margin-left: 0px;
    margin-right: 30;
  }
</style>
<div class="body">
  @section('title', ' | User Management' )
  <div class="image-container">
    <div class="watermark">
      <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/border.png'))) }}" alt="Watermark">
    </div>
    <div class="text-overlay">
      <p>
        PUSAT KEGIATAN BELAJAR MASYARAKAT (PKBM) <br>
        <span class="highlighted-text">KARYA MANDIRI</span> <br>
        NPSN: P2961645 TERAKREDITASI <br>
        KB-PAUD-KF-TBM-KESETARAAN-TPA-LIFE SKILL-KURSUS <br>
        <span class="">Program Paket A Setara SD, Paket B Setara SMP, Dan Paket C Setara SMA</span> <br>
        Alamat: Jl. Negara Km.180 Desa Muara Langon Kecamatan Muara Komam Kabupaten Paser
        <hr class="thin-line-cover">
      </p>
      <p class="smaller-text">
        Program Paket A Setara SD, Paket B Setara SMP, Dan Paket C Setara SMA
        <br>
      </p> <br>
      <div class="full-width-border">
        <center>
          <img class="logo"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/logo.png'))) }}"
            alt="Watermark"
            style="width: 250px; height: auto;">
        </center>
      </div> <!-- Full width border below the text -->

      <style>
        .info-cover {
          display: flex;
          flex-direction: column;
          gap: 0.5rem;
          margin-left: 45px;
          /* Jarak antar baris */
        }

        .info-cover label {
          display: inline-block;
          width: 180px;
          /* min-width: 200px; */
          margin-top: 10px;
          margin-left: 17px;
          /* Lebar tetap untuk sejajar */
          text-align: left;
          /* Sejajarkan teks ke kanan */
        }

        .info-cover span.sub {
          margin-left: 20px;
        }

        .info-cover span.input {
          display: inline-block;
          margin-left: 5px;
          margin-top: 10px;
          /* Jarak antara label dan titik dua */
        }
      </style>
      <div class="page-break"></div>
    </div>
  </div>
  <div>
    <style>
      .text-h1 {
        font-size: large;
      }
    </style>
    <div>
      <p style="text-align: center; margin:0; text-transform: uppercase;" class="text-h1"> Daftar Calon Peserta Valid <br>
        <span>
          TAHUN PELAJARAN {{$periode_pendidikan_id->periode}} {{$periode_pendidikan_id->semester}}
        </span>
      </p>
      <hr class="thin-line-cover">

    </div>
    <table class="min-w-full table-auto border-collapse">
      <thead>
        <tr>
          <th rowspan="2" class="px-4 py-2 border-b">No</th>
          <th rowspan="2" class="px-4 py-2 border-b">Nama Lengkap</th>
          <th rowspan="2" class="px-4 py-2 border-b"> Jenjang</th>
          <th rowspan="2" class="px-4 py-2 border-b">Periode</th>
          <th colspan="7" class="px-4 py-2 border-b">Status</th>
          <th rowspan="2" class="px-4 py-2 border-b">Tanggal <br> Pendaftaran</th>
        </tr>
        <tr>
          <th class="px-4 py-2 border-b"> 1 </th>
          <th class="px-4 py-2 border-b"> 2 </th>
          <th class="px-4 py-2 border-b"> 3 </th>
          <th class="px-4 py-2 border-b"> 4 </th>
          <th class="px-4 py-2 border-b"> 5 </th>
          <th class="px-4 py-2 border-b"> 6 </th>
          <th class="px-4 py-2 border-b"> 7 </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dataCalon as $calon)
        <tr>
          <td class="px-4 py-2 border-b" style="text-transform: capitalize; text-align: center;">{{ $loop->iteration }}</td>
          <td class="px-4 py-2 border-b" style="text-transform: capitalize; ">{{ $calon->nama_lengkap }}</td>
          <td class="px-4 py-2 border-b" style="text-transform: capitalize; text-align: center;">{{ $calon->jenjang }}</td>
          <td class="px-4 py-2 border-b" style="text-align: center;">{{ $calon->periode }}</td>
          <td class="px-4 py-2 border-b text-center" style="text-align: center;">
            @if($calon->status_1 == 'disetujui')
            <img class="logo"
              src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}"
              alt="Watermark"
              style="width: 20px; height: 20px;">
            @else
            {{ $calon->status_1 }}
            @endif
          </td>
          <td class="px-4 py-2 border-b text-center" style="text-align: center;">
            @if($calon->status_1 == 'disetujui')
            <img class="logo"
              src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}"
              alt="Watermark"
              style="width: 20px; height: 20px;">
            @else
            {{ $calon->status_1 }}
            @endif
          </td>
          <td class="px-4 py-2 border-b text-center" style="text-align: center;">
            @if($calon->status_1 == 'disetujui')
            <img class="logo"
              src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}"
              alt="Watermark"
              style="width: 20px; height: 20px;">
            @else
            {{ $calon->status_1 }}
            @endif
          </td>
          <td class="px-4 py-2 border-b text-center" style="text-align: center;">
            @if($calon->status_1 == 'disetujui')
            <img class="logo"
              src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}"
              alt="Watermark"
              style="width: 20px; height: 20px;">
            @else
            {{ $calon->status_1 }}
            @endif
          </td>
          <td class="px-4 py-2 border-b text-center" style="text-align: center;">
            @if($calon->status_1 == 'disetujui')
            <img class="logo"
              src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}"
              alt="Watermark"
              style="width: 20px; height: 20px;">
            @else
            {{ $calon->status_1 }}
            @endif
          </td>
          <td class="px-4 py-2 border-b" style="text-align: center;">
            @if($calon->status_2 == 'disetujui')
            <img class="logo"
              src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}"
              alt="Watermark"
              style="width: 20px; height: 20px;">
            @else
            {{ $calon->status_2 }}
            @endif
          </td>
          <td class="px-4 py-2 border-b" style="text-align: center;">
            @if($calon->status_3 == 'disetujui')
            <img class="logo"
              src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}"
              alt="Watermark"
              style="width: 20px; height: 20px;">
            @else
            {{ $calon->status_3 }}
            @endif
          </td>

          <td class="px-4 py-2 border-b" style="text-align: center;">{{ $calon->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Pagination -->


  </div>