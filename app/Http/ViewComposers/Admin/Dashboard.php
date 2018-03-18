<?php namespace App\Http\ViewComposers\Admin;

use Auth;
use Illuminate\View\View;
use App\User ; 
use Carbon\Carbon ;
use App\Barangay ; 
use App\Parcel ; 
class Dashboard
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $couriers = User::couriers()->count();
        $sWorkers  = User::socialworkers()->count();
        $barangays =  Barangay::count() ;

        $today = Carbon::today() ; 

        $deliveriesForToday = Parcel::where('delivery_date',Carbon::today())->count();

        $view->with(['couriers' => $couriers, 
           'sWorkers' => $sWorkers ,
           'sWorkers' => $sWorkers ,
           'deliveriesForToday' =>  $deliveriesForToday,
           'barangays' => $barangays]);
    }
}
