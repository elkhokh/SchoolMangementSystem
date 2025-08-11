<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['name' => 'Class A1', 'note' => '1/1'],
            ['name' => 'Class B1', 'note' => '1/2'],
            ['name' => 'Class C1', 'note' => '1/3'],

            ['name' => 'Class A2', 'note' => '2/1'],
            ['name' => 'Class B2', 'note' => '2/2'],
            ['name' => 'Class C2', 'note' => '2/3'],

            ['name' => 'Class A3', 'note' => '3/1'],
            ['name' => 'Class B3', 'note' => '3/2'],
            ['name' => 'Class C3', 'note' => '3/3'],

            ['name' => 'Class A4', 'note' => '4/1'],
            ['name' => 'Class B4', 'note' => '4/2'],
            ['name' => 'Class C4', 'note' => '4/3'],

            ['name' => 'Class A5', 'note' => '5/1'],
            ['name' => 'Class B5', 'note' => '5/2'],
            ['name' => 'Class C5', 'note' => '5/3'],

            ['name' => 'Class A6', 'note' => '6/1'],
            ['name' => 'Class B6', 'note' => '6/2'],
            ['name' => 'Class C6', 'note' => '6/3'],
        ];
        foreach ($classes as $class) {
            Classes::firstOrCreate(
                ['name' => $class['name']],
                ['note' => $class['note']]
            );
        }
    }
}
