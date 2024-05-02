<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskPriorita extends Model
{
    use HasFactory;

    protected $table = "task_priorita";

    protected $fillable = [
        "name",
        "icon",
    ];
}
