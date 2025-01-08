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
        Schema::create('approve_umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_user')->references('id')->on('users');
            $table->string('umkm');
            $table->string('description')->nullable();
            $table->string('email')->unique();
            $table->foreignId('city_id')->constrained('cities');
            $table->string('address')->nullable();
            $table->string('telephone_number')->nullable();
            $table->foreignId('category_id')->constrained('category');
            $table->string('original_photoname')->nullable();
            $table->string('encrypted_photoname')->nullable();
            $table->string('original_filesname')->nullable();
            $table->string('encrypted_filesname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approve_umkm');
    }
};
