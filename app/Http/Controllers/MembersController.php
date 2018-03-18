<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Core\UserEntry;

use App\User;

use Image;

use Illuminate\Http\File;   

use Illuminate\Support\Facades\Storage;

use App\Courier ; 

use App\Http\Requests\StoreUserRequest;

use App\Http\Requests\UpdateUserRequest;

use App\Filters\RoleFilters ; 

use App\Filters\UserFilters ; 

use App\Role ; 

use App\Barangay ; 

use App\Core\Traits\ManagesUploads;

use App\Parcel;  

use Nexmo ; 

use Carbon\Carbon ; 


class MembersController extends Controller
{

  use ManagesUploads ; 

  public function users() {  
    return User::select('name','email')->get();
  }


// Gets The Phone Numbers of The Senior Citizens who will receive deliveries.
  public function sendSMSForTomorrowsDeliveries()
  {

    // $recipients = CustomerParcelDelivery::with('owner')->where('delivery_date','=',$tomorrow)->get() ;  



    // if ( isset($recipients) && $recipients->exists())


    //     foreach ($recipients->owner as $customer) {
    //         $first_name =  $customer->first_name ; 
    //     }

    //     return $first_name;



    // foreach ($parcels as $parcel) {

    //     $mobile_number = $parcel->owner->mobile_number ; 
    //     $first_name = $parcel->owner->first_name ; 


    // }

    // $smsInformation = DB::table('senior_citizens')
    // ->join('customer_parcels_deliveries','customer_parcels_deliveries.senior_citizen_id','=','senior_citizens.id')
    // ->join('customer_parcel_products','customer_parcel_products.product_id','=','customer_parcels_deliveries.customer_parcel_id')
    // ->join('medicine_dosages','customer_parcel_products.product_id','')
    // ->select('mobile_phone','senior_citizen_id','senior_citizens.first_name','senior_citizens.last_name')->where('customer_parcels_deliveries.delivery_date','=',Carbon::tomorrow())
    // ->get();




    // $smsInformation = Dosage::with('parcel_delivery','owner')->get();


        // $parcels = Parcel::with('owner')->where('delivery_date','=',Carbon::tomorrow())->get();

        // $from = $country_code . $official_number;

        // foreach ($parcels as $parcel) { 
        //     Nexmo::message()->send([
        //         'to'   => $parcel->ownercountry_code . $parcel->owner->mobile,
        //         'from' => $from.
        //         'text' => 'Using the facade to send a message.',
        //     ]);
        // }



    $parcels = Parcel::with('owner')
    ->join('parcel_medicines','parcels.id','=','parcel_medicines.parcel_id')
    ->join('medicines','medicines.id','=','parcel_medicines.medicine_id')
    ->where('delivery_date','=',Carbon::tomorrow())
    ->get();


    $value =  $parcels->each( function($parcel ) {

      $owners_name = $item->owner->first_name .' ' .$item->owner->last_name ; 

      $mobile_number =  $item->owner->mobile ; 

      $parcel_items= $item->name .' - ' .$item->qty .' pcs' ; 

      return ['items' => $parcel_items, 
      'mobile_number'=> $mobile_number] ; 

      // Nexmo::message()->send([
      //   'to'   => $mobile_number , 
      //   'from'   => '639058185519',
      //   'text' => 'Dear '.$owners_name.' Please be advised that you will receive your parcel tomorrow which will have the following :'
      // ]);

    });




  }

  public function index(){
    $members = User::with('barangay')->plainusers()->where('status',1)->get();

    // dd($members);
    return view('admin.members.index',compact('members')) ; 
  }

  public function emailduplicate(Request $request) {
    $email = $request['email'];
    $query = User::where('email', $email)->count();
    return response()->json($query);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     $roles = Role::exceptAdmin()->get();

     $barangays = Barangay::select('id','name' )->get();

     return view('admin.members.create',compact('roles','barangays'));

   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
      if (request()->role_id == 2 && request()->barangay_id == null) {     
        return response(['status' => 'Assign a barangay first.']); 
      }  
      else {
        $user = User::create(['name' => request('name'),
          'email' =>  request('email'),
          'password' => bcrypt(request('password')),
          'barangay_id' => request('barangay_id'), 
          'role_id' =>  request('role_id') ,
          'status'  =>  request('status')]);

        $user->save() ; 

        if (request('role_id') == 3) {

        // return response($user,201);
          $courier = Courier::findOrFail($user->id) ;
          $courier->user()->associate($user) ;
          $courier->save() ; 

        // $courier = Courier::find($user->id);
        // $courier->user()->associate($user);
        // $courier->save();      

        }

        if (request()->wantsJson()) { 
          return response($user,201);
        }


      }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $member = User::with('info')->find($id);

      return view('admin.members.show')->withMember($member);



        // $member = User::with(['info','barangay','role'])->find($id);

        // dd($members);
    }


    public function saveNote($id)
    {

      $note = request('note');



    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $member = User::find($id);
        // dd($user);
      return view('account.edit_profile')->withMember($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      // return response()->json($request->all()); 

      $data = User::find($id);

      parse_str($request->data,$values) ; 

      if ( $values['role_id'] == 2 && $values['barangay_id'] == '') {
        return response('assign a barangay' ,500);
      }

      elseif ( $values['role_id'] == 3) {

        $data->name = $values['name'];
        $data->email = $values['email'];
        $data->password = $values['password'];
        $data->role_id = $values['role_id'];

        $data->save ();

        if (request()->wantsJson()) {
          return response ()->json ( $data ,200);
        }

      }

      elseif( $values['role_id'] == 2)
      {
        $data->name = $values['name'];
        $data->email = $values['email'];
        $data->password = $values['password'];
        $data->role_id = $values['role_id'];
        $data->barangay_id = $values['barangay_id'];
        $data->save ();
        
        if (request()->wantsJson()) {
          return response ()->json ( $data ,200);
        }

      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $user = User::find($request->id);
      $user->status = 'inactive' ;
      $user->save() ;
      return response()->json($user);
    }


    public function updateStatus(Request $request)
    {
      $user = User::find($request->id);

      $user->status = 'inactive' ;

      $user->save() ;
      
      return response()->json($user);
    }



  }
