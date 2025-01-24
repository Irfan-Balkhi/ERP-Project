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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id('PurchaseID'); // Primary Key
            $table->unsignedBigInteger('SupplierID'); // Foreign key for suppliers
            $table->unsignedBigInteger('ContractID')->nullable(); // Foreign key to contracts table
            $table->unsignedBigInteger('ProductID'); // Foreign key for products
            $table->unsignedBigInteger('CategoryID'); // Foreign key for categories

            $table->date('PurchaseDate'); // Date of purchase
            $table->text('Description')->nullable(); // Optional description
            $table->timestamps();

            // Foreign Relations
            $table->foreign('ContractID')->references('ContractID')->on('contracts')->onDelete('set null');
            $table->foreign('SupplierID')->references('SupplierID')->on('suppliers')->onDelete('set null');
            $table->foreign('ProductID')->references('ProductID')->on('products')->onDelete('cascade');
            $table->foreign('CategoryID')->references('CategoryID')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
