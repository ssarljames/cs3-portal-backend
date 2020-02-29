<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterUsageLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_usage_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('printer_id');
            $table->foreign('printer_id')->references('id')->on('printers');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->dateTime('start');
            $table->dateTime('end')->nullable();

            $table->decimal('total_time')->default(0);

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
        Schema::dropIfExists('printer_usage_logs');
    }
}
