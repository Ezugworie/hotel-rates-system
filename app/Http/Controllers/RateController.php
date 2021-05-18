<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;



class RateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rate::orderBy('start_date', 'asc')->get();  //returns values in ascending order

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'adult_rate' => 'required',
            'child_rate' => 'required',
            'hotel_id' => 'required'
        ]);
  
        $allRates = Rate::orderBy('start_date', 'asc')->get();
        $newRate = new Rate([
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'adult_rate' => $request->get('adult_rate'),
            'child_rate' => $request->get('child_rate'),
            'hotel_id' => $request->get('hotel_id'),
        ]);

        //check if rates range already exists
        if($allRates){
            $start = Carbon::parse($request['start_date'])->format('Y-m-d 00:00:00');
            $end = Carbon::parse($request['end_date'])->format('Y-m-d 23:59:59');
            $existsActive = Rate::where(function ($query) use ($start) {
                                                 $query->where('start_date', '<=', $start);
                                                 $query->where('end_date', '>=', $start);
                                             })->orWhere(function ($query) use ($end) {
                                                 $query->where('start_date', '<=', $end);
                                                 $query->where('end_date', '>=', $end);
                                             })->count();
            if($existsActive > 0 ){
                return response()->json(['message' => 'Date ranges is overlapping, you might want to select another range ']);
            }else {
                $newRate->save();  
            }
           
        }else{
            $newRate->save(); 
        }

        return response()->json(['message' => 'Rate Added', 'Rate' => $newRate]);

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
            return response()->json(['message' => 'Ratet Updated', 'Rate' => $rate]);
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

     /**
     * Search rates.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $start_date = Carbon::parse($request->get('start_date'));
        $end_date = Carbon::parse($request->get('end_date'));

        $period = CarbonPeriod::create($start_date, $end_date);
        
        // foreach ($period as $date) {
        //     $date->format('Y-m-d');
        // }

        // $dates = $period->toArray();

        // // $number_of_days = $end_date->diffInDays($start_date);
        // $allRates = Rate::all();  //returns values in ascending order
        
        // foreach ($period as $date) {
        //    foreach ($allRates as $key => $value) {
        //         $idCats = array_column($cats, 'id');
        //    }
        // }
        // return $allRates;

        $dates = Rate::where('hotel_id','=',$request->get('hotel_id'))
        ->whereBetween('start_date', array($request->start_date, $request->end_date))
        ->whereBetween('end_date', array($request->start_date, $request->end_date))
        ->get();

        return $dates;
    }

    protected function formatDate($date){
        $date = Carbon::createFromFormat('Y-m-d', $date);
        return $date;
    }
}
