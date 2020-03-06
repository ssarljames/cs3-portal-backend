<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'id' => 1,
            'id_number' => '00-0-0000',
            'firstname' => 'Juan',
            'lastname' => 'Dela Cruz'
        ]);
    }
}
