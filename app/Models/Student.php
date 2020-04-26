<?php

namespace App\Models;

use App\Events\ModelEvents\Student\StudentCreating;
use App\Events\ModelEvents\Student\StudentUpdated;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
}
