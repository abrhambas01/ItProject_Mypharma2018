
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>Custom controls</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Lato', sans-serif;
      font-size: 16px;
    }
    /*variables*/
    @blue: #1647ff;

    .map-viewport {
      position: relative;
      width: 100%;
      height: 100%;
      .map {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
      }

      .btn {
        cursor: pointer;
        border: 0;
        border-radius: 2px;
        background-color: white;
        box-shadow: 1px 1px 3px 0 rgba(0,0,0,0.1);
        transition: all 300ms ease-in-out;
        &.zoom {
          position: absolute;
          left: 20px;
          color: @blue;
          font-size: 20px;
          padding: 5px 8px;
          &.in{
            top: 50%;
            margin-top: -37px;
          }
          &.out {
            bottom: 50%;
            margin-bottom: -37px;
          }
          &.center {
            top: 50%;
            margin-top: -87px; 
          }
          &:hover, &:active {
            color: white;
            background-color: @blue;
          }
          &:active {
            opacity: 0.75; 
          }
        }
      }

      .markers-list {
        position: absolute;
        top: 0;
        left: 0;
        > li {
          display:block; 
          position:absolute; 
          left:0; 
          top:-5555px; 
          width:1px;
          height:1px; 
          z-index:90;
          div {
            display:table; 
            width:100px;
            height:100px; 
            border:0; 
            opacity: 0;
            outline:0; 
            cursor:pointer;
            text-transform: uppercase;
            color:white;
            background-color: @blue;
            overflow:hidden;
            padding: 8px;

            transform: scale(0.2);
            border-radius: 50%;
            transition: all 200ms ease-in-out; 

            p {
              display:table-cell; 
              width:85px; 
              margin:0 auto; 
              overflow:hidden;
              vertical-align:middle; 
              text-align:center; 
              background:none; 
              opacity:0;
              line-height: 12px;
              transition: opacity 200ms ease-in-out 100ms;
            }

            &:hover, &.active {
              transform: scale(1);
              opacity: 1;
              p {
                opacity:1;
              }
            }
          }
        }
      }

      .mapTypeId {
        position: absolute;
        top: 20px;
        left: 20px;
        border-radius: 2px;
        background-color: white;
        box-shadow: 1px 1px 3px 0 rgba(0,0,0,0.1);
        width: 175px;
        overflow: hidden;
        background: #fff url("http://www.scottgood.com/jsg/blog.nsf/images/arrowdown.gif") no-repeat 90% 50%;
        color: black;
        padding: 8px 0;
        i {
          position: absolute;
          top: 10px;
          left: 10px;
        }
        select {
          color: black;
          text-indent: 35px;
          text-transform: uppercase;
          font-weight: 700;
          width: 100%;
          position: relative;
          top: -2px;
          border: none;
          box-shadow: none;
          background-color: transparent;
          background-image: none;
          appearance: none;
          -webkit-appearance: none;
          -moz-appearance: none;
          &:focus {
           outline: none;
         }
       }
     }
   }
 </style>
</head>
<body>
 <div class="map-viewport">
  <div id="map" class="map"></div>

  <!--custom controls-->
  <span id="zoomIn" class="btn zoom in">
    <i class="fa fa-plus"></i>
  </span>
  <span id="zoomOut" class="btn zoom out">
    <i class="fa fa-minus"></i>
  </span>

  <span id="center" class="btn zoom center">
    <i class="fa fa-crosshairs"></i>
  </span>

  <div class="mapTypeId">
    <i class="fa fa-map-o"></i>
    <select id="mapTypeId">
      <option value="1">Roadmap</option>
      <option value="2">Terrain</option>
      <option value="3">Satellite</option>
      <option value="4">My Theme</option>
      <option value="5">RouteXL</option>
    </select>
  </div>

  <!--marker list-->
  <ul class="markers-list"><li><div><p>Blleb</p></div></li></ul>
