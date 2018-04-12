jQuery(document).ready(function($){
	'use strict';

	var util = {
		storeData: function(key, value){
			localStorage.setItem(key, value);
		},
		getStoredData: function(key) {
			return localStorage.getItem(key) || false;
		},
		getData: function(method, url, params, auth, cb) {
			$.ajax({
				type: method,
				url: url,
				dataType: "json",
				data: params,

				beforeSend: function (xhr) {
					if(auth)
						xhr.setRequestHeader ("Authorization", auth);
				},
				success: function(data) {
					cb(data);
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
		},
		setView(hash) {
			window.location.hash = hash;
		}
	};


	var app = {


		init: function() {

			//change views
			new Router({
				'/' : function() {

					//load default view
					$('.page').load('assets/views/home.html');
				},
				'/download': function() {
					$('.page').load('assets/views/download.html');
				},
				'/about': function() {
					$('.page').load('assets/views/about.html');
				},
				'/contact': function() {
					$('.page').load('assets/views/contact.html');
				}
			}).init('/');

			
			this.setEvents();

		},


		setEvents: function() {
			

			$(".button-collapse").sideNav({dismissible: true, closeOnClick: true});




		}


	};

	app.init();

});