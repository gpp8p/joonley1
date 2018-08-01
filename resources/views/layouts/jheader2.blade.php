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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <script>
        window.logOut = function(){
            alert('logout clicked!');
        });
    </script>

</head>
<body class = "bodycss">
@guest
<div class="hdr1 hdr1a line2px">
@else
<div class="hdr2 line2px">
@endguest

    @guest
        <span class="logright"><a class="loglink1" href="{{ route('login') }}">Log In</a></span>
    @else
        <div class="nav_icons">
            <table border="0">
                <tr>
                    @if($adminView)
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('admin-form').submit();"><i class="fa fa-cogs" aria-hidden="true"></i></td>
                    @endif
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('feed-form').submit();"><i class="fa fa-newspaper fa-1x" aria-hidden="true"></i></td>
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('order-form').submit();"><i class="fas fa-dollar-sign" aria-hidden="true"></i></td>
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('specials-form').submit();"><i class="fa fa-exclamation-circle fa-1x" aria-hidden="true"></i></td>
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('favorites-form').submit();"><i class="fas fa-heart" aria-hidden="true"></i></td>
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('search-form').submit();"><i class="fa fa-search fa-1x" aria-hidden="true"></i></td>
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('messages-form').submit();"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></td>
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('more-form').submit();"><i class="fa fa-ellipsis-h fa-1x" aria-hidden="true"></i></td>
                    <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt 1x"></i></td>
                </tr>
                <tr>
                    @if($adminView)
                    <td align="center">Admin</td>
                    @endif
                    <td align="center">Feed</td>
                    <td align="center">Orders</td>
                    <td align="center">Specials</td>
                    <td align="center">Favs</td>
                    <td align="center">Search</td>
                    <td align="center">Message</td>
                    <td align="center">More</td>
                    <td align="center">Log Out</td>
                </tr>
            </table>
        </div>






<!--            <span class="logright"><a href="{{ route('logout') }}" class="loglink1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></span> -->

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="feed-form" action="{{ route('feed') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="order-form" action="{{ route('orders') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="specials-form" action="{{ route('specials') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="favorites-form" action="{{ route('favorites') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="search-form" action="{{ route('search') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="messages-form" action="{{ route('messages') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="more-form" action="{{ route('more') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <form id="admin-form" action="{{ route('admin') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

    @endguest

</div>

<div>
    @yield('content')
</div>






</body>