<?php

namespace App\Http\Api\Task\ProjectAndGroup\Request;

use Illuminate\Foundation\Http\FormRequest;

class TaskProjectRequest extends FormRequest
{

    public function attributes()
    {
        return [
            "name" => "Nome del progetto ",
        ];
    }

    public function rules() : array
    {
        return  [
            "name" => ["string","required"],
        ];
    }

    public function messages()
    {
        return [
            "name.required" => " campo obbligatorio",
        ];
    }

}
