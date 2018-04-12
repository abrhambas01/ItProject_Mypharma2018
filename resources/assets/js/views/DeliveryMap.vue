<template src="./DeliveryMap.html"></template>

<script>
import swal from 'sweetalert';
// import maps from './js/maps.js';
import GMaps from 'gmaps';
// import SearchBar from './components/SearchBar.vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue' ; 
// import tspsolver from './tspsolver.js';  
// import tsp from './mixins/tsp.js';  

import * as VueGoogleMaps from 'vue2-google-maps';

// import LPulse from 'leaflet-pulse-icon';

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

			house : 'dist/img/pin.png',

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
				zoom: 10 ,
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

			// https://stackoverflow.com/questions/10656743/how-to-offset-the-center-point-in-google-maps-api-v3

			// map.setCenter(this.startLocation);
			this.$refs.map.panTo({
				lat : this.startLocation.lat,
				lng : this.startLocation.lng 
			});


			this.$refs.map.panBy(5,-100);
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


			


		},

		setPlace(place) {
			
			this.startLocation = {

				lat: place.geometry.location.lat(),

				lng: place.geometry.location.lng(),
			};
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

						// this.locationFound = false ; 

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
    top: 0.7%;
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