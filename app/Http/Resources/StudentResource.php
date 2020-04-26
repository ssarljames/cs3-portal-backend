<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'id_number' => $this->id_number,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
            'user_id' => $this->user_id,
            'created_by_user_id' => $this->created_by_user_id,
            
            'user' => $request->has('include.user')
                            ? $this->user
                            : null,

            'created_by_user' => $request->has('include.created_by_user')
                                    ? $this->created_by_user
                                    : null,

            'created_at' => $this->created_at
        ];
    }
}
