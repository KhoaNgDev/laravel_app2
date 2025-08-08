<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('technician_id')->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->dateTime('booking_start');
            $table->dateTime('booking_end');
            $table->text('note');
            $table->enum('status', ['confirmed', 'canceled','completed'])->default('confirmed');
            $table->timestamps();
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
