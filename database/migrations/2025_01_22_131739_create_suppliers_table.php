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
        // Company Name
        // - ⁠Company Address
        // - ⁠Company Email Address
        // - ⁠Company Contact Number
        // - contracts
                
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('SupplierID'); // Primary key
            $table->string('CompanyName'); // Supplier's company name
            $table->string('CompanyEmail')->unique(); // Unique email for the company
            $table->string('CompanyContactNumber'); // company Phone number / contact number
            $table->string('Address')->nullable(); // Optional address field

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
