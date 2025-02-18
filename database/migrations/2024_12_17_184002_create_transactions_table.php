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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('TransactionID');
            $table->string('CustomerName');
            $table->decimal('amount', 9, 2);
            $table->enum('transaction_type', ['income', 'expense', 'transfer']);
            $table->enum('source', [
                'payment_to_supplier', 
                'salary_payment', 
                'daily_expense', 
                'payment_to_distributors', 
                'customer_payment_received',
                'transfer_to_sarrafi', 
                'transfer_to_cash',
                'miscellaneous_income', 
                'other_expense',
            ]);

            $table->text('description')->nullable();
            $table->date('transaction_date');
            
            $table->unsignedBigInteger('SupplierID'); // Foreign key to suppliers table
            $table->unsignedBigInteger('accountID'); // Foreign key to account table

            $table->foreign('SupplierID')->references('SupplierID')->on('suppliers')->onDelete('set null');
            $table->foreign('accountID')->references('accountID')->on('accounts')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
