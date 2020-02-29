<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrinterUsageLog extends Model
{
    protected $fillable = [
        'printer_id',
        'user_id',
        'start',
        'end',
        'total_time'
    ];

    protected $dates = ['start', 'end'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
