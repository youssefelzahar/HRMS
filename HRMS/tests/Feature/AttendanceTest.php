<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employees;
use App\Models\Attendance;

class AttendanceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

  

    public function test_attendance_index_returns_success(): void
    {
        $response = $this->getJson('/api/Attendanceindex');
        $response->assertStatus(200);
    }
    

    public function test_can_create_attendance(): void
    {
        $attendanceData = [
            'employee_id' => 1,
            'date' => now()->format('Y-m-d'),
            'check_in' => '09:00:00',
            'check_out' => '17:00:00',
            'status' => 'present',
            'version' => 1
        ];

        $response = $this->postJson('/api/Attendancestore', $attendanceData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('attendances', $attendanceData);
    }

    public function test_can_update_attendance(): void
    {
        // Create an attendance record first
        $attendance = Attendance::factory()->create();

        $updateData = [
            'check_in' => '08:30:00',
            'check_out' => '16:30:00',
            'status' => 'late',
            'version' => 2
        ];

        $response = $this->putJson("/api/Attendanceupdate/{$attendance->id}", $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('attendances', $updateData);
    }

    public function test_can_delete_attendance(): void
    {
        $attendance = Attendance::factory()->create();

        $response = $this->deleteJson("/api/Attendancedelete/{$attendance->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('attendances', ['id' => $attendance->id]);
    }

    public function test_attendance_create_returns_success(): void
    {
        $response = $this->getJson('/api/Attendancecreate');
        $response->assertStatus(200);
    }
}
