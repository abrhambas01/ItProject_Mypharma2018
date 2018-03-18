<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Seniorinfo extends Model
{
	protected $table = 'seniorinfos';

	protected $fillable =  ['scn', 'first_name', 'middle_name', 'last_name', 'gender', 'dob', 'barangay', 'address','birthdate','telephone','mobile', 'lat', 'lng', 'status', 'caretakers_name', 'caretakers_number'];

	protected $dates = ['dob'];

	public function seniormedicines()
	{
		return $this->hasMany('App\SeniorMedicine');
	}

	public function medicines()
	{
		return $this->belongsToMany('App\Medicine')
		->where('status', '=', '1')
		->withPivot('qty', 'dailyfrequency', 'status');
	}

	public function dosages()
	{
		return $this->belongsToMany('App\Dosage')
		->withPivot('qty', 'dailyfrequency', 'status', 'name')
		->withTimeStamps();
	}

	public function getSeniorProfile()
	{
		$seniorinfos = DB::table('seniorinfos')
		->join('dosages', 'seniorinfo_id', '=', 'dosages.seniorinfo_id')
		->join('seniormedicines', 'seniorinfo_id', '=', 'seniormedicines.seniorinfo_id')
		->select('users.*', 'dosages.form', 'dosages.dosage_name', 'seniormedicines.qty', 'seniormedicines.dailyfreuency')
		->get();
	}

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
