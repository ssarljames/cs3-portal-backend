<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationUsageLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_usage_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id')->references('id')->on('stations');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->dateTime('time_in');
            $table->dateTime('time_out')->nullable();
            $table->boolean('force_logged_out')->default(false);

            $table->unsignedSmallInteger('total_time')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_usage_logs');
    }
}
