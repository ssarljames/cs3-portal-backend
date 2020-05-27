<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
