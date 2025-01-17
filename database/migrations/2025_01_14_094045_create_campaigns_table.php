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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->text('image');
            $table->text('cp_type');
            $table->float('commission');
            $table->string('commission_type');
            $table->string('commission_text');
            $table->text('detail');
            $table->tinyText('description');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('link_generate_type')->default(1);
            $table->tinyText('url');
            $table->tinyText('tracking_url');
            $table->dateTime('deactived_at')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
