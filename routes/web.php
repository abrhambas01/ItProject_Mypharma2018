  <?php

/***
    Classes I've created and directory location : 

1. App\Core.

2. App\Filters.


3. App\Services.. 

    **/



/***********************************

MYPHARMA ROUTES built with laravel 5.4 


Stacks Used : 

2. Jquery/Vuejs

3. Chart.js/Pages.js

4. Codebase Admin Panel. 
    
5. Jetpack Mobile Template from Themeforest. 

6. MYSQL (Server) -> 

**********/


use App\Events\MemberIsAdded;
use App\Events\MemberDeleted;
use App\SeniorCitizen ; 
use App\CustomerParcelDelivery; 

use App\Dosage; 

use Carbon\Carbon; 
//Add the Middleware soon auth and admin here only admin can access this. 



Route::group(['middleware'=> ['auth','isAdmin'], 'prefix' => 'admin'], function () {    
// Route::group(['prefix' => 'admin'], function () {
  Route::get('dashboard', 'AdminController@renderDashboard')->name('admin.dashboard');

  Route::resource('members','MembersController') ;


  Route::put('/update/status','MembersController@updateStatus')->name('admin.updateStatus');


  Route::get('members/delete','MembersController@destroy')->name('members.destroy') ; 

        //Shows Realtime Transactions..
  Route::get('transactions/realtime', 'AdminController@showRealTimeTransactions')->name('showTransactions') ; ;

        // Route::get('transaction/{id}', 'AdminController@showTransaction')

        // Deliveries Realtime
  Route::get('realtime/deliveries', 'AdminController@showTransaction')->name('deliveries.realtime') ; 

  Route::get('members/couriers',
    [
      'as' => 'members.couriers' , 
      'uses' =>    'MembersController@couriers'
    ]);

  Route::get('members/social-workers', [  'as' => 'members.socialworkers',   'uses' => 'MembersController@socialworkers']);


  Route::resource('medicines','MedicinesController');

  Route::get('profile/update ','AdminController@account_profile')->name('updateProfileForm');

  Route::post('profile/update/{id}','AdminController@updateUserProfile')->name('updateProfile');

  Route::resource('barangays','BarangaysController');

  Route::post('/create/note/{id}','MembersController@postNote')->name('notes.create');

  Route::get('account/profile/id={id}','AppController@userProfile')->name('user.profile');

  Route::post('submit/profile/{id} ','AppController@userProfile')->name('updateUserProfile');

  Route::get('api/v2/email', 'MembersController@emailduplicate')->name('email.getDuplicate');


  Route::get('profile/upload/photo/{id}','AppController@adminProfilePhoto')->name('changeAdminPhoto');



});



/*

******************



Social Worker Routes Starts here


******************

*/

Route::group(['middleware' => ['auth'], 'prefix' => 'socialworker'], function() {
  Route::resource('socialworker', 'SocialWorkerController');
  Route::get('dashboard', ['as' => 'socialworker.dashboard',
    'uses' => 'SocialWorkerController@index']);

  Route::get('register', ['as' => 'register',
    'uses' => 'SocialWorkerController@register']);

  Route::get('medicinelist', ['as' => 'medicinelist',
    'uses' => 'SocialWorkerController@medicinelist']);

  Route::post('storeSeniorCitizen', ['as' => 'storeSeniorCitizen',
    'uses' => 'SocialWorkerController@storeSeniorCitizen']);

  Route::get('getSeniorProfile/{id}', ['as' => 'getSeniorProfile',
    'uses' => 'SocialWorkerController@getSeniorProfile']);

  Route::get('/register/findPrice', ['as' => 'findPrice',
    'uses' => 'SocialWorkerController@findPrice']);

  Route::get('requestMedicine/{id}', ['as' => 'requestMedicine',
    'uses' => 'SocialWorkerController@requestMedicine']);

  Route::get('requestMedicine1/{id}', ['as' => 'requestMedicine1',
    'uses' => 'SocialWorkerController@requestMedicine1']);

  Route::post('updateMedicineList', ['as' => 'updateMedicineList',
    'uses' => 'SocialWorkerController@updateMedicineList']);

  Route::put('updateMedicineStatus/{id}', ['as' => 'updateMedicineStatus',
    'uses' => 'SocialWorkerController@updateMedicineStatus']);

  Route::put('activateMedicineStatus/{id}', ['as' => 'activateMedicineStatus',
    'uses' => 'SocialWorkerController@activateMedicineStatus']);

  Route::put('updateSeniorStatus/{id}', ['as' => 'updateSeniorStatus',
    'uses' => 'SocialWorkerController@updateSeniorStatus']);

  Route::get('MedicineHistory', ['as' => 'MedicineHistory',
    'uses' => 'SocialWorkerController@MedicineHistory']);

  Route::get('InactiveList', ['as' => 'InactiveList',
    'uses' => 'SocialWorkerController@InactiveList']);

  Route::put('activateSeniorStatus/{id}', ['as' => 'activateSeniorStatus',
    'uses' => 'SocialWorkerController@activateSeniorStatus']);

  Route::post('storeParcelInfo', ['as' => 'storeParcelInfo',
    'uses' => 'SocialWorkerController@storeParcelInfo']);

  Route::get('addQuantity/{id}', ['as' => 'addQuantity',
    'uses' => 'SocialWorkerController@addQuantity']);

  Route::put('updateSeniorCitizenProfile', ['as' => 'updateSeniorCitizenProfile',
    'uses' => 'SocialWorkerController@updateSeniorCitizenProfile']);







});

