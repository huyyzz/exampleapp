<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_items');
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity');

            $table->string('product_price');

            $table->foreign('product_id')->references('id')->on('cloths')->onDelete('set null');

            $table->foreign('order_id')->references('id')->on('orders');


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
        Schema::dropIfExists('order_items');
    }
};
