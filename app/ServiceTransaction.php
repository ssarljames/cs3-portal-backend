<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'member_id',
        'sales',
        'time'
    ];
}
