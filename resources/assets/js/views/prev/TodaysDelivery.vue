<template>


  <div>
    <div class="floating-button animated bouncein delay-3">
      <a class="btn-floating btn-large waves-effect waves-light accent-color btn z-depth-1">
        <i class="ion-ios-cart"></i>
      </a>
    </div>
    <gmap-map id="map" 
    :center="center" 
    style="width: 100%; height: 100vh;" :options="mapOptions">

      <gmap-marker 
      :key="index" 
      :icon="'http://localhost/dist/img/marker.png'"
      v-for="(m, index) in markers"
      :position="center = m.position" 
      :clickable="true" :draggable="true" @click="center=m.position">


    </gmap-marker>

  </gmap-map>
</div>



</div>


</template>

<style>
#map { 
	width: 100%;
	height: 100vh;

}
</style>

<script>

import * as VueGoogleMaps from 'vue2-google-maps' ; 
import ControlButtons from './components/ControlButtons.vue';

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCZWTTkguiQpNFtckZZ5lpJLvVvMc0hsmI',
    libraries: ['places','geometry']
  }
});

import swal from 'sweetalert';
export default {
  data(){
    return {
     coordinates : [], 
     center: {  
      lat: 10.2929,
      lng: 123.9016
    },

    markerOptions : { 


    },

    mapOptions: {
      disableDefaultUI : true,
      
      zoom : 20, 
      
      mapTypeControl: true , 

      styles:[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}],

    },
    markers: 
    [
    {
      position: 
      {
        lat: 10.2929,
        lng: 123.9016
      }
    }
    ]
  }
},

mounted(){


},

created(){
  this.showAlert(); 
  this.fetchDeliveryInformation();
},


methods: {




  findMyLocation(){

  },


  calculateRoute(start,routes){

  },


  fetchDeliveryInformation(){
    axios.get('api/v1/delivery/information')
    .then(response => this.coordinates = response.data)
    .catch(error => console.log(error.response.data));
  },

  route(){



  },



  showAlert(){
    swal("Alert!", "Mypharma defaults the locatiosn to the City Hall but you can still use your location", "info");
  }


}
};
</script>
