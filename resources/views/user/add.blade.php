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
                        <h1>Add User</h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active">Add User</li>
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
                              <h3 class="card-title">Add User</h3>
                           </div>
                           <!-- /.card-header -->
                           <!-- form start -->
                           <form role="form" id="form_id" method="post" autocomplete="off" action="{{ url('/user-insert') }}">
                              {{ csrf_field() }}
                              <div class="card-body">
                                 <div class="form-group">
                                    <label>Select</label>
                                    <select class="form-control" name="role_id">
                                    @if(isset($getRoles))
                                       @foreach($getRoles as $role)
                                          <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                       @endforeach
                                    @endif
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="search_box">Parent</label>
                                    <input type="text" autocomplete="off" name="parent_email" class="form-control size_control" id="search_box" placeholder="Enter parent email">
                                    <input type="hidden" id="parent_id" name="parent_id" value="">
                                    <div id="auto"></div>
                                 </div>
                                 <div class="form-group">
                                    <label for="full_name">Name</label>
                                    <input type="text" autocomplete="off" name="full_name" class="form-control size_control validate[required]" id="full_name" placeholder="Full Name">
                                 </div>
                                 <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" autocomplete="off" name="username" class="form-control size_control validate[required]" id="username" placeholder="User Name">
                                 </div>
                                 <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" autocomplete="off" name="email" class="form-control size_control validate[required]" id="email" placeholder="Email">
                                 </div>
                                 <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" autocomplete="new-password" name="password" class="form-control size_control validate[required]" id="password" placeholder="Password">
                                 </div>
                                 <div class="form-group">
                                    <label for="mobile">Phone Number</label>
                                    <input type="text" autocomplete="off" name="mobile" class="form-control size_control validate[required]" id="mobile" placeholder="Phone Number">
                                 </div>
                                 <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <textarea name="address" class="form-control size_control validate[required]" id="address" placeholder="Address" rows="8" cols="80"></textarea>
                                 </div> -->
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Submit</button>
                                 <a href="{{ url('/user') }}" class="btn btn-primary">Go Back</a>
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