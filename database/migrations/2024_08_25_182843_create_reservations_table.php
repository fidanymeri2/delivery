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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing ID
            $table->string('name'); // VARCHAR field for first name
            $table->string('last_name'); // VARCHAR field for last name
            $table->string('address'); // VARCHAR field for address
            $table->string('postal_code'); // VARCHAR field for postal code
            $table->date('date'); // DATE field for reservation date
            $table->time('time_reservation'); // TIME field for reservation time
            $table->text('description')->nullable(); // TEXT field for description, nullable
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
