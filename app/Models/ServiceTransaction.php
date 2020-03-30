<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ServiceTransaction extends Model
{
    protected $fillable = [
        'station_id',
        'user_id',
        'member_id',
        'sales',
        'time',

        'remarks'
    ];

    const PRINT = 1;
    const SCAN = 2;

    const TYPES = [
        [
            'key' => self::PRINT,
            'value' => 'Print'
        ],
        [
            'key' => self::SCAN,
            'value' => 'Scan'
        ]
    ];

    public function items()
    {
        return $this->hasMany(ServiceTransactionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function scopeStationId(Builder $q, $station_id){
        return $q->where('station_id', $station_id);
    }

    public function scopeFromTime(Builder $q, $time){
        return $q->where('time', '>=', $time);
    }

    public function scopeToTime(Builder $q, $time){
        return $q->where('time', '<=', $time);
    }
}
