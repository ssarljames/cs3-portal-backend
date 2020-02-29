<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintTransaction extends Model
{
    protected $fillable = [
        'printer_id',
        'user_id',
        'member_id',
        'sales'
    ];

    public function printer()
    {
        return $this->belongsTo(Printer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'foreign_key', 'other_key');
    }
}
