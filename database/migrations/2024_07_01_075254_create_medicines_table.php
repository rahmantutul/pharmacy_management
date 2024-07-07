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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('qrcode')->nullable();
            $table->string('hnscode')->nullable();
            $table->string('name');
            $table->string('strength')->nullable();
            $table->string('genericname')->nullable();
            $table->string('shelf')->nullable();
            $table->string('desc')->nullable();
            $table->string('image');
            $table->float('igta')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('leafId');
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('vendorId');
            $table->unsignedBigInteger('supplierId');
            $table->timestamps();
            $table->foreign('leafId')->references('id')->on('leaves')->onDelete('cascade');
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('vendorId')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('supplierId')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
