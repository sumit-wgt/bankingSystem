<script src="{{ URL::asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ URL::asset('admin/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ URL::asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('admin/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<!-- DataTables -->
<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ URL::asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('admin/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('admin/dist/js/pages/dashboard.js') }}"></script>
<!-- This js include for chart(or graph) -->
<script src="{{ URL::asset('admin/dist/js/pages/dashboard3.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/chart.js/Chart.min.js') }}"></script>

<!-- Jquery validations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.min.js" ></script>
<!-- Bootstrap WYSIHTML5 -->

<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('admin/dist/js/demo.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->

<script>
  $(function () {
    // bootstrap WYSIHTML5 - text editor
    $('#content').wysihtml5({
      toolbar: { fa: true }
    })
  })
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script>
$(document).ready(function(){
    $("#formID").validationEngine('attach', {promptPosition : "centerRight", scroll: false});
    $("#formID1").validationEngine('attach', {promptPosition : "centerRight", scroll: false});
    $("#formID2").validationEngine('attach', {promptPosition : "centerRight", scroll: false});
   });
</script>

<!-- toastr-->
<script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>

<script>
  @if(Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
  @endif
  @if(Session::has('info'))
      toastr.info("{{ Session::get('info') }}");
  @endif
  @if(Session::has('warning'))
      toastr.warning("{{ Session::get('warning') }}");
  @endif
  @if(Session::has('error'))
      toastr.error("{{ Session::get('error') }}");
  @endif
</script>

<!-- this is for confirm deleting  -->
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure want to delete this data?');
}
</script>
<script type="text/javascript">
  $("#search_box").keyup(function(){
      var keyword = $(this).val();
      if(keyword.length == 0) {
        $('#auto').html('');
      }
      if(keyword.length > 3) {
      $.ajax({
            type: "POST",
            url: "{{ url('user-suggestion') }}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'keyword':keyword},
            success: function(result)
            {
              if (result != '0') {
                $('#auto').fadeIn();
                $('#auto').html(result);
              }
            }
          });
      }
  });

  $(document).on('click', '.userEmail', function(){
    var email = $('a', this).text();
    $('#search_box').val(email);
    $('#auto').fadeOut();
    // call ajax to fetch id of the following Email
    $.ajax({
          type: "POST",
          url: "{{ url('user-suggestion-id') }}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {'email':email},
          success: function(result)
          {
            //console.log(result);
            if(result != '0') {
              $("#parent_id").val(result);
            }                
          }
        });
  });
//============================================================================//
function changePermission(method,value,moduleId) {
    var user_id = $('select#user_id').val();
    var role_id = $("#role_id").val();
    // state = document.getElementById(obj.id).checked;
    // alert(state);
    if(value == 1){
        value = 0;
    }
    else{
        value = 1;
    }
    $.ajax({
       type: "POST",
       url: "{{route('change-permission-status')}}",
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
        data: {'method' : method, 'value' : value, 'role_id' : role_id, 'module_id' : moduleId, 'user_id' : user_id},
       success: function(result)
       {
          //console.log(result);
          toastr.success('Permission has been changed');
          $("#permissionTable").html('');
          $("#permissionTable").html(result);
           
       }
    });
}

function changeUser(role_id) {
  $.ajax({
     type: "POST",
     url: "{{route('change-user')}}",
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
      data: {'role_id' : role_id},
     success: function(result)
     {
         //console.log(result);
         $("#selectUser").html('');
         $("#selectUser").html(result);
         //make table blank
         $("#permissionTable").html('');
         $("#role_id").val(role_id);
     }
  });
}

function selectedUserPermissionDetails() {
  var user_id = $('select#user_id').val();
  var role_id = $("#role_id").val();
  $.ajax({
     type: "POST",
     url: "{{route('selected-user-permission-details')}}",
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
      data: {'user_id' : user_id,'role_id' : role_id},
     success: function(result)
     {
         console.log(result);
         $("#permissionTable").html(result);
     }
  });
}
</script>