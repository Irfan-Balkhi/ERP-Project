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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('InvoiceNumber')->unique(); // Invoice number
            $table->enum('InvoiceType', ['internal', 'external'])->default('internal'); // Type of invoice
            $table->enum('Source', ['purchase', 'sale', 'transaction', 'manual']); // Source of invoice
            // $table->decimal('Amount', 12, 2); // Total amount
            $table->decimal('Amount', 12, 2)->nullable(); // Allow null for internal invoices
            $table->string('Description')->nullable(); // Optional description
            
            // Foreign keys
            $table->unsignedBigInteger('SaleID')->nullable(); // Linked sale
            $table->unsignedBigInteger('PurchaseID')->nullable(); // Linked purchase
            $table->unsignedBigInteger('TransactionID')->nullable(); // Linked transaction
        
            $table->timestamps();
        
            // Define foreign key relationships
            //$table->foreign('SaleID')->references('id')->on('sales')->onDelete('set null');
            $table->foreign('PurchaseID')->references('id')->on('purchases')->onDelete('set null');
            //$table->foreign('TransactionID')->references('id')->on('transactions')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice__nums');
    }
};
