<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@kisra.com'],
            [
                'first_name'     => 'Admin',
                'last_name'      => 'Kisra',
                'name'           => 'Admin Kisra', 
                'email'          => 'admin@kisra.com',
                'phone'          => '0790000000', 
                'password'       => Hash::make('password'),
                'role'           => 'admin',
                'dob'            => '1990-01-01',
                'gender'         => 'male',
                'marketing'      => false,
                'email_verified_at' => now(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );
    }
}