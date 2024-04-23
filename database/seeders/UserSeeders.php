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
           'name' => "admin",
           'email' => "admin@admin.it",
           'password' => Hash::make('admin.007'),
           'email_verified_at' => now(),
           'role_id'=>2,
       ]);
        User::create([
            'name' => "user",
            'email' => "user@user.it",
            'password' => Hash::make('user.007'),
            'email_verified_at' => now(),
            'role_id'=>3,
        ]);
    }
}
