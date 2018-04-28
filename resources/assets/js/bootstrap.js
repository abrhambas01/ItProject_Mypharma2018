import axios from 'axios';

import Vue from 'vue';

import VueRouter from 'vue-router';

// import Vuetify from 'vuetify'


// import Echo from 'laravel-echo';

window.Vue = Vue;

window.axios = axios;

window.axios.defaults.headers.common = {
	
	'X-Requested-With': 'XMLHttpRequest'

};


// window.Pusher = require('pusher-js');

Vue.use(VueRouter);

Vue.prototype.authorize = function (...params) {


	
}

// Vue.use(Vuetify);

// window.Echo = new Echo({
// 	broadcaster: 'pusher',
// 	key: 'fdf086cdb1883a504a94',
// 	cluster : 'ap1',	 
// 	encrypted : true
// });









// import vuetifyCss from 'vuetify/dist/vuetify.min.css';






