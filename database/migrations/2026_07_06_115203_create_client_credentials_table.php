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
        Schema::create('client_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->string('client_secret_hash');
            $table->string('scope')->default('publisher');
            $table->tinyInteger('status')->default(1);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_credentials');
    }
};
