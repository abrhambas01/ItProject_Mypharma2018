import VueRouter from 'vue-router';

import Home from './pages/Home.vue';

import Account from './pages/Account.vue' ; 

import ToPack from './pages/ToPack.vue';

import StartDelivering from './pages/StartDelivering.vue';

const routes = [ 	
{

	/**
	Homepage for Courier
	*/
	path: '/courier/:id' , 	
	name : 'courierHome',
	component: Home,	
	children : 
	[ 

	{ path : 'to-pack', name: 'toPack', component : ToPack, }, 
	
	{ path : 'start-delivering', name : 'startDelivery' , component : StartDelivering }	
	
	]
},
{
	path : '/account', 	
	name : 'account',
	component: Account
}, 
{ 
	path : '/', 
	name : 'dashboard',
	component : Home
}



];

export default new VueRouter({
	routes,
	linkActiveClass: 'is-active'
});