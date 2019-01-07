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
                  <input type="checkbox" id="can-add" value="{{ isset($permissionDetails[$key]->can_add) ? $permissionDetails[$key]->can_add : 0 }}" onchange="changePermission('can_add',this.value,{{ $module->id }})" @if(isset($permissionDetails[$key]) && ($module->id == $permissionDetails[$key]->module_id) && ($permissionDetails[$key]->can_add == '1')) {{ 'checked' }} @else "" @endif>
                  <span class="slider round"></span>
               </label>
            </td>
            <td>
               <label class="switch">
                  <input type="checkbox" id="can-edit" value="{{ isset($permissionDetails[$key]->can_edit) ? $permissionDetails[$key]->can_edit : 0 }}" onchange="changePermission('can_edit',this.value,{{ $module->id }})" @if(isset($permissionDetails[$key]) && ($module->id == $permissionDetails[$key]->module_id) && ($permissionDetails[$key]->can_edit == '1')) {{ 'checked' }} @else "" @endif>
                  <span class="slider round"></span>
               </label>
            </td>
            <td>
               <label class="switch">
                  <input type="checkbox" id="can-delete" value="{{ isset($permissionDetails[$key]->can_delete) ? $permissionDetails[$key]->can_delete : 0}}" onchange="changePermission('can_delete',this.value,{{ $module->id }})" @if(isset($permissionDetails[$key]) && ($module->id == $permissionDetails[$key]->module_id) && ($permissionDetails[$key]->can_delete == '1')) {{ 'checked' }} @else "" @endif>
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