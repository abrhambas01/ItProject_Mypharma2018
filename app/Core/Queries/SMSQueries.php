<?php namespace App\Core\Queries ; 
use Carbon\Carbon ; 
use App\CustomerParcelDelivery ;


class SMSQueries {

	public function recipients(){
		$recipients = CustomerParcelDelivery::with('owner')
		->get() ; 


		// $tomorrow = Carbon::tomorrow() ; 

		// $recipients = CustomerParcelDelivery::with('owner')->where('delivery_date','=',$tomorrow)->get() ;  

		return $recipients ;

	}


	

}
