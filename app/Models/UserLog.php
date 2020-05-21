<?php

namespace App\Models;



class UserLog extends BaseModel
{
    protected $fillable = [
        'user_id',
        'login',
        'logout',
        'ip_address'
    ];
}
