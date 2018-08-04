@extends('layouts.jheader')

@section('content')
    <body>
    <div class="header">
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
    <div class="line2px"></div>
    <div class="content">
        <div class="menutable">
            <div class="menuitem1">Users</div>
            <div class="menuitem1"><a href="{{ route('reviewRegistrations') }}">Review Registrations</a></div>
            <div class="menuitem1">Rdecent Activity</div>
        </div>
        <div class="contentarea">content</div>
    </div>

    </body>

@endsection