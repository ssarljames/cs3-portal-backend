<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $isPostgres;

    // public static function like(){
    //     return env('DB_CONNECTION') == 'pgsql'
    //             ? 'ILIKE'
    //             : 'LIKE';
    // }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->isPostgres = env('DB_CONNECTION') == 'pgsql';
    }

    public function trimParamater($str){
        return str_replace("'", '', strtolower(trim($str)));
    }
}
