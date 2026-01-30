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
            $table->string('airport')->index()->nullable();
            $table->string('iata_code')->index()->unique()->nullable();
            $table->string('city')->nullable();
            $table->string('iso_country')->nullable();
            $table->string('iso_region')->nullable();
            $table->string('icao_code')->nullable();
            $table->string('coordinates')->nullable();
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