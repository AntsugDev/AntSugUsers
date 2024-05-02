<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task\TaskTipologica;
use Database\Seeders\Table\CitiesSeeders;
use Database\Seeders\Task\TaskPrioritaSeeders;
use Database\Seeders\Task\TaskTipologicaSeeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UserSeeders::class,

            //pagination
            //CitiesSeeders::class

            //task
            //Tipologiche

            TaskPrioritaSeeders::class,
            TaskTipologicaSeeders::class
        ]);
    }
}
