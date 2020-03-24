<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Station::query();

        $stations = $query->paginate();

        return $stations;
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
    public function show(Station $station)
    {
        return $station;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Station $station)
    {
        if($request->has('use') && $request->has('password')){

            if(Hash::check($request->password, $request->user()->password) == false){
                return response()->json([
                    'message' => 'Password is incorrect'
                ], 401);
            }

            if($station->current_session == null){
                $station->usage_logs()->create([
                    'user_id' => $request->user()->id,
                    'time_in' => now()
                ]);
            }

            return $station;
        }


        if($request->has('leave') && $request->has('password')){


            if(Hash::check($request->password, $request->user()->password) == false){
                return response()->json([
                    'message' => 'Password is incorrect'
                ], 401);
            }

            if($station->current_session && $station->current_session->user_id == $request->user()->id){
                $station->current_session->update([
                    'time_out' => now()
                ]);
            }

            return $station;
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
        //
    }
}
