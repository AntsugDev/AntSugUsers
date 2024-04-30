<?php

namespace App\Http\Api\Google\Request;

use Illuminate\Foundation\Http\FormRequest;

class AccessGoogleRequest extends FormRequest
{

    public function attributes()
    {
        return [
            "email" => "Email ",
            "name" => "Anagrafica ",
            "access_token" => "Id token response api google "
        ];
    }

    public function rules(){
        return [
            "email" => ["email","required"],
            "name" => ["string","nullable"],
            "access_token" => ["string","required"],
        ];
    }

    public function messages()
    {
        return [
            "email.required" => " campo obbligatorio",
            "access_token.required" => " campo obbligatorio",
            "email.email" => " non valida",
        ];
    }

}
