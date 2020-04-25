<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventTimeLogResource extends JsonResource
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
            'event_id' => $this->event_id, 
            'user_id' => $this->user_id, 
            'entry_by_user_id' => $this->entry_by_user_id, 
            'time' => $this->time, 
            'type' => $this->type, 
            'monitoring_group' => $this->monitoring_group, 
            'user' => $this->user, 
            'entry_by_user' => $this->entry_by_user, 
        ];
    }
}
