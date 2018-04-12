<template>
	<div>
		<section class="mdl-layout__tab-panel" id="fixed-tab-1">
			<div class="page-content">
				<parcels></parcels>
			</div>
		</section>
		<section class="mdl-layout__tab-panel" id="fixed-tab-2">
			<div class="page-content">
				<delivery-map></delivery-map>
			</div>
		</section>
	</div>
</template>

<script>

	// import DeliveryParcels from './views/components/DeliveryParcels.vue';
	import Parcels from './Parcels.vue';
	import DeliveryMap from './DeliveryMap.vue';

	export default {	
		components : { Parcels, DeliveryMap } , 

	};
</script>

<style lang="css" scoped>

</style>