<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelMedicine extends Model
{
    protected $table ='parcel_medicines';

    protected $fillable = [ 'medicine_id'];

    public function parcels()
    {
    	return $this->belongsToMany(Parcel::class,'parcel_medicines');
    }
}
