import GMaps from 'gmaps';
import $ from 'jquery';


$(document).ready(function(){

	initMap();

	function initMap(){
		var map = new GMaps({
			div : "#map", 
			zoom : 20 , 
			styles:[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}],

		});

		GMaps.geolocate({
			success: function(position) {

				map.setCenter(position.coords.latitude, position.coords.longitude);

				map.addMarker({
					lat: position.coords.latitude,
					lng: position.coords.longitude,
						// icon : 'dist/img'
						title: 'My Location',
						infoWindow: {
							content: '<p>Your Location</p>'
						}
					});	

			},
			error: function(error) {
				alert('Geolocation failed: '+error.message);
			},
			not_supported: function() {
				alert("Your browser does not support geolocation");
			},
			always: function() {
				console.log('found you');
			}
		});

		getDeliveries();


	}



	// function getDeliveries(){
	// 	$.ajax({
	// 		method : 'GET',
	// 		url    : '/api/v1/parcels/to-deliver',
	// 		success : function(response){
	// 			console.log(response);
	// 		},
	// 		error : function (){

	// 		}

	// 	})			

	// }

	

});





 // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
      	var map = new google.maps.Map(document.getElementById('map'), {
      		center: {lat: -33.8688, lng: 151.2195},
      		zoom: 13
      	});
      	var card = document.getElementById('pac-card');
      	var input = document.getElementById('pac-input');
      	var types = document.getElementById('type-selector');
      	var strictBounds = document.getElementById('strict-bounds-selector');

      	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

      	var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
        	map: map,
        	anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
        	infowindow.close();
        	marker.setVisible(false);
        	var place = autocomplete.getPlace();
        	if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
          	map.fitBounds(place.geometry.viewport);
          } else {
          	map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
        	address = [
        	(place.address_components[0] && place.address_components[0].short_name || ''),
        	(place.address_components[1] && place.address_components[1].short_name || ''),
        	(place.address_components[2] && place.address_components[2].short_name || '')
        	].join(' ');
        }

        infowindowContent.children['place-icon'].src = place.icon;
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);
    });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
        	var radioButton = document.getElementById(id);
        	radioButton.addEventListener('click', function() {
        		autocomplete.setTypes(types);
        	});
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
        .addEventListener('click', function() {
        	console.log('Checkbox clicked! New state=' + this.checked);
        	autocomplete.setOptions({strictBounds: this.checked});
        });
    }