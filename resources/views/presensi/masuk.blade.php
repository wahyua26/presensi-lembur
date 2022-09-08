
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>Presensi Lembur JMTM</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @include('template.head')
    <script src="{{ asset('Js/jam.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
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
            <h1 class="m-0">Halaman untuk Presensi Lembur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Presensi</li>
            </ol> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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

    @if(Session::has('fail'))
    <script type="text/javascript">
        swal({
            title:'Oops!',
            text:"{{Session::get('fail')}}",
            type:'error',
            timer:5000,
            icon: 'error'
        }).then((value) => {
          //location.reload();
        }).catch(swal.noop);
    </script>
    @endif

    <!-- Main content -->
    <div class="content">
      <div class="row justify-content-center">
        <div class="card card-info card-outline">
            <div class="card-header">Presensi Masuk</div>
            <div class="card-body">
                <form action="{{ route('simpan-masuk') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <center>
                            <label id="clock" style="font-size: 50px; color: #0A77DE; -webkit-textstroke: 3px #00ACFE;
                                    text-shadow: 4px 4px 10px #36D6FE,
                                    4px 4px 20px #36D6FE,
                                    4px 4px 30px #36D6FE,
                                    4px 4px 40px #36D6FE;">
                            </label>
                          <input type="hidden" id="latitude" name="latitude" class="latitude">
                          <input type="hidden" id="longitude" name="longitude" class="longitude">
                        </center>
                    </div>
                    <center>
                      <div id="my_camera"></div>
                          <input type="hidden" name="image" class="image-tag">
                          {{-- <button class="btn btn-success" value="Take Snapshot" onClick="take_snapshot()">Submit</button> --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" value="Take Snapshot" onClick="take_snapshot()">Klik untuk Presensi Masuk</button>
                            </div>
                    </center>
                </form>
            </div>
            <div class="card-header">Presensi Keluar</div>
            <div class="card-body">
                <form action="{{ route('ubah-presensi') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="tugas" placeholder="Tugas/Pekerjaan" required/>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user-md"></span>
                        </div>
                      </div>
                    </div>
                    <center>
                        <input type="hidden" id="latitude" name="latitude" class="latitude">
                        <input type="hidden" id="longitude" name="longitude" class="longitude">
                        <input type="hidden" name="image" class="image-tag">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary value="Take Snapshot" onClick="take_snapshot()">Klik untuk Presensi Keluar</button>
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

<script language="JavaScript">
  Webcam.set({
      width: 350,
      height: 350,
      image_format: 'jpeg',
      jpeg_quality: 90
  });
  
  Webcam.attach( '#my_camera' );
  
  function take_snapshot() {
      Webcam.snap( function(data_uri) {
          $(".image-tag").val(data_uri);
          document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
      } );
  }
</script>

<script type="text/javascript">
	$(document).ready(function() {
		navigator.geolocation.getCurrentPosition(function (position) {
   			 tampilLokasi(position);
		}, function (e) {
		    alert('Geolocation Tidak Mendukung Pada Browser Anda');
		}, {
		    enableHighAccuracy: true
		});
	});
	function tampilLokasi(posisi) {
		console.log(posisi);
		var latitude 	= posisi.coords.latitude;
		var longitude 	= posisi.coords.longitude;
        console.log(latitude);
        console.log(longitude);
        document.getElementById("latitude").innerHTML = latitude;
        document.getElementById("longitude").innerHTML = longitude;
        $(".latitude").val(latitude);
        $(".longitude").val(longitude);
	}
</script>

</html>
