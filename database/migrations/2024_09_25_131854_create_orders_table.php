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
            $table->string('id_orders')->primary();
            $table->string('order_number')->unique();
            $table->string('name_orders');
            $table->string('email_orders');
            $table->string('phone_orders');
            $table->string('product_orders');
            $table->integer('qty_orders');
            $table->integer('total_orders');
            $table->string('payment_method')->nullable();
            $table->string('status_orders');
            $table->string('payment_status');
            $table->string('proof_of_payment')->nullable();
            $table->text('shipping_address');
            $table->string('tracking_number')->nullable();
            $table->text('notes')->nullable();
            $table->string('created_by');
            $table->string('modified_by');
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
