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

  

    public function test_making_an_api_request(): void
    {      

        $response = $this->getJson('/api/Attendancindex');
 
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    
    
       


}
