<template>
	<footer class="page-footer primary-color">

		<div class="container">
			<div class="row">
				<div class="col s12">
					<p class="center-align grey-text text-lighten-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, quidemsasd!</p>
					<div class="center-align">
						<i class="ion-social-facebook m-10 white-text"></i>
						<i class="ion-social-twitter m-10 white-text"></i>
						<i class="ion-social-pinterest m-10 white-text"></i>
						<i class="ion-social-dribbble m-10 white-text"></i>
					</div>
				</div>
			</div>
		</div>

		
		<div class="footer-copyright">
			<div class="container">
				2018 Mypharma
				<a class="grey-text text-lighten-4 right" href="!">Privacy Policy</a>
			</div>
		</div>

	</footer>
	

</template>

<style>
* {
	margin: 0;
	padding: 0;
}

html,
body {
	height: 100%;
}

#wrap {
	min-height: 100%;
}

#main {
	overflow: auto;
	padding-bottom: 180px;
	/* must be same height as the footer */
}

#footer {
	position: relative;
	margin-top: -180px;
	/* negative value of footer height */
	height: 180px;
	clear: both;
	background-color: red;
}


/* Opera Fix thanks to Maleika (Kohoutec) */

body:before {
	content: "";
	height: 100%;
	float: left;
	width: 0;
	margin-top: -32767px;
	/* thank you Erik J - negate effect of float*/
}
</style>

