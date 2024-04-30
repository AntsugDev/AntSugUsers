<?php
return [
    "prefix" => env('APP_PREFIX'),
    "path_api_base" => env('APP_URL'),
    "keycloack" => [
        "realm" => env('KEYCLOACK_REALM'),
        "client_id" => env("KEYCLOACL_CLIENT_ID"),
        "path_base" => env("APP_URL")
    ],
    "google" => [
        "jwt_secret" => env('APP_KEY'),
        "api" => env('GOOGLE_API_TOKEN_INFO')
    ]
];
