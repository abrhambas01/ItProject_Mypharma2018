/******
------------------------
Mypharma JS File 

---Jquery libary with GMaps.js--
User : Abrham Bas
Date : March 22,2018
------------------------
**/

$(document).ready(function(){

  $('#p2').hide() ; 

  initMap(); 


  var locations = [] ; 

  var cachedDirections  = false ; 

  var wayArr ; 



});




function getDeliveries(url){

  // $.get(url, function(response){
    // console.log(response);
  // var coords = [] ; 

  // $.each(data,function(key,value) { 
  //   coords.push(data);
  // });

  $.ajax({
    url: url,
    type: 'GET',
    async: false,
    success: function(data) {
      result = data;
    }
  });

  return result;

}


/**

1- called it a - z or One way

**/
function directions(mode,k) {
  console.log(mode,k);

  var cachedDirections = false ; 


  if (cachedDirections) { 
    doTsp(mode);
  }

  wayArr = new Array();
  numActive = 0;
  numDirectionsComputed = 0;
  for (var i = 0; i < waypoints.length; ++i) {
    if (wpActive[i]) ++numActive;
  }
  numDirectionsNeeded = numActive * (numActive - 1);

  for (var i = 0; i < waypoints.length; ++i) {
    if (wpActive[i]) {
      wayArr.push(makeDirWp(waypoints[i], addresses[i]));
      getWayArr(i);
      break;
    }

  }

}


/** 

Uses algorithms in providing the route

**/

function optimizeRoute(position,data) {
  // $.each(data)

  console.log(data);

  $.each(data, function (key,value) { 

    var coords = { 
      "lat" :value.position.lat , 
      "lng" : value.position.lng ,
      "owner" : value.position.full_name,
      "parcel_id" : value.position.id,
    } ;


    coords.push(waypoints) ; 


  }); 






  // val = val.replace(/\t/g, ' ');
  // document.listOfLocations.inputList.value = val;
  // addList(val);



}



/**

calculates the routes and draw it to the map..

***/
function calculateRoute(position,urlToRetrieve){

// populate the destinations with the result from ajax with latlng coordinates / Store it into the coords array.
var response = getDeliveries(urlToRetrieve) ; 

// make the algorithm work w/ ANT COLONY ..
optimizeRoute(position, response);

/* Drawing a route.. with GMaps*/





map.drawRoute({ 
  origin: [ position.coords.latitude, position.coords.longitude],
  destination: [10.30356400, 123.89964100],
  avoidHighways : true , 
  travelMode: 'driving',
  strokeColor: '#000',
  strokeOpacity: 0.6,
  strokeWeight: 6
});



}









//Places all the markers.. called upon the initialization of the app.

function placeMarkers(url){
  console.log(url);

  $.getJSON(url,function(data){

    // $.each(data,)

    $.each( data, function( key, value ) {
      map.addMarker({
        lat: value.position.lat,
        lng: value.position.lng,
        title: 'Lima',
        details: {
          database_id: 42,
          author: 'HPNeo'
        },
        click: function(value){
          alert(value.position.id);
        },
        mouseover: function(e){
          if(console.log)
            console.log(e);
        }
      });
    });


  });


}




function initMap() {

//Written with Gmaps examples. initMap()
map = new GMaps({
  el: '#map',
  lat: -12.043333,
  lng: -77.028333,  
  zoom : 19, 
  zoomControl : true,
  zoomControlOpt: {
    style : 'SMALL',
    position: 'TOP_LEFT'
  },
  panControl : false,
  streetViewControl : false,
  mapTypeControl: false,
  overviewMapControl: false
});

var styles = [{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#f3f4f4"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"weight":0.9},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#83cead"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#7fc8ed"}]}]



map.addStyle({
  styledMapName:"Styled Map",
  styles: styles,
  mapTypeId: "map_style"  
});

map.setStyle("map_style");


GMaps.geolocate({
  success: function(position){

    map.addMarker({
      lat: position.coords.latitude,
      lng: position.coords.longitude,
      title: 'Current Location',
      details: 
      {
        database_id: 42,
        author: 'HPNeo'
      },
      click: function(e){
        if(console.log)
          console.log(e);
        alert(title);
      },
      mouseover: function(e){
        if(console.log)
          console.log(e);
      }
    });

    dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });

    dialog.querySelector('.route').addEventListener('click', function() {
      // calculateRoute(position,apiGetDeliveriesUrl) ;
      // dialog.close();
      map.panTo({
        lat: position.coords.latitude,
        lng: position.coords.longitude, 
      });

      map.setZoom(19);

    });

    $('#changeMapType').on('click',function(){

      map.setMapTypeId('satellite');

    });


    $('.showMyLocation').on('click',function(){
      map.panTo({
        lat: position.coords.latitude,
        lng: position.coords.longitude, 
      });


      map.setZoom(19);

    });

    map.setCenter(position.coords.latitude, position.coords.longitude);

  },
  error: function(error){
    alert('Geolocation failed: '+error.message);
  },
  not_supported: function(){
    alert("Your browser does not support geolocation");
  },
  always: function(position){
    console.log(position);
  }
});

placeMarkers(apiGetDeliveriesUrl) ; 
var coords = getDeliveries(apiGetDeliveriesUrl)  ;

console.log('Coords'+coords);

}
