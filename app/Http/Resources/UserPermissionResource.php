<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($request->route()->getName() == 'me' 
                || $request->route()->getName() == 'update-profile')
                
            return [
                'permission_code' => $this->permission_code
            ];

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'permission' => $this->permission,
            'type' => $this->type,
            'granted_by_user_id' => $this->granted_by_user_id,
            'permission_label' => $this->permission_label,
            'type_label' => $this->type_label
        ];
    }
}
