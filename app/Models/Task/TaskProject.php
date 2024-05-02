<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $id)
 * @method static create(array $data)
 */
class TaskProject extends Model
{
    use HasFactory;

    protected $table = "task_project_group";

    protected $fillable = [
        "name",
        "user_id"
    ];
}
