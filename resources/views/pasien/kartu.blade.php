<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kartu Pasien</title>
<style>
  /* Ukuran halaman & margin ketat */
  @page { size: A7 landscape; margin: 5mm; }
  html, body { margin: 0; padding: 0; }
  * { box-sizing: border-box; }

  /* Cegah pecah halaman */
  .no-break, .no-break * { page-break-inside: avoid; }

  body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 10.5px; color: #111; }

  .kartu {
    border: 1px solid #333; border-radius: 6px;
    padding: 6px 8px;              /* lebih kecil dari sebelumnya */
    display: flex; gap: 6px;       /* ganti grid -> flex (lebih stabil di dompdf) */
    align-items: flex-start;
  }

  .left { flex: 1 1 64%; min-width: 0; }
  .right { flex: 0 0 36%; text-align: center; }

  .title { font-weight: 700; font-size: 11.5px; margin-bottom: 2px; }
  .sub   { font-size: 9.5px; color: #555; margin-bottom: 4px; }

  .rm {
    display: inline-block; padding: 2px 6px;
    border: 1px dashed #666; border-radius: 4px;
    font-weight: 700; letter-spacing: .4px; margin-bottom: 4px;
  }

  table { width: 100%; border-collapse: collapse; margin: 0; }
  td { padding: 1px 0; vertical-align: top; }
  .label { width: 32%; color: #666; }

  /* QR aman untuk A7 landscape */
  .qr-wrap { margin-top: 2px; }
  .qr-caption { font-size: 9px; color:#666; margin-top: 2px; }

  /* Jaga-jaga overflow */
  .kartu { overflow: hidden; }
</style>
</head>
<body class="no-break">
  <div class="kartu no-break">
    <div class="left no-break">
      <div class="title">KARTU PASIEN PUSKESMAS</div>
      <div class="sub">Jl. Contoh Alamat No. 123, Semarang • (024) 123456</div>

      <div class="rm">No. RM: {{ $pasien->no_rm }}</div>

      <table class="no-break">
        <tr>
          <td class="label">Nama</td>
          <td>: {{ $pasien->nama_pasien }}</td>
        </tr>
        <tr>
          <td class="label">NIK</td>
          <td>: {{ $pasien->nik }}</td>
        </tr>
        <tr>
          <td class="label">JK / Umur</td>
          <td>: {{ $pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
              @if(!empty($umur)) / {{ $umur }} th @endif
          </td>
        </tr>
        <tr>
          <td class="label">TTL</td>
          <td>: {{ $pasien->tempat_lahir ?? '-' }},
               {{ $pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') : '-' }}
          </td>
        </tr>
        <tr>
          <td class="label">Alamat</td>
          <td>: {{ $pasien->alamat }}</td>
        </tr>
        <tr>
          <td class="label">No. HP</td>
          <td>: {{ $pasien->no_hp }}</td>
        </tr>
      </table>
    </div>

    <div class="right no-break">
      <div class="qr-wrap">
        {{-- Kecilkan QR agar tidak mendorong tinggi halaman --}}
        @php
            $qrImage = base64_encode(QrCode::format('png')->size(70)->generate($pasien->no_rm));
        @endphp
        <img src="data:image/png;base64,{{ $qrBase64 }}" width="70" height="70" alt="QR Code">

        <img src="data:image/png;base64,{{ $qrImage }}" width="70" height="70" alt="QR Code">

      </div>
      <div class="qr-caption">Scan: No. RM</div>
    </div>
  </div>
</body>
</html>
