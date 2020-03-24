<?php

use App\Models\PaperSize;
use App\Models\PrintQuality;
use App\Models\ServiceTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceRatesTableSeeder extends Seeder
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


        DB::table('service_rates')->insert([
            'type' => ServiceTransaction::SCAN,
            'rate'          => 10,
            'created_at' => now()
        ]);


        $ctr = 0.5;

        foreach ($paper_sizes as $ps) {
            foreach ($print_qualities as $pq) {
                DB::table('service_rates')->insert([
                    'type' => ServiceTransaction::PRINT,
                    'paper_size_id' => $ps->id,
                    'print_quality_id' => $pq->id,
                    'rate'          => $ctr,
                    'created_at' => now()
                ]);

                $ctr += 0.5;

                $this->command->info($ps->description . ' - ' . $pq->description);
            }
        }


        // $this->command->info('--------------------------------------------------');

        // foreach ($paper_sizes as $ps) {
        //     foreach ($print_qualities as $pq) {
        //         if($ps->id && $pq->id){
        //             DB::table('service_rates')->insert([
        //                 'paper_size_id' => $ps->id,
        //                 'print_quality_id' => $pq->id,
        //                 'rate'          => 2,
        //                 'created_at' => date("Y-m-d")
        //             ]);
        //             $this->command->info($ps->description . ' - ' . $pq->description);
        //         }
        //     }
        // }
    }
}
