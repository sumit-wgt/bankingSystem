<!DOCTYPE html>
<html>
@include('/admin/layout/head')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin/layout/header')
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 @include('/admin/layout/side_navigation_bar')
 <!-- Main Sidebar Container Ends-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles</h1>
          </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div>
        </div>

      </div><!-- /.container-fluid -->
      <div class="row">
        <div class="col-12">
          <a class="btn btn-primary float-sm-right" href="{{ url('roles-add') }}">
              <i class="fa fa-plus"></i>&nbsp;Add &emsp;
          </a>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">


            <!-- <div class="card-header">
              <h3 class="card-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Roll Name</th>
                  <th>Is Admin</th>
                  <th>Site Admin</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($getRoles))
                  @foreach ($getRoles as $userRole)
                  <tr>
                    <td>{{$userRole->role_name}}</td>
                    <td>{{$userRole->is_admin}}</td>
                    <td>{{$userRole->site_admin}}</td>
                    <td>
                      <a href="{{ url('/roles-status', ['id' => $userRole->id]) }}">
                        @if($userRole->status == 'active')
                        <i class="fa fa-check" title="Change Status"></i>
                        @else
                        <i class="fa fa-times" title="Change Status"></i>
                        @endif
                      </a>
                    </td>
                    <td>
                      <a href="{{ url('/roles-edit', ['id' => $userRole->id]) }}">
                        <i class="fa fa-edit" title="Edit"></i>
                      </a>
                      &nbsp;
                      <a onclick="return checkDelete()" href="{{ url('/roles-delete', ['id' => $userRole->id]) }}">
                        <i class="fa fa-trash" title="Delete"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                @endif
                </tbody>
                <tfoot>
                  <tr>
                    <th>Roll Name</th>
                    <th>Is Admin</th>
                    <th>Site Admin</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin/layout/footer')
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('admin/layout/jquery_includes')
</body>
</html>
