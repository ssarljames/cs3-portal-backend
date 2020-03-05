<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PrintRate extends Model
{
    protected $fillable = [
        'paper_size_id',
        'print_quality_id',
        'rate'
    ];



    public static function scopeUpdatedRates($q){
        // return DB::select('(select `paper_size_id`, `print_quality_id`, `rate`, max(created_at) as created_at from `print_rates` group by `paper_size_id`, `print_quality_id`)');
        return $q->select('paper_size_id',
                            'print_quality_id',
                            'rate',
                            DB::raw('max(created_at) as created_at'))
                            ->groupBy('paper_size_id','print_quality_id');
    }

    public function paper_size()
    {
        return $this->belongsTo(PaperSize::class);
    }

    public function print_quality()
    {
        return $this->belongsTo(PrintQuality::class);
    }
}
