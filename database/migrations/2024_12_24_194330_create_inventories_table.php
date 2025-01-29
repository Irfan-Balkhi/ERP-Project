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
            $table->unsignedBigInteger('InvoiceID'); // Foreign Key for invoices
            $table->decimal('ExtraExpense', 12, 2); // Additional expenses
            $table->string('Description')->nullable(); // Optional description
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('InvoiceID')->references('InvoiceID')->on('invoices')->onDelete('cascade');
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
