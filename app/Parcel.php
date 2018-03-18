<?php

namespace App;

use Carbon\Carbon ; 

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{

	protected $table = 'parcels';

	public $timestamps = false;

	// protected $dates = 'delivery_date';


	
	public function medicines()
	{
		return $this->belongsToMany(Medicine::class,'parcel_medicines','parcel_id','medicine_id')
		 ->withPivot('qty'); 
	}

	// public function medicines()
	// {
	// 	return $this->belongsToMany('App\Medicine')
	// 	->withPivot('qty');
	// }

	public function owner()
	{	
		return $this->belongsTo(SeniorCitizen::class,'seniorcitizen_id') ; 
	}


	// public function setPlacedOnAttribute($date){
	// 	$this->attributes['placed_on'] = Carbon::parse($date);
	// }


	public function getDeliveryDateAttribute($date){

		return Carbon::parse($date)->format('F j, Y, g:i a');

	}


	public function setDeliveryDateAttribute($date){
		$this->attributes['delivery_date'] = Carbon::parse($date);
	}




	public function courier()
	{	
		return $this->hasOne(User::class,'courier_id') ; 
	}



	public function deliveryStatus() {
		return $this->hasOne(DeliveryStatusCode::class);
	}




	

}
