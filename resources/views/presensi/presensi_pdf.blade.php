<!DOCTYPE html>
<html>
<head>
	<title>Laporan Presensi Lembur</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style type="text/css">
  table tr td,
  table tr th{
    font-size: 9pt;
  }
</style>
<body>
	<center>
		<h5>Laporan Presensi Lembur Karyawan</h5>
    <br>
	</center>
 
	<table class="table table-striped projects">
        <tr>
          <th>NPP</th>
          <th>Pegawai</th>
          <th>Untuk Melaksanakan Tugas/Pekerjaan</th>
          <th>Tanggal</th>
          <th>Waktu Masuk</th>
          <th colspan="2">Lokasi Masuk</th>
          {{-- <th>Foto Masuk</th> --}}
          <th>Waktu Keluar</th>
          <th colspan="2">Lokasi Keluar</th>
          {{-- <th>Foto Keluar</th> --}}
          <th>Jumlah Jam Lembur</th>
        </tr>
        @foreach ($presensi as $item)
        <tr>
            <td>{{ $item->npp }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->tugas }}</td>
            <td>{{ $item->tgl }}</td>
            <td>{{ $item->jamMasuk }}</td>
            <td>Lat: {{ $item->latMasuk }}</td>
            <td>Long: {{ $item->longMasuk }}</td>
            {{-- <td><img style="height:50%; width:50%" src="{{ asset( 'storage/' . $item->fotoMasuk) }}" /></td> --}}
            <td>{{ $item->jamKeluar }}</td>
            <td>Lat: {{ $item->latKeluar }}</td>
            <td>Long: {{ $item->longKeluar }}</td>
            {{-- <td ><img style="height:50%; width:50%" src="{{ asset( 'storage/' . $item->fotoKeluar) }}" /></td> --}}
            <td>{{ $item->lamaLembur }}</td>
        </tr>  
        @endforeach
    </table>
 
</body>
</html>