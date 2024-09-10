<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view-all-authors',
            'create-author',
            'edit-author',
            'delete-author',
            'view-all-books',
            'create-book',
            'edit-book',
            'delete-book',
            'view-all-categories',
            'view-category',
            'create-category',
            'edit-category',
            'delete-category',
            'view-own-reservations',
            'make-reservations',
            'cancel-reservations'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
