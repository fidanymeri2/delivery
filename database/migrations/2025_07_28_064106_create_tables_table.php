<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurant_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_category_id')->constrained('table_categories')->onDelete('cascade');
            $table->string('table_number'); // e.g., "Table 1", "Table 2"
            $table->enum('status', ['available', 'occupied', 'reserved', 'maintenance'])->default('available');
            $table->integer('capacity')->default(4); // number of seats
            $table->text('notes')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_tables');
    }
};
