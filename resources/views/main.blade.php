<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uploading images in Laravel with DropZone</title>

    <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">


    <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="{{ URL::asset('css/joonley.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/gridstyling.css') }}" rel="stylesheet" type="text/css">


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>


    @yield('head')
</head>
<body>
<div class="container-fluid">
    @yield('content')
</div>

@yield('js')

</body>
</html>