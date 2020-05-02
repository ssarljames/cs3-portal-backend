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


    /**
     * Return collection of App/User
     */
    public function attend_by_users()
    {
        return $this->belongsToMany(

                        User::class, 
                        'event_time_logs', 
                        'event_id', 
                        'user_id'

                )->withPivot([
                    'event_id',
                    'user_id',
                    'entry_by_user_id',
                    'time',
                    'type'
                ]);
    }


    public function attend_by_students()
    {
        return $this->belongsToMany(
                            Student::class,
                            'attendances',
                            'event_id', 
                            'student_id')
                    ->withPivot([
                            'event_id',
                            'student_id',
                            'log_time',
                            'log_type'
                    ]);
    }
}
