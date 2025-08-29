<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Classes;
use App\Models\Students;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Students>
 */
class StudentsFactory extends Factory
{
 protected $model = Students::class;

    public function definition(): array
    {
        $user = User::factory()->create();
        $user->assignRole('student'); // Assign role

        return [
            'user_id' => $user->id,
            'class_id' => Classes::inRandomOrder()->first()->id,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address(),
            'birth_date' => $this->faker->date(),
            'note' => $this->faker->sentence(),
        ];
    }
}
