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
        Schema::create('allumkm', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_user')->references('id')->on('users');
            $table->string('umkm');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('category_id')->constrained('category');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allumkm');
    }
};
