<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Departments table
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Employees table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('departments')->constrained('departments');
            $table->string('position');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('hire_date');
            $table->decimal('salary', 10, 2);
            $table->enum('status', ['active', 'terminated']);
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Salaries table
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->date('effective_date');
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Leave Types table
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Leave Requests table
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('leave_type_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('pending');
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Attendance table
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Training Sessions table
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Employee Trainings table
        Schema::create('employee_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('training_session_id')->constrained();
            $table->string('status')->default('scheduled');
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });

        // Performance Reviews table
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->date('review_date');
            $table->text('comments');
            $table->integer('rating');
            $table->timestamps();
        });

        // Documents table
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->string('title');
            $table->string('file_path');
            $table->string('document_type');
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('performance_reviews');
        Schema::dropIfExists('employee_trainings');
        Schema::dropIfExists('training_sessions');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('salaries');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('users');
    }
}; 