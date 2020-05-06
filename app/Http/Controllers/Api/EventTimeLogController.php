<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventTimeLogResource;
use App\Models\Event;
use App\Models\EventTimeLog;
use App\Models\Student;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EventTimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event, Request $request)
    {
        $query = $event->time_logs();

        if($request->date)
            $query->dated($request->date);

        $query->orderBy('time', 'desc');


        $logs = $query->paginate(0);

        return EventTimeLogResource::collection($logs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $rule = [
            // 'user_id' => 'required|exists:users,id',
            // 'time'    => 'date_format:Y-m-d h:i:s'
            'code'  => 'required',
            'type'  => 'required'
        ];


        $request->validate($rule);

        $code = $request->code;

        $user = User::whereHasMorph('userable',
                        [ Student::class ],
                        function(Builder $q1) use ($code){
                            $q1->where('id_number', $code);
                        })
                        ->select('id')
                        ->first();

        if($user){

            $exist = EventTimeLog::where('event_id', $event->id)
                                    ->where('user_id', $user->id)
                                    ->where('type', $request->type)
                                    ->whereDate('time', date("Y-m-d"))
                                    ->count() > 0;

            if($exist == false) {                                   
                $log = EventTimeLog::create([
                    'event_id' => $event->id,
                    'user_id'  => $user->id,
                    'entry_by_user_id' => $request->user()->id,
                    'time'      => now(),
                    'type'      => $request->type,
                    'monitoring_group' => 1
                ]);
    
                return new EventTimeLogResource($log);
            }
            else
                return response()->json([
                    'message' => 'Entry already exist'
                ], 409);
        
        }

        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\EventTimeLog  $eventTimeLog
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, EventTimeLog $eventTimeLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @param  \App\Models\EventTimeLog  $eventTimeLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, EventTimeLog $eventTimeLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\EventTimeLog  $eventTimeLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, EventTimeLog $eventTimeLog)
    {
        //
    }
}
