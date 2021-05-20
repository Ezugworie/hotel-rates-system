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
        return Rate::orderBy('hotel_id', 'asc')
                    ->orderBy('start_date', 'asc')
                    ->get();  //returns values in ascending order

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

        $this->validate($request, [
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'hotel_id' => 'required',
            'number_of_adults' => 'required|numeric',
            'number_of_children' => 'required|numeric'
        ]);

        $start_date = $request->get('check_in_date');
        $end_date = $request->get('check_out_date');
        $hotel_id = $request->get('hotel_id');
        $number_of_adults = $request->get('number_of_adults');
        $number_of_children = $request->get('number_of_children');

        $adult_rate_query = '
                                SUM(
                                    DATEDIFF(
                                        if( end_date > ?, ?, end_date ),
                                        if( start_date < ?, ?, start_date )
                                    ) * adult_rate
                                )';

        $total_adult_rate = DB::table('rates')
                            ->where('hotel_id', '=', $hotel_id )
                            ->selectRaw(DB::raw($adult_rate_query), 
                                        [$end_date, $end_date, $start_date, $start_date])
                            ->where('start_date', '<', $end_date)
                            ->where('end_date', '>', $start_date)
                            ->get(); 

        $child_rate_query = '
                                SUM(
                                    DATEDIFF(
                                        if( end_date > ?, ?, end_date ),
                                        if( start_date < ?, ?, start_date )
                                    ) * child_rate
                                )';

        
        $total_child_rate = DB::table('rates')
                        ->where('hotel_id', '=', $hotel_id )
                        ->selectRaw(DB::raw($child_rate_query), 
                                    [$end_date, $end_date, $start_date, $start_date])
                        ->where('start_date', '<', $end_date)
                        ->where('end_date', '>', $start_date)
                        ->get();

        $db_result = [$total_adult_rate[0], $total_child_rate[0]];
        $result = [];
        
        foreach ($db_result as $obj) {
            foreach ($obj as $key => $value) {
                $result[] = $value;
            }
        }
        
        $overall_adults_rate = $result[0] * $number_of_adults;
        $overall_children_rate = $result[1] * $number_of_children;
        $overall_total_rate = $overall_adults_rate + $overall_children_rate;

        return response()->json([
            'per_adult_rate' => $result[0],
            'per_child_rate' => $result[1],
            'total_adults_rate' => $overall_adults_rate,
            'total_children_rate' => $overall_children_rate,
            'total_rate' => $overall_total_rate,
        ]);
    }

    protected function formatDate($date){
        $date = Carbon::createFromFormat('Y-m-d', $date);
        return $date;
    }
}
