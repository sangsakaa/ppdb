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
        <span style="text-transform: uppercase; border: 1px solid black; padding: 5px;">
          PROGRAM KESETARAAN TAHUN PELAJARAN {{$data->periode??'-'}} {{$data->semester??'-'}}
        </span>

      </p> <br>
      <div class="full-width-border">
        <center>
          <img class="logo"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/logo.png'))) }}"
            alt="Watermark"
            style="width: 250px; height: auto;">
        </center>
      </div> <!-- Full width border below the text -->

      <p style="text-transform: uppercase;" class="highlighted-text">Formulir Pendaftaran Peserta Didik Baru <br>Kode Pendaftaran: {{$data->kode_pendaftaran?? '-'}}</p>
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
      <div class="info-cover">
        <label for="nama">Nama</label>
        <span class="input">: {{$data->nama_lengkap ?? '-'}}</span> <br>
        <label for="nama">Tempat,Tanggal Lahir</label>
        <span class="input">: {{$data->tempat_lahir ?? '-'}} , {{$tanggalLahir ?? '-'}}</span> <br>
        <label for="alamat">Nomor WhatsApp</label>
        <span class="input">
          : {{ $data && $data->nomor_telepon ? implode(str_split($data->nomor_telepon, 4)) : '-' }}
        </span> <br>
        <label for="alamat">Alamat</label>
        <span class="input">: {{$data->alamat ?? '-'}}</span> <br>
        <label for="alamat">Program Kesetaraan</label>
        <span class="input">: {{$data->jenjang ?? '-'}} </span>
      </div>

      <div>
        <div class="container">
          <table>
            <thead>
              <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Dokumen</th>
                <th colspan="2">Status</th>
                <th rowspan="2">Status Dokumen</th>
              </tr>
              <tr>
                <th>Valid</th>
                <th>Error</th>
              </tr>
            </thead>
            <tbody>
              @foreach($file as $item)
              <tr>
                <td>
                  {{$loop->iteration}}
                </td>
                <td>
                  @if($item->file_type === 'kk')
                  Kartu Keluarga
                  @elseif($item->file_type === 'ktp')
                  Kartu Tanda Kependudukan
                  @elseif($item->file_type === 'ijazah')
                  Ijazah Terakhir
                  @elseif($item->file_type === 'foto')
                  Foto 3x4 background Merah
                  @elseif($item->file_type === 'akte')
                  Akte Kelahiran
                  @elseif($item->file_type === 'ktp_ibu')
                  Kartu Tanda Kependudukan Ibu Kandung
                  @elseif($item->file_type === 'ket_mutasi')
                  Keterangan Surat mutasi
                  @else
                  File tidak dikenal
                  @endif

                </td>
                <td class="px-4 py-2 border-b text-center" style="text-align: center;">
                  @if($item->status_pendaftaran === 'disetujui')
                  <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/check.png'))) }}" alt="Check" style="width: 20px; height: 20px;">
                  @else
                  -
                  @endif
                </td>
                <td class="px-4 py-2 border-b text-center" style="text-align: center;">
                  @if($item->status_pendaftaran === 'disetujui')
                  -
                  @else
                  <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/error.png'))) }}" alt="Check" style="width: 20px; height: 20px;">
                  @endif
                </td>
                <td>
                  {{$item->catatan}}
                </td>

              </tr>
              @endforeach
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-break"></div>
<!-- COVER -->
<p style="text-align: center; margin:0;">
  <style>
    .page-break {
      page-break-after: always;
    }
  </style>
  PUSAT KEGIATAN BELAJAR MASYARAKAT (PKBM) <br>
  <span style="font-size: 18px;">KARYA MANDIRI</span> <br>
  NPSN: P2961645 TERAKREDITASI <br>
  KB-PAUD-KF-TBM-KESETARAAN-TPA-LIFE SKILL-KURSUS <br>
  <span style="font-size: 16px;">Program Paket A Setara SD, Paket B Setara SMP, Dan Paket C Setara SMA</span> <br>
  Alamat: Jl. Negara Km.180 Desa Muara Langon Kecamatan Muara Komam Kabupaten Paser
</p>
<!-- <hr style="margin-top: 0; border: 0,5px  solid #000;"> -->
<hr class="thick-line">
<hr class="thin-line">

<style>
  .thick-line {
    margin: 0;
    margin-top: 0.5px;
    margin-bottom: 0.5px;
    border: 2px solid #000;
  }

  .thin-line {
    margin-top: 0;
    border: 0.5px solid #000;
  }
</style>

<p style="text-align: center; margin:0">
  SURAT PERNYATAAN <br>

  Nomor: {{ isset($data->kode_pendaftaran) ? substr($data->kode_pendaftaran, -3) : '000' }}/PPDB-KM/{{$bulanRomawi}}/{{$tahun}}

</p>

