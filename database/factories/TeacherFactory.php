<?php
namespace Database\Factories;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Subjects;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        $user = User::factory()->create();
        $user->assignRole('teacher'); // Assign role

        return [
            'user_id' => $user->id,
            'subject_id' => Subjects::inRandomOrder()->first()->id,
            'phone' => $this->faker->phoneNumber(),
            'specialization' => $this->faker->word(),
            'note' => $this->faker->sentence(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address(),
        ];
    }
}
