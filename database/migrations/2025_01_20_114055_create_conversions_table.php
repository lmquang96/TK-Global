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
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('order_code');
            $table->decimal('unit_price');
            $table->decimal('commission_pub');
            $table->decimal('commission_sys');
            $table->string('status');
            $table->string('product_code');
            $table->string('product_name');
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('click_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
