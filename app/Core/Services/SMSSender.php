<?php 
namespace App\Services ; 
use Carbon\Carbon ; 
use App\SeniorCitizen ;
use Nexmo ; 


class SMSSender{


	public function toAllRecipients($recipients){	

		Chikka::send($recipients->mobile_phone,$this->message);


		$this->send() ; 



	}


	protected function message($recipients){

		foreach($recipients->)


	}

	public function send()
	{


	}



}