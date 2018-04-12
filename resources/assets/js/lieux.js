lieux = [
    {"nom": "place1", "icon": "galerie.png", "coordinates": [46.2018773, 6.1396896]},
    {"nom": "place2", "icon": "galerie.png", "coordinates": [46.1989726, 6.1371983]},
    {"nom": "place3", "icon": "galerie.png",    "coordinates": [46.1976313, 6.1382951]},
    {"nom": "place4", "icon": "galerie.png", "coordinates": [46.1997394, 6.1388766]}
];	



function errorfunction(error){
    console.log(error);
};   

function successfunction(position){
    myLatitude = position.coords.latitude;
    myLongitude = position.coords.longitude;
};

calcul_itin = function() {                                                              
    origin = myLatitude+","+myLongitude;                                                
    for (i = 0; i < place.length; i++) {
        lieuxLat = place[i].coordinates[0];                                             
        lieuxLong = place[i].coordinates[1];
        destination = placeLat+","+placeLong;                                           
    }
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.WALKING                      
        }
        var directionsService = new google.maps.DirectionsService();                    
        directionsService.route(request, function(response, status){                    
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response);                                      
            }
        });
    }; 
};






var directionRenderers = [];    // array for keeping track of renderers
calcul_itin = function(origin) {
    // Remove previous renderers
    for (var i=0; i < directionRenderers.length; i++) {
        directionRenderers[i].setMap(null);
    }

    directionRenderers = [];
    // create a request for each destination
    for (i = 0; i < lieux.length; i++) {    // guess destinations are in lieux...
        var dest = lieux[i].coordinates[0] +','+ lieux[i].coordinates[1];
        var request = {
            origin: origin,     // assume origin is an instance of google.maps.LatLng
            destination: dest,
            travelMode: google.maps.DirectionsTravelMode.WALKING
        };
        var directionsService = new google.maps.DirectionsService(); 
        directionsService.route(request, function(response, status){                    
            if(status == google.maps.DirectionsStatus.OK){
                // create a new DirectionsRenderer for this route
                var dirRenderer = new google.maps.DirectionsRenderer({map: map});
                dirRenderer.setDirections(response);
                directionRenderers.push(dirRenderer);   // track the renderers
            }
        });
    }
};