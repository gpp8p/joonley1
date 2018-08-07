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