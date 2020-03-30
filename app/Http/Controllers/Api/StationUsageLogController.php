<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\StationUsageLog;
use App\User;
use Illuminate\Http\Request;

class StationUsageLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->has('duty_time_percentage'))
            return $this->dutyTimePercentage($request);

        $query = StationUsageLog::query();

        $query->with(['user', 'station']);

        if($request->has('sortBy'))
            $query->orderBy($request->sortBy, $request->has('sortOrder') ?  $request->sortOrder : 'asc' );


        $logs = $query->paginate($request->page_size ? $request->page_size : $this->defaultPageSize);

        foreach ($logs as $log) {
            $log->validate();
        }

        return $logs;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    public function dutyTimePercentage(Request $request){

        $dutyTimePercentages = [];

        $total_time = StationUsageLog::query()->sum('total_time');

        $suls = StationUsageLog::selectRaw("user_id,
                                           sum(total_time) as total_time")
                                        ->groupBy('user_id')
                                        ->orderBy('total_time', 'desc')
                                        ->with('user')
                                        ->paginate(100);

        foreach ($suls as $sul) {
            $sul->percentage = round(($sul->total_time * 100.0) /  $total_time, 2);
        }

        return $suls;

    }
}
