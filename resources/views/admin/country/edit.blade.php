<!DOCTYPE html>
<?php //a($cuisines->name); ?>
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
            <h1>Edit Country</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit Country</li>
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
                <h3 class="card-title">Edit Country</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/country-update" id="formID" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $countries->id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Country Name*</label>
                    <input type="text" autocomplete="off" value="{{ $countries->name }}" name="name" class="form-control size_control validate[required]" id="name" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Currency Name*</label>
                    <input type="text" autocomplete="off" value="{{ $countries->currency_name }}" name="currency_name" class="form-control size_control validate[required]" id="currency_name" placeholder="Currency Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Currency Code*</label>
                    <input type="text" autocomplete="off" value="{{ $countries->currency_code }}" name="currency_code" class="form-control size_control validate[required]" id="currency_code" placeholder="Currency Code">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Currency Symbol*</label>
                    <input type="text" autocomplete="off" value="{{ $countries->currency_symbol }}" name="currency_symbol" class="form-control size_control validate[required]" id="currency_symbol" placeholder="Currency Symbol">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone Code*</label>
                    <input type="text" autocomplete="off" value="{{ $countries->country_code }}" name="country_code" class="form-control size_control validate[required]" id="country_code" placeholder="Phone Code">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">ISO Code*</label>
                    <input type="text" autocomplete="off" value="{{ $countries->iso }}" name="iso" class="form-control size_control validate[required]" id="iso" placeholder="ISO code">
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
