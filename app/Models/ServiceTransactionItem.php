<?php

namespace App\Models;



class ServiceTransactionItem extends BaseModel
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
