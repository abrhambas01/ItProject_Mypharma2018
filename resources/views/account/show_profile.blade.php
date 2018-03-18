@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')



<div class="bg-image bg-image-bottom" style="background-image: url {{ asset('assets/img/photos/photo13@2x.jpg') }} ; ">
	<div class="bg-primary-dark-op py-30">
		<div class="content content-full text-center">
			<!-- Avatar -->


			<div class="mb-15">
				<a class="img-link" href="{{ route('changeAdminPhoto',$user->id) }} ">
					<img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset('assets/img/avatars/default.jpg') }} " alt="">
				</a>
			</div>
			

			<!-- END Avatar -->



			<!-- Personal -->
			<h1 class="h3 text-white font-w700 mb-10">
				
				@if(is_null($users_information))

				{{ $username }}

				@else

				{{ $users_information->first_name }}  {{ $users_information->middle_name }} {{ $users_information->last_name }} 
				<br>
				@ {{ $username}}
				

				@endif


			</h1>

			
			<h2 class="h5 text-white-op">
				{{ $user->role->name }} <a class="text-primary-light" href="javascript:void(0)">at Mypharma </a>
			</h2>
			<!-- END Personal -->

			<!-- Actions -->

			@if(is_null($users_information))
			<?php 
			
			$option1 = 'Add Profile';
			
			?>

			@else

			<?php
			$option1 = 'Update Profile';

			?>

			@endif

			<button type="button" data-toggle="modal" data-target="#updateInformationModal" class="btn btn-rounded btn-hero btn-sm btn-alt-success mb-5">
				<i class="fa fa-plus mr-5"></i> {{ $option1 }}
			</button>
			<button type="button" class="btn btn-rounded btn-danger btn-hero btn-sm  mb-5">
				<i class="fa fa-trash-o mr-5"></i> Delete My Account
			</button>
			<!-- END Actions -->
		</div>
	</div>
</div>

@include('admin.modals.update_member_information')



<h2 class="content-heading">Your Information</h2>



<div class="row">
	<div class="col-lg-12">
		<!-- Block Tabs Animated Fade -->
		<div class="block">
			<ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" href="#basic-info">Basic Information</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#admin-profile">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#address">Address</a>
				</li>
				<li class="nav-item ml-auto">
					<a class="nav-link" href="#btabs-animated-fade-settings"><i class="si si-settings"></i></a>
				</li>
			</ul>
			<div class="block-content tab-content overflow-hidden">
				<div class="tab-pane fade show active" id="basic-info" role="tabpanel">
					<h4 class="font-w400">Home Content</h4>

					<h5 class="font-w300"> <small>Username:</small>{{ $user->name }}</h5>
					<h5 class="font-w300"><small>Email: </small> {{ $user->email }} </h5>



				</div>
				<div class="tab-pane fade" id="admin-profile" role="tabpanel">
					<h4 class="font-w400">Profile Content</h4>
					

					@if(empty($users_information))
					<h3 class="font-w300">No Information was added </h3>

					@else

					<h5 class="font-w300"> <small>First Name :</small>{{ $users_information->first_name  }}</h5>

					<h5 class="font-w300"> <small>Middle Name:</small>{{ $users_information->middle_name  }}</h5>

					<h5 class="font-w300"> <small>Last Name : </small>{{ $users_information->last_name  }}</h5>


					<h5 class="font-w300"> <small>Mobile Phone : </small>{{ $users_information->mobile_phone  }}</h5>




					@endif

				</div>
				<div class="tab-pane fade" id="address" role="tabpanel">
					<h4 class="font-w400">Address</h4>
					<h5 class="font-w300"> <small>Work Address </small>{{ $users_information->work_address  }}</h5>
					<h5 class="font-w300"> <small>House Number: </small>{{ $users_information->house_number  }}</h5>

					<h5 class="font-w300"> <small>Street Name : </small>{{ $users_information->street_name  }}</h5>

					<h5 class="font-w300"> <small>Postal Code : </small>{{ $users_information->postal_code  }}</h5>
				</div>
			</div>
		</div>



		@endsection