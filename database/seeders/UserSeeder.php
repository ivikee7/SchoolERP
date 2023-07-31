<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'title' => 'Mr',
            'first_name' => 'Super',
            'middle_name' => '',
            'last_name' => 'Admin',
            'contact_number' => '1234567890',
            'address_line1' => 'Patna',
            'city' => 'Patna',
            'state' => 'Bihar',
            'pin_code' => '804453',
            'country' => 'India',
            'blood_group' => 'UNK',
            'date_of_birth' => '2022-01-01',
            'father_name' => 'NA',
            'mother_name' => 'NA',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'email' => 'ivikee7@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('Super Admin');
    }
}
