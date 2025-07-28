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
        Schema::create('stock_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->comment('User who acknowledged the alert');
            
            // Alert details
            $table->enum('alert_type', [
                'low_stock',        // Stock below minimum level
                'out_of_stock',     // Stock is zero
                'overstock',        // Stock above maximum level
                'expiring_soon',    // For products with expiry dates
                'custom'            // Custom alert
            ]);
            
            $table->string('title');
            $table->text('message');
            $table->integer('current_stock')->comment('Current stock when alert was triggered');
            $table->integer('threshold_stock')->comment('Stock level that triggered the alert');
            
            // Alert status
            $table->enum('status', ['active', 'acknowledged', 'resolved', 'dismissed'])->default('active');
            $table->timestamp('acknowledged_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            
            // Priority levels
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            
            // Notification settings
            $table->boolean('email_sent')->default(false);
            $table->boolean('sms_sent')->default(false);
            $table->boolean('push_sent')->default(false);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['product_id', 'status']);
            $table->index(['alert_type', 'status']);
            $table->index(['priority', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_alerts');
    }
}; 