/*

******************


Courier Routes Starts here


******************


*/
Route::post('text',function(){
  function itexmo($number,$message,$apicode){

    $apicode = TR-MYPHA152063_N2J9P  ;

    $number = '09332998610' ; 
    $message = 'OK' ; 


    $ch = curl_init();

    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);

    curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
    
    curl_setopt($ch, CURLOPT_POST, 1);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, 

     http_build_query($itexmo));
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    return curl_exec ($ch);

    curl_close ($ch);



    $ch = curl_init();
    
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);

    curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
    
    curl_setopt($ch, CURLOPT_POST, 1);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, 

      http_build_query($itexmo));
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    return curl_exec ($ch);

    curl_close ($ch);

  }

});


Route::get('sms/itextmo',function(){

 $result = itexmo("09332998610","Test Message","API_CODE");
 if ($result == ""){
   echo "iTexMo: No response from server!!!
   Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
   Please CONTACT US for help. ";  
 }else if ($result == 0){
   echo "Message Sent!";
 }
 else{ 
   echo "Error Num ". $result . " was encountered!";
 }

});


Route::group(['middleware' => ['auth', 'isCourier']], function () {
  Route::get('/', 'CourierController@dashboard')->name('courier.dashboard');
});


/*
  |-------------------------------------------------------------------------------

        
            C O N S U M A B L E API's..


        v0 -> Count 
        v1 -> Retrieval 
        v2 -> Availability

 |-------------------------------------------------------------------------------

        
 *************************************/

/*
|-------------------------------------------------------------------------------
| Get All parcels to be packed..
|-------------------------------------------------------------------------------
| URL:            /#/pickup/parcels
| Controller:     CourierController@getTodaysParcels
| Method:         GET

Actor :         courier
| Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..

Returns 

packages information.. parcel_id

medicine_number - quantity(pcs)
owner_name 


*/

Route::get('api/v1/parcels/to-pack','CourierController@getTodaysParcelsToPack');


/*
|-------------------------------------------------------------------------------
| Get All information of the senior_citizens who will receive todays deliveries..
|-------------------------------------------------------------------------------
| URL / USED IN :            /#/deliveries/today
| Controller:     CourierController@getTodaysParcels
| Method:         GET
  Actor :         courier
| Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
      Returns lat , lng , owners_information.. 


*/

      Route::get('api/v1/parcels','CourierController@getDeliveriesInformation')->name('api.deliveries');


/** 

  /*
  |-------------------------------------------------------------------------------
  | Get All information of the senior_citizens who will receive todays deliveries..
  |-------------------------------------------------------------------------------
  | URL:            /#/deliveries/today
  | Controller:     CourierController@getTodaysParcels
  | Method:         GET
    Actor :         courier
  | Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
  */

  Route::get('api/v1/deliveries/information','CourierController@getDeliveriesInformation')->name('api.deliveries');


  /*
  |-------------------------------------------------------------------------------
  | Updates the status of the parcels
  |-------------------------------------------------------------------------------
  | URL:            /#/pickup/parcels
  | Controller:     CourierController@updateParcelStatus
  | Method:         PUT/POST/UPDATE
    Actor :         courier
  | Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
  */  

  Route::post('api/parcel/check/{id}','CourierController@updateParcelStatus');


  /*
  |-------------------------------------------------------------------------------
  | Updates the status of the parcels
  |-------------------------------------------------------------------------------
  | URL:            /#/pickup/parcels
  | Controller:     CourierController@updateParcelStatus
  | Method:         PUT/POST/UPDATE
    Actor :         courier
  | Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
  */  

  Route::post('api/parcel/uncheck/{id}','CourierController@markasCheck');


  /*
  |-------------------------------------------------------------------------------
  | Updates the status of the parcel to uncheck
  |-------------------------------------------------------------------------------
  | URL:            /#/pickup/parcels
  | Controller:     CourierController@updateParcelStatus
  | Method:         PUT/POST/UPDATE
    Actor :         courier
  | Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
  */  

  Route::post('api/parcel/{id}/state','CourierController@markAsUncheck');


