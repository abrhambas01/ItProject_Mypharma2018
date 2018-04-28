<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	
	<title>Welcome</title>

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">

	<link rel="icon" sizes="192x192" href="images/android-desktop.png">

	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">

	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<meta name="apple-mobile-web-app-title" content="Material Design Lite">
	
	<link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
	
	<meta name="msapplication-TileColor" content="#3372DF">

	<link rel="shortcut icon" href="images/favicon.png">

	<!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
<!--
<link rel="canonical" href="http://www.example.com/">
-->

<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/iconfont/material-icons.css') }}">

<link rel="stylesheet" href="{{ asset('css/material.min.css') }}">

<link rel="stylesheet" href="{{ asset('dist/css/styles.css') }} ">

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/courier.css') }}"> --}}

<link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}">

<script src="{{ asset('js/material.min.js') }}"></script>

<script>
window.App = {!! json_encode([
	'csrfToken' => csrf_token(),
	'user' => Auth::user(),
	'signedIn' => Auth::check() //true or false
	]) !!};
</script>

<style>
#view-source {
	position: fixed;
	display: block;
	right: 0;
	bottom: 0;
	margin-right: 40px;
	margin-bottom: 40px;
	z-index: 900;
}	

 /* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
 #map { 
 	width: 100%;
 	height: 100vh;
 	position: relative ; 
 }
 /* Optional: Makes the sample page fill the window. */
 html, body {
 	height: 100%;
 	margin: 0;
 	padding: 0;
 }
 
 .demo-avatar {
 	width: 63px;
 	height: 61px;
 	border-radius: 35px;
 }

 .username {
 	font-size :0.8em;
 }
</style>

</head>
<body>
    <!--
	Main Page is App.vue
	I just mounted it inside here..
-->


<div id="app"></div>

@yield('content')


<script src="{{ mix('dist/js/app.js') }}"></script>



{{-- Include when using jetpack template --}}

{{-- <script src="{{ asset('dist/js/courier.js') }}"></script> --}}


@yield('scripts')
</body>
</html>
