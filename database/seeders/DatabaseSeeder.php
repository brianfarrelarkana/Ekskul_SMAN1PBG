<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'SuperAdmin',
            'password' => Hash::make('SuperEkskulSMA1PBG'),
            'role' => 'superadmin',
        ]);
    }
}
