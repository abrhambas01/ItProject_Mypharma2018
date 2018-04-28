@extends('layouts.courier')

@section('page-title', 'Home')

@section('content')
<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
	<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
		<div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
			<h2 class="mdl-card__title-text">Updates</h2>
		</div>
		<div class="mdl-card__supporting-text mdl-color-text--grey-600">
			Non dolore elit adipisicing ea reprehenderit consectetur culpa.
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">Read More</a>
		</div>
	</div>
	<div class="demo-separator mdl-cell--1-col"></div>
	
</div>
<div class="page animated fadeinright">
	<div class="hero-header bg-5 animated fadeinright">
		<div lass="hero-title">Parcels to pack up</div>
	</div>
	<div class="todo animated fadeinright delay-1" id="test1">
		<p class="todo-element">
			<input id="todo1" type="checkbox"> 
			<label for="todo1">Go to gym with Mike</label> 
			<span class="small ownersName">Owner : Mike Jordan </span>
			<span class="small medicineId">Medicine ID : 3 - 4pcs </span>
		</p>
	</div>
</div>

@endsection


@section('scripts')


<script src="{{ asset('js/app.js') }}"></script>
<script>
	var dialog = document.querySelector('dialog');
	
	var showDialogButton = document.querySelector('#show-dialog');
	
	if (! dialog.showModal) {
		dialogPolyfill.registerDialog(dialog);
	}

	showDialogButton.addEventListener('click', function() {
		dialog.showModal();
	});

	
	dialog.querySelector('.close').addEventListener('click', function() {
		dialog.close();
	});



	$(function(){


		var url = '/api/v1/parcels/to-pack';

		$.get('/api/v1/parcels/to-pack',function(data){
			console.log(data);
			
			//append the content to the dom..
			

		});


	});

</script>


@endsection