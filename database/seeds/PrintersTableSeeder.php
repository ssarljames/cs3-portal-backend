<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrintersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('printers')->insert([
            'description' => 'HP L330'
        ]);
    }
}
