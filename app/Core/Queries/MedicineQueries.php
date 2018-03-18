<?php namespace App\Core\Queries ; 

use App\Medicine ; 

class MedicineQueries {


	public function __construct(Medicine $medicine)
	{
		$this->model = $medicine ; 
	}

	public function getAllInformation(){
		return $this->model
		->join('medicine_classes','medicine_classes.id','=','medicines.medicine_class_id')
		->select('medicines.id as medicine_id','medicine_classes.treatment_of as treatmentFor','medicines.name as medicine_name',
			'medicines.form as form','medicines.price as price','medicines.picture as picture')
		->orderBy('treatmentFor','asc')->get();
	}

	

}
