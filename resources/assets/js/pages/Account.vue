<template>
	<div id ="mycard">

		<div class="demo-card-wide mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
				<h2 class="mdl-card__title-text">Contact details</h2>
			</div>


			<div class="mdl-card__supporting-text">
				First, tell us how to get in touch with you!
				<form action="#">

					<div id="name">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="text" id="first">
							<label class="mdl-textfield__label" for="sample3">First Name</label>
						</div>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="text" id="last">
							<label class="mdl-textfield__label" for="sample3">Last Name</label>
						</div>
					</div>

					<div id ="contact">
						<div id="phone">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="mobile">
								<label class="mdl-textfield__label" for="sample2">Mobile Phone</label>
								<span class="mdl-textfield__error">Mobile must be a number!</span>
							</div>
						</div>

						<div id="email">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="email" >
								<label class="mdl-textfield__label" for="sample2">E-mail</label>
								<span class="mdl-textfield__error">Enter a valid email!</span>
							</div>
						</div>
					</div>
				</form>
			</div>




		</div>

		<!-- FAB button with ripple -->
	</div>

	<!-- <div class="page animated fadeinright"> -->
		<!-- Order Recap -->
<!-- 
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

	-->
	<!-- </div> -->

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
.demo-card-wide.mdl-card {
	width: 640px;
	height: 100%;

}

.mdl-card__actions {

	outline: skyblue solid 5px;
	z-index: 4;


}
#name {
	display:flex;
	margin-top: 10px;
	justify-content: left;
}

#contact{
	diplay: flex;

}


.mdl-button {
	// outline: red solid 5px; 
	margin-left: 10px ;

}
.demo-card-wide {
	height: 200px;
	// outline: limegreen 10px solid;
}


.demo-card-wide > .mdl-card__title {
	color: #fff;
	height: 64px;
	background-color:indigo;
}

.mdl-card__title-text {
	position: relative;
	top: -2px;

}

.demo-card-wide > .mdl-card__menu {
	color: #fff;
}


#mycard {
	height: 600px;
	width:100%;
	display:flex;
	flex-direction: row;
	// outline: red solid 10px;
	justify-content: center;
	align-items: center;
}

.mdl-textfield {
	width: 250px;
	margin-right: 10px;
}
</style>