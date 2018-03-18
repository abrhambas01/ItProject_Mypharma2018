<template>


	<div class="widget">
	<weather 
		api-key="675c26ed66daf3e7490ead63b6b381b8"
		latitude="24.886436"
		longitude="91.880722"
		language="en"
		bar-color="52D1DC"
		text-color="fff"
		title="Weather for Cebu"	
		units="us">
	</weather>
	
	</div>

</template>

<script>
import VueWeatherWidget from 'vue-weather-widget';

import 'vue-weather-widget/dist/css/vue-weather-widget.css';

export default {

	name: 'Home',
	data(){
		return {
			animation : false
		}


	},
	components : {  'weather': VueWeatherWidget } 

};
</script>

<style lang="css" scoped>
.widget {

	margin-top: 20%;	

}
</style>