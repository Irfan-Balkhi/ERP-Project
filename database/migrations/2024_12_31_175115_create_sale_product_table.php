<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sale_product', function (Blueprint $table) {
            $table->id(); // Optional, for indexing
            $table->foreignId('SaleID')->constrained('sales')->onDelete('cascade');
            $table->foreignId('ProductID')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_product');
    }
};
