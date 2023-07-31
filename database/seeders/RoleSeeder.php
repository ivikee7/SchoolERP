<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        $administrator = Role::create(['name' => 'ADMINISTRATOR']);
        $teacher = Role::create(['name' => 'TEACHER']);
        $principal = Role::create(['name' => 'PRINCIPAL']);
        $student = Role::create(['name' => 'STUDENT']);
        Role::create(['name' => 'PARENTS']);
        Role::create(['name' => 'LOCAL GAURDIAN']);
        Role::create(['name' => 'PEON']);
        Role::create(['name' => 'SPORTS TEACHER']);
        Role::create(['name' => 'PHYSICAL TRAINER']);
        Role::create(['name' => 'DRIVER']);
        Role::create(['name' => 'HELPER']);
        Role::create(['name' => 'NURSE']);
        Role::create(['name' => 'MADE']);
        Role::create(['name' => 'CLEANER']);
        Role::create(['name' => 'SECURITY GARD']);
        Role::create(['name' => 'GROUND STAFF']);
        Role::create(['name' => 'GUEST']);
        Role::create(['name' => 'OTHER']);
        Role::create(['name' => 'CLASS ADMINISTROTOR']);
        Role::create(['name' => 'SCHOOL ADMINISTROTOR']);
        Role::create(['name' => 'TRANSPORT ADMINISTROTOR']);
        Role::create(['name' => 'ADMISSION INCHARGE']);
        Role::create(['name' => 'ACCOUNTANT']);
        Role::create(['name' => 'SCHOOL COORDINATOR']);
        Role::create(['name' => 'EXAM COORDINATOR']);

        // Give permissions to ADMINISTRATOR
        // $administrator->givePermissionTo('create_attendance');
    }
}
