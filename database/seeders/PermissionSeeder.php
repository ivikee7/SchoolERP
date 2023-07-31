<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission
        Permission::create(['name' => 'permission_create']);
        Permission::create(['name' => 'permission_view']);
        Permission::create(['name' => 'permission_update']);
        Permission::create(['name' => 'permission_delete']);
        // Role
        Permission::create(['name' => 'role_create']);
        Permission::create(['name' => 'role_view']);
        Permission::create(['name' => 'role_update']);
        Permission::create(['name' => 'role_delete']);
        // User
        Permission::create(['name' => 'user_create']);
        Permission::create(['name' => 'user_view']);
        Permission::create(['name' => 'user_update']);
        Permission::create(['name' => 'user_delete']);
        // Attendance
        Permission::create(['name' => 'attendance_create']);
        Permission::create(['name' => 'attendance_view']);
        Permission::create(['name' => 'attendance_update']);
        Permission::create(['name' => 'attendance_delete']);
        // Registration
        Permission::create(['name' => 'registration_create']);
        Permission::create(['name' => 'registration_view']);
        Permission::create(['name' => 'registration_update']);
        Permission::create(['name' => 'registration_delete']);
        // Enquiry
        Permission::create(['name' => 'enquiry_create']);
        Permission::create(['name' => 'enquiry_view']);
        Permission::create(['name' => 'enquiry_update']);
        Permission::create(['name' => 'enquiry_delete']);
        // Media
        Permission::create(['name' => 'media_create']);
        Permission::create(['name' => 'media_view']);
        Permission::create(['name' => 'media_update']);
        Permission::create(['name' => 'media_delete']);
    }
}
