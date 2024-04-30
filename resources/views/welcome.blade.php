<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite('resources/js/app.js')
</head>
<body>
<script>
    var appConfig = {
        appUrl : "{{config('utils.path_api_base')}}",
        keycloack: {
            realm: "{{config('utils.keycloack.realm')}}",
            clientId: "{{config('utils.keycloack.client_id')}}",
        }
    };

</script>
<div id="app">
</div>
<!--<a href="{{ url('auth/google') }}" class="bg-blue-600 text-white rounded-md px-4 py-2 ml-2">-->
<!--    Google Login-->
<!--</a>-->
</body>
</html>
