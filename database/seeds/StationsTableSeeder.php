<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stations')->insert([
           'description' => 'Station 1'
        ]);
        DB::table('stations')->insert([
           'description' => 'Station 2'
        ]);
    }
}
