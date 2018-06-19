<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/joonley.css') }}" rel="stylesheet" type="text/css">
</head>
<body class = "bodycss">

<div class="hdr1 line2px">
    <span class="alignleft">Joonley</span>
    <span class="alignright">Log In</span>
</div>

<div>
    @yield('content')
</div>






</body>