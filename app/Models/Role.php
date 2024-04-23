<?php

namespace App\Models;

use App\Http\Api\Core\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array[] $array)
 */
class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'label'];

    const ROOT = 1;

    const ADMIN = 2;

    const USER = 3;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
