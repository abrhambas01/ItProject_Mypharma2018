@extends('layouts.admin')

@section('title', 'Registered Barangays')

@section('styles')

<style>
	#map-canvas {
		height : 100%;
		width:75%;
	}
</style>

@endsection

@section('content')

<div class="content">
	<div class="block">

		<div class="block-header block-header-default">
			<h3 class="block-title">Barangays</h3>
		</div>

		<div class="block-content block-content-full">
			<!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
				<thead>
					<tr>

						<th class="text-center">Name</th>
						<th class="text-center">Facebook Profile</th>

						<th class="d-none d-sm-table-cell" style="width: 15%;">Actions</th>

					</tr>
				</thead>
				<tbody>

					@include('partials.barangays_list');
					
				</tbody>
			</table>

		</div>
	</div>
</div>


<div class="modal fade" id="barangayLocationModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright" role="document">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header bg-primary-dark">
					<h3 class="block-title">Location of the Barangay Hall</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					<div id="map-canvas"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-alt-success" data-dismiss="modal">
					<i class="fa fa-check"></i> Perfect
				</button>
			</div>
		</div>
	</div>
</div>




@endsection


@section('js')

<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }} "></script>

<!-- Page JS Code -->
<script src="{{ asset('assets/js/pages/be_tables_datatables.js') }} "></script>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZWTTkguiQpNFtckZZ5lpJLvVvMc0hsmI&libraries=places"></script> 

<script>



	// function mapInit(lat, lng ){
	// 	var modalElm = $('#mapModal');
	// 	var myLatlng = new google.maps.LatLng(lat, lng);

	// 	var myOptions = {
	// 		zoom: 10,
	// 		center: myLatlng
	// 	};


	// 	map = new google.maps.Map($('#map-canvas')[0],myOptions);

	// 	var marker = new google.maps.Marker({
	// 		position: myLatlng,
	// 		map: map
	// 	});

	// 	modalElm.modal('show');

	// 	modalElm.on('shown.bs.modal', function() {
	// 		google.maps.event.trigger(map, 'resize');
	// 		map.setCenter(myLatlng);
	// 	});

	// 	modalElm.on('hide.bs.modal', function() {
 //  	/// clear canvas
 //  		$('#map-canvas').html('');


 // 	 })


	// }

	$(function(){
		
		function showMap(lat, lng ){
			var location = {
				lat:parseFloat(lat) ,
				lng: parseFloat(lng)
			};

			var map = new google.maps.Map(document.getElementById('map-canvas'), {
				zoom: 4,
				center: location
			});

			var marker = new google.maps.Marker({
				position: location,
				map: map
			});
		}

		$("#barangayLocationModal").on("shown.bs.modal", function () {
			google.maps.event.trigger(map, "resize");
		});



		$('.showModal').on('click',function(){

			var lat = $(this).data('lat');
			var lng = $(this).data('lng');

			console.log(lat);
			console.log(lng);

			showMap(lat,lng) ;

		});


    	// var element = $(e.relatedTarget);
    	// var data = element.data("lat").split(',')
    	// initialize(new google.maps.LatLng(data[0], data[1]));

    	// console.log(e);


    });





	

</script>


@endsection