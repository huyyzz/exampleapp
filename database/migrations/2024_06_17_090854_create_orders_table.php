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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('customer_id');
            $table->enum('status',
                [
                    'Chờ duyệt đơn',
                    'Đang giao hàng',
                    'Đã giao',
                    'Đã hủy'
                ])
                ->default('Chờ duyệt đơn');
            $table->decimal('sub_total',20,2);



           $table->foreign('customer_id')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
