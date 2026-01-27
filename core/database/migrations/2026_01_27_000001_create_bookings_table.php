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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('country_code', 10);
            $table->string('phone', 20);
            $table->string('email');
            $table->unsignedInteger('passengers');
            $table->text('message')->nullable();
            $table->enum('booking_type', ['One Way', 'Round Trip', 'Multi City']);
            $table->timestamps();

            // Indexes for better query performance
            $table->index('email');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};