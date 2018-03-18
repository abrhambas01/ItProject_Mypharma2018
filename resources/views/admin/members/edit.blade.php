@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<div class="content">
	<h2 class="content-heading">EDIT USER  {{ $member->name }} with a role of  {{ $member->role->name }}</h2>
	<div class="block">
		<div class="block-header block-header-default">
			<h3 class="block-title">UPDATE THE FIELDS BELOW</h3>
			<div class="block-options">
				<button type="button" class="btn-block-option">
					<i class="si si-wrench"></i>
				</button>
			</div>
		</div>
		<div class="block-content">
			<div class="row justify-content-center py-20">
				<div class="col-xl-6">
					<!-- jQuery Validation (.js-validation-material class is initialized in js/pages/be_forms_validation.js) -->
					<!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
					<form class="js-validation-material" action="be_forms_validation.html" method="post">

						{!! Form::model($member , ['method' => 'PATCH', 'action' => ['MembersController@update' , $member->id]]) !!}

						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-username2" value="{{ $member->name }} " name="val-username2" placeholder="Enter a username..">
								<label for="val-username2">Username</label>
							</div>
						</div>
						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" value="{{ $member->email }} " name="val-email2" placeholder="Your valid email..">
								<label for="val-email2">Email</label>
							</div>
						</div>
						<div class="form-group">
							<div class="form-material">
								<input type="password" class="form-control" id="val-password2" value="{{ $member->password }} " name="val-password2" placeholder="Choose a safe one..">
								<label for="val-password2">Password</label>
							</div>
						</div> 

						
						<div class="form-group">

							<div class="form-material">
								<select class="js-select2 form-control" id="val-select22" name="val-select22" style="width: 100%;" data-placeholder="Choose one..">
									@foreach ($roles as $role)
									<option value="{{ $role->id}} ">{{ $role->name }} </option>
									@endforeach
								</select>
								<label for="val-select2">Assign a barangay.</label>
							</div>

						</div>
						<div class="form-group">


							<div class="form-material">
								<select class="js-select2 form-control" id="val-select22" name="val-select22" style="width: 100%;" data-placeholder="Choose one..">
									@foreach ($barangays as $barangay)
									<option value="{{ $barangay->role_id}} ">{{ $barangay->name }} </option>
									@endforeach
								</select>
								<label for="val-select2">Assign a barangay.</label>
							</div>


						</div>



						<div class="form-group">
							<button type="button" class="btn btn-primary min-width-125 btn-lg">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



	@endsection


	@section('js')
	<script>
		$(function(){
			$('select[name="role_id"]').on('change', function () {
				var addBarangayDiv = $('div#add_barangay_id');
				if ($(this).val() == 2)
				{
					addBarangayDiv.hide();
					addBarangayDiv.find('select').val('');

				} else {
					addBarangayDiv.show();

				}
			});
		})
		
	</script>

	@endsection