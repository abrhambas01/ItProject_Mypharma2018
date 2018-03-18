<?php

namespace App\Http\ViewComposers;
use App\User ; 
use App\Barangay ; 
use App\Role ; 
use App\MedicineClass ; 

use Illuminate\View\View   ;
class Admin
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
    	$user = auth()->user();

        $information = $user->info ;

        $couriers = User::couriers()->count();

        $sWorkers  = User::socialworkers()->count();

        $barangay_count =  Barangay::count() ;

        $role  = Role::select(['id','name'])->whereIn('id',[2,3])->get() ; 

        $barangays = Barangay::all();

        $medicine_classes = MedicineClass::all();



        $view->with(['user' => $user, 'medicine_classes' => $medicine_classes, 'users_information' => $information,'couriers' => $couriers , 
            'sWorkers' => $sWorkers , 'barangay_count' => $barangay_count  ,'roles' => $role  ,'barangays' => $barangays ]);

    }




}