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
            <h1>Add State</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add State</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add State</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="formID" action="/state-update" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="id" value="{{ $state->id }}">

                    <label for="exampleInputEmail1">Country Name*</label>
                    <select class="form-control size_control validate[required]" class="" name="country_id">
                        <option value="">-- Select Country --</option>

                        @foreach($countries as $country)
                        <option @if($state->country_id == $country->id) selected="selected" @endif value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">State Name*</label>
                    <input type="text" value="{{ $state->name }}" autocomplete="off" name="name" class="form-control size_control validate[required]" id="name" placeholder="Name">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>

                  <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
