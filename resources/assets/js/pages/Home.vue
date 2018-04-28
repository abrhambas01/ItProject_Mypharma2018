<template>


	<div class="demo-card-square mdl-card mdl-shadow--2dp">
		<div class="mdl-card__title mdl-card--expand">
			<h2 class="mdl-card__title-text">Update</h2>
		</div>
		<div class="mdl-card__supporting-text">
			<weather 
			api-key="930c613a5c44c05a5e0d5c3052630b60"
			title="Weather"
			latitude="24.886436"
			longitude="91.880722"
			language="en"
			units="uk">
		</weather>
	</div>
	<div class="mdl-card__actions mdl-card--border">
		<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
			View Updates
		</a>
	</div>
</div>
<!-- 
	<div class="demo-card-wide mdl-card mdl-shadow--2dp">
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Welcome  : {{ $route.params.id }} </h2>
		</div>
		<div class="mdl-card__supporting-text">
			
	</div>
	<div class="mdl-card__actions mdl-card--border">
		<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
			Get Started
		</a>
	</div>
	<div class="mdl-card__menu">
		<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="material-icons">share</i>
		</button>
	</div>
</div> -->
</template>
<script>
import VueWeatherWidget from 'vue-weather-widget';
import 'vue-weather-widget/dist/css/vue-weather-widget.css';


export default {

	components : { 
		'weather': VueWeatherWidget
	} ,


	mounted(){

		this.getLocation() ;

	} ,


	methods : { 
		getLocation(){

		}
	}

}	
</script>


<style scoped>
.demo-card-wide.mdl-card {
	width: 512px;
}


</style>