</div>
<div class="mt-6">
  <p style="text-align: left; margin:0">Yang bertanda tangan di bawah ini:</p>
  <style>
    .info {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      font-size: 16px;
      /* Jarak antar baris */
    }

    .info label {
      display: inline-block;
      width: 185px;
      /* min-width: 200px; */
      margin-top: 2px;
      margin-left: 10px;
      /* Lebar tetap untuk sejajar */
      text-align: left;
      /* Sejajarkan teks ke kanan */
    }

    .info span.input {
      display: inline-block;
      margin-left: 5px;
      margin-top: 2px;
      /* Jarak antara label dan titik dua */
    }

    .info span.sub {
      margin-left: 20px;
    }
  </style>
  <div class="form-container">
    <div class="info" style="font-size: 16px;">
      <label for="nama">Nama</label>
      <span class="input">: {{$data->nama_lengkap ?? '-'}}</span> <br>
      <label for="nama">NIK</label>
      <span class="input">: {{$data->nomor_identitas_kependudukan ?? '-'}}</span> <br>
      <label for="nama">Tempat,Tanggal Lahir</label>
      <span class="input">: {{$data->tempat_lahir ?? '-'}} , {{$tanggalLahir ?? '-'}}</span> <br>
      <label for="alamat">Nomor WhatsApp</label>
      <span class="input">: {{ $data && $data->nomor_telepon ? implode(str_split($data->nomor_telepon, 4)) : '-' }}</span> <br>
      <label for="alamat">Alamat</label>
      <span class="input">: {{$data->alamat ?? '-'}}</span> <br>
      <label for="alamat">Program Kesetaraan</label>
      <span class="input">: {{$data->jenjang ??'-'}} </span>
    </div>
    <p style="font-size: 16px; text-align: justify; line-height: 1.5; margin:0; margin-top: 10px;">
      Dengan ini saya menyatakan bahwa : <br>
      Saya bersedia menaati Anggaran Dasar dan Anggaran Rumah Tangga (AD-ART) PKBM Karya Mandiri. Saya bersedia membayar semua biaya kegiatan PKBM Karya Mandiri seperti : <br>
    </p>
    <ul style="margin-left: 20px; font-size: 16px;">
      <li>Sosialisasi</li>
      <li>Pendataan</li>
      <li>Belajar</li>
      <li>Praktek</li>
      <li>Keterampilan</li>
      <li>Ujian</li>
      <li>Kegiatan outdoor</li>
      <li>Perpisahan, dan kegiatan lainnya</li>
    </ul>
    <p style="text-align: justify; line-height: 1.5; font-size: 16px; margin:0; ">Apabila saya Mengundurkan Diri, Tidak Melanjutkan Sekolah Paket, atau tidak mengikuti kegiatan ujian akhir sehingga mengakibatkan tidak lulus, saya tidak akan menarik kembali uang yang telah saya bayarkan dan tidak akan memperkarakan hal tersebut dengan PKBM Karya Mandiri.</p>
    <p style="font-size: 16px; text-align:left; margin:0;">Demikian surat pernyataan ini saya buat dengan penuh kesadaran dan tanggung jawab.</p>
    <style>
      .rata-kanan {
        margin-left: 450px;
        font-size: 16px;
        text-align: left;
      }

      .mt-16 {
        margin-top: 100px;
      }

      h5 {
        margin: 0;
        padding: 0;
      }
    </style>

    <div class="rata-kanan">
      Muara Langon, {{$tanggalCetak}}
      <br>
      Yang membuat pernyataan, <br> <br><br><br> <br><br>
      <span style="text-transform: capitalize; ">
        {{$data->nama_lengkap ?? '-'}}
      </span>
    </div>
    <div class="page-break"></div>
    <!-- SURAT PERNYATANN -->
    <table>
      <tbody>
        <tr>
          <td>
            <h5 style="text-align: left;">
              FORMULIR PENDAFTARAN <br> PESERTA DIDIK BARU <br>
              <span style="font-size:  16px; text-transform: uppercase;"></span>
            </h5>
          </td>
          <td style="text-align: center ;  width: 200px; font-size:  16px; text-transform: uppercase;">
            Kode Pendaftaran <br>
            {{$data->kode_pendaftaran ?? '-'}}
          </td>
        </tr>
      </tbody>
    </table>
    <div class="info">
      <h5 style="text-align: left;">
        A. IDENTITAS PESERTA DIDIK
      </h5>
      <label for="nama_lengkap">1. Nama Lengkap</label>
      <span class="input">: {{$data->nama_lengkap ?? '-'}}</span> <br>
      <label for="jenis_kelamin">2. Jenis Kelamin</label>
      <span class="input">: {{$data->jenis_kelamin ?? '-'}}</span> <br>

      <label for="tanggal_lahir">3. Tanggal Lahir</label>
      <span class="input">: {{$data->tempat_lahir ?? '-'}} {{$tanggalLahir ?? '-'}}</span> <br>

      <label for="agama">4. Agama</label>
      <span class="input">: {{$data->agama ?? '-'}}</span> <br>

      <label for="kewarganegaraan">5. Kewarganegaraan</label>
      <span class="input">: {{$data->kewarganegaraan ?? '-'}}</span> <br>

      <!-- <label for="anak_ke_berapa">6. Anak Ke-berapa</label>
      <span class="input">: </span> <br>

      <label for="jumlah_saudara_kandung">7. Jumlah Saudara Kandung</label>
      <span class="input">: </span> <br>

      <label for="jumlah_saudara_tiri">8. Jumlah Saudara Tiri</label>
      <span class="input">: </span> <br>

      <label for="jumlah_saudara_angkat">9. Jumlah Saudara Angkat</label>
      <span class="input">: </span> <br>

      <label for="status_anak">10. Status Anak</label>
      <span class="input">: </span> <br>

      <label for="bahasa_sehari_hari">11. Bahasa Sehari-hari</label>
      <span class="input">: </span> <br> -->
      <h5 style="text-align: left;">
        B. KETERANGAN TEMPAT TINGGAL
      </h5>
      <label for="alamat_lengkap">6. Alamat Lengkap</label>
      <span class="input">: {{$data->alamat ??'-'}}</span> <br>

      <label for="nomor_whatsapp">7. Nomor WhatsApp</label>
      <span class="input">: {{ $data && $data->nomor_telepon ? implode(str_split($data->nomor_telepon, 4)) : '-' }}</span> <br>


      <label for="jenis_tinggal">8. Status Tinggal</label>
      <span class="input">: {{$data->jenis_tinggal ??'-'}} </span> <br>
      <h5 style="text-align: left;">
        C. KETERANGAN PENDAFTARAN
      </h5>
      <label for="alamat_lengkap">9. Status </label>
      <span class="input">: {{$data->status ??'-'}}</span> <br>
      <label for="jenis_tinggal">10. Jenjang </label>
      <span class="input">: {{$data->jenjang ??'-'}} </span> <br>
      <h5 style="text-align: left;">
        D. RIWAYAT PENDIDIKAN
      </h5>
      <label for="alamat_lengkap">11. NISN </label>
      <span class="input">: {{$data->nisn ??'-'}}</span> <br>
      <label for="alamat_lengkap">12. NPSN </label>
      <span class="input">: {{$data->npsn_sekolah ??'-'}}</span> <br>
      <label for="jenis_tinggal">13. Nama Sekolah </label>
      <span style="text-transform: uppercase;" class="input">: {{$data->nama_sekolah ??'-'}} </span> <br>
      <label for="jenis_tinggal">14. Jenjang </label>
      <span style="text-transform: uppercase;" class="input">: {{$data->jenjang_sekolah ??'-'}} </span> <br>
      <label for="jenis_tinggal">15. Status Sekolah </label>
      <span style="text-transform: uppercase;" class="input">: {{$data->status_sekolah ??'-'}} </span> <br>
      <label for="jenis_tinggal">16. Tahun Lulus </label>
      <span style="text-transform: uppercase;" class="input">: {{$data->tahun_lulus ??'-'}} </span> <br>

      <!-- <label for="jarak_rumah_ke_sekolah" style="font-size: small;">16. Jarak Rumah ke Sekolah</label>
      <span class="input">: </span> <br> -->

      <h5 style="text-align: left;">
        E. KETERANGAN AYAH
      </h5>
      <label for="nama_ayah">25. Nama</label>
      <span class="input">: {{$data->nama_ayah ??'-'}} </span> <br>

      <label for="tanggal_lahir_ayah">26. Tanggal Lahir</label>
      <span class="input">: </span> <br>
      <label for="agama_ayah">27. Agama</label>
      <span class="input">: {{$data->agama_ayah ??'-'}}</span> <br>

      <label for="kewarganegaraan_ayah">28. Kewarganegaraan</label>
      <span class="input">: </span> <br>

      <label for="pendidikan_ayah">29. Pendidikan</label>
      <span class="input" style="text-transform: uppercase;">: {{$data->pendidikan_ayah ??'-'}}</span> <br>

      <label for="pekerjaan_ayah">30. Pekerjaan</label>
      <span class="input">: </span> <br>
      <h5 style="text-align: left;">
        F. KETERANGAN IBU
      </h5>
      <label for="nama_ayah">25. Nama</label>
      <span class="input">: {{$data->nama_ibu ??'-'}} </span> <br>

      <label for="tanggal_lahir_ibu">26. Tanggal Lahir</label>
      <span class="input">: </span> <br>

      <label for="agama_ibu">27. Agama</label>
      <span class="input">: {{$data->agama_ibu ??'-'}} </span> <br>

      <label for="kewarganegaraan_ibu">28. Kewarganegaraan</label>
      <span class="input">: </span> <br>

      <label for="pendidikan_ibu">29. Pendidikan</label>
      <span class="input" style="text-transform: uppercase;">: {{$data->pendidikan_ibu ??'-'}} </span> <br>
    </div>
    <table style="border: none;">
      <tbody>
        <tr>
          <td style="border: none;">
            Tanda Tangan
          </td>
          <td style="text-align: right ;  width: 150px; border: none; ">
            <img src="file://{{ $imagePath  }}" alt="Image" style="width: 150px; height: 200px; text-align:right;">
          </td>
        </tr>
      </tbody>
    </table>