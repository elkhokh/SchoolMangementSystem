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
// $user = User::updateOrCreate(
//     ['email' => 'mustafaelkhokhy@gmail.com'],
//     [
//         'name' => 'mustafa khalid abd elmonem',
//         'password' => Hash::make("123456789"),
//     ]
// );

    $admin = User::updateOrCreate(
        ['email' => 'mustafaelkhokhy@gmail.com'],
        [
            'name' => 'mustafa elkhokhy',
            'password' => Hash::make('123456'),
        ]
    );
    $admin->assignRole('admin');

    }
}
