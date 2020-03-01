<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public static function query(){
        return parent::query()->where('id', '>', 1);
    }
}
