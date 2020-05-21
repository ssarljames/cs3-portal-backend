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
        'user_id'
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
        $q = $this->trimStringParamater($q);

        if(!$q)
            return $query;


        return $query->where(function($query) use ($q){
            $query->whereRaw("LOWER(firstname) LIKE '$q%'")
                    ->orWhereRaw("LOWER(lastname) LIKE '$q%'");
        });
    }
}