</div>
<script>
  $(document).ready(function() {
    
    var map;
    var marker;
    var lat = 41.616302;
    var lng = -8.432792;
    var ico = new google.maps.MarkerImage("https://res.cloudinary.com/durky4ga0/image/upload/v1438339086/marker_plnomd.png");
    var markerList = $('.markers-list');
    
    /*Draw Overlay*/
    var overlay = new google.maps.OverlayView();
    overlay.draw = function() {};

  // Goole Maps SKIN
  var styleGrey = [{featureType: "administrative",elementType: "all",stylers: [{ visibility: "off" }]},{featureType: 'landscape',elementType: 'all',stylers: [{ hue: '#FFFFFF' },{ saturation: -100 },{ lightness: 100 },{ visibility: 'on' }]},{featureType: "poi",elementType: "all",stylers: [{ visibility: "off" }]},{featureType: "road",elementType: "all",stylers: [{ visibility: "on" },{ lightness: -30 }]},{featureType: "transit",elementType: "all",stylers: [{ visibility: "off" }]},{featureType: "water",elementType: "all",stylers: [{ saturation: -100 },{ lightness: -100 }]},{featureType: "all",elementType: "all",stylers: [{ saturation: -100 },{ lightness: 91 }]}];
  // Ref: https://snazzymaps.com/
  var routeXL = [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}]

  var styledMapOptions = { name: "MYTHEME" }
  var greyMapType = new google.maps.StyledMapType( styleGrey, styledMapOptions );

  var styledSnazzymaps = { name: "RouteXL" }
  var snazzymapsMapType = new google.maps.StyledMapType( routeXL, styledSnazzymaps );
  
  
  function initialize () {
    var mapCanvas = document.getElementById('map');
    var mapOptions = {
      zoom: 13,
      center: {
        lat: lat, 
        lng: lng
      },
      mapTypeControl: false,
      zoomControl: false,
      panControl: false,
      scaleControl: false,
      streetViewControl: false,
      scrollwheel: false
    }

    map = new google.maps.Map( mapCanvas, mapOptions );

    // set overlay map
    overlay.setMap(map);

    // call zoom control
    ZoomControl(map);

      // call add marker
      addMarker(map);

      // call gmap skin
      map.mapTypes.set("MYTHEME", greyMapType);
      map.mapTypes.set("RouteXL", snazzymapsMapType);
    }

  // Add marker and listeners
  function addMarker ( map ) {
    marker = new google.maps.Marker({
      map: map,
      draggable: false,
      icon: ico,
      position: new google.maps.LatLng( lat, lng )
    });

    mouseOverHandler = function () {
      showMarker(marker);
    }
    mouseClickHandler = function () {
      clickMarker(lat, lng);
    }

    google.maps.event.addListener( marker, 'click', mouseClickHandler );
    google.maps.event.addListener( marker, 'mouseover', mouseOverHandler );
  }

  // Marker over animation
  function showMarker ( marker ) {
    var name = 'Blleb';
    var projection = overlay.getProjection();
    var pixel = projection.fromLatLngToContainerPixel( marker.getPosition() );
    var x = pixel.x-58;
    var y = pixel.y-84;

    markerList.find('li').css({"left": x, "top": y});
    markerList.find('p').html( name );
    markerList.fadeIn();
  }

  // Marker click function
  function clickMarker ( lat, lng ) {
    var url = 'https://maps.google.com/maps?q='+lat+','+lng+'&z=18';
    window.open(url, '_blank');
  }

  // Zoom control function
  function ZoomControl ( map ) {
    var zoomIn = document.getElementById('zoomIn');
    var zoomOut = document.getElementById('zoomOut');

    google.maps.event.addDomListener(zoomOut, 'click', function() {
      var currentZoomLevel = map.getZoom();
      if(currentZoomLevel != 0){
        map.setZoom(currentZoomLevel - 1);}     
      });

    google.maps.event.addDomListener(zoomIn, 'click', function() {
      var currentZoomLevel = map.getZoom();
      if(currentZoomLevel != 21){
        map.setZoom(currentZoomLevel + 1);}
      });
  }

  // Map set center
  $( '#center' ).on( 'click', function () {
    map.setZoom( 13 );
    map.setCenter(new google.maps.LatLng( lat, lng ) );
    map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
    $( '#mapTypeId' ).val( "1" ).trigger('click');
  });

  // Change Map TypeId
  function TypeIdChange ( option ) {
    switch (option) {
      case "1":
      map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
      break;
      case "2":
      map.setMapTypeId( google.maps.MapTypeId.TERRAIN );
      break;
      case "3":
      map.setMapTypeId( google.maps.MapTypeId.SATELLITE );
      break;
      case "4":
      map.setMapTypeId( "MYTHEME" );
      break;
      case "5":
      map.setMapTypeId( "RouteXL" );
      break;
      default:
      map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
    }
  }

  $( '#mapTypeId' ).change( function () {
    var self = $(this);
    TypeIdChange( self.val() );
  });

  google.maps.event.addDomListener( window, 'load', initialize );
});
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZWTTkguiQpNFtckZZ5lpJLvVvMc0hsmI&callback=initMap">
</script>
</body>
</html>