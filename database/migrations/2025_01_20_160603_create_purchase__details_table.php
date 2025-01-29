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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id('Purchase_DetailID'); // Primary Key
            $table->unsignedBigInteger('PurchaseID'); // Foreign Key for purchases
            $table->unsignedBigInteger('ProductID'); // Foreign Key for products
            $table->unsignedBigInteger('CategoryID'); // Foreign key for categories
            $table->integer('Quantity');
            $table->string('PurchasedUnit'); //use for purchased unit of measurement واحد اندازه گیری جنس خریده شده
            $table->decimal('PricePerUnit', 10, 2);
            $table->decimal('Total', 15, 2);
            $table->timestamps();
        
            // Foreign Key Constraints
            $table->foreign('PurchaseID')->references('PurchaseID')->on('purchases')->onDelete('cascade');
            $table->foreign('ProductID')->references('ProductID')->on('products')->onDelete('cascade');
            $table->foreign('CategoryID')->references('CategoryID')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
