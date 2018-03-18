@extends('layouts.admin')

@section('title', 'Update Profile')

@section('content')


<div class="content">
	<h2 class="content-heading">EDIT MEMBER  {{ $member->name }} with a role of  {{ $member->role->name }}</h2>
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
					<form class="js-validation-material" action="{{ url('admin/profile/update/' .Auth::user()->id ) }}" method="post">


						{{ csrf_field() }} 

						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-username2" name="first_name" placeholder="Enter a username..">
								<label for="val-username2">First Name</label>
							</div>
						</div>

						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" name="middle_name" placeholder="">
								<label for="val-email2">Middle Name</label>
							</div>
						</div>


						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" name="last_name" >
								<label for="val-email2">Last Name</label>
							</div>
						</div>

						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" name="house_number" placeholder="30024">
								<label for="val-email2">House Number</label>
							</div>
						</div>


						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" name="street_name" placeholder="35th Kaimito Street..">
								<label for="val-email2">Street Name</label>
							</div>
						</div>

						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" name="postal_code" placeholder="">
								<label for="val-email2">Postal Code</label>
							</div>
						</div>

						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" name="mobile_phone" placeholder="">
								<label for="val-email2">Mobile Phone</label>
							</div>
						</div>

						<div class="form-group">
							<div class="form-material">
								<input type="text" class="form-control" id="val-email2" name="telephone" placeholder="">
								<label for="val-email2">Telephone</label>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-12" for="example-file-input">Your Photo</label>
							<div class="col-12">
								<input type="file" id="example-file-input" name="picture">
							</div>
						</div>


						<div class="form-group">
							<div>
								<label><a data-toggle="modal" data-target="#modal-terms" href="#">Terms &amp; Conditions</a> <span class="text-danger">*</span></label>
							</div>
							<label class="css-control css-control-primary css-checkbox" for="val-terms2">
								<input type="checkbox" class="css-control-input" id="val-terms2" name="val-terms2" value="1">
								<span class="css-control-indicator"></span> I agree to the terms
							</label>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-alt-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



	@endsection
