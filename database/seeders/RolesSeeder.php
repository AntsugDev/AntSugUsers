<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Role::insert([
            [
                'id' => 1,
                'name' => 'root',
                'label' => 'Root',
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'id' => 2,
                'name' => 'administrator',
                'label' => 'Amministratore',
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'id' => 3,
                'name' => 'user',
                'label' => 'Utente',
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
