export function initMap(){
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 20,
		center:
		{  
			lat: 10.2929,
			lng: 123.9016
		},	
		disableDefaultUI : true,
		styles:[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}],

	});

	var marker = new google.maps.Marker({
		position: this.cityHallLocation,
		map: map
	});

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 20,
		center:this.cityHallLocation ,
		disableDefaultUI : true,
		styles:[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}],

	});


		// var icon = {
		// url: "dist/img/marker.png", // url
		// scaledSize: new google.maps.Size(50, 50), // scaled size
		// origin: new google.maps.Point(0,0), // origin
		// anchor: new google.maps.Point(0, 0) // anchor
		// };

		var marker = new google.maps.Marker({
			position: this.cityHallLocation,
			map: map,
			// icon : icon ,
			draggable : true
		});
    //### Add a button on Google Maps ...
    
    var controlMarkerUI = document.createElement('DIV');
    controlMarkerUI.style.cursor = 'pointer';
    controlMarkerUI.style.backgroundImage = 'dist/img/my_location_white.png' ; 
    controlMarkerUI.style.height = '28px';
    controlMarkerUI.style.width = '25px';
    controlMarkerUI.style.top = '11px';
    controlMarkerUI.style.left = '120px';
    controlMarkerUI.title = 'Click to set the map to Home';
      //myLocationControlDiv.appendChild(controlUI);

      map.controls[google.maps.ControlPosition.LEFT_TOP].push(controlMarkerUI);


      
  }


  function calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map){
		        // First, remove any existing markers from the map.
		        for (var i = 0; i < markerArray.length; i++) {
		        	markerArray[i].setMap(null);
		        }

		        // Retrieve the start and end locations and create a DirectionsRequest using
		        // WALKING directions.
		        directionsService.route({
		        	origin: this.myLocation,
		        	destination: document.getElementById('end').value,
		        	travelMode: 'WALKING'
		        }, function(response, status) {
		          // Route the directions and pass the response to a function to create
		          // markers for each step.
		          if (status === 'OK') {
		          	document.getElementById('warnings-panel').innerHTML =
		          	'<b>' + response.routes[0].warnings + '</b>';
		          	directionsDisplay.setDirections(response);
		          	showSteps(response, markerArray, stepDisplay, map);
		          } else {
		          	window.alert('Directions request failed due to ' + status);
		          }
		      });

		    }