/*
  |-------------------------------------------------------------------------------
  | Returns the info of the current user
  |-------------------------------------------------------------------------------
  | URL:            /#/pickup/parcels
  | Controller:     CourierController@updateParcelStatus
  | Method:         PUT/POST/UPDATE
    Actor :         courier
  | Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
  */  
  Route::get('api/get/current-user/information','CourierController@getCurrentUserInformation');



  /*
  |-------------------------------------------------------------------------------
  | Sends API Routes Data
  |-------------------------------------------------------------------------------
  | URL:            /#/deliveries/today
  | Controller:     CourierController@getTodaysParcels
  | Method:         post
    Actor :         courier
  | Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
  */

  Route::post('api/routes','CourierController@saveRoutes');


/** 

Returns all senior_citizens (response in json)..  

**/

Route::get('api/v1/senior_citizens',function(){
  $parcels = SeniorCitizen::all();
  return response()->json($parcels);          
});



Route::get('auth/users',function(){

  // $users = Auth::user()

}) ; 

/** 

Returns all barangays (response in json)..  

**/
Route::get('/barangays','BarangaysController@getBarangays');


/** 
Returns all roles (response )..  
**/
Route::get('/roles','AppController@getRoles');



/* 
|-------------------------------------------------------------------------------
                Charts 
|-------------------------------------------------------------------------------
/*




|-------------------------------------------------------------------------------
| Gets Information for the charts..
|-------------------------------------------------------------------------------
| URL / USED IN for the couriers.. : /#/
| Controller:     CourierController@getTodaysParcels
| Method:         GET
Actor :         courier
| Description:    Gets parcels to be delivered then to be checked if it is packed by the courier..
*/

Route::get('api/v1/delivery-charts','CourierController@DeliveryCharts');



Route::get('api/v1/sales-charts','CourierController@salesCharts');

//-------------------/

Route::get('api/v1/delivery/information',function(){

  $today = Carbon::today(); 
  $id = auth()->user()->id ; 
  $undeliveredStatus = 102;


  $parcels =  CustomerParcelDelivery::where([ 
    ['delivery_date', '=', $today],
    ['courier_id', '=', $id],
    ['delivery_status_code','=',$undeliveredStatus]
  ])->get();




  $data = array() ; 

  foreach ($parcels as $parcel) {
    $owner = $parcel->owner ; 

    $data[] = (object)[
      'full_name' => $owner->first_name." ".$owner->middle_name." ".$owner->last_name,
      'complete_address' => $owner->complete_address,
      'lat' => $owner->lat ,
      'lng' => $owner->lng ,
      'mobile_phone' => $owner->mobile_phone

    ];

  }   

  return $user ; 

});




/** 

Widgets for Administrators 
returns stats of the applications.. 

**/

Route::get('api/v0/widget-stats','AdminController@widgetStats');

/** 

Users on site.. 
returns array json with the user

{
        "name": "keely.beier",
        "email": "schimmel.shaylee@example.net"
},

**/

Route::get('api/v1/users',  'MembersController@users')->name('users');




/** 

Users on site.. 
returns array json with the user

{
        "name": "keely.beier",
        "email": "schimmel.shaylee@example.net"
},

**/
Route::get('api/v1/parcel/status','AppController@parcelStatus');

Route::get('api/v1/de',function(){

  return DB::table('customer_parcels_deliveries')->distinct('senior_citizen_id')->get();

}) ; 





Route::get('api/v1/recipients',function(){
  $recipients = CustomerParcelDelivery::join('senior_citizens','senior_citizens.id','=','customer_parcels_deliveries.senior_citizen_id')->join('medicine_dosages','customer_parcels_deliveries.product_dosage_id','=','medicine_dosages.id')->join('medicines','medicine_dosages.medicine_id','=','medicines.id')
  ->where('delivery_date','=',Carbon::tomorrow())
  ->select('first_name','middle_name','last_name','dosage_volume','form','generic_name','product_quantity','mobile_phone')->get() ; 


//Filter all the SMS Recipients and send
// foreach ($recipients->owner as $owner ) {
//     $first_name = $owner->first_name ;
//     $middle_name = $owner->middle_name ;
//     $last_name = $owner->last_name ;

// }   


  return $recipients ;


});


