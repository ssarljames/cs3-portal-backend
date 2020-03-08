<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperSize extends Model
{
    protected $fillable = [
        'description',
        'dimension'
    ];
}
