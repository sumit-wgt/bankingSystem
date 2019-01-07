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
            <h1>Add Area/Zipcode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Area/Zipcode</li>
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
                <h3 class="card-title">Add Area/Zipcode</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="formID" action="/area-add" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Country Name*</label>
                    <select class="form-control size_control validate[required]" class="country_id" id="country_id" name="country_id">
                      <option value="">-- Select Country --</option>

                      @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">State Name*</label>
                    <select class="form-control size_control validate[required]" class="state_id" id="state_id" name="state_id">
                      <option value="">-- State Country --</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">City Name*</label>
                    <select class="form-control size_control validate[required]" class="city_id" id="city_id" name="city_id">
                      <option value="">-- State City --</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Area Name*</label>
                    <input type="text" autocomplete="off" name="name" class="form-control size_control validate[required]" id="name" placeholder="Name">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Area Name*</label>
                    <input type="text" autocomplete="off" name="post_code" class="form-control size_control validate[required]" id="post_code" placeholder="Post Code">
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

<script type="text/javascript">

$(document).ready(function(){
    $("#country_id").change(function(){
        var country_id = $(this).val();
        $.ajax({
        url: "/city/state-listing/"+country_id,
        type: "GET",
        success: function (response) {
          $('select[name="state_id"]').empty();
          $('select[name="state_id"]').append('<option value="">-- State Country --</option>');

          $.each(response, function(key, value) {
          $('select[name="state_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
          });
        },
    });
    });

    //this is for city dropdown

    $("#state_id").change(function(){
        var state_id = $(this).val();
        $.ajax({
        url: "/area/city-listing/"+state_id,
        type: "GET",
        success: function (response) {
          $('select[name="city_id"]').empty();
          $('select[name="city_id"]').append('<option value="">-- State Country --</option>');
          $.each(response, function(keys, values) {
          $('select[name="city_id"]').append('<option value="'+ values.id +'">'+ values.name +'</option>');
          });
        },
    });
    });

});

</script>



</body>
</html>
