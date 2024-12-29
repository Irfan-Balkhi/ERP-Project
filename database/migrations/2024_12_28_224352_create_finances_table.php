<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id('FinanceID'); // Primary Key
            $table->decimal('TotalPurchases', 15, 2)->default(0); // Aggregated total purchase amount
            $table->decimal('TotalSales', 15, 2)->default(0); // Aggregated total sales amount
            $table->decimal('AdditionalExpenses', 15, 2)->default(0); // Sum from expenses table
            $table->decimal('TotalTransactions', 15, 2)->default(0); // Sum from Transactions table
            $table->decimal('ProfitOrLoss', 15, 2)->default(0); // Dynamic profit/loss calculation
            $table->date('Date'); // Date for the record
            $table->timestamps(); // CreatedAt and UpdatedAt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
