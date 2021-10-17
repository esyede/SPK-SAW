<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create director
        $director = Role::where('slug', 'director')->first();
        User::updateOrCreate([
            'role_id' => $director->id,
            'registration_code' => Str::random(10),
            'name' => 'Mr. Director',
            'email' => 'director@gmail.com',
            'password' => Hash::make('password'),
            'status' => true
        ]);

        // Create employee
        $employee = Role::where('slug', 'employee')->first();
        User::updateOrCreate([
            'role_id' => $employee->id,
            'registration_code' => Str::random(10),
            'name' => 'Employee One',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('password'),
            'status' => true
        ]);
    }
}
