<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTransactionItem extends Model
{
    protected $fillable = [
        'service_transaction_id',
        'type',
        'paper_size_id',
        'print_quality_id',
        'quantity',
        'price',
        'total'
    ];
}
