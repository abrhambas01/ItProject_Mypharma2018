<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\DosageRequest;

use App\Core\Traits\ManagesUploads; 

use App\Core\Queries\MedicineQueries; 

use Image ; 

use App\Dosage ; 

use Debugbar ; 

use Storage ; 

use Carbon\Carbon ; 
use App\Medicine ; 

class MedicinesController extends Controller
{

    use ManagesUploads ; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MedicineQueries $query)
    {

        $medicines = $query->getAllInformation() ; 

        Debugbar::info($medicines);

        return view('admin.medicines.index',compact('medicines'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function store(DosageRequest $request)
    {   
        if ( request()->hasFile('photo')) { 

            $image = request()->file('photo') ;

            $path = $image->store('medicines','public');

            // return $image->getClientOriginalName()   ; 
            
            // $thumbImage = Image::make(Storage::get($image))->resize(75,null,function($constraint){
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })->encode('png',75);   

            // $fileName = $image->getClientOriginalName() ; 

            // Storage::put($image);
            // Storage::put('public/medicines/'.$image);

            $medicine = Medicine::create([  
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
       $dosage = Dosage::find($id)->with('medicine');
       dd($dosage);
     // return view('admin.medicines.show',compact('dosage'));
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
    public function destroy($id)
    {
        //
    }
}
