<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="javascript:;" class="brand-link">
   <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="Admin Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
   <span class="brand-text font-weight-light">{{ Session::get('user_details')['role_name'] }}</span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="javascript:;" class="d-block">{{ Session::get('user_details')['full_name'] }}</a>
         </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
               <a href="{{ route('admin-dashboard') }}" class="nav-link @if(getCurrentUrl(3) =='admin-dashboard') active @endif">
                  <i class="nav-icon fa fa-dashboard"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="{{ route('admin-change-password')}}" class="nav-link @if(getCurrentUrl(3) =='admin-change-password') active @endif">
                <i class="nav-icon fa fa-key"></i>
                <p>
                  Change Password
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
               <a href="javascript:void(0)" class="nav-link @if((getCurrentUrl(3) =='roles-list') || (getCurrentUrl(3) =='permission') || (getCurrentUrl(3) =='email-template-list') || (getCurrentUrl(3) =='email-template-add') || (getCurrentUrl(3) =='email-template-edit')) active @endif">
                  <i class="nav-icon fa fa-gear"></i>
                  <p>
                     Settings
                     <i class="fa fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('roles-list') }}" class="nav-link @if(getCurrentUrl(3) =='roles-list') active @endif">
                      <i class="fa fa-users nav-icon"></i>
                      <p>Roles</p>
                    </a>
                  </li>
               </ul>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('permission') }}" class="nav-link @if(getCurrentUrl(3) =='permission') active @endif">
                      <i class="fa fa-lock nav-icon"></i>
                      <p>Module Permission</p>
                    </a>
                  </li>
               </ul>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('email-template-list') }}" class="nav-link @if((getCurrentUrl(3) =='email-template-list') || (getCurrentUrl(3) =='email-template-add') || (getCurrentUrl(3) =='email-template-edit')) active @endif">
                      <i class="fa fa-envelope nav-icon"></i>
                      <p>Email Template</p>
                    </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="{{ url('module-list') }}" class="nav-link @if(getCurrentUrl(3) =='module-list' || getCurrentUrl(3) =='module-add') active @endif">
                <i class="nav-icon fa fa-bar-chart"></i>
                <p>
                   Module Management
                </p>
              </a>
            </li>
            @php 
              $getModuleList = getModuleList();
              if(isset($getModuleList)) {
                foreach($getModuleList as $module) {
                @endphp
                <li class="nav-item has-treeview">
                  <a href="{{ url($module->module_slug) }}" class="nav-link {{ (getCurrentUrl(3) ==  $module->module_slug) || (getCurrentUrl(3) ==  $module->module_slug.'-add') || (getCurrentUrl(3) ==  $module->module_slug.'-edit') ? 'active' : '' }}">
                    <i class="nav-icon fa {{ $module->module_icon }}"></i>
                    <p>
                      {{ $module->module_name }}
                       <!--i class="fa fa-angle-left right"></i-->
                    </p>
                  </a>
                </li>
                @php
                }
              }
            @endphp
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>