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
    Schema::create('ulasan', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('email')->nullable();
        $table->tinyInteger('rating'); // 1-5
        $table->text('komentar');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
