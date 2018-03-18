<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User  ; 	
use App\Barangay ; 
use App\Medicine ; 
use App\Role ; 
use App\Dosage ; 
use App\UserInformation ; 
use App\Core\Traits\Stats ;


class AdminController extends Controller
{

	use Stats ; 

	public function account_profile(){
		$id = auth()->user()->id;
		$member = User::find($id);
        // dd($user);
		return view('admin.update_profile')->withMember($member);
	}

	public function renderDashboard() {		

		$medicines = Medicine::select('id','name')->get();

		return view('admin.dashboard',compact('couriers','sWorkers','barangay_count','medicines'));

	}


	public function widgetStats(){
		$couriers = User::couriers()->count();
		$sWorkers  = User::socialworkers()->count();
		$barangays =  Barangay::count() ;
		$medicines  = Dosage::with(['user']) ; 

		return response()->json([
			'couriers' => $couriers ,
			'social_workers' => $sWorkers, 
			'barangays' => $barangays,
			'medicines' => $medicines
		]);

	}

	public function showRealTimeTransactions(){
		return view('admin.transactions');
	}

	public function basePage() {
		return view('layouts.admin');
	} 


	public function updateUserProfile(Request $request,$id) {

		request()->validate([
			'user_id' => 'required|numeric',
			'middle_name' => 'alpha',
			'last_name' => 'required|alpha',
			'picture' => 'required|mimes:jpeg,bmp,png,gif' ,
			'work_address' => 'required|alpha',
			'house_number' => 'required|numeric' , 
			'street_name' => 'required', 
		]);


		$users_info = UserInformation::create([
			'user_id' => auth()->id(),
			'channel_id' => request('channel_id'),
			'title' => request('title'),
			'body' => request('body')
		]);


		$users_info->save();

		if (request()->wantsJson()) {
			return response($thread, 201);
		}

		return redirect($thread->path())
		->with('flash', 'Your thread has been published!');
	

	}

	public function checkParcel() {

	}






}
