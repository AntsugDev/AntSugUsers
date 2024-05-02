<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTipologica extends Model
{
    use HasFactory;

    protected $table = "task_tipologica";

    protected $fillable = [
        "name",
        "icon",
        "id_project"
    ];
}
