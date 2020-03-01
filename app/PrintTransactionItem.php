<?php

namespace App;

use App\Events\ModelEvents\PrintTransactionItem\PrintTransactionItemCreating;
use Illuminate\Database\Eloquent\Model;

class PrintTransactionItem extends Model
{
    protected $fillable = [
        'print_transaction_id',
        'size',
        'quality',
        'quantity',
        'price',
        'total'
    ];


    protected $dispatchesEvents = [
        'creating' => PrintTransactionItemCreating::class,
    ];
}
