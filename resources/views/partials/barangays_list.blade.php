@foreach($barangays as $barangay)

<tr>
	<td class="text-center">{{ $barangay->name }} </td>
	<td class="text-center">{{ $barangay->facebook_profile }} </td>

	<td class="text-center">
		<button href="" class="btn btn-sm btn-secondary viewProfile" data-toggle="tooltip" title="View Profile">
			<a href="{{ route('barangays.show', $barangay->id ) }}"> 
				<i class="fa fa-folder" style="color : black ; "></i>
			</a>
		</button>

		<button href="" class="btn btn-sm btn-primary edit-barangay" data-barangay_id = "{{ $barangay->id }} " 
			data-toggle="tooltip" title="Edit Barangay">
			<a href="{{ route('barangays.edit', $barangay->id ) }}"> 
				<i class="fa fa-edit" style="color : #fff ; "></i>
			</a>
		</button>

		<button class="btn btn-sm btn-primary showModal" 
		data-lat="{{ $barangay->lat }}" data-lng="{{ $barangay->lng }}"
		data-toggle="modal" data-target="#barangayLocationModal" title="Show Map">
		<a><i class="fa fa-map" style="color : #fff ; "></i></a>
	</button>

</td>


</tr>


@endforeach