<!-- Hidden stuff -->
// <div id="dialogBulk" title='Bulk add addresses'>
// <form name="listOfLocations" onSubmit="clickedAddList(); return false;">
// <textarea name="inputList" rows="10" cols="70">One destination per line</textarea><br>
// <input type="button" value="Add list of locations" onClick="clickedAddList();">
// </form>
// </div>






var tsp; // singleton
var gebMap;           // The map DOM object
var directionsPanel;  // The driving directions DOM object
var gebDirectionsResult;    // The driving directions returned from GMAP API
var gebDirectionsService;
var gebGeocoder;      // The geocoder for addresses
var maxTspSize = 100;  // A limit on the size of the problem, mostly to save Google servers from undue load.
var maxTspBF = 0;     // Max size for brute force, may seem conservative, but ma
var maxTspDynamic = 15;     // Max size for brute force, may seem conservative, but many browsers have limitations on run-time.
var maxSize = 10;     // Max number of waypoints in one Google driving directions request.
var maxTripSentry = 2000000000; // Approx. 63 years., this long a route should not be reached...
var avoidHighways = false; // Whether to avoid highways. False by default.
var avoidTolls = false; // Whether to avoid toll roads. False by default.
var travelMode;
var distIndex;
var waypoints = new Array();
var addresses = new Array();
var GEO_STATUS_MSG = new Array();
var DIR_STATUS_MSG = new Array();
var labels = new Array();
var addr = new Array();
var wpActive = new Array();
var addressRequests = 0;
var addressProcessing = false;
var requestNum = 0;
var currQueueNum = 0;
var wayArr;
var legsTmp;
var distances;
var durations;
var legs;
var dist;
var dur;
var visited;
var currPath;
var bestPath;
var bestTrip;
var nextSet;
var numActive;
var costForward;
var costBackward;
var improved = false;
var chunkNode;
var okChunkNode;
var numDirectionsComputed = 0;
var numDirectionsNeeded = 0;
var cachedDirections = false;
var requestLimitWait = 1000;
var fakeDirResult; // Object used to store travel info like travel mode etc. Needed for route renderer.

var onSolveCallback = function(){};
var onProgressCallback = null;
var originalOnFatalErrorCallback = function(tsp, errMsg) { alert("Request failed: " + errMsg); }
var onFatalErrorCallback = originalOnFatalErrorCallback;
var doNotContinue = false;
var onLoadListener = null;
var onFatalErrorListener = null;

var directionunits;


function clickedAddList() {
	var val = document.listOfLocations.inputList.value;
	val = val.replace(/\t/g, ' ');
	document.listOfLocations.inputList.value = val;
	addList(val);
}




