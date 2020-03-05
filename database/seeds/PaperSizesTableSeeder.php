<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaperSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paper_sizes = [
            [
                'description' => 'Letter',
                'dimension' => '8.5in × 11in'
            ],
            [
                'description' => 'Long',
                'dimension' => '8.5in × 13in'
            ],
            [
                'description' => 'A4',
                'dimension' => '8.27in × 11.69in'
            ],
        ];


        foreach ($paper_sizes as $ps)
            DB::table('paper_sizes')->insert($ps);

    }
}
