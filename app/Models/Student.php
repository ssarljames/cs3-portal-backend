<?php

namespace App\Models;

use App\Events\ModelEvents\Student\StudentCreated;
use App\Events\ModelEvents\Student\StudentCreating;
use App\Events\ModelEvents\Student\StudentUpdated;
use App\User;
use Illuminate\Database\Eloquent\Builder;


class Student extends BaseModel
{
    protected $fillable = [
        'id_number',
        'firstname',
        'lastname',
        'middlename',
        'user_id',
        'program_id',
        'year_level',
        'current_address',
        'home_address'
    ];

    public $dispatchesEvents = [
        'creating' => StudentCreating::class,
        'created' => StudentCreated::class,
        'updated' => StudentUpdated::class 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function scopeSearch(Builder $query, $q){
        $q = $this->trimParamater($q);

        if(!$q)
            return $query;


        return $query->where(function($query) use ($q){
            $query->whereRaw("LOWER(firstname) LIKE '$q%'")
                    ->orWhereRaw("LOWER(lastname) LIKE '$q%'");
        });
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
