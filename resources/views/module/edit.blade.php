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
                        <h1>Edit Module</h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active">Edit Module</li>
                        </ol>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
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
                              <h3 class="card-title">Edit Module</h3>
                           </div>
                           <!-- /.card-header -->
                           <!-- form start -->
                           <form role="form" id="formID" method="post" action="{{ url('/module-update') }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="moduleId" value="{{ $getData->id }}">
                              <div class="card-body">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Module Name</label>
                                    <input type="text" autocomplete="off" name="module_name" class="form-control size_control validate[required]" id="module_name" placeholder="Module Name"
                                    value="{{ (isset($getData)) ? $getData->module_name : "" }}">
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Module Slug</label>
                                    <input type="text" autocomplete="off" name="module_slug" class="form-control size_control validate[required]" id="module_slug" placeholder="Module Slug"
                                    value="{{ (isset($getData)) ? $getData->module_slug : "" }}" disabled>
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Module Icon</label>
                                    <input type="text" autocomplete="off" name="module_icon" class="form-control size_control validate[required]" id="module_icon" placeholder="Module Icon"
                                    value="{{ (isset($getData)) ? $getData->module_icon : "" }}" disabled>
                                 </div>
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control validate[required]" name="status">
                                      <option value="active" @if($getData->status == "active") selected @endif>Active</option>
                                      <option value="inactive" @if($getData->status == "inactive") selected @endif>Inactive</option>
                                    </select>
                                 </div>
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Submit</button>
                                 <a href="{{ url('/module-list') }}" class="btn btn-primary">Go Back</a>
                              </div>
                           </form>
                        </div>
                        <!-- /.card -->
                     </div>
                     <!--/.col (left) -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
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