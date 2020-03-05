<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_transaction_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('print_transaction_id');
            $table->foreign('print_transaction_id')->references('id')->on('print_transactions');

            $table->unsignedTinyInteger('paper_size_id');
            $table->foreign('paper_size_id')->references('id')->on('paper_sizes');

            $table->unsignedTinyInteger('print_quality_id');
            $table->foreign('print_quality_id')->references('id')->on('print_qualities');

            $table->unsignedInteger('quantity');
            $table->decimal('price', 5, 2);
            $table->decimal('total');

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
        Schema::dropIfExists('print_transaction_items');
    }
}
