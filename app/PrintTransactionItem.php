<?php

namespace App;

use App\Events\ModelEvents\PrintTransactionItem\PrintTransactionItemCreating;
use Illuminate\Database\Eloquent\Model;

class PrintTransactionItem extends Model
{
    protected $fillable = [
        'print_transaction_id',
        'paper_size_id',
        'print_quality_id',
        'quantity',
        'price',
        'total'
    ];

    protected $with = [ 'paper_size', 'print_quality' ];

    protected $dispatchesEvents = [
        'creating' => PrintTransactionItemCreating::class,
    ];


    public function paper_size()
    {
        return $this->belongsTo(PaperSize::class);
    }


    public function print_quality()
    {
        return $this->belongsTo(PrintQuality::class);
    }
}
