
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>User Profile</title>
    @include('template.head')
</head>
<body class="hold-transition sidebar-mini">
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
            <h1 class="m-0">User Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
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
      <div class="row justify-content-center">
        <div class="card card-info card-outline">
            <div class="card-header"></div>
            <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-5">
                      <!-- Profile Image -->
                      <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <a href="#" data-toggle="modal" data-target="#importFoto">
                              <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/images/' . $user->foto) }}" alt="User profile picture">
                            </a>
                          </div>
                          <!-- Import Excel -->
                          <div class="modal fade" id="importFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post" action="{{ route('edit-foto-profile') }}" enctype="multipart/form-data">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Foto Profil</h5>
                                  </div>
                                  <div class="modal-body">
                       
                                    {{ csrf_field() }}
                       
                                    <label>Pilih Foto Profil</label>
                                    <div class="form-group">
                                      <input type="file" name="foto" required="required" accept="image/png, image/jpeg, image/jpg">
                                      <input type="hidden" name="npp" value="{{ $user->npp }}">
                                    </div>
                       
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
          
                          <h3 class="profile-username text-center">{{ $user->name }}</h3>
          
                          <p class="text-muted text-center">{{ $user->jabatan }}</p>
          
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>NPP</b> <a class="float-right">{{ $user->npp }}</a>
                            </li>
                            <li class="list-group-item">
                              <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                            </li>
                            <li class="list-group-item">
                              <b>Level</b> <a class="float-right">{{ $user->level }}</a>
                            </li>
                          </ul>
          
                          <a href="/edit-profile/{{ $user->npp }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-7">
                      <div class="card">
                        <div class="card-body">
                          <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="timeline">
                              <!-- The timeline -->
                              <div class="timeline timeline-inverse">
                                @if($presensi->count() == 0)
                                <div class="time-label">
                                  <span class="bg-success">
                                    {{ $tanggal }}
                                  </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                  <i class="fas fa-user bg-blue"></i>
          
                                  <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">{{ $user->name }}</a> belum melakukan presensi masuk</h3>
          
                                    <div class="timeline-body">
                                      {{-- <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="..."> --}}
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <i class="fas fa-user bg-red"></i>
          
                                  <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">{{ $user->name }}</a> belum melakukan presensi keluar</h3>
                                    
                                    <div class="timeline-body">
                                      {{-- <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="..."> --}}
                                    </div>
                                  </div>
                                </div>
                                @endif
                                @foreach ($presensi as $item)
                                <!-- timeline time label -->
                                <div class="time-label">
                                  <span class="bg-success">
                                    {{ $item->tgl }}
                                  </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                  <i class="fas fa-user bg-blue"></i>
          
                                  <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> {{ $item->jamMasuk }} </span>
                                    <h3 class="timeline-header"><a href="#">{{ $user->name }}</a> melakukan presensi masuk</h3>
          
                                    <div class="timeline-body">
                                      {{-- <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="..."> --}}
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <i class="fas fa-user bg-red"></i>
          
                                  <div class="timeline-item">
                                    @if ($item->jamKeluar)
                                      <span class="time"><i class="far fa-clock"></i> {{ $item->jamKeluar }} </span>
                                      <h3 class="timeline-header"><a href="#">{{ $user->name }}</a> melakukan presensi keluar</h3>
                                    @else
                                      <h3 class="timeline-header"><a href="#">{{ $user->name }}</a> belum melakukan presensi keluar</h3>
                                    @endif
                                    
                                    <div class="timeline-body">
                                      {{-- <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="...">
                                      <img src="https://placehold.it/150x100" alt="..."> --}}
                                    </div>
                                  </div>
                                </div>
                                @endforeach
                                <!-- END timeline item -->
                                <div>
                                  <i class="far fa-clock bg-gray"></i>
                                </div>
                              </div>
                              
                            </div>
                            <!-- /.tab-pane -->
                          </div>
                          <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div><!-- /.container-fluid -->
              </section>
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
