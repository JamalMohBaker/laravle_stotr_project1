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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                   ->nullable()
                   ->constrained()
                   ->nullOnDelete();
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('customer_address');
            $table->string('customer_city');
            $table->string('customer_postal_code')->nullable();
            $table->string('customer_province')->nullable();
            $table->string('customer_country_code');
            $table->enum('status', ['pending','processing','shipped','completed','cancelled','refunded']);
            $table->enum('payment_status', ['pending','paid','failed']);
            $table->char('currency')->default('USD');
            $table->float('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
