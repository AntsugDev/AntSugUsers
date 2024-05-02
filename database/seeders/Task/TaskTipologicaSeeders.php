<?php

namespace Database\Seeders\Task;

use App\Models\Task\TaskTipologica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTipologicaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipologica = [
            array(
                "name" => "Bug",
                "icon" => "mdi-bug"
            ),
            array(
                "name" => "Task",
                "icon" => "mdi-record"
            ),
            array(
                "name" => "Log",
                "icon" => "mdi-math-log"
            ),


        ];
        foreach ($tipologica as $value)
            TaskTipologica::create($value);
    }
}
