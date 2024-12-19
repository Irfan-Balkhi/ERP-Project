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
            // $table->integer('RowNumber'); // New column for row numbers
            $table->id('PurchaseID');
            $table->string('InvoiceNumber')->unique(); // Automatically generated
            $table->string('SellerName');
            $table->unsignedBigInteger('CategoryID'); // Foreign key for categories
            $table->date('PurchaseDate');
            $table->text('Description')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
