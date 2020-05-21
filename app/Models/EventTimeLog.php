<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;


class EventTimeLog extends BaseModel
{
    protected $fillable = [
        'event_id',
        'user_id',
        'entry_by_user_id',
        'time',
        'type',
        'monitoring_group'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entry_by_user()
    {
        return $this->belongsTo(User::class, 'entry_by_user_id');
    }

    public function scopeDated(Builder $q, $date){

        if($date)
            return $q->where('time', '>=', "$date 00:00:00")
                     ->where('time', '<=', "$date 23:59:59");
    }
}
