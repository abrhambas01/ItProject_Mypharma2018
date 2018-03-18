<template>
	<div>
		<div id="map"></div>
	</div>
</template>

<script>

import $ from 'jquery'; 
// import maps from './js/maps.js' ;

export default {

	name: 'DeliveriesMap',

	data () {
		return {
			cityHallLocation : {  
				lat: 10.2929,
				lng: 123.9016
			} ,


			markers : [ ]
		};
	},

	methods : { 	

		

	},

	mounted(){

		this.initializeMap(); 


	}
};
</script>

<style lang="css" scoped>

#map { 
	width: 100%;
	height: 100vh;

}
</style>