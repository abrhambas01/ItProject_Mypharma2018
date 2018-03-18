var timeout = null;

var textInput = document.getElementById('emailInput');
    // Listen for keystroke events
    textInput.onkeyup = function (e) {

      // Clear the timeout if it has already been set.
      // This will prevent the previous task from executing
      // if it has been less than <MILLISECONDS>
      clearTimeout(timeout);
    // Make a new timeout set to go off in 800ms
    timeout = setTimeout(function () {

    	console.log('Input Value:', textInput.value);

    	if (textInput.value === '') {
    		$('.availability').text('');
    	}
    	else {
    		getEmailAvailability(textInput.value); 
    	}
    },1500);

  } 


  function getEmailAvailability(value){

   $.get( 'api/v2/email', { email: value } ).done(function( data ) {
    if(data >= 1) {
     console.log(data);
     $('.availability').text('Email is taken').addClass('text-danger');
   }
   else { 
     $('.availability').text('Email is available').addClass('text-success').removeClass('text-danger');
   }
 });

 }



 $(document).ready(function() {


  $('.addNote').on('click',function(){
    var privateNote = $('#privateNote').val();  

    if (privateNote === null) {
      alert('No Notes Made');
    }


  });


//Hide /Remove the barangay div from the dom if the role is courier.

$("select#role_id").on('change',function(){
 var role_value = $(this).val();

 if (role_value == 2) {

  $('#form-group-barangay').show() ; 


}
else{
  $('#form-group-barangay').hide() ; 
}
});




// }) === 2 ){


//   if ($("select#role_id option:selected").val() === 2 ){





//     alert("social worker");
//   }
//   else {
//     alert("courier");
//   }



// $('select option#role_id').each(function() {
//   if ($(this).prop("selected") == 2) {
//    console.log('social-wor')
//  } else {
//    console.log('cour');
//  }
// }) ;








/*
    Attempt # 2  
    if( $('#optionRole_id').val() === '3')
    {

     $('#form-group-barangay').hide(); 
   }
   else {

    $('#form-group-barangay').show(); 

  }

  Attempt #4

     $('select option#role_id').each(function() {
       if ($(this).prop("selected") == 2) {
         console.log('social-wor')
       } else {
    //     console.log('cour');

    //   }
    // });​



  Attempt #3

  function show(aval) {
    if (aval == 3) {
      form-group-barangay.style.display='none';
    } 
    else{
      form-group-barangay.style.display='inline-block';
    }
  }
  


  */



  /*
  Data Entry 
  */


  $('#registerUser').on('click', function (e) {
  	e.preventDefault() ;

        //serializing the data..
        var data = $('#createUserForm').serialize(); 

        var role_id = document.getElementById('role_id');

        var barangay_id = document.getElementById('barangay_id');

        if ( role_id.value == 2) { 
        	if (barangay_id.value == '') {
        		swal({
        			title: "Alert",
        			text: "Please choose a barangay to assign to a social worker",
        			type: "error",
        			confirmButtonClass: 'btn btn-danger',
        			confirmButtonText: 'Danger!'
        		});
        	}
        	else {

        		console.log(data);

        		storeUser(data, urlStoreUser); 
        	}
        }
        else {

        	storeUser(data, urlStoreUser); 

        }

      });


  $('#storeMedicineBtn').on('click',function(){

  	var postData = new FormData($("#addMedicineForm")[0]);

  	storeMedicine(postData,urlStoreMedicine) ;

  });


  /*modal */
  $('.modal').on('hidden.bs.modal', function(){

  	$(this).find('form')[0].reset();

  	$('.availability').text('');

  });





});
