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
        Schema::create('restauracja_dostawa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produkt_id');
            $table->unsignedBigInteger('restauracja_id');
            $table->unsignedBigInteger('ilość');
            $table->timestamps();

            $table->foreign('produkt_id')->references('id')->on('dostawies')->onDelete('cascade');
            $table->foreign('restauracja_id')->references('id')->on('restauracjas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restauracja_dostawa');
    }
};
