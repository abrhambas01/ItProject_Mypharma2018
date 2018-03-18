<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerParcelDelivery extends Model
{

	protected $table = 'customer_parcels_deliveries' ; 

	public $timestamps = false ;
	

	// public function product()
	// {
	// 	return $this->hasOne(CustomerParcel::class,'customer_parcel_id','customer_parcel_id') ; 
	// }

	public function product()
	{
		// id
		// product_dosage_id
		return $this->belongsToMany(Dosage::class,'customer_parcels_deliveries','product_dosage_id','product_dosage_id') ; 
	}



	public function owner()
	{	
		return $this->belongsTo(SeniorCitizen::class,'senior_citizen_id') ; 
	}

	public function courier()
	{	
		return $this->hasOne(User::class,'courier_id') ; 
	}




	// public function courier()
	// {
	// 	return $this->hasOne(User::class,'courier_id','id');
	// }

}