function addList(listStr) {
	var listArray = listStr.split("\n");
	for (var i = 0; i < listArray.length; ++i) {
		var listLine = listArray[i];
		if (listLine.match(/\(?\s*\-?\d+\s*,\s*\-?\d+/) ||
			listLine.match(/\(?\s*\-?\d+\s*,\s*\-?\d*\.\d+/) ||
			listLine.match(/\(?\s*\-?\d*\.\d+\s*,\s*\-?\d+/) ||
			listLine.match(/\(?\s*\-?\d*\.\d+\s*,\s*\-?\d*\.\d+/)) {
			// Line looks like lat, lng.
		var cleanStr = listLine.replace(/[^\d.,-]/g, "");
		var latLngArr = cleanStr.split(",");
		if (latLngArr.length == 2) {
			var lat = parseFloat(latLngArr[0]);
			var lng = parseFloat(latLngArr[1]);
			var latLng = new google.maps.LatLng(lat, lng);
			tsp.addWaypoint(latLng, addWaypointSuccessCallbackZoom);
		}
	} else if (listLine.match(/\(?\-?\d*\.\d+\s+\-?\d*\.\d+/)) {
			// Line looks like lat lng
			var latLngArr = listline.split(" ");
			if (latLngArr.length == 2) {
				var lat = parseFloat(latLngArr[0]);
				var lng = parseFloat(latLngArr[1]);
				var latLng = new google.maps.LatLng(lat, lng);
				tsp.addWaypoint(latLng, addWaypointSuccessCallbackZoom);
			}
		} else if (listLine.match(/\S+/)) {
			// Non-empty line that does not look like lat, lng. Interpret as address.
			tsp.addAddress(listLine, addAddressSuccessCallbackZoom);
		}
	}
}


function addWaypoint(latLng, label) {
	var freeInd = -1;
	for (var i = 0; i < waypoints.length; ++i) {
		if (!wpActive[i]) {
			freeInd = i;
			break;
		}
	}
	if (freeInd == -1) {
		if (waypoints.length < maxTspSize) {
			waypoints.push(latLng);
			labels.push(label);
			wpActive.push(true);
			freeInd = waypoints.length-1;
		} else {
			return(-1);
		}
	} else {
		waypoints[freeInd] = latLng;
		labels[freeInd] = label;
		wpActive[freeInd] = true;
	}

	return(freeInd);

}


// <div id='dialogOptions' title='Travel Options'>
// <p>
// <form name="travelOpts">
// <input id='walking' type='checkbox'/> Walking <span class='slowWarn red'></span><br>
// <input id='bicycling' type='checkbox'/> Bicycling <span class='slowWarn red'></span><br>
// <input id='avoidHighways' type='checkbox'/> Avoid highways <span class='slowWarn red'></span><br>
// <input id='avoidTolls' type='checkbox'/> Avoid toll roads <span class='slowWarn red'></span><br>
// <input id='metricUnits' type='checkbox'/> Metric units (km)
// </form>
// </p>
// <p>
// <input class="calcButton" type="button" value="Calculate Fastest Roundtrip" onClick="directions(0, document.forms['travelOpts'].walking.checked, document.forms['travelOpts'].bicycling.checked, document.forms['travelOpts'].avoidHighways.checked, document.forms['travelOpts'].avoidTolls.checked, document.forms['travelOpts'].metricUnits.checked)"/>
// <input class="calcButton" type="button" value="Calculate Fastest A-Z Trip" onClick="directions(1, document.forms['travelOpts'].walking.checked, document.forms['travelOpts'].bicycling.checked, document.forms['travelOpts'].avoidHighways.checked, document.forms['travelOpts'].avoidTolls.checked, document.forms['travelOpts'].metricUnits.checked)"/>
// <input class="calcButton" type="button" value="Calculate In Order" onClick="orderedDirections(document.forms['travelOpts'].walking.checked, document.forms['travelOpts'].bicycling.checked, document.forms['travelOpts'].avoidHighways.checked, document.forms['travelOpts'].avoidTolls.checked, document.forms['travelOpts'].metricUnits.checked)"/>
// </p>
// </div>
function directions(mode) {
	if (cachedDirections) {
// Bypass Google directions lookup if we already have the distance
// and duration matrices.
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

// Roundtrip
if (numActive > maxTspSize) {
	alert("Too many locations! You have " + numActive + ", but max limit is " + maxTspSize);
} else {
	legsTmp = new Array();
	distances = new Array();
	durations = new Array();
	chunkNode = 0;
	okChunkNode = 0;
	if (typeof onProgressCallback == 'function') {
		onProgressCallback(tsp);
	}
	nextChunk(mode);
}
}

function doTsp(mode) {
//alert("doTsp");
// Calculate shortest roundtrip:
visited = new Array();
for (var i = 0; i < numActive; ++i) {
	visited[i] = false;
}
currPath = new Array();
bestPath = new Array();
nextSet = new Array();
bestTrip = maxTripSentry;
visited[0] = true;
currPath[0] = 0;
cachedDirections = true;
if (numActive <= maxTspBF + mode) {
	tspBruteForce(mode, 0, 0, 1);
} else if (numActive <= maxTspDynamic + mode) {
	tspDynamic(mode);
} else {
	tspAntColonyK2(mode);
	tspK3(mode);
}

prepareSolution();
}


function prepareSolution() {
	var wpIndices = new Array();
	for (var i = 0; i < waypoints.length; ++i) {
		if (wpActive[i]) {
			wpIndices.push(i);
		}
	}
	var bestPathLatLngStr = "";
	var directionsResultLegs = new Array();
	var directionsResultRoutes = new Array();
	var directionsResultOverview = new Array();
	var directionsResultBounds = new google.maps.LatLngBounds();
	for (var i = 1; i < bestPath.length; ++i) {
		directionsResultLegs.push(legs[bestPath[i-1]][bestPath[i]]);
	}
	for (var i = 0; i < bestPath.length; ++i) {
		bestPathLatLngStr += makeLatLng(waypoints[wpIndices[bestPath[i]]]) + "\n";
		directionsResultBounds.extend(waypoints[wpIndices[bestPath[i]]]);
		directionsResultOverview.push(waypoints[wpIndices[bestPath[i]]]);
	}
	directionsResultRoutes.push({ 
		legs: directionsResultLegs,
		bounds: directionsResultBounds,
		copyrights: "Map data ©2012 Google",
		overview_path: directionsResultOverview,
		warnings: new Array(),
	});
	gebDirectionsResult = fakeDirResult;
	gebDirectionsResult.routes = directionsResultRoutes;

	if (onFatalErrorListener)
		google.maps.event.removeListener(onFatalErrorListener);
	onFatalErrorListener = google.maps.event.addListener(gebDirectionsService, 'error', onFatalErrorCallback);

	if (typeof onSolveCallback == 'function') {
		onSolveCallback(tsp);
	}
}


function nextChunk(mode) {
//  alert("nextChunk");
chunkNode = okChunkNode;
if (chunkNode < wayArr.length) {
	var wayArrChunk = new Array();
	for (var i = 0; i < maxSize && i + chunkNode < wayArr.length; ++i) {
		wayArrChunk.push(wayArr[chunkNode+i]);
	}
	var origin;
	var destination;
	origin = wayArrChunk[0].location;
	destination = wayArrChunk[wayArrChunk.length-1].location;
	var wayArrChunk2 = new Array();
	for (var i = 1; i < wayArrChunk.length - 1; i++) {
		wayArrChunk2[i-1] = wayArrChunk[i];
	}
	chunkNode += maxSize;
	if (chunkNode < wayArr.length-1) {
		chunkNode--;
	}

	var myGebDirections = new google.maps.DirectionsService();

	myGebDirections.route({
		origin: origin,
		destination: destination,
		waypoints: wayArrChunk2,
		avoidHighways: avoidHighways,
		avoidTolls: avoidTolls,
		unitSystem: directionunits,
		travelMode: travelMode }, 
		function(directionsResult, directionsStatus) {
			if (directionsStatus == google.maps.DirectionsStatus.OK) {
				requestLimitWait = 1000;
//alert("Request completed!");
// Save legs, distances and durations
fakeDirResult = directionsResult;
for (var i = 0; i < directionsResult.routes[0].legs.length; ++i) {
	++numDirectionsComputed;
	legsTmp.push(directionsResult.routes[0].legs[i]);
	durations.push(directionsResult.routes[0].legs[i].duration.value);
	distances.push(directionsResult.routes[0].legs[i].distance.value);
}
if (typeof onProgressCallback == 'function') {
	onProgressCallback(tsp);
}
okChunkNode = chunkNode;
nextChunk(mode);
} else if (directionsStatus == google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
	requestLimitWait *= 2;
	setTimeout(function(){ nextChunk(mode) }, requestLimitWait);
} else {
	var errorMsg = DIR_STATUS_MSG[directionsStatus];
	var doNotContinue = true;
	alert("Request failed: " + errorMsg);
}
});
} else {
	readyTsp(mode);
}
}






