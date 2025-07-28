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
        Schema::create('table_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_table_id')->constrained('restaurant_tables')->onDelete('cascade');
            $table->foreignId('waiter_id')->constrained('waiters')->onDelete('cascade');
            $table->enum('status', ['open', 'closed', 'cancelled'])->default('open');
            $table->enum('payment_status', ['pending', 'paid', 'partial'])->default('pending');
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer'])->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_orders');
    }
};
