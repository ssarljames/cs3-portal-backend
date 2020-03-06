<?php

namespace App;

use App\Events\ModelEvents\PrintTransaction\PrintTransactionCreating;
use Illuminate\Database\Eloquent\Model;

class PrintTransaction extends Model
{
    protected $fillable = [
        'printer_id',
        'user_id',
        'member_id',
        'sales',
        'time'
    ];

    protected $dates = ['time'];


    protected $dispatchesEvents = [
        'creating' => PrintTransactionCreating::class,
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
        return $this->belongsTo(Member::class);
    }

    public function transaction_items()
    {
        return $this->hasMany(PrintTransactionItem::class);
    }

    public function updateSales(){
        $this->update([
            'sales' => $this->transaction_items()->sum('total')
        ]);
    }

    public function scopeTransactionBy($q, $user_id=null){
        if($user_id)
            return $q->where('user_id', $user_id);
    }


    public function scopeCreatedSince($q, $datetime=null){
        if($datetime)
            return $q->where('created_at', '>=', $datetime);
    }
}
