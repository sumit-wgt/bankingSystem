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
                        <h1>Apply For Loan</h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active">Loan</li>
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
                              <h3 class="card-title">Loan</h3>
                           </div>
                           <!-- /.card-header -->
                           <!-- form start -->
                           <form role="form" id="form_id" method="post" autocomplete="off" action="{{ url('/') }}">
                              {{ csrf_field() }}
                              <div class="card-body">
                                 <div class="form-group">
                                    <label for="loan_amount">Loan Amount</label>
                                    <input type="text" autocomplete="off" name="loan_amount" class="form-control size_control validate[required]" id="loan_amount" placeholder="Enter Loan Amount">
                                 </div>
                                 <div class="form-group">
                                    <label for="tenure">Tenure</label>
                                    <input type="text" autocomplete="off" name="tenure" class="form-control size_control validate[required]" id="tenure" placeholder="Enter Tenure">
                                 </div>
                                 <div class="form-group">
                                    <label>Interest Tenure</label>
                                    <select class="form-control" name="">
                                       <option value="">Select</option>
                                       <option value="pa">Per annum</option>
                                       <option value="pm">Per month</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label>Interest</label>
                                    <select class="form-control" name="">
                                       <option value=""></option>
                                    </select>
                                 </div>
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