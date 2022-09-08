
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>Rekap Presensi Karyawan</title>
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
            @if(Session::has('error'))
              <script type="text/javascript">
                  swal({
                      title:'Error!',
                      text:"{{Session::get('error')}}",
                      timer:5000,
                      type:'error',
                      icon: 'error'
                  }).then((value) => {
                    //location.reload();
                  }).catch(swal.noop);
              </script>
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
            <h1 class="m-0">Rekap Presensi Lembur Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap Presensi</li>
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
                    <input type="date" name="tglAwal" id="tglAwal" class="form-control" value = "{{ $tanggal }}"/>
                </div>
                <div class="form-grup">
                    <label form="label">Tanggal Akhir</label>
                    <input type="date" name="tglAkhir" id="tglAkhir" class="form-control" value = "{{ $tanggal }}"/>
                </div>
                <div class="form-grup">
                    <a href="" onclick="this.href='/filter-data/'+document.getElementById('tglAwal').value +
                    '/' + document.getElementById('tglAkhir').value + '/' + {{ auth()->user()->npp }}" class="btn btn-primary col-md-12">
                        Lihat <i class="fas fa-print"></i>
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
                            <th>Lokasi Masuk</th>
                            <th>Foto Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Lokasi Keluar</th>
                            <th>Foto Keluar</th>
                            <th>Jumlah Jam Lembur</th>
                        </tr>
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
