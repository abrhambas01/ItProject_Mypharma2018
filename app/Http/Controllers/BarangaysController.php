<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Barangay ; 

class BarangaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangays = Barangay::get();
        return view('admin.barangays.index',compact('barangays')) ; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.barangays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barangay = Barangay::find($id);
        
        return view('admin.barangays.show')->withBarangay($barangay);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $barangay = Barangay::find($id);  
        return view('admin.barangays.edit',compact('barangay'));
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
        if (request()->barangay_hall_picture == null) {

          $barangay = Barangay::find($id);

          $barangay->name = $request->name ;

          $barangay->facebook_profile = $request->facebook_profile ;

          $barangay->barangay_hall_picture  = 'barangay_hall.jpg' ; 

          $barangay->save();  
      }
      else {

         $barangay = Barangay::find($id);

         $barangay->name = $request->name ;

         $barangay->facebook_profile = $request->facebook_profile ;

         $barangay->barangay_hall_picture  = $request->barangay_hall_photo ; 

         $barangay->save();  


     }




        // Session::flash('success', 'Comment updated');

     return redirect()->route('barangays.index');
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getBarangays(){
        $barangays = Barangay::select('name','id')->get(); 
        return $barangays ; 
    }

}
