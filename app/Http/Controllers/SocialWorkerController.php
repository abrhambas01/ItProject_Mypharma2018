<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \Cart as Cart;

use Validator;

use Exception;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use Auth;

use App\User;

use App\Medicine;

use App\SeniorCitizen;

use App\Seniorinfo;

use App\SeniorMedicine;

use App\Courier;

use App\Parcel;

use App\ParcelMedicine;

use Carbon\Carbon;

use DB;

class SocialWorkerController extends Controller
{
  public function __construct(SeniorCitizen $seniorcitizen, Parcel $parcel, Courier $courier)
  {
    $this->parcel = $parcel;
    $this->courier = $courier;
    $this->seniorcitizen = $seniorcitizen;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $seniorcitizens = DB::table('seniorcitizens')
      ->select('id', 'first_name', 'last_name', 'gender', 'telephone', 'budget')
      ->where('barangay_id', '=', Auth::user()->barangay_id)
      ->where('status', '=', 1)
      ->get();
      
      return view('socialworker.index', compact('seniorcitizens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $elderly_info->delete();
    //     return redirect()->route('socialworker.index')->with('message', 'Elderly removed');
    // }

    public function register()
    {
      $medicines = Medicine::pluck('name', 'id');
      return view('socialworker.register', compact('medicines'));
    }

    public function medicineList()
    {
      $medicines = DB::table("medicines")->pluck("name","id");
      return view('socialworker.medicinelist',compact('medicines'));
    }

    public function findPrice(Request $request){

        //it will get price if its id match with product id
      $medicine=Medicine::select('price')->where('id',$request->id)->first();

      return response()->json($medicine);
    }


    public function storeSeniorCitizen(Request $request){

      
      dd($request);


      // try{
      //   $birth_date = Carbon::createFromFormat("d-m-Y", $request->input('dob'));
      //   $seniorcitizen = $this->seniorcitizen;
      //   $seniorcitizen->id = $request['id'];
      //   $seniorcitizen->first_name = $request['first_name'];
      //   $seniorcitizen->middle_name = $request['middle_name'];
      //   $seniorcitizen->last_name = $request['last_name'];  
      //   $seniorcitizen->gender = $request['gender'];
      //   $seniorcitizen->dob = $birth_date;
      //   $seniorcitizen->barangay_id = $request['barangay_id'];
      //   $seniorcitizen->address = $request['address'];
      //   $seniorcitizen->telephone = $request['telephone'];
      //   $seniorcitizen->mobile = $request['mobile'];
      //   $seniorcitizen->budget = $request['budget'];
      //   $seniorcitizen->lat = $request['lat'];
      //   $seniorcitizen->lng = $request['lng'];
      //   $seniorcitizen->caretakers_name = $request['caretakers_name'];
      //   $seniorcitizen->caretakers_number = $request['caretakers_number'];

      //   if ($seniorcitizen->save()){
      //     $id = $seniorcitizen->id; 
      //     $info = array( 'seniorcitizen_id'=>$id,
      //       'medicine_id'=>$request['medicine'],
      //       'qty'=>$request['qty'],
      //       'status' => 1);
      //     DB::table('medicine_seniorcitizen')->insert($info);

      //     if (!empty($request->input('medicine2'))) {
      //       $info = array( 'seniorcitizen_id'=>$id,
      //         'medicine_id'=>$request['medicine2'],
      //         'qty'=>$request['qty2'],
      //         'status' => 1);
      //       DB::table('medicine_seniorcitizen')->insert($info);
      //     }

      //     if (!empty($request->input('medicine3'))) {
      //       $info = array( 'seniorcitizen_id'=>$id,
      //         'medicine_id'=>$request['medicine3'],
      //         'qty'=>$request['qty3'],
      //         'status' => 1);
      //       DB::table('medicine_seniorcitizen')->insert($info);
      //     }

      //     if (!empty($request->input('medicine4'))) {
      //       $info = array( 'seniorcitizen_id'=>$id,
      //         'medicine_id'=>$request['medicine4'],
      //         'qty'=>$request['qty4'],
      //         'status' => 1);
      //       DB::table('medicine_seniorcitizen')->insert($info);
      //     }

      //     if (!empty($request->input('medicine5'))) {
      //       $info = array( 'seniorcitizen_id'=>$id,
      //         'medicine_id'=>$request['medicine5'],
      //         'qty'=>$request['qty5'],
      //         'status' => 1);
      //       DB::table('medicine_seniorcitizen')->insert($info);
      //     }

      //   }
      //   return redirect()->route('dashboard')->with('message', 'New Senior Citizen Added');
      // }
      // catch (Exception $e){
      //   return redirect()->back()->withErrors(['Senior Citizen ID already registered']);
      // }

    }

    public function requestMedicine($id)
    { 

      $seniorcitizens = SeniorCitizen::find($id);
      $courier = Courier::status()->parcel()->first();
      $initialbudget = $seniorcitizens->budget;
      $budget = $seniorcitizens->budget;
      $asd = 0;
      // dd($courier);
      foreach ($seniorcitizens->medicines as $medicine) {


        if ($medicine->pivot->status == 1 && $medicine->pivot->qty != 0) {


          $cost = $medicine->price * $medicine->pivot->qty;

          if($cost < $budget){

            $asd = $budget -= $cost;
            

          }

        }

      }

      // var_dump($t);
      // $medicines = DB::table('medicine_seniorinfo')
      // ->join('medicines', 'medicine_id', '=', 'medicine_seniorinfo.medicine_id') 
      // // ->select('medicine_seniorinfo.*', 'medicines.price', 'medicine_seniorinfo.qty', 'medicine_seniorinfo.dailyfrequency')
      // ->select(DB::raw('medicine_seniorinfo.*', ('medicines.price' * 'medicine_seniorinfo.qty') as $total))
      // ->where('seniorinfo_id', $id)
      // ->get();
      // dd($seniorinfos);
      // dd($total);

      return view('socialworker.requestMedicine' , ['seniorcitizens' => $seniorcitizens])->with('asd', $asd)->with('budget', $budget)->with('initialbudget', $initialbudget);
       // return view('socialworker.requestMedicine' , ['seniorinfos' => $seniorinfos]);

    }

    public function testParcel(Request $request)
    {
      $qty = $request['asd'];
      $dailyfrequency = $request['dailyfrequency'];
      $price = $request['price'];

      $total = $qty * 2;

      if ($qty > 1000) {
        echo($qty);
      }
      else{

      // $info = array('qty' => $qty);
      // DB::table('testparcels')->insert($info);
        echo "sakto ra";

        return redirect()->route('dashboard')->with('message', 'Parcel Successfully Processed');
      }
    }

    public function requestMedicine1($id)
    {
      // $qty            = $request['qty'];
      // $total = $qty * 5;
      // dd($total);
      // $status = DB::table('seniormedicines')
      //   ->select('status')
      //   ->get();

      $courier = Courier::status()->parcel()->first();

      //echo $courier->user_id;


      $seniorinfos = SeniorInfo::find($id);
      $remainingBudget = $seniorinfos->budget;
      $total = 0;
      foreach ($seniorinfos->medicines as $medicine) {

        $cost = $medicine->price * $medicine->pivot->qty;

        
        if ($medicine->pivot->status == 1) {


          $total += $cost;
          echo $total;
          echo "<br>";
          
        }

      }

      return view('socialworker.requestMedicine' , ['seniorinfos' => $seniorinfos], compact('cost'));



    }

    public function getSeniorProfile($id)
    {
      $seniorcitizens = SeniorCitizen::find($id);
      foreach ($seniorcitizens->medicines as $medicine) 
      {
        $medicine->pivot->medicine_seniorcitizen;
      } 
      $medicines = Medicine::pluck('name', 'id');
      // dd($seniorcitizens);
      return view('socialworker.senior-profile', ['seniorcitizens' => $seniorcitizens], compact('medicines') );
    }


    public function updateMedicineStatus( $id)
    {

      DB::table('medicine_seniorcitizen')
      ->where('medicine_id', $id)
      ->update(['status' =>0 , 'qty' => 0]);

      return redirect()->back()->with('message', 'Updated');

    }

    public function activateMedicineStatus($id)
    {

      DB::table('medicine_seniorcitizen')
      ->where('medicine_id', $id)
      ->update(['status' =>1]);

      return redirect()->back()->with('message', 'Updated');

    }

    public function updateSeniorStatus($id)
    {
      DB::table('seniorcitizens')
      ->where('id', $id)
      ->update(['status' =>0]);

      return redirect()->back()->with('message', 'Updated');

    }

    public function MedicineHistory()
    {

      echo "hello";
      return view('socialworker.seniorcitizen-medhistory');

    }

    public function InactiveList()
    {
      $seniorinfos = DB::table('seniorcitizens')
      ->select('id', 'first_name', 'last_name', 'gender', 'telephone')
      ->where('barangay_id', '=', Auth::user()->barangay_id)
      ->where('status', '=', 0)
      ->get();
      // dd($seniorinfos);
      return view('socialworker.inactive-seniorcitizens', compact('seniorinfos'));
    }

    public function activateSeniorStatus($id)
    {
      DB::table('seniorinfos')
      ->where('id', $id)
      ->update(['status' =>1]);

      return redirect()->back()->with('message', 'Updated');

    }

    public function storeParcelInfo(Request $request)
    {
      // dd($request->all());

     if(!is_null($request['medid']))
     {
      $parcel = $this->parcel;
      $medicineid = $request['medid'];
      $qty = $request['qty'];
      $courier = Courier::status()->parcel()->first();
      $parcel->seniorcitizen_id = $request['seniorid'];
      $parcel->courier_id = $courier->id;
      $parcel->totalPrice = $request['rem'];
      $parcel->status = 'pending';
      $total = $parcel->totalPrice;
      $asd = $request['asd'];
        // dd($medicineid);
      if ($parcel->save()){
        $id = $parcel->id;

        $parcelmedicines = [];
        for ($i=0; $i < count($medicineid) ; $i++) { 
         $parcelmedicines[] = [
          'parcel_id'=>$id,
          'medicine_id'=>$medicineid[$i],
          'qty'=>$qty[$i],];
        }
        DB::table('parcel_medicines')->insert($parcelmedicines);

        $seniorcitizens = DB::table('seniorcitizens')
        ->where('id', $parcel->seniorcitizen_id)
        ->update(['budget' => $asd]);

        $medicine_seniorcitizen = DB::table('medicine_seniorcitizen')
        ->where('seniorcitizen_id', $parcel->seniorcitizen_id)
        ->update(array('qty' => DB::raw('qty - qty')));

        $couriers = DB::table('couriers')
        ->where('id', $parcel->courier_id)
        ->increment('parcel');
      }


      return redirect()->route('dashboard')->with('message', 'Parcel Successfully Processed');
    }
    else
    {
      return redirect()->back()->withErrors(['No Medicines To Process']);
    }
  }
  public function updateMedicineList(Request $request)
  {
    try{
      $info = array( 'seniorcitizen_id'=>$request['id'],
        'medicine_id'=>$request['medicine'],
        'qty'=>$request['qty'],
        'status' => 1);
      DB::table('medicine_seniorcitizen')->insert($info);

      if (!empty($request->input('medicine2'))) {
        $info = array( 'seniorcitizen_id'=>$request['id'],
          'medicine_id'=>$request['medicine2'],
          'qty'=>$request['qty2'],
          'status' => 1);
        DB::table('medicine_seniorcitizen')->insert($info);
      } 
      return redirect()->back()->with('message', 'Added New Medicine');
    }
    catch (Exception $e){
      return redirect()->back()->withErrors(['Duplicated or Inactive Medicine ID']);
    }
  }

  public function updateElderlyProfile($id)
  {
    $elderly_info->update($request->all());
    return redirect()->route('socialworker.elderly-profile')->with('message', 'Elderly Information has been updated');
  }

  public function deleteElderlyProfile($id)
  {
    $seniorinfos = SeniorInfo::find($id);
    $seniorinfos->delete();
    return redirect()->route('dashboard')->with('message', 'Senior has been removed');
  }


  public function addQuantity(Request $request, $id)
  {
    $qwe = $request['first_name'];
        // $quantity = 5;
        // dd($qwe);
        // dd($quantity);
    $medicineseniorcitizen = DB::table('medicine_seniorcitizen')
    ->where('medicine_id', $id)
    ->increment('qty');
    return redirect()->back()->with('message', 'Added Quantity');

  }

  public function updateSeniorCitizenProfile(Request $request)
  {
    $birth_date = Carbon::createFromFormat("d-m-Y", $request->input('dob'));
    $seniorcitizen_id = $request['seniorcitizen_id'];
    $firstname = $request['first_name'];
    $lastname = $request['last_name'];
    $middlename = $request['middle_name'];
    $telephone = $request['telephone'];
    $mobile = $request['mobile'];
    $caretakers_name = $request['caretakers_name'];
    $caretakers_number = $request['caretakers_number'];
    $seniorcitizens = DB::table('seniorcitizens')
    ->where('id', $seniorcitizen_id)
    ->update(['first_name' => $firstname, 
      'last_name' => $lastname,
      'middle_name' => $middlename,
      'telephone' => $telephone,
      'mobile' => $mobile,
      'dob' => $birth_date,
      'caretakers_name' => $caretakers_name,
      'caretakers_number' => $caretakers_number]);
        // dd($lastname);
    return redirect()->back()->with('message', 'Senior Citizen Profile Updated');
  }

  public function addMedicineInfo(Request $request)
  {
    $elderly_medicine_infos = new ElderlyMedicineInfo;
    foreach ($request as $key => $v) {
      $data = array('medicine_id' => $v, );
    }
    dd($data);
  }
}

