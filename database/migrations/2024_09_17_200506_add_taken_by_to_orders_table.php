<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->unsignedBigInteger('taken_by')->nullable(); // ID of the delivery user who takes the order
        $table->foreign('taken_by')->references('id')->on('users'); // Foreign key to users table
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['taken_by']);
        $table->dropColumn('taken_by');
    });
}
};
