<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$user = User::updateOrCreate(
    ['email' => 'mustafaelkhokhy@gmail.com'],
    [
        'name' => 'mustafa khalid abd elmonem',
        'password' => Hash::make("123456789"),
    ]
);

//    $admin = User::updateOrCreate(
//         ['email' => 'mustafaelkhokhy@gmail.com'],
//         [
//             'name' => 'mustafa elkhokhy',
//             'password' => Hash::make('123456'),
//         ]
//     );
//     $admin->assignRole('admin');

//     $teacher = User::updateOrCreate(
//         ['email' => 'teacher@gmail.com'],
//         [
//             'name' => 'ali',
//             'password' => Hash::make('123456'),
//         ]
//     );
//     $teacher->assignRole('teacher');

//     $student = User::updateOrCreate(
//         ['email' => 'student@gmail.com'],
//         [
//             'name' => 'ali',
//             'password' => Hash::make('123456'),
//         ]
//     );
//     $student->assignRole('student');

//     $user = User::updateOrCreate(
//         ['email' => 'user@gmail.com'],
//         [
//             'name' => 'user',
//             'password' => Hash::make('123456'),
//         ]
//     );
//     $user->assignRole('user');

    }
}
