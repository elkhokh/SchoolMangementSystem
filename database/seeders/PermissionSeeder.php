<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

$permissions = [
            'show-index',

            'create-role',
            'edit-role',
            'delete-role',
            'show-roles',

            'create-user',
            'edit-user',
            'delete-user',
            'show-users',

            // 'print-invoice',
            // 'view-invoice',
            // 'show-invoice',
            // 'create-invoice',
            // 'edit-invoice',
            // 'delete-invoice',
            // 'show-deleted-invoice',
            // 'edit-status-invoice',
            // 'excel-import-invoice',
            // 'add-attachments-invoice',
            // 'delete-attachments',

            // 'add-image-invoice',
            // 'delete-image-invoice',
            // 'show-image-invoice',

            // 'create-product',
            // 'edit-product',
            // 'delete-product',
            // 'show-product',

            // 'create-section',
            // 'edit-section',
            // 'delete-section',
            // 'show-section',

        ];

foreach ($permissions as $permission) {

Permission::create(['name' => $permission]);
}


}
}
