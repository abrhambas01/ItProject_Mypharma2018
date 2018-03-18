<template >

	<div id="pie_chart" class="card chart animated fadeinright delay-1">
		
		<div class="legend">
			<h5>Deliveries <i class="ion-android-more-vertical 	right text-color"></i></h5>
			<p><span class="data-color blue lighten-3"></span>Undelivered</p>
			<p><span class="data-color orange lighten-3"></span>Delivered</p>
			<p><span class="data-color purple lighten-4"></span>Archived</p>
		</div>

		<div class="pieChartCont">
			<!-- <canvas id="pieChart" width="300" height="300"></canvas>  -->

			<!-- <delivery-charts></delivery-charts> -->

		</div>


	</div>


</template>

<script>
// import DeliveryCharts from './DeliveryCharts'

export default {

	name: 'DeliveryCharts',

	// components  : { 
	// 	'delivery-charts' : DeliveryCharts
	// }

};
</script>

<style lang="css" scoped>
</style>