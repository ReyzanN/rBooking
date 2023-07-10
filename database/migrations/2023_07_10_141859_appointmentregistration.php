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
        Schema::create('appointment_registration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idAppointment');
            $table->unsignedBigInteger('idUser');
            $table->boolean('confirmed')->default(0);
            $table->dateTime('confirmed_at')->nullable(true);
            $table->string('confirmToken',30);
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->foreign('idAppointment')->on('appointment')->references('id');
            $table->foreign('idUser')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_registration');
    }
};
