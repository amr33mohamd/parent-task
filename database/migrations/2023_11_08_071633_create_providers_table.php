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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->nullable();
            $table->string('balance')->nullable();
            $table->string('status')->nullable();
            $table->string('currency')->nullable();
            $table->string('identification')->nullable();
            $table->string('authorised')->nullable();
            $table->string('declined')->nullable();
            $table->string('created_at')->nullable();
            $table->string('created_at_format')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
