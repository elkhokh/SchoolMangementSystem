<?php

namespace Database\Factories;

use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentsAttachment>
 */
class StudentsAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Students::factory(), // يولد طالب جديد تلقائي
            'father_name' => $this->faker->name('male'),
            'mother_name' => $this->faker->name('female'),
            'parent_email' => $this->faker->safeEmail(),
            'parent_phone' => $this->faker->phoneNumber(),
            'file_name' => $this->faker->filePath(), // ممكن تغيرها لمسار وهمي للملف
            'note' => $this->faker->sentence(),
        ];
    }
}
