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
        Schema::create('products', function (Blueprint $table) {
           
           // Primary key
           $table->id('ProductID'); // Auto-incrementing primary key

           // Attributes
           $table->string('ProductName'); // Product name
           $table->unsignedBigInteger('CategoryID'); // Foreign key to Category table
           $table->text('Description')->nullable(); // Optional description

           // Timestamps (Automatically adds created_at and updated_at columns)
           $table->timestamps();

           // Foreign key constraints
           $table->foreign('CategoryID')
               ->references('CategoryID')
               ->on('categories')
               ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
