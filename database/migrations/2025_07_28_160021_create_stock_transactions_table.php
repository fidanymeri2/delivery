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
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->comment('User who made the transaction');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null')->comment('Related order if transaction is from sale');
            $table->foreignId('table_order_id')->nullable()->constrained()->onDelete('set null')->comment('Related table order if transaction is from POS');

            // Transaction details
            $table->enum('transaction_type', [
                'purchase',      // Stock purchased from supplier
                'sale',         // Stock sold to customer
                'adjustment',   // Manual stock adjustment
                'return',       // Customer return
                'damage',       // Damaged/lost stock
                'transfer',     // Transfer between locations
                'initial',      // Initial stock setup
                'correction'    // Stock correction
            ]);

            $table->integer('quantity')->comment('Quantity moved (positive for in, negative for out)');
            $table->integer('quantity_before')->comment('Stock level before transaction');
            $table->integer('quantity_after')->comment('Stock level after transaction');
            $table->decimal('unit_cost', 10, 2)->nullable()->comment('Cost per unit for purchases');
            $table->decimal('total_cost', 10, 2)->nullable()->comment('Total cost of transaction');

            // Reference information
            $table->string('reference_number')->nullable()->comment('Invoice/PO number for purchases');
            $table->string('supplier_name')->nullable()->comment('Supplier name for purchases');
            $table->text('notes')->nullable()->comment('Additional notes about the transaction');

            // Audit fields
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['product_id', 'transaction_type']);
            $table->index(['created_at']);
            $table->index(['order_id']);
            $table->index(['table_order_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
