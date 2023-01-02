<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Montri's Portfolio</title>

        <!-- Fonts -->

        <!-- Styles -->


        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body style="background-color: #191919; color: #8e8e8e; padding: 0; border: 0; height: 100%">
        <div id="app" class="h-full">
        </div>
    </body>
</html>
