<template>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
	mdl-layout--fixed-tabs">
	<header class="mdl-layout__header">
		<div class="mdl-layout__header-row">
			<!-- Title -->
			<span class="mdl-layout-title">Home</span>
		</div>
		<!-- Tabs -->
		<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
			<a href="#fixed-tab-1" class="mdl-layout__tab">Parcels to Pack in us</a>
			<a href="#fixed-tab-2" class="mdl-layout__tab">Start Delivering</a>
		</div>
	</header>
	<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
		<header class="demo-drawer-header">
			<img src="images/user.jpg" class="demo-avatar">
			<div class="demo-avatar-dropdown">
				<span>hello@example.com</span>
				<div class="mdl-layout-spacer"></div>
				<button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
					<i class="material-icons" role="presentation">arrow_drop_down</i>
					<span class="visuallyhidden">Accounts</span>
				</button>
				<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
					<li class="mdl-menu__item">hello@example.com</li>
					<li class="mdl-menu__item">info@example.com</li>
					<li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
				</ul>
			</div>
		</header>
		<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
			<router-link to="/" class="mdl-navigation__link">
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home
			</router-link>

			<router-link to="/account" class="mdl-navigation__link">
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>Account
			</router-link>
		</nav>
	</div>
	<main class="mdl-layout__content">

		<router-view></router-view>

	</main>
</div>
</template>

<script>
	export default {	
		data(){
			return { 
				pageTitle : 'Mypharma Home',
				username : 'ok'

			}
		},

	};

</script>


<style>
	span.username {
		font-size:15px;
	}
</style>