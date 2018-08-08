@extends('layouts.jheader')

@section('content')
    <div class="wrapper">
        <div class="box header">
            <div class="jtitle">Joonley</div>
            <div class="menuicons">
                <div></div>
                <div>
                    @include('iconmenu')
                </div>
            </div>
        </div>
        <div class="bar"></div>
        <div id="sidebar" class="sidebar">
            @switch($sidebar)
                @case('admin')
                    @include('adminSidebar')
                @break
                @case('feed')
                    @include('feedSidebar')
                @break
                @case('orders')
                    @include('ordersSidebar')
                @break
                @case('specials')
                    @include('specialsSidebar')
                @break
                @case('favorites')
                    @include('favoritesSidebar')
                @break
                @case('search')
                @include('searchSidebar')
                @break
                @case('messages')
                    @include('messagesSidebar')
                @break
                @case('more')
                @include('moreSidebar')
                @break


            @endswitch
        </div>
        <div class="box content">
            @switch($contentWindow)
                @case('viewRegistrations')
                    @include('regwindow')
                @break
                @case('viewThisRegistration')
                    @include('regdata')
                @break
                @case('feedContent')
                    @include('feedContent')
                @break
                @case('ordersContent')
                    @include('ordersContent')
                @break
                @case('specialsContent')
                    @include('specialsContent')
                @break
                @case('favoritesContent')
                    @include('favoritesContent')
                @break
                @case('searchContent')
                    @include('searchContent')
                @break
                @case('messagesContent')
                    @include('messagesContent')
                @break
                @case('moreContent')
                    @include('moreContent')
                @break

            @endswitch
        </div>
        <div class="footer">
            <div class="menuFiller"></div>
            <div class="menuSpacer">
                <div></div>
                <div class="socialFooter">
                </div>
                <div></div>
            </div>
        </div>
@endsection