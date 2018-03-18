<template>
	<div class="page animated fadeinright">
		<!-- Order Recap -->

		<div class="form-inputs p-20">
			<h4>Customer Information</h4>

			<h4 class="shipping-address">Update Account Information</h4>

			<div>


				<div class="input-field">
					<input id="first_name" type="text" class="validate">
					<label for="first_name">First Name</label>
				</div>


				<div class="input-field">
					<input id="first_name" type="text" class="validate">
					<label for="first_name">Middle Name</label>
				</div>

				<div class="input-field">
					<input id="last_name" type="text" class="validate">
					<label for="last_name">Last Name</label>
				</div>

				<div class="input-field">
					<input id="last_name" type="text" class="validate">
					<label for="last_name">Complete Address</label>
				</div>

				<div class="input-field">
					<input id="last_name" type="text" class="validate">
					<label for="last_name">Mobile Phone</label>
				</div>


			</div>

			<div class="file-field input-field">
				<div class="btn green">
					<span>Picture</span>
					<input type="file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>


			<a class="waves-effect waves-light btn-large primary-color block" @click="saveProfile">Save Profile</a>


		</div>


	</div>

</template>

<script>
export default {

	name: 'Profile',

	data () {
		return {
			form :  {

				email : '',

				password : '' , 

				first_name : '' ,

				last_name:  '' , 

				complete_address : ' '

			}, 
		};
	} ,


	methods : { 

		getFormInformation(){
			axios.get('/api/v1/getFormInformation')
		}

	}
};
</script>

<style lang="css" scoped>
</style>