<?php

namespace App\Http\Controllers\Api; 

use Carbon\Carbon ; 

use App\CustomerParcelDelivery ; 

class DeliveriesApiController extends Controller {

	public function getTodaysCoordinates(){

		$id = Auth::user()->id ; 

		$today = Carbon::today(); 

		$deliveries = CustomerParcelDelivery::with('owner')->get() ; 

		return CustomerParcelDelivery::join('senior_citizens', 'senior_citizens.id','=', 'customer_parcels_deliveries.senior_citizen_id')
		->select('senior_citizens.lat as latitude ','senior_citizens.lng as longitude','senior_citizens.first_name','senior_citizens.last_name')->where([ 
			['courier_id','=',$id ],
			['delivery_date','=',$today]
		])->get();


	}


}
