<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//         - ⁠Invoices (تعداد انوایس‌های که این شرکت به ما میدهد باید با شماره انوایس، تاریخ انوایس و مبلغ انوایس از طرف همین شرکت ثبت گردد)
// هر انوایس شامل معلومات ذیل می باشد
//          - Item
//          - Quantity
//          - Price
//          - Total Price

            Schema::create('invoices', function (Blueprint $table) {
                $table->id('InvoiceID'); // Primary key
                $table->string('InvoiceNumber')->unique(); // Invoice number
                $table->enum('InvoiceType', ['internal', 'external'])->default('internal'); // Type of invoice only for sale-related
                $table->enum('InvoiceSource', ['Purchase', 'Sale', 'Transaction']);
                $table->date('Date'); // Invoice date
                $table->decimal('TotalAmount', 15, 2)->nullable(); // Allow NULL values
                $table->string('PaymentMethod')->nullable(); // Only for external invoices
                $table->decimal('Amount', 12, 2)->nullable(); // Nullable for internal invoices
                $table->decimal('Quantity', 12, 2)->nullable(); // Nullable for internal invoices
                $table->string('Description')->nullable(); // Optional description

                // Foreign keys
                $table->unsignedBigInteger('ContractID')->nullable(); // Nullable for sales-related invoices
                $table->unsignedBigInteger('SaleID')->nullable(); // Nullable for contract-related invoices
                $table->unsignedBigInteger('TransactionID')->nullable(); // Nullable for Transaction-related invoices

                $table->timestamps();

                // Foreign key constraints
                $table->foreign('ContractID')->references('ContractID')->on('contracts')->onDelete('set null');
                $table->foreign('SaleID')->references('SaleID')->on('sales')->onDelete('set null');
                $table->foreign('TransactionID')->references('TransactionID')->on('transactions')->onDelete('set null');

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
