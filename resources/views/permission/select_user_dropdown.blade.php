<label>Select</label>
<select class="form-control" id="user_id" onchange="selectedUserPermissionDetails()">
	<option value="">--Select--</option>
	@if(isset($getRoleName))
		@foreach($getRoleName as $roleName)
		  <option value="{{ $roleName->id }}">{{ $roleName->full_name }}</option>
		@endforeach
	@endif  
</select>