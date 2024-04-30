<?php

namespace App\Models\Google;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $string, mixed $uuid)
 */
class AccessGoogle extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table="access_google";

    protected $fillable = [
        "email",
        "name",
        "id_request"
    ];
}
