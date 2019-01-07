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
                        <h1>Add Email Template</h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active">Add Email Template</li>
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
                              <h3 class="card-title">Add Email Template</h3>
                           </div>
                           <!-- /.card-header -->
                           <!-- form start -->
                           <form role="form" id="formID" method="post" action="{{ url('/email-template-insert') }}">
                              {{ csrf_field() }}
                              <div class="card-body">
                                 <div class="form-group">
                                    <label for="template_name">Template Name</label>
                                    <input type="text" autocomplete="off" name="template_name" class="form-control size_control validate[required]" id="template_name" placeholder="Template Name">
                                 </div>
                                 <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" autocomplete="off" name="subject" class="form-control size_control validate[required]" id="subject" placeholder="Subject">
                                 </div>
                                 <div class="box box-info">
                                    <div class="box-header">
                                      <label class="box-title">Content
                                      </label>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body pad">
                                       <textarea id="content" name="content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                       </textarea>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control validate[required]" name="status">
                                      <option value="active">Active</option>
                                      <option value="inactive">Inactive</option>
                                    </select>
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