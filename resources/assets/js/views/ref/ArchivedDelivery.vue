<template>
	<div id="map">
		<gmap-map :center="center" :zoom="7" ref="mmm" style="width: 100%; height: 500px">
			<gmap-marker :key="index" v-for="(m, index) in markers" :position="m.position" :clickable="true" :draggable="true" @click="center=m.position">
			</gmap-marker>
		</gmap-map>
	</div>
</template>

<script>
import swal from 'sweetalert';

// import maps from './js/maps.js';

import GMaps from 'gmaps';

// import SearchBar from './components/SearchBar.vue';

import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

import * as VueGoogleMaps from 'vue2-google-maps';


Vue.use(VueGoogleMaps,{
	load: {
		key: 'AIzaSyB4n9WHPJ0vhZVIR7rhjZdz_OZ-KrrrEpA',
		libraries: ['places','geometry']
        //// If you need to use place input
        // libraries: ['places','geometry'] //// If you need to use place input and geometry too for directions..
    }
});
export default {

	name: 'MapOfTodaysDeliveries',

	data () {
		return {

			startPosition : {} ,

			loading: true , 

			locationFound : true ,

			size : '40px' ,

			center : {
				lat: 10.3157, 
				lng : 123.8854
			} ,

			myLocation : {
				lat: 10.3157, 
				lng : 123.8854
			} ,
			
			cityHallLocation : {	
				lat: 10.2929,
				lng: 123.9016
			}, 

			markers: [{
				position: {
					lat: 10.0,
					lng: 10.0
				}
			}, {
				position: {
					lat: 11.0,
					lng: 11.0
				}
			}],
			
			coordinates : [] 


		};
	},

	components: {
		PulseLoader,
		// SearchBar
	},


	methods : { 	

		toggleSatelliteMode(){

			swal("Alert", "This would show your route", "info");

		},


		showRoute(){

			swal("Alert", "This would show your route", "info");

		},		

		moveToMyLocation(){
			swal("Alert", "This would show your route", "info");

		},



		initializeMap(){	
			GMaps.geolocate({
				success: function(position) {

					this.locationFound = true ;

					this.myLocation.lat = position.coords.latitude ; 

					this.myLocation.lng = position.coords.longitude ; 


					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 20,
						center: { lat: this.myLocation.lat , lng  : this.myLocation.lng },
						disableDefaultUI: true, 
						styles : [{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]

					}); 


					var marker = new google.maps.Marker({    
						position: this.myLocation,   
						map: map  
					}); 


				},
				error: function(error) {

					// alert('Geolocation failed: '+error.message);

					swal(error.message,'alert', "error");

					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 20,
						center: this.myLocation,
						disableDefaultUI: true, 
						styles : [{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#165c64"},{"saturation":34},{"lightness":-69},{"visibility":"on"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"hue":"#b7caaa"},{"saturation":-14},{"lightness":-18},{"visibility":"on"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"hue":"#cbdac1"},{"saturation":-6},{"lightness":-9},{"visibility":"on"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#8d9b83"},{"saturation":-89},{"lightness":-12},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#d4dad0"},{"saturation":-88},{"lightness":54},{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#bdc5b6"},{"saturation":-89},{"lightness":-3},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#bdc5b6"},{"saturation":-89},{"lightness":-26},{"visibility":"on"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"hue":"#c17118"},{"saturation":61},{"lightness":-45},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"hue":"#8ba975"},{"saturation":-46},{"lightness":-28},{"visibility":"on"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"hue":"#a43218"},{"saturation":74},{"lightness":-51},{"visibility":"simplified"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":0},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":0},{"lightness":100},{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels","stylers":[{"hue":"#ffffff"},{"saturation":0},{"lightness":100},{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":0},{"lightness":100},{"visibility":"off"}]},{"featureType":"administrative","elementType":"all","stylers":[{"hue":"#3a3935"},{"saturation":5},{"lightness":-57},{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"hue":"#cba923"},{"saturation":50},{"lightness":-46},{"visibility":"on"}]}]
					}); 

				},
				not_supported: function() {
					alert("Your browser does not support geolocation");
				},
				always: function() {
					console.log('geolocation');
				}
			});

}

},

mounted(){
	this.initializeMap() ; 
}
};
</script>

<style lang="css" scoped>



#map { 
	width: 100%;
	height: 100vh;
	position: relative ; 
}


</style>	