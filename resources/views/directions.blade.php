<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
 <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
 <title>TSP</title>
 <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
 <style>
   body {
    padding: 0px;
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.5;
    font-size: 14px;
  }
  .tabs-menu {
    height: 30px;
    float: left;
    clear: both;
  }
  .tabs-menu li {
    height: 30px;
    line-height: 30px;
    float: left;
    margin-right: 10px;
    background-color: #ccc;
    border-top: 1px solid #d4d4d1;
    border-right: 1px solid #d4d4d1;
    border-left: 1px solid #d4d4d1;
  }
  .tabs-menu li.current {
    position: relative;
    background-color: #fff;
    border-bottom: 1px solid #fff;
    z-index: 5;
  }
  .tabs-menu li a {
    padding: 0px;
    text-transform: uppercase;
    color: #fff;
    text-decoration: none;
  }
  .tabs-menu .current a {
    color: #2e7da3;
  }
  .tab {
    border: 2px solid #d4d4d1;
    background-color: #fff;
    float: left;
    margin-bottom: 0px;
    width: auto;
  }
  .tab-content {
    width: 88%;
    padding: 10px;
    display: none;
  }
  #tab-1 {
    display: block;
  }
</style>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
{{-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> --}}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZWTTkguiQpNFtckZZ5lpJLvVvMc0hsmI&libraries=geometry,places"></script>


<script type="text/javascript">
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var origin = null;
  var destination = null;
  var waypoints = [];
  var markers = []; 
  var directionsVisible = false;

  function initialize() {

    directionsDisplay = new google.maps.DirectionsRenderer();
    
    var bryan = new google.maps.LatLng(30.595, -96.4155);
    
    var myOptions = {
      zoom: 11,
    
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    
      center: bryan
    
    }
    
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
    directionsDisplay.setMap(map);
    
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));

    google.maps.event.addListener(map, 'click', function(event) {
      if (origin == null) {
    
        origin = event.latLng;
    
        addMarker(origin);
    
      } else if (destination == null) {
    
        destination = event.latLng;
    
        addMarker(destination);
      } else {

        if (waypoints.length < 30) {
        
          waypoints.push({
            location: destination,
            stopover: true
          });
          destination = event.latLng;
          addMarker(destination);
        } else {
          alert("Maximum number of waypoints reached");
        }
      }
    });

  }

  function addMarker(latlng) {
    markers.push(new google.maps.Marker({
      position: latlng,
      map: map,
      icon: "http://maps.google.com/mapfiles/marker" + String.fromCharCode(markers.length + 65) + ".png"
    }));
  }

  function calcRoute() {
    if (origin == null) {
      alert("Click on the map to add a start point");
      return;
    }

    if (destination == null) {
      alert("Click on the map to add an end point");
      return;
    }

    var mode;
    switch (document.getElementById("mode").value) {
      case "bicycling":
      mode = google.maps.DirectionsTravelMode.BICYCLING;
      break;
      case "driving":
      mode = google.maps.DirectionsTravelMode.DRIVING;
      break;
      case "walking":
      mode = google.maps.DirectionsTravelMode.WALKING;
      break;
    }

    var request = {
      origin: origin,
      destination: destination,
      waypoints: waypoints,
      travelMode: mode,
      optimizeWaypoints: document.getElementById('optimize').checked,
      avoidHighways: document.getElementById('highways').checked,
      avoidTolls: document.getElementById('tolls').checked
    };

    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });

    clearMarkers();
    directionsVisible = true;
  }

  function updateMode() {
    if (directionsVisible) {
      calcRoute();
    }
  }

  function clearMarkers() {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
  }

  function clearWaypoints() {
    markers = [];
    origin = null;
    destination = null;
    waypoints = [];
    directionsVisible = false;
  }

  function reset() {
    clearMarkers();
    clearWaypoints();
    directionsDisplay.setMap(null);
    directionsDisplay.setPanel(null);
    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));
  }
