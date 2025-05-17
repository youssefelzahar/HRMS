<?php

namespace Database\Factories;

use App\Models\Employees;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employees::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'departments' => Departments::factory(),
            'position' => $this->faker->jobTitle(),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'hire_date' => $this->faker->date(),
            'salary' => $this->faker->numberBetween(30000, 100000),
            'status' => $this->faker->randomElement(['active', 'terminated']),
            'version' => 1
        ];
    }
} 