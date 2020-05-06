<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'    => $this->id,
            'username' => $this->username, 
    
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
    
            'reset_password' => $this->reset_password,
    
            'deactivated_at' => $this->deactivated_at,
    
            'userable_type' => $this->userable_type,
            'userable_id' => $this->userable_id,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'is_administrator' => $this->is_administrator,
            'fullname' => $this->fullname,
            'role' => $this->role,

            'permissions' =>  UserPermissionResource::collection($this->permissions)
        ];
    }
}
