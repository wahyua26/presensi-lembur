
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Karyawan Baru</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <link href='{{ asset('AdminLTE/dist/img/badgejpg.jpg') }}' rel='shortcut icon'>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><img src="{{ asset('AdminLTE/dist/img/logo.png') }}" alt="JMTM Logo" class="brand-image" style="height:100px"></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      {{-- menampilkan error validasi --}}
      @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <p class="login-box-msg">Pendaftaran Karyawan Baru</p>

      <form action="{{ route('simpanRegister') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="npp" placeholder="NPP" value="{{ old('npp') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fab fa-500px"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <select id="level" name="level" class="form-control select" style="width: 100%;">
            <option value="admin">Admin</option>
            <option value="karyawan">Karyawan</option>
          </select>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="{{ old('jabatan') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <b>File Foto Profil</b><br/>
          <input type="file" name="foto">
        </div>  
        <div class="row">
          <div class="col"></div>
          <div class="col"></div>
          <div class="col">
            <a href="/list-karyawan" id="cancel" name="cancel" class="btn btn-default">Cancel</a>
          </div>
          <!-- /.col -->
          <div class="col">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      {{-- <a href="{{ route('login') }}" class="text-center">I already have a membership</a> --}}
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
@include('template.script')
</body>
</html>
