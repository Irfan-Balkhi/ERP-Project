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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id('ExpensesID'); // Primary Key
            $table->string('ExpenseCategory'); // Category of the expense
            $table->decimal('Amount', 15, 2); // Expense amount
            $table->text('Description')->nullable(); // Optional description
            $table->date('Date'); // Expense date
            $table->timestamps(); // CreatedAt and UpdatedAt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
