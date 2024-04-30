<?php

namespace App\Http\Api\Google\Request;

use Illuminate\Foundation\Http\FormRequest;

class AccessGoogleRequest extends FormRequest
{

    public function attributes()
    {
        return [
            "password" => "Password ",
            "email" => "Email ",
        ];
    }

    public function rules(){
        return [
            "password" => ["string","required"],
            "email" => ["email","required"],
        ];
    }

    public function messages()
    {
        return [
            "password.required" => " campo obbligatorio",
            "email.required" => " campo obbligatorio",
            "email.email" => " non valida",
        ];
    }

}
