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
//         مشخصات قرارداد
// ۱. نمبر قرارداد
// ۲. ⁠تاریخ قرار داد
// ۳. ⁠شرکت قرارداد کننده
// ۴. ⁠جنس
// ۵. ⁠مقدار مجموعی قرارداد
// ۶. ⁠مبلغ مجموعی قرارداد
// ۷. ⁠تاریخ انقضاء یا ختم قرارداد
        Schema::create('contracts', function (Blueprint $table) {
            
            $table->id('ContractID');
            $table->unsignedBigInteger('SupplierID'); // Foreign key to suppliers table
            $table->decimal('TotalValue', 15, 2); // مبلغ مجموعی قرارداد
            $table->decimal('TotalQuantity'); // مقدار مجموعی قرارداد
            $table->string('ContractAttachment')->nullable();
            $table->date('StartDate');
            $table->date('EndDate')->nullable();
            $table->timestamps();

            $table->foreign('SupplierID')->references('SupplierID')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
