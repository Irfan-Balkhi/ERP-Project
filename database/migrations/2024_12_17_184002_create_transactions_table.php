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
            $table->id();
            $table->string('InvoiceNumber')->unique();
            $table->string('SupplierName');
            $table->enum('TransactionType', ['Purchase', 'Sale', 'Payment', 'Refund', 'Transfer']);
            $table->decimal('Amount', 15, 2);
            $table->date('TransactionDate');
            $table->enum('PaymentMethod', ['Cash', 'Bank Transfer', 'Credit', 'Cheque']);
            $table->enum('Status', ['Pending', 'Completed', 'Cancelled']);
            $table->text('Description')->nullable();
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
