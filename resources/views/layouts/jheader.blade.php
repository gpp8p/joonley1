<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="{{ URL::asset('css/joonley.css') }}" rel="stylesheet" type="text/css">
</head>
<body class = "bodycss">

<div class="hdr1 line2px">
    <span class="alignleft">Joonley</span>
    @guest
        <span class="alignright">Log In</span>
    @else
            <span class="alignright">Log Out</span>
    @endguest

</div>

<div>
    @yield('content')
</div>






</body>