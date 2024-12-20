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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('SaleID');
            $table->string('InvoiceNumber')->unique(); // Automatically generated
            $table->string('CustomerName');
            $table->unsignedBigInteger('CategoryID'); // Foreign key for categories
            $table->date('SaleDate');
            $table->text('Description')->nullable();
            $table->string('PurchasedUnit'); //واحد خریداری
            $table->integer('Quantity');
            $table->decimal('PricePerUnit', 10, 2);
            $table->decimal('Total', 15, 2);
            $table->timestamps();
        
            // Foreign Key Constraint
            $table->foreign('CategoryID')->references('CategoryID')->on('categories')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
