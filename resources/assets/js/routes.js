
import VueRouter from 'vue-router';

import Home from './views/Home.vue';
import Account from './views/Account.vue' ; 

const routes = [ 	
{
	path: '/', 
	component: Home
},
{
	path : '/account', 
	component: Account
}

];

export default new VueRouter({
	routes,
	linkActiveClass: 'is-active'
});