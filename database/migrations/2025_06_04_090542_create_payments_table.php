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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->unsignedBigInteger('order_id');
            $table->decimal('sub_total',20,2);
            $table->enum('status',
                [
                    'Chờ xác nhận',
                    'Đã thanh toán',
                    'Đã hủy'
                ])
                ->default('Chờ xác nhận');


            $table->foreign('order_id')->references('id')->on('orders');
            $table->timestamps();

            /*
            'date',
            'description',
            'order_id',
            'status',
            'sub_total' 
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
