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
        Schema::table('payments', function (Blueprint $table) {

            $table->enum('payment_type',
                [
                    'COD',
                    'VNPAY',
                ])
                ->default('COD');

            $table->string('p_note')->nullable()->comment('ghi chú thanh toán');
            $table->string('p_vnp_response_code', 255)->nullable()->comment('mã phản hồi');
            $table->string('p_code_vnpay', 255)->nullable()->comment('mã giao dịch vnpay');
            $table->string('p_code_bank', 255)->nullable()->comment('mã ngân hàng');
            $table->dateTime('p_time')->nullable()->comment('thời gian chuyển khoản');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
};