</script>

<script>  
  $(document).ready(function () {
    $(".tabs-menu a").click(function (event) {
      event.preventDefault();
      $(this).parent().addClass("current");
      $(this).parent().siblings().removeClass("current");
      var tab = $(this).attr("href");
      $(".tab-content").not(tab).css("display", "none");
      $(tab).fadeIn();
    });
  });
</script>
<body onload="initialize()" style="font-family: sans-serif;">
  <div data-role="page" class="jqm-demos ui-responsive-panel" id="panel-responsive-page1" data-title="Panel responsive page">
    <div data-role="header">
     <h1>Traveling Salesman</h1>
     <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
     <a href="#add-form" data-icon="gear" data-iconpos="notext">Add</a>

   </div>
   <!-- /header -->
   <div data-role="content" class="ui-content jqm-content jqm-fullwidth">
    <h1>Traveling Salesman-click adds stops, 10 stops max.</h1>

    <div data-demo-html="#panel-responsive-page1">
      <table style="width: 400px">
        <th></th>
        <tr>
          <td>
            <input type="checkbox" id="optimize" checked="checked" />Optimize</td>
            <td>
              <select id="mode" onchange="updateMode()">
                <option value="bicycling">Bicycling</option>
                <option value="driving">Driving</option>
                <option value="walking">Walking</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" id="highways" checked />Avoid highways</td>
              <td>
                <input type="button" value="Reset" onclick="reset()" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="checkbox" id="tolls" checked />Avoid tolls</td>
                <td>
                  <input type="button" value="Get Directions!" onclick="calcRoute()" />
                </td>
                <td></td>
              </tr>
            </table>
            <div style="position:relative; border: 1px; width: 99%; height: 400px;">
              <div id="map_canvas" style="border: 1px solid black; position:absolute; width:55%; height:398px"></div>
              <div id="directionsPanel" style="float:right; width:40%; height:400px; overflow: auto;"></div>
            </div>
          </div>
          <!--/demo-html -->
        </div>
        <!-- /content -->
        <div data-role="panel" data-display="push" data-theme="b" id="nav-panel">
          <ul data-role="listview">
            <li data-icon="delete"><a href="#" data-rel="close">Close menu</a>

            </li>
            <li><a href="#panel-responsive-page2">Tabs</a>

            </li>
            <li><a href="#panel-responsive-page2">Ajax Navigation</a>

            </li>
            <li><a href="#panel-responsive-page2">Autocomplete</a>

            </li>
          </ul>
        </div>
        <!-- /panel -->
        <div data-role="panel" data-position="right" data-display="overlay" data-theme="a" id="add-form">
          <form class="userform">
            <h2>Login</h2>

            <label for="name">Username:</label>
            <input type="text" name="name" id="name" value="" data-clear-btn="true" data-mini="true">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="" data-clear-btn="true" autocomplete="off" data-mini="true">
            <div class="ui-grid-a">
              <div class="ui-block-a"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-b ui-mini">Cancel</a>

              </div>
              <div class="ui-block-b"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-mini">Save</a>

              </div>
            </div>
          </form>
        </div>
        <!-- /panel -->
      </div>
      <!-- /page -->
      <div data-role="page" id="panel-responsive-page2">
        <div data-role="header"> <a href="#panel-responsive-page1" class="ui-icon-back" data-iconpos="notext" data-icon="back"></a>

         <h1>Page 2</h1>

       </div>
       <!-- /header -->
       <div data-role="content" class="ui-content jqm-content">
        <div id="tabs-container">
          <ul class="tabs-menu">
            <li class="current"><a href="#tab-1">Tab 1</a>

            </li>
            <li><a href="#tab-2">Tab 2</a>

            </li>
            <li><a href="#tab-3">Tab 3</a>

            </li>
            <li><a href="#tab-4">Tab 4</a>

            </li>
          </ul>
          <div class="tab">
            <div id="tab-1" class="tab-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet purus urna. Proin dictum fringilla enim, sit amet suscipit dolor dictum in. Maecenas porttitor, est et malesuada congue, ligula elit fermentum massa, sit amet porta odio est at velit. Sed nec turpis neque. Fusce at mi felis, sed interdum tortor. Nullam pretium, est at congue mattis, nibh eros pharetra lectus, nec posuere libero dui consectetur arcu. Quisque convallis facilisis fermentum. Nam tincidunt, diam nec dictum mattis, nunc dolor ultrices ipsum, in mattis justo turpis nec ligula. Curabitur a ante mauris. Integer placerat imperdiet diam, facilisis pretium elit mollis pretium. Sed lobortis, eros non egestas suscipit, dui dui euismod enim, ac ultricies arcu risus at tellus. Donec imperdiet congue ligula, quis vulputate mauris ultrices non. Aliquam rhoncus, arcu a bibendum congue, augue risus tincidunt massa, vel vehicula diam dolor eget felis.</p>
            </div>
            <div id="tab-2" class="tab-content">
              <p>Donec semper dictum sem, quis pretium sem malesuada non. Proin venenatis orci vel nisl porta sollicitudin. Pellentesque sit amet massa et orci malesuada facilisis vel vel lectus. Etiam tristique volutpat auctor. Morbi nec massa eget sem ultricies fermentum id ut ligula. Praesent aliquet adipiscing dictum. Suspendisse dignissim dui tortor. Integer faucibus interdum justo, mattis commodo elit tempor id. Quisque ut orci orci, sit amet mattis nulla. Suspendisse quam diam, feugiat at ullamcorper eget, sagittis sed eros. Proin tortor tellus, pulvinar at imperdiet in, egestas sed nisl. Aenean tempor neque ut felis dignissim ac congue felis viverra.</p>
            </div>
            <div id="tab-3" class="tab-content">
              <p>Duis egestas fermentum ipsum et commodo. Proin bibendum consectetur elit, hendrerit porta mi dictum eu. Vestibulum adipiscing euismod laoreet. Vivamus lobortis tortor a odio consectetur pulvinar. Proin blandit ornare eros dictum fermentum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur laoreet, ante aliquet molestie laoreet, lectus odio fringilla purus, id porttitor erat velit vitae mi. Nullam posuere nunc ut justo sollicitudin interdum. Donec suscipit eros nec leo condimentum fermentum. Nunc quis libero massa. Integer tempus laoreet lectus id interdum. Integer facilisis egestas dui at convallis. Praesent elementum nisl et erat iaculis a blandit ligula mollis. Vestibulum vitae risus dui, nec sagittis arcu. Nullam tortor enim, placerat quis eleifend in, viverra ac lacus. Ut aliquam sapien ut metus hendrerit auctor dapibus justo porta.</p>
            </div>
            <div id="tab-4" class="tab-content">
              <p>Proin sollicitudin tincidunt quam, in egestas dui tincidunt non. Maecenas tempus condimentum mi, sed convallis tortor iaculis eu. Cras dui dui, tempor quis tempor vitae, ullamcorper in justo. Integer et lorem diam. Quisque consequat lectus eget urna molestie pharetra. Cras risus lectus, lobortis sit amet imperdiet sit amet, eleifend a erat. Suspendisse vel luctus lectus. Sed ac arcu nisi, sit amet ornare tellus. Pellentesque nec augue a nibh pharetra scelerisque quis sit amet felis. Nullam at enim at lacus pretium iaculis sit amet vel nunc. Praesent sapien felis, tincidunt vitae blandit ut, mattis at diam. Suspendisse ac sapien eget eros venenatis tempor quis id odio. Donec lacus leo, tincidunt eget molestie at, pharetra cursus odio.</p>
            </div>
          </div>
        </div>
      </div>
      <!-- /content -->
    </div>
    <!-- /page -->
  </body>
  </html>