<?php

use App\PaperSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrintRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paper_sizes = PaperSize::select('id')->get();
        $print_qualities = PaperSize::select('id')->get();

        foreach ($paper_sizes as $ps) {
            foreach ($print_qualities as $pq) {
                DB::table('print_rates')->insert([
                    'paper_size_id' => $ps->id,
                    'print_quality_id' => $pq->id,
                    'rate'          => random_int(1,10)
                ]);
            }
        }
    }
}
