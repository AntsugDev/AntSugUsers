<?php

namespace Database\Seeders\Task;

use App\Models\Task\TaskPriorita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskPrioritaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $priorita = [
           array(
               "name" => "Low",
               "icon" => "mdi-battery-low"
           ),
           array(
               "name" => "Medium",
               "icon" => "mdi-battery-medium"
           ),
           array(
               "name" => "High",
               "icon" => "mdi-battery-high"
           ),


       ];
       foreach ($priorita as $value){
           TaskPriorita::create($value);
       }
    }
}
