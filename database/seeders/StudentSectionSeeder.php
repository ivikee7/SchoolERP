<?php

namespace Database\Seeders;

use App\Models\StudentSection;
use Illuminate\Database\Seeder;

class StudentSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentSection::create(['name' => 'EMPATHY']);
        StudentSection::create(['name' => 'HARMONY']);
        StudentSection::create(['name' => 'INTEGRITY']);
        StudentSection::create(['name' => 'COURAGE']);
        StudentSection::create(['name' => 'NA']);
        StudentSection::create(['name' => '1']);
        StudentSection::create(['name' => 'NEW SECTION']);
    }
}
