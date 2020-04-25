<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventTimeLogResource;
use App\Models\Event;
use App\Models\EventTimeLog;
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
            'user_id' => 'required|exists:users,id',
            'time'    => 'date_format:Y-m-d h:i:s'
        ];

        $data = $request->validate($rule);

        $log = EventTimeLog::create([
            'event_id' => $event->id,
            'user_id'  => $data['user_id'],
            'entry_by_user_id' => $request->user()->id,
            'time'      => now(),
            'type'      => 1,
            'monitoring_group' => 1
        ]);

        return new EventTimeLogResource($log);
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
