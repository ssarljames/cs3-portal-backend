<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'user_id',
        'login',
        'logout',
        'ip_address'
    ];
}
