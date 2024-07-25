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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->string('invoice_no');
            $table->unsignedBigInteger('customerId');
            $table->unsignedBigInteger('paymentId');
            $table->integer('grand_total');
            $table->integer('invoice_discount');
            $table->tinyInteger('discount_type');
            $table->integer('payable_total');
            $table->integer('paid_amount');
            $table->integer('due_amount');
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('paymentId')->references('id')->on('paymen_methods')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
