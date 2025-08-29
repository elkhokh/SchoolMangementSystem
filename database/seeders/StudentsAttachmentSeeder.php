<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentsAttachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentsAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         StudentsAttachment::factory()->count(30)->create();
    }
}
