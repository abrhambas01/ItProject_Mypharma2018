<template>
	<div>
<!-- 		<h1>this is google map</h1>
		<gmap-autocomplete :value="description"
		@place_changed="setPlace"
		class="input-item"
		>
	</gmap-autocomplete> -->
	<gmap-map
	id="map"
	style="width: 100%; height: 100vh"
	:options="mapOptions"
	:center="center"
	:zoom="18"
	:styles="mapStyle"
	>
	<gmap-marker
	:key="index"
	v-for="(m, index) in markers"
	:position="center = m.position"
	:clickable="true"
	:draggable="true"
	@click="center=m.position"
	></gmap-marker>
</gmap-map>

</div>
</template>

<style>

</style>

<script>
export default{
	data(){
		return {
			center: {
				lat: 10.2929,
				lng: 123.9016
			},
			mapOptions: {
				disableDefaultUI : true,
			},
	
			markers: [
			{
				position: {
					lat: 10.2929,
					lng: 123.9016
				}
			}
			],
			getMap: this.$root.mapping,
			description: '',
			latLng: {},
			place: null
		}
	},

	mounted(){
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
				let pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				this.center.lat = pos.lat;
				this.center.lng = pos.lng;
				this.markers[0].position.lat = pos.lat;
				this.markers[0].position.lng = pos.lng;

				this.geocodeLatLng(new google.maps.Geocoder, pos, google.maps.InfoWindow);

			}.bind(this));
		}
	},
	methods: {
		setDescription(description){
			this.description = description
		},
		setPlace(place){
			this.latLng = {
				lat: place.geometry.location.lat(),
				lng: place.geometry.location.lng(),
			}
		},
		geocodeLatLng(geocoder, map, infowindow){
			geocoder.geocode({'location':this.center}, function(results, status){
				console.log(results, status); 
			});
		}
	},
};
</script>
