<template>
  <div>
    <h1>shortest path calculator (TSP algorithme)</h1>
    <h6>click to put markers on positions and then click on calculate</h6>
    <gmap-map
      ref="map"
      class="map"
      v-if="mapLoaded"
      :center="center"
      :zoom="13"
      :clickable="true"
      map-type-id="terrain"
      @click="addMarker($event)">
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        :clickable="true"
        :draggable="true"
        @click="deleteMarker($event)">
      </gmap-marker>
    </gmap-map>
    <button @click="calculate()" class="button" >calculer</button>
  </div>
</template>


<script>
  export default {
    data () {
      return {
        mapLoaded: false,
        center: null,
        markers: null
      }
    },
    mounted(){
      this.locateMe().then((location) => {
        this.center = {lat: location.latitude, lng: location.longitude}
        this.mapLoaded = true;
        this.markers = [{
          position: this.center
        }]
      });
    },
    methods: {
      addMarker: function ($event) {
        this.markers.push({position: {lat: $event.latLng.lat(), lng: $event.latLng.lng()}});
      },
      deleteMarker: function ($event) {
        this.markers.splice(this.markers.indexOf({position: {lat: $event.latLng.lat(), lng: $event.latLng.lng()}}), 1);
      },
      DisplayRoute: function (directionsService, directionsDisplay, start, destination, waypoints) {
        directionsService.route({
          origin: start,
          destination: destination,
          waypoints: waypoints,
          travelMode: 'WALKING'
        }, function (response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      },
      calculate: function () {
        var tab = [{
          "name": "location 0 ",
          "latitude": this.markers[0].position.lat,
          "longitude": this.markers[0].position.lng,
          "origin": true
        }]
        for (var i = 1; i < this.markers.length; i++) {
          var obj = {
            "name": 'location ' + i,
            "latitude": this.markers[i].position.lat,
            "longitude": this.markers[i].position.lng
          }
          tab.push(obj)
        }
        var directionsService = new google.maps.DirectionsService
        var directionsDisplay = new google.maps.DirectionsRenderer
        directionsDisplay.setMap(this.$refs.map.$mapObject)
        this.axios.post('http://localhost:8080/api/tsp', tab).then((response) => {
          console.log(response)
          var markerArray = []
          for (var i = 1; i < response.data.length; i++) {
            markerArray.push({location: {lat: response.data[i].latitude, lng: response.data[i].longitude}})
          }
          console.log(markerArray)
          this.DisplayRoute(directionsService, directionsDisplay, this.markers[0].position, this.markers[0].position, markerArray);
        })
      },
      locateMe: function () {
        return new Promise((resolve, reject) => {
          if (navigator && navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
              resolve(position.coords)
            });
          } else {
            const error = "Unable to retrieve your geolocation."
            reject(new Error(error))
          }
        })
      }
    }
  }
</script>

<style>
  .map {
    position: relative;
    height: 90px;
    width: 150vh;
    min-height: 90vh;
    min-width: 150vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }
  .button {
    height: 40px;
    width: 100px;
  }
</style>