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
            <h1>Category</h1>
          </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>

      </div><!-- /.container-fluid -->
      <div class="row">
        <div class="col-12">
          <a class="btn btn-primary float-sm-right" href="{{ route('category-add') }}">
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
                  <th>Cuisine Name</th>
                  <th>Added Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($categories as $caregory)
                <tr>
                <td>{{$caregory->name}}</td>
                <td>{{ date('Y-m-d'),strtotime($caregory->created_at)}}</td>
                <td>
                  <a href="{{ url('/category-status', ['id' => $caregory->id]) }}">
                  @if($caregory->status == 1)
                  <i class="fa fa-check" title="Change Status"></i>
                  @else
                  <i class="fa fa-times" title="Change Status"></i>
                  @endif
                </a>
                </td>
                <td>
                  <a href="{{ url('/category-edit', ['id' => $caregory->id]) }}">
                    <i class="fa fa-edit" title="Edit"></i>
                  </a>
                  &nbsp;
                  <a onclick="return checkDelete()" href="{{ url('/category-delete', ['id' => $caregory->id]) }}">
                    <i class="fa fa-trash" title="Delete"></i>
                  </a>
                </td>

                </tr>
                @endforeach


                </tbody>
                <tfoot>
                  <tr>
                    <th>Cuisine Name</th>
                    <th>Added Date</th>
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
