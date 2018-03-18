<!DOCTYPE html>
<html> 
<head> 
 <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
 <title>Google Maps API v3 Directions Example</title> 
</head> 
<body style="font-family: Arial; font-size: 12px;"> 
 <div style="width: 600px;">
   <div id="map" style="width: 280px; height: 400px; float: left;"></div> 
   <div id="panel" style="width: 300px; float: right;"></div> 
 </div>


 <script async defer
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4n9WHPJ0vhZVIR7rhjZdz_OZ-KrrrEpA&libraries=geometry,places&callback=initMap">
</script>
<script type="text/javascript"> 

  function initMap(){
   var directionsService = new google.maps.DirectionsService();
   var directionsDisplay = new google.maps.DirectionsRenderer();

   var map = new google.maps.Map(document.getElementById('map'), {
     zoom:7,
     mapTypeId: google.maps.MapTypeId.ROADMAP
   });

   directionsDisplay.setMap(map);
   directionsDisplay.setPanel(document.getElementById('panel'));

   var request = {
    origin: 'SM Seaside ', 
    destination: 'Cebu City Hall',
    travelMode: google.maps.DirectionsTravelMode.DRIVING
   };

   directionsService.route(request, function(response, status) {
     if (status == google.maps.DirectionsStatus.OK) {
       directionsDisplay.setDirections(response);
     }
   });
 
 }
</script> 
</body> 
</html>