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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('city_code')->nullable();
            $table->string('city_name')->nullable();
            $table->string('account_type')->default('Individual');
            $table->string('bank_owner')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('citizen_id_no')->nullable();
            $table->dateTime('citizen_id_date')->nullable();
            $table->string('citizen_id_place')->nullable();
            $table->string('tax')->nullable();
            $table->tinyText('avatar')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
