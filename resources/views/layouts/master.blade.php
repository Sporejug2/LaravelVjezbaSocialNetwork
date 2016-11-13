<!DOCTYPE html>
<html>
    <head>
     <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}"> <!-- putanja do css , laravel helper , putanja koda sam uvijek u public folderu-->
    </head>
    <body>
        @include('includes.header') <!-- include folder bez imena foldera -->
        <div class="container">
            @yield('content')
        </div>

    </body>
</html>
