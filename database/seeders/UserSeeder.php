<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $password = bcrypt('password');
        $users = [];

        // Create employee
        $role = Role::where('slug', 'employee')->first();
        $genders = ['Male', 'Female'];

        $users = [
            [
                'role_id' => 'employee',
                'registration_code' => 196809222008011009,
                'name' => 'Delta Pranowo, SE.',
                'address' => null,
                'date_of_birth' => null,
                'phone' => null,
                'gender' => 'Male',
                'email' => null,
                'password' => $password,
                'status' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 'employee',
                'registration_code' => 197407302010011004,
                'name' => 'Murtriyanto, S.p',
                'address' => null,
                'date_of_birth' => null,
                'phone' => null,
                'gender' => 'Male',
                'email' => null,
                'password' => $password,
                'status' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 'employee',
                'registration_code' => 196306271986031012,
                'name' => 'Sujito, SH.',
                'address' => null,
                'date_of_birth' => null,
                'phone' => null,
                'gender' => 'Male',
                'email' => null,
                'password' => $password,
                'status' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 'employee',
                'registration_code' => 196707131988031011,
                'name' => 'Hari Wahyudi, SH.',
                'address' => null,
                'date_of_birth' => null,
                'phone' => null,
                'gender' => 'Male',
                'email' => null,
                'password' => $password,
                'status' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 'employee',
                'registration_code' => 196404121989032012,
                'name' => 'Sri Wahyuni, BA.',
                'address' => null,
                'date_of_birth' => null,
                'phone' => null,
                'gender' => 'Female',
                'email' => null,
                'password' => $password,
                'status' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 'employee',
                'registration_code' => 19710804206041016,
                'name' => 'Suparno, SE.',
                'address' => null,
                'date_of_birth' => null,
                'phone' => null,
                'gender' => 'Female',
                'email' => null,
                'password' => $password,
                'status' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Create director
        $role = Role::where('slug', 'director')->first();
        $users[] = [
            'role_id' => $role->id,
            'registration_code' => random_int(100000, 999999),
            'name' => $faker->name,
            'address' => 'Pak Direktur',
            'date_of_birth' => $faker->dateTimeBetween('-10 years', 'now'),
            'phone' => $faker->phoneNumber,
            'gender' => 'Male',
            'email' => 'director@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        User::insert($users);
    }
}
