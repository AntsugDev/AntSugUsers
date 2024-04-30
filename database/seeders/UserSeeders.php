<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
           'first_name' => "admin",
           'last_name' => "admin",
           'email' => "admin@admin.it",
           'password' => Hash::make('admin.007'),
           'email_verified_at' => now(),
       ]);
        User::create([
            'first_name' => "user",
            'last_name' => "user",
            'email' => "user@user.it",
            'password' => Hash::make('user.007'),
            'email_verified_at' => now(),
        ]);
    }
}
