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
        // order_lines => pivot table
        Schema::create('order_lines', function (Blueprint $table) {
          $table->foreignId('order_id')->constrained()->cascadeOnDelete();
          $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
          $table->string('product_name');
          $table->float('price');
          //product_name & price ; if change name or price in the future
          $table->unsignedTinyInteger('quantity');
          $table->unique(['order_id','product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
