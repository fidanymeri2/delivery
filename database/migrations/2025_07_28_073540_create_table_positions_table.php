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
        Schema::create('table_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_table_id')->constrained('restaurant_tables')->onDelete('cascade');
            $table->foreignId('table_category_id')->constrained('table_categories')->onDelete('cascade');
            $table->integer('x_position')->default(0);
            $table->integer('y_position')->default(0);
            $table->integer('width')->default(100);
            $table->integer('height')->default(80);
            $table->integer('z_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Ensure unique position per table per category
            $table->unique(['restaurant_table_id', 'table_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_positions');
    }
};
