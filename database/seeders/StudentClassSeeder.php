<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Seeder;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentClass::create(['id' => 1, 'name' => 'STD-1']);
        StudentClass::create(['id' => 2, 'name' => 'STD-2']);
        StudentClass::create(['id' => 3, 'name' => 'STD-3']);
        StudentClass::create(['id' => 4, 'name' => 'STD-4']);
        StudentClass::create(['id' => 5, 'name' => 'STD-5']);
        StudentClass::create(['id' => 6, 'name' => 'STD-6']);
        StudentClass::create(['id' => 7, 'name' => 'STD-7']);
        StudentClass::create(['id' => 8, 'name' => 'STD-8']);
        StudentClass::create(['id' => 9, 'name' => 'STD-9']);
        StudentClass::create(['id' => 10, 'name' => 'STD-10']);
        StudentClass::create(['id' => 11, 'name' => 'STD-11']);
        StudentClass::create(['id' => 12, 'name' => 'STD-12']);
        StudentClass::create(['id' => 13, 'name' => 'K1']);
        StudentClass::create(['id' => 14, 'name' => 'K2']);
        StudentClass::create(['id' => 15, 'name' => 'NUR']);
        StudentClass::create(['id' => 16, 'name' => 'NONE']);
    }
}
