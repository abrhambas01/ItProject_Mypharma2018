@foreach($members as $member)
<tr class="">


	<td class="text-center">{{ $member->id }} </td>
	<td class="text-center">{{ $member->name }} </td>
	<td class="font-w600">{{ $member->email }} </td>

	<td class="d-none d-sm-table-cell">

		@if ( $member->status == 'active')

		<span class="badge badge-primary">Active</span>

		@else

		<span class="badge badge-primary">Inactive</span>


		@endif



	</td>


	<td class="d-none d-sm-table-cell">{{ $member->role->name }} </td>

	<td class="font-w600">
		@if (empty($member->barangay))
		Courier
		@else
		{{ $member->barangay->name }}
		@endif
	</td>


	<td class="text-center">

		<button href="" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Profile">
			<a href="{{ route('members.show', $member->id ) }}"> 
				<i class="fa fa-user" style="color : black ; "></i>
			</a>
		</button>

		<button type="button" class="btn btn-sm btn-danger" id="deleteUser" data-id="{{ $member->id }} " data-name="{{ $member->name }} "data-toggle="tooltip" title="Deactivate User">
			<i class="fa fa-remove"></i>
		</button>

		<button type="button" class="btn btn-sm btn-primary editModal" data-id="{{ $member->id }} "

			data-password="{{ $member->password }}"
			data-name="{{ $member->name }}" 
			data-email="{{ $member->email }} "
			data-role_id="{{ $member->role_id }} "


			title="Edit User" data-toggle="modal" data-target="#myModal">
			<a href="#"> 
				<i class="fa fa-edit" style="color : #fff ; "></i>
			</a>
		</button>


	</td>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-popin" role="document">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header bg-primary-dark">
						<h3 class="block-title">Edit User</h3>

						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>

					<div class="block-content">

						{{ Form::open(['id' => 'editUserForm', 'method'=>'POST']) }} 

						@include('partials.member_form')


						{{ Form::close() }}

					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-alt-secondary " data-dismiss="modal">Close</button>
					<button type="button" id="updateUser" class="btn btn-alt-success">
						<i class="fa fa-check"></i> Update
					</button>
				</div>
			</div>
		</div>
	</div>




</tr>
@endforeach