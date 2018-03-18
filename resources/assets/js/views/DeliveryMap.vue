<template>
	<div id="wrapper">
		<div class="form-inputs p-10" v-if="!locationFound">
			<h4>Where do you want to start..</h4>
			<div class="input-field">
				<!-- <input id="company" type="text"> -->
				<gmap-autocomplete :value="dataUpdate.address" @place_changed="setPlace"></gmap-autocomplete>
			</div>

			<button class="waves-effect waves-light btn-large primary-color" @click="calculate()">START FROM HERE</button>

		</div>

		<gmap-map v-show="coordinates.length != 0 " ref="map" :center="startLocation" id="map" :options="mapOptions">

			<gmap-info-window :options="infoOptions" :position="infoPosition" :opened="infoOpened" @closeclick="infoOpened=false">
				{{ infoContent }}
			</gmap-info-window>


			<gmap-marker
			:icon="pin"
			:position="startLocation" 
			:clickable="true">
		</gmap-marker>

<!-- 	<gmap-info-window :position="startLocation">
		Hello world!
	</gmap-info-window>
-->

<!-- <google-marker v-for="m in markers" :position="m.position" :clickable="true" :draggable="true" @click="center=m.position"></google-marker> -->

<!-- 
	<gmap-marker v-for="(item, key) in markers" 
	:key="key"
	:position="item.position" 
	:clickable="true" 
	@click="center=m.position">
</gmap-marker>
-->
<gmap-marker v-for="(item, key) in coordinates" 
:key="key"
:icon="house"
:draggable="false"
:position="getPosition(item.position)" 
:clickable="true" 
@click="toggleInfoWindow(m,i)">
</gmap-marker>

</gmap-map>


<div id="control-buttons" v-show="coordinates.length != 0">
	<div class="fixed-action-btn horizontal click-to-toggle">
		<div class="floating-button animated bouncein delay-3">
			<span class="btn-floating btn-large green-lighten-3">
				<i class="large material-icons">menu</i>
			</span>
		</div>
		<ul>

			<div v-if='locationFound = false'>
				<li>
					<span @click="showRoute" class="btn-floating btn-large waves-effect waves-light blue btn z-depth-1 ">
						<i class="material-icons">directions</i>
					</span>
				</li>
			</div>



			<li>
				<span @click="toggleSatelliteMode" class="btn-floating btn-large waves-effect waves-light green btn z-depth-1 btn tooltipped" data-position="left" data-delay="50" data-tooltip="Change Map Type">
					<i class="material-icons">{{ maptype }}</i>
				</span>
			</li>


			<li>
				<span @click="panToMyLocation" data-tooltip="Current Location" class="btn-floating btn-large waves-effect waves-light green-darken-2 btn z-depth-1">
					<i class="material-icons">my_location</i>
				</span>
			</li>


			<li>
				<span data-tooltip="Show Directions" class="modal-trigger btn-floating btn-large waves-effect waves-light orange btn z-depth-1">
					<i class="material-icons">directions</i>
				</span>
			</li>


			<div id="modal4" class="modal bottom-sheet">
				<div class="modal-content choose-date">
					<p><i class="ion-ios-clock-outline"></i>Today</p>
					<p><i class="ion-ios-alarm-outline"></i>Tomorrow</p>
					<p><i class="ion-ios-stopwatch-outline"></i>Next week</p>
					<p><i class="ion-ios-timer-outline"></i>Next month</p>
					<p><i class="ion-ios-speedometer-outline"></i>Choose date</p>
				</div>
			</div>


		</ul>
	</div>
</div>



</div>


<!-- @click="toggleInfo(item, key)" -->
	<!-- 	<gmap-marker v-for="(item, key) in coordinates" :key="key" :value="newEvent.address" position="getPosition(item)" :clickable="true" @click="toggleInfo(item, key)" />
	</gmap-marker>
-->	<!-- Floating Action Button
<!-- 		<div class="floating-button page-fab animated bouncein delay-3">
			<a class="btn-floating btn-large waves-effect waves-light accent-color btn z-depth-1 modal-trigger" href="#modal4">
				<i class="ion-plus"></i>
			</a>
		</div>
	-->



