
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>Rekap Presensi Keseluruhan</title>
    @include('template.head')
</head>
<body class="hold-transition sidebar-mini">
  @if(Session::has('success'))
              <script type="text/javascript">
                  swal({
                      title:'Success!',
                      text:"{{Session::get('success')}}",
                      timer:5000,
                      type:'success',
                      icon: 'success'
                  }).then((value) => {
                    //location.reload();
                  }).catch(swal.noop);
              </script>
            @endif
  @if(isset($errors) && $errors->any())
              @foreach($errors->all() as $error)
                <script type="text/javascript">
                  swal({
                      title:'Error!',
                      text:"{{ $error }}",
                      timer:5000,
                      type:'error',
                      icon: 'error'
                  }).then((value) => {
                    //location.reload();
                  }).catch(swal.noop);
                </script>
              @endforeach
            @endif
<div class="wrapper">

  <!-- Navbar -->
  @include('template.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('template.side')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rekap Presensi Lembur Keseluruhan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap Presensi Keseluruhan</li>
            </ol> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="row justify-content-center">
        <div class="card card-info card-outline">
            <div class="card-header">Lihat Data</div>
            <div class="card-body">
                <div class="form-grup">
                    <label form="label">Tanggal Awal</label>
                    <input type="date" name="tglAwal" id="tglAwal" class="form-control" value = "{{ $tglAwal }}"/>
                </div>
                <div class="form-grup">
                    <label form="label">Tanggal Akhir</label>
                    <input type="date" name="tglAkhir" id="tglAkhir" class="form-control" value = "{{ $tglAkhir }}"/>
                </div>
                <div class="form-grup">
                    <a href="" onclick="this.href='/filter-keseluruhan/'+document.getElementById('tglAwal').value +
                    '/' + document.getElementById('tglAkhir').value" class="btn btn-primary col-md-12">
                        Lihat <i class="fas fa-print"></i>
                    </a>
                    <button type="button" class="btn btn-secondary my-2" data-toggle="modal" data-target="#importExcelKaryawan">
                      <i class="fas fa-file-excel"></i>
                      Import Excel
                    </button>
                    <!-- Import Excel -->
                    <div class="modal fade" id="importExcelKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <form method="post" action="{{ route('importExcelKaryawan') }}" enctype="multipart/form-data">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">
                
                              {{ csrf_field() }}
                
                              <label>Pilih file excel</label>
                              <div class="form-group">
                                <input type="file" name="file" required="required">
                              </div>
                              <a href="{{ url('template-presensi.xlsx') }}" class="btn btn-info">Download Template</a>
                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <a href="" onclick="this.href='/filter-keseluruhan/'+document.getElementById('tglAwal').value +
                    '/' + document.getElementById('tglAkhir').value + '/cetakExcelKeseluruhan'" class="btn btn-success my-2">
                      Cetak Excel <i class="fas fa-file-excel"></i>
                    </a>
                    <a href="" onclick="this.href='/filter-keseluruhan/'+document.getElementById('tglAwal').value +
                    '/' + document.getElementById('tglAkhir').value + '/cetakPdfKeseluruhan'" class="btn btn-info my-2">
                      Cetak PDF <i class="fas fa-file-pdf"></i>
                    </a>
                </div>

                <div class="form-group" style="overflow: auto">
                    <table class="table table-striped projects">
                        <tr>
                          <th>NPP</th>
                          <th>Pegawai</th>
                          <th>Untuk Melaksanakan Tugas/Pekerjaan</th>
                          <th>Tanggal</th>
                          <th>Waktu Masuk</th>
                          <th colspan="2">Lokasi Masuk</th>
                          <th>Foto Masuk</th>
                          <th>Waktu Keluar</th>
                          <th colspan="2">Lokasi Keluar</th>
                          <th>Foto Keluar</th>
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
                            <td><img style="height:50%; width:50%" src="{{ asset( 'storage/' . $item->fotoMasuk) }}" /></td>
                            <td>{{ $item->jamKeluar }}</td>
                            <td>Lat: {{ $item->latKeluar }}</td>
                            <td>Long: {{ $item->longKeluar }}</td>
                            <td ><img style="height:50%; width:50%" src="{{ asset( 'storage/' . $item->fotoKeluar) }}" /></td>
                            <td>{{ $item->lamaLembur }}</td>
                        </tr>  
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
    @include('template.footer')  
<!-- ./wrapper -->

</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
@include('template.script')
</body>
</html>
