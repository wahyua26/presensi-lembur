
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>AdminLTE 3 | Starter</title>
    @include('template.head')
    <script src="{{ asset('Js/jam.js') }}"></script>
    <style>
        #watch {
            color: rgb(252, 150, 65);
            position: absolute;
            z-index: 1;
            height: 40px;
            width: 700px;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            font-size: 10vw;
            -webkit-text-stroke: 3px rgb(210, 65, 36);
            text-shadow:  4px 4px 10px rgba(210, 65, 36, 0.4),
                4px 4px 20px rgba(210, 45, 26, 0.4),
                4px 4px 30px rgba(210, 25, 16, 0.4),
                4px 4px 40px rgba(210, 15, 06, 0.4);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini" onload="realtimeClock()">
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
            <h1 class="m-0">Halaman untuk Presensi Keluar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Presensi Keluar</li>
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
            <div class="card-header">Presensi Keluar</div>
            <div class="card-body">
                <form action="{{ route('ubah-presensi') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <center>
                            <label id="clock" style="font-size: 50px; color: #0ade5bb8; -webkit-textstroke: 3px #00fe2fc2;
                                    text-shadow: 4px 4px 10px #36fe36,
                                    4px 4px 20px #36fe36,
                                    4px 4px 30px #36fe36,
                                    4px 4px 40px #36fe36;">
                            </label>
                        </center>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="tugas" placeholder="Tugas/Pekerjaan" required/>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user-md"></span>
                        </div>
                      </div>
                    </div>
                    <center>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Klik untuk Presensi Keluar</button>
                        </div>
                    </center>
                </form>
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
