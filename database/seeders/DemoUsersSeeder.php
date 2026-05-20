<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [

            [
                'first_name' => 'ليان',
                'last_name' => 'أحمد',
                'name' => 'ليان أحمد',
                'email' => 'leen@test.com',
                'phone' => '0798123456',
                'dob' => '2002-05-14',
                'gender' => 'female',
                'marketing' => 1,
                'is_active' => 1,
                'password' => Hash::make('Leen@123'),
                'role' => 'customer',
            ],

            [
                'first_name' => 'محمد',
                'last_name' => 'خالد',
                'name' => 'محمد خالد',
                'email' => 'mohammad@test.com',
                'phone' => '0789456123',
                'dob' => '1999-11-20',
                'gender' => 'male',
                'marketing' => 1,
                'is_active' => 1,
                'password' => Hash::make('Mo@2026'),
                'role' => 'customer',
            ],

            [
                'first_name' => 'سارة',
                'last_name' => 'علي',
                'name' => 'سارة علي',
                'email' => 'sara@test.com',
                'phone' => '0777012345',
                'dob' => '2001-08-03',
                'gender' => 'female',
                'marketing' => 1,
                'is_active' => 1,
                'password' => Hash::make('Sara#456'),
                'role' => 'customer',
            ],

            [
                'first_name' => 'عمر',
                'last_name' => 'ياسين',
                'name' => 'عمر ياسين',
                'email' => 'omar@test.com',
                'phone' => '0793344556',
                'dob' => '1998-01-17',
                'gender' => 'male',
                'marketing' => 0,
                'is_active' => 1,
                'password' => Hash::make('Omar!789'),
                'role' => 'customer',
            ],

        ];

        foreach ($users as $user) {

            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}