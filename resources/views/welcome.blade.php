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
    };

</script>
<div id="app">
</div>
</body>
</html>