//Get Information for sms  for tomorrows deliveries..
Route::get('api/v1/sms-recipients',function(){

  $tomorrow = Carbon::tomorrow() ; 


  $parcels = CustomerParcelDelivery::with('owner')
  ->join('medicine_dosages','customer_parcels_deliveries.product_dosage_id','=','medicine_dosages.id')
  ->join('medicines','medicine_dosages.medicine_id','=','medicines.id')
  ->where('delivery_date','=',$tomorrow)->get() ; 



  return $parcels ; 


});








Route::get('api/v1/social-workers','AdministratorController@getSocialWorkers');

Route::get('api/v2/senior-citizen/{id}', 'UsersController@checkseniorcitizenid');

Route::get('api/v2/email', 'MembersController@emailduplicate')->name('email.duplicateCheck');



Route::get('api/v2/senior-citizen/phone', 'UsersController@checkseniorcitizensphone');  



Route::post('api/v1/checked','CourierController@toggleParcelStatus');


/****
 Not Used API's 
Route::get('api/seniors', 'UsersController@seniorcitizens'); //NA



Route::get('/api/check',function(){
    return [ 'hey','say','lay'];

});



Route::get('api/routes', 'MapsController@showRoutes');  // NA

// Get/Fetch all senior citizens

Route::get('/api/seniors', 'UsersController@seniorcitizens'); //NA




**/


Route::get('api/deliveries', function() {
  $user_id = auth()->user()->name;
  dd($user_id);
});




Route::get('/get/social-workers','AdministratorController@getSocialWorkers');




// Route::get('api/v1/sms/')

//Test pusher.. 
Route::get('/fire',function(){
  event(new MemberIsAdded);
  return 'fired' ; 
});


Route::get('/fire/deleted',function(){
  $x = event(new MemberDeleted);
  return $x;
});





Route::get('/fire/updated',function(){
  event(new MemberInformationUpdated);
  return 'fired' ; 
});



Route::get('/fire/parcel-delivered',function(){
  event(new ParcelIsDelivered);
  return 'fired' ; 
});







/*social workers*/
// Route::get('social-workers/home','AppController@socialworkers')->name('socialworker.dashboard');


//Couriers for every barangay 
//parameters  => barangay_id
Route::get('barangay/couriers/{id}', 'UsersController@getCouriersPerBarangay');

//Check Availability API..
Route::get('availability/email', 'MembersController@emailduplicate');

Route::get('users', 'AppController@users');

Route::get('barangays/data', 'AppController@barangays');

Route::get('tasks', 'MapsController@showSpecificBarangayHallLocation'); //=returns lat,lng of barangay_hall

//Database operations.. 
Route::get('reset/users', function () {
  DB::table('users')->truncate();
});

Route::get('seed/statuses', function(){

    // DB::table('delivery_status_codes')->truncate(); 

    // DB::table('order_status_codes')->truncate(); 


    // DB::table('order_status_codes')->insert(
    //     [
    //         [  'status_code'   => 201 , 'title' => 'Part Subtracted', 'description' => 'Parcel is delivered to the user..'],
    //         [  'status_code'   => 202 , 'title' => 'Extra Status Code', 'description' => 'Lorem ipsum dolor sit amet.']
    //     ]);


  DB::table('delivery_status_codes')->insert([
    [  'status_code'   => 101, 'title' => 'Delivered', 'description' => 'Parcel is delivered to the user..'],
    [  'status_code'   => 102, 'title' => 'Undelivered', 'description' => 'Was not picked up or delivered' ],
    [ 
     'status_code'   => 103, 
     'title' =>'Pending', 
     'description' =>'Put on Hold by the courier'
   ],
   [
    'status_code'   => 104,
    'title' =>'Left Warehouse',
    'description' => 'Parcel is picked by the courier'
  ]
]); 

});



// $id = Auth::id(); 
/**
  Plain XHR Requests for API
 * /get all lat and lng  in a specific barangay and the location of the barangay_hall
  //parameter : barangay_id
  //returns : the lat long of the registered senior citizens who placed their order and the barangay_ hall..
  /*
Route::get('get/barangay-hall/{id}', 'MapsController@showSpecificBarangayHallLocation'); //=returns lat,lng of barangay_hall
/**
 * Show Routes for today's orders.. [Courier...]
 */     




/**
--------------------------
 TESTING  ROUTES...
---------------------------
 **/


