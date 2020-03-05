<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrintQualitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $print_qualities = [
            'Standard',
            'Draft',
            'Standard Graphics',
            'Whole Coloured Graphics'
        ];


        foreach ($print_qualities as $pq)
            DB::table('print_qualities')->insert([
                'description' => $pq
            ]);
    }
}
