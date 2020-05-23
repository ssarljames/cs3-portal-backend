<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('program_id')->nullable();
            $table->foreign('program_id')->references('id')->on('programs');

            $table->unsignedTinyInteger('year_level')->default(0);

            $table->string('current_address')->nullable();
            $table->string('home_address')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'program_id',
                'year_level',
                'current_address',
                'home_address'
            ]);
        });
    }
}
