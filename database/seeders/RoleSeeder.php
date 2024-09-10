<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);

        $user = Role::create(['name' => 'user']);

        $admin->givePermissionTo([
            'view-all-authors',
            'create-author',
            'edit-author',
            'delete-author',
            'view-all-books',
            'delete-book',
            'view-all-categories',
            'view-category',
            'create-category',
            'edit-category',
            'delete-category'
        ]);

        $user->givePermissionTo([
            'create-book',
            'edit-book',
            'delete-book',
            'view-own-reservations',
            'make-reservations',
            'cancel-reservations'
        ]);
    }
}
