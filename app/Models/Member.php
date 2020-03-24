<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    protected $appends = [ 'fullname' ];

    public static function query(){
        return parent::query()->where('id', '>', 1);
    }


    public function getFullnameAttribute(){
        return ucwords(strtolower($this->lastname . ', ' . $this->firstname));
    }
}
