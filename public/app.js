if ('serviceworker' in navigator) {
	navigator.serviceworker.register('./sw.js')
	.then(function(){
		console.log('SW Registered');
	})
}