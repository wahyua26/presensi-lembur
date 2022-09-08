
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>List Data Karyawan</title>
    @include('template.head')
    <style>
      th {
        text-align: center;
      }
    </style>
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
          <div class="col-sm">
            <h1 class="m-0">Daftar Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Karyawan</li>
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
            <div class="card-header">
                <a href="{{ route('register') }}" class='btn btn-primary btn-sm'><i class="fas fa-user-plus"></i> Tambah Karyawan </a>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#importExcel">
                  <i class="fas fa-file-excel"></i>
                  Import Excel
                </button>
                <!-- Import Excel -->
                <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('import-excel') }}" enctype="multipart/form-data">
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
                          <a href="{{ url('template-users.xlsx') }}" class="btn btn-info">Download Template</a>
             
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <a href="{{ route('export-excel') }}" class='btn btn-success btn-sm'><i class="fas fa-file-excel"></i> Export Excel </a>
            </div>
            <div class="card-body">
              {{-- <div class="input-group col-4 mb-3">
                <input type="text" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <button class="btn btn-secondary" type="submit">Search</button>
                </div>
              </div> --}}
                <div class="form-group" style="overflow: auto">
                    <table class="table table-striped projects">
                        <tr>
                            <th>@sortablelink('npp', 'NPP')</th>
                            <th>@sortablelink('name', 'Nama')</th>
                            <th>@sortablelink('level', 'Level')</th>
                            <th>@sortablelink('jabatan', 'Jabatan')</th>
                            <th>@sortablelink('email', 'Email')</th>
                            <th>Aksi</th>
                        </tr> 
                        @foreach ($karyawan as $item)
                        <tr>
                            <td>{{ $item->npp }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->level }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="project-actions text-right">
                              <a href="/profile/{{ $item->npp }}" class="btn btn-primary btn-sm" href="#">
                                  <i class="fas fa-user">
                                  </i>
                                  View
                              </a>
                              <a href="/edit-karyawan/{{ $item->npp }}" class="btn btn-info btn-sm" href="#">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                  Edit
                              </a>
                              <a onclick="return confirm('Apakah anda yakin?')" href="/delete-karyawan/{{ $item->npp }}" class="btn btn-danger btn-sm" href="#">
                                  <i class="fas fa-trash">
                                  </i>
                                  Delete
                              </a>
                          </td>
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
