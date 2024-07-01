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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('appname',255)->default("Pharmacy Management");
            $table->string('currency',100)->default("Taka");
            $table->string('email',100)->default('rahmantutul50@gmail.com');
            $table->string('phone',20)->default('01881053602');
            $table->string('address',255)->default('133/4 East rampura Dhaka, 1219');
            $table->integer('lowstockalert')->default(10);
            $table->integer('expiryalert')->default(10);
            $table->string('timezone',20)->default('UTC');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
