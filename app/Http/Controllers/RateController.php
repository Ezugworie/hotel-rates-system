<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use Carbon\Carbon;


class RateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rate::orderBy('created_at', 'asc')->get();  //returns values in ascending order

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
            'adult_rate' => 'required',
            'child_rate' => 'required',
            'hotel_id' => 'required'
        ]);
  

        $rate = new Rate([
            // 'start_date' => $this->formatDate($request->get('start_date')),
            // 'end_date' => $this->formatDate($request->get('end_date')),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'adult_rate' => $request->get('adult_rate'),
            'child_rate' => $request->get('child_rate'),
            'hotel_id' => $request->get('hotel_id'),
        ]);
        $rate->save(); 
        
        return response()->json(['message' => 'Rate Added', 'Rate' => $rate]);

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
       
        if (Rate::where('id', $id)->exists()) {
            $rate = Rate::find($id);
            $rate->start_date =  $request->get('start_date');
            $rate->end_date = $request->get('end_date');
            $rate->adult_rate = $request->get('adult_rate');
            $rate->child_rate = $request->get('child_rate');
            $rate->save();
            return response()->json(['message' => 'Rate Updated', 'Rate' => $rate]);
        }else {
            return response()->json([
                "message" => "Rate not found"
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
        if (Rate::where('id', $id)->exists()) {
            $contact = Rate::find($id);
            $contact->delete();
            return response()->json(['message' => 'Rate Deleted']);

        }else {
            return response()->json([
                "message" => "Rate not found"
              ], 404);
        }
    }

    protected function formatDate($date){
        $date = Carbon::createFromFormat('Y-m-d', $date);
        return $date;
    }
}
