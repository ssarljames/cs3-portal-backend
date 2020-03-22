<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MembersTableSeeder::class);

        $this->call(PaperSizesTableSeeder::class);
        $this->call(PrintQualitiesTableSeeder::class);
        $this->call(PrintRatesTableSeeder::class);

        $this->call(StationsTableSeeder::class);
    }
}
