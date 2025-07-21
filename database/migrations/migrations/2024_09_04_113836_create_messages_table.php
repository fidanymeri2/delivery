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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Kolona për ID unike
            $table->string('category'); // Kolona për kategorinë e mesazhit
            $table->text('description'); // Kolona për përshkrimin e mesazhit
            $table->timestamps(); // Kolonat për datën e krijimit dhe përditësimit
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
