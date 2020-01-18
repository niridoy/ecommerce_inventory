<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_sends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->unique();
            $table->unsignedBigInteger('product_id')->on('');
            $table->integer('unit')->default(0);
            $table->boolean('is_received')->default(false);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('product_stock_sends');
    }
}
