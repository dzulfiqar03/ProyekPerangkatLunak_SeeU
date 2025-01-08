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
        Schema::create('photoUmkm', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_user')->references('id')->on('users');
            $table->foreignId('umkm_id')->constrained('detailUmkm');
            $table->string('original_photoname')->nullable();
            $table->string('encrypted_photoname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photoUmkm');
    }
};
