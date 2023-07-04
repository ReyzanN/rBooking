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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('surname',50);
            $table->string('email',100)->unique();
            $table->string('phone',10);
            $table->string('password');
            $table->integer('rank')->default(0);
            $table->boolean('accountValidity');
            $table->dateTime('accountVerifiedAt')->nullable();
            $table->dateTime('lastConnection')->nullable();
            $table->boolean('killSession')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
