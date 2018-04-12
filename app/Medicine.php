<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
	protected $table ='medicines';

	protected $fillable = [ 'medicine_class_id','name','form','qty','price','picture'];

	public $timestamps = false;

	protected $location = '/images/logo/';
	
	public function getImageAttribute($image){
		if ($image) {
			return $this->location.$image;
		}

	}

	

	public function parcels(){
		return $this->belongsToMany(Parcel::class,'parcel_medicines','medicine_id','parcel_id');
	}


	//a medicine can have many dosage
	// public function dosages()
	// {
	// 	return $this->belongstoMany('App\Dosage');
	// }


	public function form()
	{
		return $this->hasMany(Dosage::class) ; 
	}
	

	
	public function seniormedicine()
	{
		return $this->hasMany('App\SeniorMedicine');
	}

	public function seniorinfos()
	{
		return $this->belongstoMany('App\SeniorInfo', 'medicine_seniorinfo')
		->withPivot('status','qty','dailyfrequency');
	}


	public function class(){

		return $this->belongsTo(MedicineClass::class,'medicine_class_id') ; 

	}

	public function dosage(){
		return $this->hasMany(Dosage::class);
	}





}
