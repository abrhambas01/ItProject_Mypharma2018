import './bootstrap';

import './components';



import router   from './routes';

import App from './views/App.vue';



// import VueGeolocation from 'vue-browser-geolocation';

// Vue.use(VueGeolocation);

const app = new Vue({
	el :'#app',
	render: h => h(App),
	router 
});	



