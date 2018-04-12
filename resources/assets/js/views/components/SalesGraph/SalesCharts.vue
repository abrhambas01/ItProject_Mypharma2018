<template>
	
	<div id="line_chart" class="card chart animated fadeinright">
		<div class="legend">
			<br>
			<h5>Sales Charts <i class="ion-android-more-vertical right text-color"></i></h5>

			<p>
				<span class="data-color red lighten-3"></span>Sales
			</p>
		</div>

		<div class="lineChartCont">
			<canvas id="canvas"></canvas>
		</div>
	</div>
	

</template>

<script>


export default {
	name: 'SalesCharts',

	data(){
		return {

			
		}

	}	
};
</script>	

<style lang="css" scoped>
</style>