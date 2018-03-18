this.directionsService = new google.maps.DirectionsService()
this.directionsDisplay = new google.maps.DirectionsRenderer()
this.directionsDisplay.setMap(this.$refs.map.$mapObject)
var vm = this
vm.directionsService.route({
      origin: this.coords, // Can be coord or also a search query
      destination: this.destination,
      travelMode: 'DRIVING'
    }, function (response, status) {
      if (status === 'OK') {
        vm.directionsDisplay.setDirections(response) // draws the polygon to the map
      } else {
        console.log('Directions request failed due to ' + status)
      }
})