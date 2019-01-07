<!DOCTYPE html>
<html>
   @include('/admin/layout/head')
   <style>
      .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
      }

      .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
      }

      .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
      }

      .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
      }

      input:checked + .slider {
      background-color: #2196F3;
      }

      input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
      }

      /* Rounded sliders */
      .slider.round {
      border-radius: 34px;
      }

      .slider.round:before {
      border-radius: 50%;
      }
   </style>
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
                        <h1>Role Permission</h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active">Role Permission</li>
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
                              <h3 class="card-title">Role Permission</h3>
                           </div>
                           <!-- /.card-header -->
                           <!-- This section is for tab (starts) -->
                           <div class="col-md-12" style="margin-top:20px;">
                              <div class="card">
                                 <div class="p-2">
                                    <ul class="nav nav-pills">
                                       @if(isset($getRoles))
                                       @php $i=1 @endphp
                                          @foreach($getRoles as $role)
                                          <li class="nav-item"><a class="nav-link {{ ($i==1) ? 'active' : ''}} " href="#{{ $role->id }}" onclick="changeUser({{ $role->id }})" data-toggle="tab">{{ $role->role_name }}</a></li>
                                          <input type="hidden" value="{{ $role->id }}" id="role_id">
                                          @php $i++ @endphp
                                          @endforeach
                                       @endif
                                    </ul>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">
                                    <div class="tab-content">
                                       <div class="form-group" id="selectUser">
                                          <label>Select</label>
                                          <select class="form-control" id="user_id">
                                             @if(isset($getRoleName))
                                                @foreach($getRoleName as $roleName)
                                                  <option value="{{ $roleName->id }}">{{ $roleName->full_name }}</option>
                                                @endforeach
                                             @endif  
                                          </select>
                                       </div>
                                       <div id="permissionTable">
                                          <div class="tab-pane" id="">
                                            <table id="example1" class="table table-bordered table-striped">
                                             <thead>
                                                <tr>
                                                   <th>Modules</th>
                                                   <th>Add</th>
                                                   <th>Edit</th>
                                                   <th>Delete</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             @if(isset($getModules))
                                                @foreach($getModules as $key=>$module)
                                                   <tr>
                                                      <td>{{ $module->module_name }}</td>
                                                      <td>
                                                         <label class="switch">
                                                            <input type="checkbox" id="can-add" value="{{ $permissionDetails[$key]->can_add }}" onchange="changePermission('can_add',this.value,{{ $module->id }})" @if(isset($permissionDetails[$key]) && ($module->id == $permissionDetails[$key]->module_id) && ($permissionDetails[$key]->can_add == '1')) {{ 'checked' }} @else "" @endif>
                                                            <span class="slider round"></span>
                                                         </label>
                                                      </td>
                                                      <td>
                                                         <label class="switch">
                                                            <input type="checkbox" id="can-edit" value="{{ $permissionDetails[$key]->can_edit }}" onchange="changePermission('can_edit',this.value,{{ $module->id }})" @if(isset($permissionDetails[$key]) && ($module->id == $permissionDetails[$key]->module_id) && ($permissionDetails[$key]->can_edit == '1')) {{ 'checked' }} @else "" @endif>
                                                            <span class="slider round"></span>
                                                         </label>
                                                      </td>
                                                      <td>
                                                         <label class="switch">
                                                            <input type="checkbox" id="can-delete" value="{{ $permissionDetails[$key]->can_delete }}" onchange="changePermission('can_delete',this.value,{{ $module->id }})" @if(isset($permissionDetails[$key]) && ($module->id == $permissionDetails[$key]->module_id) && ($permissionDetails[$key]->can_delete == '1')) {{ 'checked' }} @else "" @endif>
                                                            <span class="slider round"></span>
                                                         </label>
                                                      </td>
                                                   </tr>
                                                @endforeach
                                             @endif
                                             </tbody>
                                             <tfoot>
                                                <tr>
                                                   <th>Modules</th>
                                                   <th>Add</th>
                                                   <th>Edit</th>
                                                   <th>Delete</th>
                                                </tr>
                                             </tfoot>
                                            </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.card-body -->
                              </div>
                              <!-- /.nav-tabs-custom -->
                           </div>
                           <!-- This section is for tab (ends) -->
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