</template>

<script>
import swal from 'sweetalert';
// import maps from './js/maps.js';
import GMaps from 'gmaps';
// import SearchBar from './components/SearchBar.vue';

import PulseLoader from 'vue-spinner/src/PulseLoader.vue' ; 

import * as VueGoogleMaps from 'vue2-google-maps';

import LPulse from 'leaflet-pulse-icon';

Vue.use(VueGoogleMaps,{

	load: {

		key: 'AIzaSyB4n9WHPJ0vhZVIR7rhjZdz_OZ-KrrrEpA',

		libraries: ['places','geometry']
        //// If you need to use place input
        // libraries: ['places','geometry'] //// If you need to use place input and geometry too for directions..

    }
});


export default {
	name: 'DeliveryMap',
	
	data () {
		return {	
			routeResults : [],

			pin : 'dist/img/map-marker.png' ,

			house : 'dist/img/user.png',

			isLoading: true , 

			maptype : 'satellite',

			mapLoaded : false ,

			origin : null , 

			directionsVisible : false , 

			markers: 
			[	
			{
				position: {
					full_name: 'Erich  Kunze',
					lat: 10.30356400,
					lng: 123.89964100
				}
			}, 
			{	
				position: 
				{
					full_name: 'Delmer Olson',
					lat: 10.32,
					lng: 123.89
				}
			},
			{	
				position: 
				{
					full_name: 'Delmer Olson',
					lat: 10.30431500,
					lng: 123.89035500
				}
			}
			],

			coordinates : [],
			
			infoPosition: null,

			infoContent: null,
			
			infoOpened: false,

			infoCurrentKey: null,

			infoOptions: {
				pixelOffset: {
					width: 0,
					height: -35
				}
			},

			// mixins : [ maps ],

			mapOptions : {
				zoom: 17 ,
				disableDefaultUI : true , 
				mapTypeId : 'terrain',
				styles :[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
			},

			dataUpdate : {
				address : '',
				latitude: null,
				longitude: null,
			},

			locationFound : false ,

			size : '40px' ,

			//Center of cebu

			// startLocation : {	
			// 	lat: 10.3157, 
			// 	lng : 123.8854
			// } ,



			//city Hall location
			startLocation : {	
				lat: 10.2929,
				lng: 123.9016
			} ,

			cityHallLocation : {	
				lat: 10.2929,
				lng: 123.9016
			},
		};
	},



	computed : { 	

		// pulsedMarker(){
		// 	return LPulse.marker([50,15],{icon: pulsingIcon}).addTo(map) ; 
		// }


	},

	components: {
		PulseLoader,
	},

	methods : {

		toggleSatelliteMode(){
			if ( this.mapOptions.mapTypeId  = 'terrain'){
				this.$refs.map.setMapTypeId('satellite') ; 
			}
			else if ( this.mapOptions.mapTypeId  = 'satellite'){
				this.$refs.map.setMapTypeId('terrain') ; 
			}
		},

		toggleInfo: function(marker, key) {
			this.infoPosition = this.getPosition(marker);
			this.infoContent = marker.full_name;
			if (this.infoCurrentKey == key) {
				this.infoOpened = !this.infoOpened;
			} else {
				this.infoOpened = true;
				this.infoCurrentKey = key;
			}
		},

		panToMyLocation(){

			// map.setCenter(this.startLocation);
			this.$refs.map.panTo({
				lat : this.startLocation.lat,
				lng : this.startLocation.lng 
			});
			
		},


		DisplayRoute(directionsService, directionsDisplay, start, destination, waypoints){

			directionsService.route({

				origin: start,

				destination: destination,

				waypoints: waypoints,

				travelMode: 'DRIVING'

			}, function (response, status){

				if (status === 'OK'){

					directionsDisplay.setDirections(response);

				} else {
					window.alert('Directions request failed due to ' + status);
				}
			});
		},

		calculate() {
			var tab = [{
				"name": "location 0 ",
				"latitude": this.startLocation.lat,
				"longitude": this.startLocation.lng,
				"origin": true
			}]

			console.log(tab);

			for (var i = 1; i < this.coordinates.length; i++) {

				var obj = {

					"name": 'location' + i,

					"latitude": this.coordinates[i].position.lat,

					"longitude": this.coordinates[i].position.lng
				}

				tab.push(obj);
				
			}

			console.log(obj);


			this.directionsService = new google.maps.DirectionsService()

			this.directionsDisplay = new google.maps.DirectionsRenderer()

			this.directionsDisplay.setMap(this.$refs.map.$mapObject)
			

			directionsDisplay.setMap(this.$refs.map.$mapObject)
			
			axios.post('api/routes', tab).then((response) => {
				console.log(response);

				var markerArray = []
				
				for (var i = 1; i < response.data.length; i++) {
					markerArray.push({

						location: {

							lat: response.data[i].latitude, 

							lng: response.data[i].longitude

						}})
				}

				console.log(markerArray) ; 

				this.DisplayRoute(directionsService, directionsDisplay, this.coordinates[0].position, this.coordinates[0].position, markerArray);
			})

		},

		setPlace(place) {

			this.startLocation = {

				lat: place.geometry.location.lat(),

				lng: place.geometry.location.lng(),
			};
		},

		showRoute(){

			var tab = [{
				"name": "location 0 ",
				"latitude": this.markers[0].position.lat,
				"longitude": this.markers[0].position.lng,
				"origin": true
			}]

			for (var i = 1; i < this.markers.length; i++) {
				var obj = {
					"name": 'location ' + i,
					"latitude": this.markers[i].position.lat,
					"longitude": this.markers[i].position.lng
				}
				tab.push(obj)
			}

			var directionsService = new google.maps.DirectionsService

			var directionsDisplay = new google.maps.DirectionsRenderer

			directionsDisplay.setMap(this.$refs.map.$mapObject)

			this.axios.post('http://localhost:8080/api/tsp', tab).then((response) => {
				console.log(response)

				var markerArray = []
				
				for (var i = 1; i < response.data.length; i++) {

					markerArray.push({location: {
						lat: response.data[i].latitude,
						lng: response.data[i].longitude
					}})

				}
				
				console.log(markerArray)
				this.DisplayRoute(directionsService, directionsDisplay, this.markers[0].position, this.markers[0].position, markerArray);

			});


			var origin = this.startLocation ; 

			if ( this.coordinates === null) { 

				swal("No Locations Found", "No Routes for Today", "info");

			}

			else {

				console.log('Start Routing');

				if ( this.coordinates.length < 30 ) {
				// this.directionsDisplay.setPanel(document.getElementBy)	

				this.directionsService = new google.maps.DirectionsService() 

				this.directionsDisplay = new google.maps.DirectionsRenderer()

				this.directionsDisplay.setMap(this.$refs.map.$mapObject); 

				var request = { 

					origin: origin,

					destination : this.coordinates, 

					waypoints : this.getPosition(waypoints) , 

					travelMode: 'DRIVING'

				}

				var vm = this

				vm.directionsService.route(request, function (response, status) {
					if (status === 'OK') {
				            vm.directionsDisplay.setDirections(response) // draws the polygon to the map
				        } else {
				        	console.log('Directions request failed due to ' + status)
				        }
				    })

			}
			else 
			{
				alert('None');
			}
		}
	},
			// var vm = this
			// vm.directionsService.route({
	  //         origin: this.coords, // Can be coord or also a search query
	  //         destination: this.destination,
	  //         travelMode: 'DRIVING'
	  //     }, function (response, status) {
	  //     	if (status === 'OK') {
			//             vm.directionsDisplay.setDirections(response) // draws the polygon to the map
			//         } else {
			//         	console.log('Directions request failed due to ' + status)
			//         }
			//     })

			// console.log(this.directionsDisplay);

			// this.directionsDisplay.setMap(this.$refs.map.$mapObject);
			// var vm = this
			// vm.directionsService.route({
			//         origin: { lat : this.startLocation.lat , lng : this.startLocation.lng } , // Can be coord or also a search query
			//         destination: this.coordinates,
			//         travelMode: 'DRIVING'
			//     }, function (response, status) {
			//     	if (status === 'OK') {
			//           vm.directionsDisplay.setDirections(response) // draws the polygon to the map
			//       } else {
			//       	console.log('Directions request failed due to ' + status)
			//       }
			//   })
			// var currentPosition = new google.maps.LatLng(this.startLocation.lat, this.startLocation.lng);

			// var i = this.coordinates.length; 

			// while (i--) {

			// 	this.coordinates[i].marker = new google.maps.Marker({
			// 		position: this.coordinates[i].latLng,
			// 		map: map,
			// 		title: this.coordinates[i].title,
			// 		icon: 'https://maps.google.com/mapfiles/ms/icons/green.png'
			// 	});
			// }

			// this.findNearestPlace();

			// vm.directionsService.route({
			// 	origin: this.coords,
			// 	destination: this.destination,
			// 	travelMode: 'DRIVING'
			// }, function (response, status) {
			// 	if (status === 'OK') {
			// 		vm.directionsDisplay.setDirections(response)
			// 	} else {
			// 		console.log('Directions request failed due to ' + status)
			// 	}
			// })



			locateMe(){
				return new Promise((resolve, reject) => {

					if (navigator && navigator.geolocation) {
						navigator.geolocation.getCurrentPosition((position) => {
							resolve(position.coords)
						});

					} else {

						const error = "Unable to retrieve your geolocation."

						swal("Geolocation not found", "We can't see your location. Please use the searchbox!", "info");

						this.locationFound = false ; 

						console.log('Geolocation failed');

						reject(new Error(error))
					}
				})
			},

			getPosition: function(marker) {
				return {
					lat: parseFloat(marker.lat),
					lng: parseFloat(marker.lng)
				}
			},

			updatePosition(event) {
				const latLng = event.latLng.toJSON()
				this.setGeocoder(this.newEvent, latLng)

			},


			fetchDeliveries(){
				axios.get('api/v1/deliveries/information')
				.then(response => this.coordinates = response.data)
				.catch(error => console.log(error.response.data));
			},


			initializeMap(){

				// if ( this.coordinates.length === 0 ) {

				// 	swal("No deliveries", "You don't have deliveries!", "info");

				// }else {

				// 	this.locateMe().then((location) => {
				// 		this.startLocation = {lat: location.latitude, lng: location.longitude}
				// 		this.mapLoaded = true;
				// 		this.startLocation = [{ position: this.center }]
				// 	});	

				// }



				GMaps.geolocate({
					success: function(position) {

						swal("Info", "Did we get your location right ? If not please use the searchbox!", "info");

						this.startPosition.lat = position.coords.latitude ;

						this.startPosition.lng = position.coords.longitude ;

					},
					error: function(error) {
						swal("Geolocation not found", "We can't see your location. Please use the searchbox!", "info");

						this.locationFound = false ; 

						console.log('Geolocation failed: '+error.message);

					},
					not_supported: function() {
						alert("Your browser does not support geolocation");
					},
					always: function() {
					// alert("Always alert!");
					console.log('Call this always');
				}

			});
			}
		},

		mounted(){
			this.fetchDeliveries();
			this.initializeMap() ; 
		}
	};
	</script>

	<style lang="css" scoped>
/* Always set the map height explicitly to de	e the size of the div
* element that contains the map. */
#map { 
	width: 100%;
	height: 100vh;
	position: relative ; 
}

#wrapper {

	position: relative ; 

}

.form-inputs {
	position: absolute; 
	top: 10%;
	left: 10px; 
	z-index: 5;
	background-color: #fff;
	width : 85%;
}



.loader{
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	text-align: center;
	min-height: 100vh;
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

html, body {
	height: 100%;
	margin: 0;
	padding: 0;
}
</style>	