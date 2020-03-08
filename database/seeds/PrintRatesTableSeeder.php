<?php

use App\PaperSize;
use App\PrintQuality;
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
        $paper_sizes = PaperSize::all();
        $print_qualities = PrintQuality::all();

        $price = 1;

        foreach ($paper_sizes as $ps) {
            foreach ($print_qualities as $pq) {
                DB::table('print_rates')->insert([
                    'paper_size_id' => $ps->id,
                    'print_quality_id' => $pq->id,
                    'rate'          => 1,
                    'created_at' => "2019-12-31"
                ]);

                $this->command->info($ps->description . ' - ' . $pq->description);
            }
        }


        $this->command->info('--------------------------------------------------');

        foreach ($paper_sizes as $ps) {
            foreach ($print_qualities as $pq) {
                if($ps->id && $pq->id){
                    DB::table('print_rates')->insert([
                        'paper_size_id' => $ps->id,
                        'print_quality_id' => $pq->id,
                        'rate'          => 2,
                        'created_at' => date("Y-m-d")
                    ]);
                    $this->command->info($ps->description . ' - ' . $pq->description);
                }
            }
        }
    }
}
