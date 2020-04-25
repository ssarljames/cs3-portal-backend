<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'user_id',
        'start_date',
        'end_date',
        'include_weekends'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function time_logs()
    {
        return $this->hasMany(EventTimeLog::class);
    }
}
