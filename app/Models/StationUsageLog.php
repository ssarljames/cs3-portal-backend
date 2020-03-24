<?php

namespace App\Models;

use App\Events\ModelEvents\StationUsageLog\StationUsageLogUpdating;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StationUsageLog extends Model
{
    protected $fillable = [
        'station_id',
        'user_id',
        'time_in',
        'time_out',
        'force_logged_out',
        'total_time',


        'total_sales'
    ];

    protected $appends = [ 'total_time_formatted' ];

    protected $dates = [
        'time_in',
        'time_out'
    ];

    public function getTotalTimeFormattedAttribute(){
        $hours = (int)($this->total_time / 60);
        $mins = ($this->total_time % 60);

        return ($hours > 0 ? "{$hours} hr" : '') . ($mins > 0 && $hours > 0 ? ' & ' : '') . "{$mins} min" ;

    }

    protected $dispatchesEvents = [
        'updating' => StationUsageLogUpdating::class
    ];

    public function scopeActiveSessions(Builder $q){
        return $q->whereNull('time_out')->orderBy('time_in');
    }

    public function scopeInactiveSessions(Builder $q){
        return $q->whereNotNull('time_out')->whereNotNull('time_in');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
