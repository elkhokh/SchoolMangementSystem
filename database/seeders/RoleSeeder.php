<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        // give roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $student  = Role::firstOrCreate(['name' => 'student']);
        // $user  = Role::firstOrCreate(['name' => 'user']);

        // admin roles have full access
        $admin->givePermissionTo(Permission::all());

        //teacher
        $teacher->givePermissionTo([
            // 'create-user',
            // 'edit-user',
            // 'delete-user',
            // 'create-invoice',
            // 'edit-invoice',
            // 'delete-invoice'
        ]);

        //student
        $student->givePermissionTo([
            // 'create-user',
            // 'edit-user',
            // 'delete-user',
            // 'create-invoice',
            // 'edit-invoice',
            // 'delete-invoice'
        ]);

        // user
        // $user->givePermissionTo([
        //     // 'view-invoice'
        // ]);
    }
}
