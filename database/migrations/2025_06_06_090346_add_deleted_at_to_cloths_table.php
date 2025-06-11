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
        // Schema::table('cloths', function (Blueprint $table) {
        //     $table->softDeletes(); // Adds deleted_at TIMESTAMP (nullable)
        // });
    }

    public function down()
    {
        // Schema::table('cloths', function (Blueprint $table) {
        //     $table->dropSoftDeletes(); // Drops the deleted_at column
        // });
    }
};
