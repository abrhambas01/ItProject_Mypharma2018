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
        
        if ( request()->hasFile('barangay_hall_photo')) { 

            $image = request()->file('barangay_hall_photo') ;

            $path = $image->store('barangays','public');

            // return $image->getClientOriginalName()   ; 
            
            // $thumbImage = Image::make(Storage::get($image))->resize(75,null,function($constraint){
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })->encode('png',75);   

            // $fileName = $image->getClientOriginalName() ; 

            // Storage::put($image);
            // Storage::put('public/medicines/'.$image);

            $medicine = Barangay::create([  
                'medicine_class_id' => request('medicine_class_id'),
                'name' => request('name'),
                'form' => request('dosage_form'),
                'price'=> request('price'),
                'picture' => $path 
            ]);

            return response()->json($medicine);

        }

        else {


         $medicine = Medicine::create([  
            'medicine_class_id' => request('medicine_class_id'),
            'name' => request('name'),
            'form' => request('dosage_form'),
            'price'=> request('price'),
            'picture' => 'medicines/default_picture.jpg' 
        ]);

         return response()->json($medicine);


         return response('No file',500);

     }





        // $attachment_path = $this->upload($request->file('photo'), 'medicines');

        // $this->makethumbNail($photo);

        // Image::make($photo)->resize(75, 75)->save(storage_path('medicines/thumbs/'.$photo->hashName(),60));         



        // return response()->json($request);

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
