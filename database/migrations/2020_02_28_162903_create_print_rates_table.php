<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_rates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedTinyInteger('paper_size_id');
            $table->foreign('paper_size_id')->references('id')->on('paper_sizes');

            $table->unsignedTinyInteger('print_quality_id');
            $table->foreign('print_quality_id')->references('id')->on('print_qualities');

            $table->decimal('rate', 4, 2);

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
        Schema::dropIfExists('print_rates');
    }
}
