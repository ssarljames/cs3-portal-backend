<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'code',
        'college_id'
    ];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
