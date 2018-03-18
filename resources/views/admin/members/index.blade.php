@extends('layouts.admin')

@section('title', 'Site Members')

@section('content')

<div class="content">
	<div class="block">
		<div class="block-header block-header-default">
			{{-- <h3 class="block-title logo-1">Members List</h3> --}}
			<button class="btn btn-success" data-toggle="modal" data-target="#addUserModal">Add Member</button>
		</div>


		<div class="block-content block-content-full">
			<!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
				<thead>

					<tr>

						<th class="text-center">Member Unique ID</th>

						<th class="text-center">Name</th>
						<th class="d-none d-sm-table-cell">Email</th>
						<th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
						<th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
						<th class="d-none d-sm-table-cell" style="width: 15%;">Barangay</th>

						<th class="d-none d-sm-table-cell" style="width: 15%;">Actions</th>

					</tr>

				</thead>
				
				<tbody>
					
					@include('partials.members_list')

				</tbody>

			</table>

		</div>
	</div>
</div>



<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin" role="document">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header bg-primary-dark">
					<h3 class="block-title">Register New User</h3>

					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>

				<div class="block-content">

					{{ Form::open(['id' => 'createUserForm', 'method'=>'POST']) }} 

					@include('partials.member_form')

					{{ Form::close() }}

				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="registerUser" class="btn btn-alt-success">
					<i class="fa fa-check"></i> Register
				</button>
			</div>
		</div>
	</div>
</div>

@endsection


@section('js')


<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }} "></script>
<script src="{{ asset('assets/js/pages/be_tables_datatables.js') }} "></script>


<script>


	$(document).ready(function() {

		var selected_option = $('#role_id option:selected');

		console.log(selected_option);

		// $('#mySelectBox option').each(function() {
		// 	if($(this).is(':selected')) ...


		// });



	});


		$(document).on('click', '#deleteUser', function () {

			var id = $(this).data('id');

			var name = $(this).data('name');


			console.log(id);

			swal({

				title: "Are you sure?",

				text: "Once deactivated, all this user's transactions will be removed!",

				icon: "warning",

				buttons: true,

				dangerMode: true,

			})
			.then((willDelete) => {
				if (willDelete) {

					deactivateUser(urlDeactivateUser,id) ; 

				} else {
					swal("That User was not deleted");
				}
			});


		});







		$(document).on('click', '.editModal', function () {

			$('.footer_action_button').text("Update");

			$('#fid').val($(this).data('id'));

			$('#name').val($(this).data('name'));

			$('#emailInput').val($(this).data('email'));

			$('#passWord').val($(this).data('password'));

			var role = {} ;

			role.val = $(this).data('role_id') ; 
			console.log(role.val);

			$("#barangay_id option[data-value='" +role.val  +"']").attr("selected","selected");


			id = $(this).data('id');

			console.log(id);







		// $('#optionRole_id').val($(tis).data('role_id'));

		// $('select#role_id').val($('select#role_id').data('role_id'));


		$('#myModal').modal('show');



	});

		$('.modal-footer').on('click', '#updateUser', function() {

			var data = $('#editUserForm').serialize();

			console.log('id is '+id);

			updateUser(data,id) ; 

		});


	</script>




	@endsection