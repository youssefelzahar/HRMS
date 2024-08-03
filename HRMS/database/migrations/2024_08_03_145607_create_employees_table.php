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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('departments');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('departments')->references('id')->on('users')->onDelete('cascade');
            $table->string('position');
            $table->dateTime('date_of_birth')->nullable();
            $table->enum('gender',['male','femal']);
            $table->dateTime('hire_date')->nullable();
            $table->string('salary');
            $table->enum('status',['active','terminated'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
