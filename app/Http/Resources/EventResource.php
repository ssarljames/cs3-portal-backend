<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'user_id' => $this->user_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_at' => $this->created_at,
            'include_weekends' => $this->include_weekends,
            'user' => $this->user,

            'time_logs' =>  $request->include_logs 
                            ? EventTimeLogResource::collection(
                                    $this->time_logs()
                                            ->dated($request->all_logs
                                                        ? date("Y-m-d")
                                                        : null)->get()
                                )
                            : [],

            'attend_by_users' => $this->attend_by_users()->get()

        ];
    }
}
