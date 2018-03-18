<template>
	<div>
		<div v-if="locationFound = false ">
			<div class="pac-card" id="pac-card" >
				<div>
					<div id="title">
						Autocomplete search
					</div>
					<div id="type-selector" class="pac-controls">
						<input type="radio" name="type" id="changetype-all" checked="checked">
						<label for="changetype-all">All</label>

						<input type="radio" name="type" id="changetype-establishment">
						<label for="changetype-establishment">Establishments</label>

						<input type="radio" name="type" id="changetype-address">
						<label for="changetype-address">Addresses</label>

						<input type="radio" name="type" id="changetype-geocode">
						<label for="changetype-geocode">Geocodes</label>
					</div>
					<div id="strict-bounds-selector" class="pac-controls">
						<input type="checkbox" id="use-strict-bounds" value="">
						<label for="use-strict-bounds">Strict Bounds</label>
					</div>
				</div>
				<div id="pac-container">
					<input id="pac-input" type="text"
					placeholder="Enter a location">
				</div>
			</div>
			<div id="infowindow-content">
				<img src="" width="16" height="16" id="place-icon">
				<span id="place-name"  class="title"></span><br>
				<span id="place-address"></span>
			</div>
		</div>


		<div id="map"></div>
		<div id="control-buttons">

			<div class="fixed-action-btn horizontal click-to-toggle">
				<div class="floating-button animated bouncein delay-3">
					<span class="btn-floating btn-large green-lighten-3">
						<i class="large material-icons">menu</i>
					</span>
				</div>
				<ul>
					<li><span @click="showRoute" class="btn-floating btn-large waves-effect waves-light blue btn z-depth-1">
						<i class="material-icons">directions</i>
					</span></li>
					<li><span @click="toggleSatelliteMode" class="btn-floating btn-large waves-effect waves-light red btn z-depth-1">
						<i class="material-icons">satellite</i>
					</span></li>
					<li>
						<span @click="moveToMyLocation" class="btn-floating btn-large waves-effect waves-light green-darken-2 btn z-depth-1">
							<i class="material-icons">my_location</i>
							<span href="#" class="btn-floating mobile-fab-tip">Edit</span> tooltip
						</span>
					</li>
				</ul>
			</div>
		</div>



	</div>
</template>

<script>
import swal from 'sweetalert';

// import maps from './js/maps.js';

import GMaps from 'gmaps';

// import SearchBar from './components/SearchBar.vue';

import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

// import

export default {
	name: 'MapOfTodaysDeliveries',
	data () {
		return {

			startPosition : {} ,

			loading: true , 

			locationFound : true ,

			size : '40px' ,

			latitude: null,
			longitude: null,

			cebuCityLocation : {
				lat: 10.3157, 
				lng : 123.8854
			} ,

			cityHallLocation : {	
				lat: 10.2929,
				lng: 123.9016
			}, 


			markersArray : [],
			coordinates : [] 


		};
	},

	components: {
		PulseLoader,
		// SearchBar
	},


	methods : 
	{ 	
		initializeMap(){
			GMaps.geolocate({
				success: function(position) {

					var options = { 
						center: {lat: position.coords.latitude, lng: position.coords.longitude},
						zoom: 20,
						disableDefaultUI : true , 
						styles : [{"featureType":"all","elementType":"geometry.fill","stylers":[{"color":"#ff0000"},{"visibility":"on"}]},{"featureType":"all","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#669933"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]

					};


					var map = new google.maps.Map(document.getElementById('map'), options);

					var marker = new google.maps.Marker({
						map: map,
						center : center
					});



				},
				error: function(error) {

					this.locationFound = false ; 


					alert('Geolocation failed: '+error.message);




					var options = { 
						center: {lat: position.coords.latitude, lng: position.coords.longitude},
						zoom: 20
					};


					var map = new google.maps.Map(document.getElementById('map'), options);


					var card = document.getElementById('pac-card');
					var input = document.getElementById('pac-input');
					var types = document.getElementById('type-selector');
					var strictBounds = document.getElementById('strict-bounds-selector');

					map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

					var autocomplete = new google.maps.places.Autocomplete(input);


					      // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);

        var marker = new google.maps.Marker({
        	map: map,
        	anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
        	infowindow.close();
        	marker.setVisible(false);
        	var place = autocomplete.getPlace();
        	if (!place.geometry) {
						            // User entered the name of a Place that was not suggested and
						            // pressed the Enter key, or the Place Details request failed.
						            window.alert("No details available for input: '" + place.name + "'");
						            return;
						        }

			          // If the place has a geometry, then present it on a map.
			          if (place.geometry.viewport) {
			          	map.fitBounds(place.geometry.viewport);
			          } else {
			          	map.setCenter(place.geometry.location);
			            map.setZoom(17);  // Why 17? Because it looks good.
			        }
			        marker.setPosition(place.geometry.location);
			        marker.setVisible(true);

			        var address = '';
			        if (place.address_components) {
			        	address = [
			        	(place.address_components[0] && place.address_components[0].short_name || ''),
			        	(place.address_components[1] && place.address_components[1].short_name || ''),
			        	(place.address_components[2] && place.address_components[2].short_name || '')
			        	].join(' ');
			        }

			        infowindowContent.children['place-icon'].src = place.icon;
			        infowindowContent.children['place-name'].textContent = place.name;
			        infowindowContent.children['place-address'].textContent = address;
			        infowindow.open(map, marker);
			    });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
        	var radioButton = document.getElementById(id);
        	radioButton.addEventListener('click', function() {
        		autocomplete.setTypes(types);
        	});
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
        .addEventListener('click', function() {
        	console.log('Checkbox clicked! New state=' + this.checked);
        	autocomplete.setOptions({strictBounds: this.checked});
        });




    },
    not_supported: function() {
    	alert("Your browser does not support geolocation");
    },
    always: function() {
    	alert("Done!");
    }
});
},


calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map){


	var markerArray = [];

	var directionsService = new google.maps.DirectionsService;

				    // Create a map and center it on Manhattan.
				    var map = new google.maps.Map(document.getElementById('map'), {
				    	zoom: 13,
				    	center: {lat: 40.771, lng: -73.974}
				    });

				    var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

				    var stepDisplay = new google.maps.InfoWindow;

				    this.calculateAndDisplayRoute(
				    	directionsDisplay, directionsService, markerArray, stepDisplay, map);
				    

				},

				toggleSatelliteMode(){

					swal("Alert", "This would show your route", "info");

				},


				showRoute(){

					swal("Alert", "This would show your route", "info");

				},		

				moveToMyLocation(){
					swal("Alert", "This would show your route", "info");

				},



			},

			mounted(){
				this.initializeMap() ; 
			}
		};
		</script>

		<style lang="css" scoped>

