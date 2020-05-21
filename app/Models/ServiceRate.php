<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\DB;

class ServiceRate extends BaseModel
{
    protected $fillable = [
        'type',
        'paper_size_id',
        'print_quality_id',
        'rate'
    ];

    public function scopeUpdatedRates(Builder $q){
        if(env('DB_CONNECTION') == 'mysql')
                return $q->fromRaw('(select * from service_rates as sr
                                    where
                                        created_at in (select max(created_at) as created_at from service_rates as sr2
                                                where sr.type = sr2.type
                                                and sr.paper_size_id = sr2.paper_size_id
                                                and sr.print_quality_id = sr2.print_quality_id
                                        )
                                    ) as service_rates')
                                    ->orderBy('type', 'desc')
                                    ->orderBy('paper_size_id')
                                    ->orderBy('print_quality_id');
            // return $q->select('type', 'paper_size_id', 'print_quality_id','rate', DB::raw('max(created_at) as x'))
            //                 ->whereRaw('created_at = x')
            //                 ->groupBy(['type', 'paper_size_id','print_quality_id']);

        if(env('DB_CONNECTION') == 'pgsql')
            return $q->fromRaw('(select (row_number() over (partition by
                                                                type, paper_size_id, print_quality_id
                                                                order by created_at desc)
                                    ) as rn,
                                    type,
                                    paper_size_id,
                                    print_quality_id,
                                    rate,
                                    created_at
                                    from service_rates) as service_rates')

                                    ->where('rn', 1)

                                    ->select(
                                        'type',
                                        'paper_size_id',
                                        'print_quality_id',
                                        'rate',
                                        'created_at'
                                    )
                                    ->orderBy('type', 'desc')
                                    ->orderBy('paper_size_id')
                                    ->orderBy('print_quality_id');
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
