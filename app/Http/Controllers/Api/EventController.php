<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Event::query();

        $query->orderBy('start_date', 'desc');

        $events = $query->paginate();

        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required|max:100',
            'description' => 'required',
            'type' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date'  => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
            'include_weekends' => 'nullable'
        ];

        $data = $request->validate($rule);
        
        $data['include_weekends'] = $request->include_weekends ? true : false;

        $event = $request->user()->events()->create($data);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new EventResource(Event::find($id));
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
        $rule = [
            'name' => 'required|max:100',
            'description' => 'required',
            'type' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date'  => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
            'include_weekends' => 'nullable'
        ];

        $data = $request->validate($rule);

        $data['include_weekends'] = $request->include_weekends ? true : false;

        $event = Event::find($id);
        $event->update($data);

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try{
            Event::destroy($id);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();

            return response()->json([
                'error' => $e
            ], 500);
        }

        return [
            'message' => 'ok'
        ];
    }
}
