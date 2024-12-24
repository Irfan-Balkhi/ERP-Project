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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id('InventoryID'); // Primary Key
            $table->unsignedBigInteger('PurchaseID'); // Foreign Key for purchase table
            $table->unsignedBigInteger('ProductID'); // Foreign Key for product table
            $table->string('ProductName'); // Related to product table
            $table->integer('Quantity'); // Related to purchase table
            $table->decimal('TotalPurchasedPrice', 10, 2); // Related to purchase table
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('PurchaseID')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('ProductID')->references('id')->on('products')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
