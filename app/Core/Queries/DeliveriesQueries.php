<?php namespace App\Core\Queries ; 
use Carbon\Carbon ; 
use App\CustomerParcelDelivery ;
use App\Parcel ; 
use Auth ; 

class DeliveriesQueries {


	public function retrieveTodaysDeliveries()
	{

		$today = Carbon::today(); 

		$id = auth()->user()->id ; 

		$customer_parcel = CustomerParcelDelivery::with('owner')->where([	
			['courier_id','=',$id ],
			['delivery_date','=',$today]
		])->get();


		return response()->json($customer_parcel) ;

		// $data =	$customer_parcel->owner()->where([
		// 	['courier_id','=',$id ],
		// 	['delivery_date','=',$today]
		// 	->select('customer_parcel_id'), 
		// ])->get();


	}

	public function getParcelsForChecking($id)
	{

		$today = Carbon::today(); 

		$id = auth()->user()->id ; 

		$customer_parcel = CustomerParcelDelivery::with('owner')->where([	
			['courier_id','=',$id ],
			['delivery_date','=',$today]
		])->get();


		return response()->json($customer_parcel) ;

		// $data =	$customer_parcel->owner()->where([
		// 	['courier_id','=',$id ],
		// 	['delivery_date','=',$today]
		// 	->select('customer_parcel_id'), 
		// ])->get();


	}




	public function smsInformation()
	{
		$today = Carbon::today(); 

		$id = auth()->user()->id ; 
		
		return CustomerParcelDelivery::select('senior_citizen_id')
		->where([
			['courier_id','=',$id ],
			['delivery_date','=',$today] , 
		])->get();


	}


		//Retrieve Data..

	public function getDeliveryOwnersAddress()
	{
		$id = Auth::user()->courier->id ; 

		$today = Carbon::today(); 

		$deliveries = Parcel::with('owner')->where([ 
			['courier_id','=',$id ],
			['delivery_date','=',$today]
		])->get() ; 


		$parcelsData = array() ; 

		foreach ($deliveries as $delivery) {
			$parcelsData[] = (object)[
				'position' => [ 
					'full_name' => $delivery->owner->first_name .' ' .$delivery->owner->last_name  ,
					'lat' => $delivery->owner->lat ,
					'lng' => $delivery->owner->lng ,
					'id' =>  $delivery->id
				]

			] ;

		}

		// return $data;
		return $parcelsData;


		

	}

	


}


