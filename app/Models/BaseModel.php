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

    public function __construct()
    {
        $this->isPostgres = env('DB_CONNECTION') == 'pgsql';
    }

    public function trimStringParamater($str){
        return str_replace("'", '', strtolower(trim($str)));
    }
}