//get the geolocation of the user..
Route::get('map/autocomplete', 'AppController@autoComplete'); //Not included..
Route::get('test/queries', 'AppController@testQueries');



/** 

Testing Nexmo SMS 

**/
Route::get('test/sms',function(){
  Nexmo::message()->send([
    'to'   => '639058185519',
    'from' => '639058185519 ',
    'text' => 'Ulsdjf'
  ]);
});



/**


Sends SMS to all Senior Citizens with Nexmo SMS API.. 

*/

Route::get('test/sms/send','MembersController@sendSMSForTomorrowsDeliveries'); 

Route::get('test/image-upload','AppController@testUpload');


Route::get('/get/courier_id',function(){

  $user = \Auth::user();

  return $user ; 



});

Route::get('/tsp/directions','AppController@mapping');

// barangay_id to be passed
// Route::get('routes/barangay/{id}','MapsController@showSpecificBarangayAllLocation') ; 
//lee Jacobson test routes..=> tsp
// Route::get('tsp/1', function() {
//     return view('test-deliver');
// });



Route::post('chikka/post', function() {
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  $post_cp = "639327473899;639332998610";

  $message = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, ratione.";

  $url = "https://post.chikka.com/smsapi/request";

  $shortcode = "29290 45485";

  $client_id = "63a07c71a6eabbb9bcd28321c1f5ccd08046be8dd6a6151c8663e5716ec17694";

  $secret_key = "202ee4438b62ada004032b6ecf9c5d648118a4920707907d0817e0d01501514b";

  $count = time();
  $arr_cp = explode(";", $post_cp);
  for ($i = 0; $i < sizeof($arr_cp); $i++) {
    /* loop through */
    if (trim($arr_cp[$i]) != "") {
      echo $arr_cp[$i];
      $post_data = array(
        "mobile_number" => $arr_cp[$i],
        "shortcode" => $shortcode,
        "message_id" => md5($count++),
        "client_id" => $client_id,
        "secret_key" => $secret_key,
        "message_type" => "SEND",
        "message" => $message
      );
      $postvars = http_build_query($post_data);
            // open connection
      $ch = curl_init();
            // set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, count($post_data));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
            // execute post
      $result = curl_exec($ch);
            // close connection
      curl_close($ch);
    }
  }
});

// register senior citizen form
Route::get('senior-citizen/form/registration', 'UsersController@showUploadForm');

//save senior_citizen..
Route::post('senior-citizen/store', ['as' => 'storeSeniorCitizen', 'uses' => 'UsersController@saveNewSeniorCitizen']);




//Test GMAPS
Route::get('gmaps/show', 'MapsController@testGMaps');



// Dashboard for other users
Route::get('dashboard','AppController@dashboard');




// Auth Routes. 
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@showLoginForm']);
Route::post('login', 'AuthController@postLogin')->name('login');
Route::get('reset/password','AuthController@resetPassword')->name('password.reset');
Route::post('reset/password','AuthController@saveNewPassword');


Route::get('logout', 'AuthController@logout');



Route::get('/home', function () {
  return view('index');
});









Route::get('tsp/optimap',function(){
  return view('tsp-optimap');
});




Route::get('locate/me',function(){
  return view('geolocation');
});



/** Logs Admin 

with any  user

 **/
Route::get('log/admin',function(){

  $user =  \App\User::where('role_id','=',1)->first(); 

  $id = $user->id  ;

  Auth::loginUsingId($id);

});




/** Logs Couier 

with any user

 **/

Route::get('log/cour',function(){

  $user =  \App\User::where('role_id','=',3)->first(); 

  $id = $user->id  ;  

  Auth::loginUsingId($id);


});

/**

Hot Module Replacement Test

**/


Route::get('/hmr',function(){

  return view('some_file');


});


/** google maps 
directions service  ..

*/

Route::get('/delivery',function(){
  return view('tspCheck');
});



Route::get('/tsp/directions2',function(){
  return view('tsp-direction2');
});

Route::get('/tsp3',function(){
  return view('tsp3');
});


Route::get('/hide',function(){
  return view('admin.testhide');
});



/** google maps 
autocomplete service  ..

*/
Route::get('/autocomplete',function(){
  return view('autocomplete');

});


Route::get('/tsp/ga',function(){

  return view('tsp-ga');



});




// General users interaction.... Update users profile..f

// Route::get('update/profile/{id}', 'UsersController@showProfile')->name('updateprofileform');
// Route::post('update/profile', 'UsersController@updateUserProfile')->name('updateProfile');






//eloquent routes..
// Route::get('role-user','UsersController@showAllUsersWithRoles');

