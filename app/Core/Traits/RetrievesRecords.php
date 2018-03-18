<?php namespace App\Core\Traits ;

use DB ; 

use Carbon\Carbon ; 

use App\CustomerParcelDelivery;

use Auth ; 


trait RetrievesRecords {








	

	// public function ()
	// {

	// 	CustomerParcel::join('customer_parcels_delivery','customer_parcels.customer_parcel_id','=','customer_parcels_delivery.customer_parcel_id')
	// 	->join('customer_parcel_products','customer_parcels_delivery.customer_parcel_id','=','customer_parcel_products.customer_parcel_id')
	// 	->select('')
	// 	->get();

	// }




  // $parcels = CustomerParcelDelivery::with('product')->get();

   // $users = DB::table('users')->where([
        //     ['status', '=', '1'],
        //     ['subscribed', '<>', '1'],
        // ])->get();



       //  $parcels = CustomerParcelDelivery::whereHas('parcel.owner', function ($query) use ($id) {
       //     $query->where('owner_id', $id); 
       // })->orWhere('parcel.delivery_date','=',$today)
       //  ->get();


        // ->where([
            // ['delivery_information.courier_id','=',$id],
            // ['delivery_information.delivery_date','=',$today]
    // ])->get() ;










}