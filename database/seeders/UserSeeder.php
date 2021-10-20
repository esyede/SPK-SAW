<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create('id_ID');
        $password = bcrypt('password');
        $users = [];

        // Create employee
        $role = Role::where('slug', 'employee')->first();
        $genders = ['Male', 'Female'];

        for ($i = 0; $i < 19; $i++) {
            $users[$i] = [
                'role_id' => $role->id,
                'registration_code' => Str::random(10),
                'name' => $faker->name,
                'address' => $faker->address,
                'date_of_birth' => $faker->dateTimeBetween('-10 years', 'now'),
                'phone' => $faker->phoneNumber,
                'gender' => $genders[array_rand($genders)],
                'email' => $faker->unique()->email,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $users[] = [
            'role_id' => $role->id,
            'registration_code' => Str::random(10),
            'name' => $faker->name,
            'address' => $faker->address,
            'date_of_birth' => $faker->dateTimeBetween('-10 years', 'now'),
            'phone' => $faker->phoneNumber,
            'gender' => $genders[array_rand($genders)],
            'email' => 'employee@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Create director
        $role = Role::where('slug', 'director')->first();
        $users[] = [
            'role_id' => $role->id,
            'registration_code' => Str::random(10),
            'name' => $faker->name,
            'address' => 'Pak Direktur',
            'date_of_birth' => $faker->dateTimeBetween('-10 years', 'now'),
            'phone' => $faker->phoneNumber,
            'gender' => 'Male',
            'email' => 'director@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        User::insert($users);
    }
}
