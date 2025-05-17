<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employees;
use App\Models\Departments;
use App\Models\User;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_index_returns_success(): void
    {
        $response = $this->getJson('/api/Employeesindex');
        $response->assertStatus(200);
    }

    public function test_can_create_employee(): void
    {
        // Create required related models first
        $user = User::factory()->create();
        $department = Departments::factory()->create();

        $employeeData = [
            'user_id' => $user->id,
            'departments' => $department->id,
            'position' => 'Software Developer',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'hire_date' => now()->format('Y-m-d'),
            'salary' => 50000,
            'status' => 'active',
            'version' => 1
        ];

        $response = $this->postJson('/api/Employeesstore', $employeeData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('employees', $employeeData);
    }

    public function test_can_update_employee(): void
    {
        // Create an employee first
        $employee = Employees::factory()->create();
        $user = User::factory()->create();
        $department = Departments::factory()->create();

        $updateData = [
            'user_id' => $user->id,
            'departments' => $department->id,
            'position' => 'Senior Developer',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'hire_date' => now()->format('Y-m-d'),
            'salary' => 60000,
            'status' => 'active',
            'version' => 2
        ];

        $response = $this->putJson("/api/Employeesupdate/{$employee->id}", $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('employees', $updateData);
    }

    public function test_can_delete_employee(): void
    {
        $employee = Employees::factory()->create();

        $response = $this->deleteJson("/api/Employeesdelete/{$employee->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }

    public function test_can_get_employee_by_id(): void
    {
        $employee = Employees::factory()->create();

        $response = $this->getJson("/api/Employeescreate/{$employee->id}");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'user_id',
            'departments',
            'position',
            'date_of_birth',
            'gender',
            'hire_date',
            'salary',
            'status',
            'version'
        ]);
    }

    public function test_employee_validation_fails_with_invalid_data(): void
    {
        $invalidData = [
            'user_id' => 999, // Non-existent user
            'departments' => 999, // Non-existent department
            'position' => '', // Empty position
            'gender' => 'invalid', // Invalid gender
            'hire_date' => 'invalid-date', // Invalid date
            'salary' => 'not-a-number', // Invalid salary
            'status' => 'invalid-status', // Invalid status
            'version' => 'not-an-integer' // Invalid version
        ];

        $response = $this->postJson('/api/Employeesstore', $invalidData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'user_id',
            'departments',
            'position',
            'gender',
            'hire_date',
            'salary',
            'status',
            'version'
        ]);
    }
} 