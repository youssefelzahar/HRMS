<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Departments;

class DepartmentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_departments_index_returns_success(): void
    {
        $response = $this->getJson('/api/Departmentsindex');
        $response->assertStatus(200);
    }

    public function test_can_create_department(): void
    {
        $departmentData = [
            'name' => 'IT Department',
            'description' => 'Information Technology Department'
        ];

        $response = $this->postJson('/api/Departmentsstore', $departmentData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('departments', $departmentData);
    }

    public function test_can_update_department(): void
    {
        // Create a department first
        $department = Departments::factory()->create();

        $updateData = [
            'name' => 'Updated IT Department',
            'description' => 'Updated Information Technology Department'
        ];

        $response = $this->putJson("/api/Departmentsupdate/{$department->id}", $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('departments', $updateData);
    }

    public function test_can_delete_department(): void
    {
        $department = Departments::factory()->create();

        $response = $this->deleteJson("/api/Departmentsdelete/{$department->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

        public function test_department_validation_fails_with_invalid_data(): void
    {
        $invalidData = [
            'name' => '', // Empty name
            'description' => '' // Empty description
        ];

        $response = $this->postJson('/api/Departmentsstore', $invalidData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'name',
            'description'
        ]);
    }

    
} 