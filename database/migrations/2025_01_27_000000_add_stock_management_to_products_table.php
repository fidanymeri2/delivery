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
        Schema::table('products', function (Blueprint $table) {
            // Stock management columns
            $table->boolean('requires_stock')->default(false)->after('status')->comment('Whether this product requires stock tracking');
            $table->integer('current_stock')->default(0)->after('requires_stock')->comment('Current available stock quantity');
            $table->integer('min_stock_level')->default(0)->after('current_stock')->comment('Minimum stock level before low stock alert');
            $table->integer('max_stock_level')->nullable()->after('min_stock_level')->comment('Maximum stock level for reordering');
            $table->string('stock_unit')->default('pieces')->after('max_stock_level')->comment('Unit of measurement for stock (pieces, kg, liters, etc.)');
            $table->boolean('low_stock_alert')->default(false)->after('stock_unit')->comment('Whether low stock alerts are enabled');
            $table->timestamp('last_stock_update')->nullable()->after('low_stock_alert')->comment('Last time stock was updated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'requires_stock',
                'current_stock',
                'min_stock_level',
                'max_stock_level',
                'stock_unit',
                'low_stock_alert',
                'last_stock_update'
            ]);
        });
    }
}; 