/*


.loader{
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	text-align: center;
	min-height: 100vh;
}

.form-field {
	position: absolute;
	top: 10%; 
	right: 10px ; 
	z-index: 99; 
	padding-top:5px;
	background-color: white;
	border: 2px solid #F7F7F7;
}

.form-field{
	outline: inherit;
	border: none;
	border-radius: 5px;
	width: 65%;
	margin-bottom: 25px;
	padding: 10px;
	font-family: "Lato", sans-serif;
	font-size: 14px;
	line-height: 14px;
	background-color: #fff;
	color: #000;
	font-weight: 300;
}

.mobile-fab-tip {
	position: fixed;
	right: 85px;
	padding:0px 0.5rem;
	text-align: right;
	background-color: #323232;
	border-radius: 2px;
	color: #FFF;
	width:auto;
} 

#control-buttons {
	position: absolute; bottom: 34px; left: 10px ; z-index: 99; padding-top:5px;
}


@-webkit-keyframes anim-pulse{
	0%   { 
		opacity: 0 ;
		-webkit-transform : scale(.5);
	}
	10% {
		opacity: 1 ;
	}

	90% {
		opacity: 0 ;
	}

	100% {
		-webkit-transform : scale(1.25)
	}
}


.core {
	fill:red;
}

.ring {
	opacity: 0;
	stroke: red;
	-webkit-transform-origin: center;
	-webkit-animation: anim-pulse 2s 1s infinite;
}

.wrapper {
	float: left;
	width: 25%;
	}*/


	/* Always set the map height explicitly to define the size of the div
	* element that contains the map. */
	#map { 
		width: 100%;
		height: 100vh;
		position: relative ; 
	}

	/* Optional: Makes the sample page fill the window. */
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	}
	#description {
		font-family: Roboto;
		font-size: 15px;
		font-weight: 300;
	}

	#infowindow-content .title {
		font-weight: bold;
	}

	#infowindow-content {
		display: none;
	}

	#map #infowindow-content {
		display: inline;
	}

	.pac-card {
		margin: 10px 10px 0 0;
		border-radius: 2px 0 0 2px;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		outline: none;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
		background-color: #fff;
		font-family: Roboto;
	}

	#pac-container {
		padding-bottom: 12px;
		margin-right: 12px;
	}

	.pac-controls {
		display: inline-block;
		padding: 5px 11px;
	}

	.pac-controls label {
		font-family: Roboto;
		font-size: 13px;
		font-weight: 300;
	}

	#pac-input {
		background-color: #fff;
		font-family: Roboto;
		font-size: 15px;
		font-weight: 300;
		margin-left: 12px;
		padding: 0 11px 0 13px;
		text-overflow: ellipsis;
		width: 400px;
	}

	#pac-input:focus {
		border-color: #4d90fe;
	}

	#title {
		color: #fff;
		background-color: #4d90fe;
		font-size: 25px;
		font-weight: 500;
		padding: 6px 12px;
	}

</style>	