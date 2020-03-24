<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_transaction_items', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('service_transaction_id');
            $table->foreign('service_transaction_id')->references('id')->on('service_transactions');

            $table->unsignedInteger('type');

            $table->unsignedTinyInteger('paper_size_id')->nullable();
            $table->foreign('paper_size_id')->references('id')->on('paper_sizes');

            $table->unsignedTinyInteger('print_quality_id')->nullable();
            $table->foreign('print_quality_id')->references('id')->on('print_qualities');

            $table->unsignedInteger('quantity');
            $table->unsignedDecimal('price', 5, 2);

            $table->unsignedDecimal('total');

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
        Schema::dropIfExists('service_transaction_items');
    }
}
