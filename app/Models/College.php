<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class College extends BaseModel
{
    protected $fillable = [
        'name',
        'code'
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }


    public function scopeSearch(Builder $query, $q){
        $q = $this->trimParamater($q);

        if(!$q)
            return $query;

        return $query->where(function($query) use ($q){
            $query->where(DB::raw('LOWER(name)'), 'LIKE', "%$q%")
                    ->orWhere(DB::raw('LOWER(code)'), 'LIKE', "%$q%");
        });

    }
}
