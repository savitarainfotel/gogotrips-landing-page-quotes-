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
        Schema::create('airport_codes', function (Blueprint $table) {
            $table->id();
            $table->string('airport')->index();
            $table->string('airport_type');
            $table->string('city')->index();
            $table->string('country');
            $table->string('iata')->index();
            $table->string('icao');
            $table->string('faa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airport_codes');
    }
};