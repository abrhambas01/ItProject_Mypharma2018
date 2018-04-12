@foreach($medicines as $medicine)
<tr>

	<td class="text-center">{{ $medicine->treatmentFor }} </td>
	<td class="text-center">{{ $medicine->medicine_name }} </td>
	<td class="text-center">{{ $medicine->form }} </td>
	<td class="text-center">{{ $medicine->price }} </td>

	@if (is_null($medicine->picture))
	
	<td class="text-center"><img height="75" width="75" src="{{ asset('storage/medicines/leAoShtaopeS9SrAYvygBbWvzaDSvLOtEsAqhJZI.jpeg') }}" alt=""> 	

	</td>
	@else

	<td class="text-center"><img src="{{ asset('storage/'.$medicine->picture) }}" height="75" width="75" alt=""> </td>


	@endif
	
	<td class="text-center">

		<button href="" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Profile">
			<a href="{{ route('medicines.show', $medicine->medicine_id ) }}"> 
				<i class="fa fa-align-left" style="color : black ; "></i>
			</a>
		</button>

		<button href="" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit Medicine">
			<a href="{{ route('medicines.edit',  $medicine->medicine_id ) }}"> 
				<i class="fa fa-edit" style="color : #fff ; "></i>
			</a>
		</button>


	</td>


</tr>
@endforeach