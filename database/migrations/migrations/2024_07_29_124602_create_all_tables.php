<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        // Tabela banners
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('link_url');
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabela categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('description')->nullable();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // For static image storage (file path)
            $table->boolean('new_product')->default(false);
            $table->boolean('new_offers')->default(false);
            $table->timestamps();
        });

        

        // Tabela allergies
        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->text('allergy_info');
        });

        // Tabela shipping_fees
        Schema::create('shipping_fees', function (Blueprint $table) {
            $table->id();
            $table->string('postal_code', 10);
            $table->decimal('fee', 10, 2);
        });

        // Tabela sales_reports
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id();
            $table->date('report_date');
            $table->decimal('total_sales', 10, 2);
            $table->integer('total_orders');
            $table->timestamp('generated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('extra_product');
        Schema::dropIfExists('allergies');
        Schema::dropIfExists('shipping_fees');
        Schema::dropIfExists('sales_reports');
    }
}
