<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hotel::orderBy('created_at', 'asc')->get();  //returns values in ascending order

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'stars' => 'required',
        ]);
  
        $hotel = new Hotel([
            'name' => $request->get('name'),
            'stars' => $request->get('stars'),
            'address' => $request->get('address'),
        ]);
        $hotel->save(); 
        return response()->json(['message' => 'Hotel Added', 'Hotel' => $hotel]);
 
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
        $request->validate([
            'name'=>'required',
            'stars'=>'required',
        ]);
        if (Hotel::where('id', $id)->exists()) {
            $hotel = Hotel::find($id);
            $hotel->name =  $request->get('name');
            $hotel->stars = $request->get('stars');
            $hotel->address = $request->get('address');
            $hotel->save();
            return response()->json(['message' => 'Hotel Updated', 'Hotel' => $hotel]);
        }else {
            return response()->json([
                "message" => "Hotel not found"
              ], 404);
        }
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Hotel::where('id', $id)->exists()) {
            $contact = Hotel::find($id);
            $contact->delete();
            return response()->json(['message' => 'Hotel Deleted']);

        }else {
            return response()->json([
                "message" => "Hotel not found"
              ], 404);
        }
    }
}
