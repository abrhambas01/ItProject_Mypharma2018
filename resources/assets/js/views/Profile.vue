<template>
	<div class="page animated fadeinright">

		<!-- Hero Header -->
		<div class="hero-header hero-big bg-v-4">
			<div class="about animated fadeinright delay-1">
				<img class="avatar" src="assets/img/avatars/default.jpg" ></img>
				<h2 class="white-text m-0">{{ user.name }}</h2>
				<p class="white-text m-0">Courier.</p>
				<router-link to="/update/cover_photo" tag="li" class="waves-effect waves-light btn primary-color m-20" >
					Update Cover Photo
				</router-link>


			</div>
		</div>

		<!-- Transactions Counter -->
		<div class="row m-0">
			<div class="col s4 p-20 center">
				<h4 class="m-0"><strong>350</strong></h4>
				<p class="m-0 grey-text small">Delivered</p>
			</div>
			<div class="col s4 p-20 center">
				<h4 class="m-0"><strong>120</strong></h4>
				<p class="m-0 grey-text small">Houses Visited</p>
			</div>
			<div class="col s4 p-20 center">
				<h4 class="m-0"><strong>846</strong></h4>
				<p class="m-0 grey-text small">Like</p>
			</div>
		</div>

		<!-- Profile Contents -->
		<!-- <ul class="tabs border-top animated fadeinup delay-2"> -->
			<!-- <li class="tab col s3"><a class="active" href="#transactions">Post</a></li> -->
		<!-- 	<router-link to="/basic-information" exact class="tab col s3" tag="li">
				<a class="active">
					Basic Information
				</a>
			</router-link>

			<router-link to="/profile" exact class="tab col s3" tag="li">
				<a class="active">
					Profile
				</a>
			</router-link>

		-->


		<div class="activities">
			<div class="activity animated fadeinright delay-1">
				<p>Contact Information</p>
				<span class="activity-time small grey-text">
					<i class="material-icons">email</i> 
					<span class="">email@gmail.com</span>
					<br>
					<i class="material-icons">phone</i> 
					<span class="">09342343123 / 39021	</span>

				</span>
				<span class="activity-type">
					<i class="material-icons">perm_identity</i></span>
				</div>

				<div class="activity animated fadeinright delay-1">
					<p>Address</p>
					<span class="activity-time small grey-text"><i class="ion-ios-clock-outline"></i> <span class="">7 - 9am | Just a coffee</span></span>
					<span class="activity-type">
						<i class="material-icons">place</i>
					</span>
				</div>


			</div>



		</div>


	</template>

<script>


export default {

	name: 'Profile',

	data () {
		return {

			avatar : ''

		};
	} ,


	computed : {

	},


	methods  : {


		getAuthenticatedUsersName(){
			// axios.get('/get/profile').then('').catch
		},





	}


};


</script>

	<style lang="css" scoped>
	</style>