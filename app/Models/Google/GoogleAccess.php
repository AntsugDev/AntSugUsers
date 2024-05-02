<?php

namespace App\Models\Google;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class GoogleAccess extends Model
{
    use HasFactory;


    protected $table = "google_access";

    protected $fillable = [
        "user_id",
        "payload",
        "tk"
    ];
}
