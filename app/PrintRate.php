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

    public function scopeUpdatedRates(Builder $q){
        if(env('DB_CONNECTION') == 'mysql')
            return $q->select('paper_size_id', 'print_quality_id','rate', DB::raw('max(created_at) as created_at'))
                            ->groupBy('paper_size_id','print_quality_id');

        if(env('DB_CONNECTION') == 'pgsql')
            return $q->fromRaw('(select (row_number() over (partition by
                                                                paper_size_id, print_quality_id
                                                                order by created_at desc)
                                    ) as rn,
                                    paper_size_id,
                                    print_quality_id,
                                    rate,
                                    created_at
                                    from print_rates) as print_rates')

                                    ->where('rn', 1)

                                    ->select(
                                        'paper_size_id',
                                        'print_quality_id',
                                        'rate',
                                        'created_at'
                                    );
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
