<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class SeniorCitizen extends Model
{
	protected $table = 'seniorcitizens';

    public $incrementing = false;

	protected $fillable =  ['first_name', 'middle_name', 'last_name', 'gender', 'dob', 'barangay_id', 'address','birthdate','telephone','mobile', 'lat', 'lng', 'status', 'caretakers_name', 'caretakers_number'];

    protected $dates = ['dob'];


    public function barangay(){
        return $this->belongsTo(Barangay::class);
    }   

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine', 'medicine_seniorcitizen', 'seniorcitizen_id')
        ->withPivot('qty', 'status');
    }

    // public function getSeniorProfile()
    // {
    // 	$seniorinfos = DB::table('seniorinfos')
    // 	->join('dosages', 'seniorinfo_id', '=', 'dosages.seniorinfo_id')
    // 	->join('seniormedicines', 'seniorinfo_id', '=', 'seniormedicines.seniorinfo_id')
    // 	->select('users.*', 'dosages.form', 'dosages.dosage_name', 'seniormedicines.qty', 'seniormedicines.dailyfreuency')
    // 	->get();
    // }

    // function getDobAttribute()
    // {
    //     return $this->attributes['dob']->format('m/d/Y');
    // }

    // public function setDobAttribute($value)
    // {
    //     $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
    // }

	// public function dosage()
	// {
	// 	return $this->hasMany('App\Dosage');
	// }

	// public function getAttribute($key)
 //    {
 //        $seniorinfo = Seniorinfo::where('id', '=', $this->attributes['id'])->first()->toArray();

 //        foreach ($seniorinfo as $attr => $value) {
 //            if (!array_key_exists($attr, $this->attributes)) {
 //                $this->attributes[$attr] = $value;
 //            }
 //        }
    
 //        return parent::getAttribute($key);
 //    }

}
