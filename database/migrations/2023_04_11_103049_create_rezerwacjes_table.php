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
        Schema::create('rezerwacjes', function (Blueprint $table) {
            $table->id();
            $table->string('name_res');
            $table->string('last_name_res');
            $table->unsignedSmallInteger('hour_start');
            $table->unsignedSmallInteger('hour_end');
            $table->unsignedTinyInteger('table_nr');
            $table->unsignedTinyInteger('guest_nr');
            $table->date('date_res');
            $table->string('restauracja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rezerwacjes');
    }
};
