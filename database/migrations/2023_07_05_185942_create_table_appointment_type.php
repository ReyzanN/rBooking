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
        Schema::create('appointmentType', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('description');
            $table->string('location',50);
            $table->string('street',50);
            $table->string('streetNumber',2);
            $table->string('zipCode',5);
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointmentType');
    }
};
