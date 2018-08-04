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
            <div class="sidebarItem">Item #1</div>
            <div class="sidebarItem">Item #1</div>
            <div class="sidebarItem">Item #1</div>
            <div class="sidebarItem">Item #1</div>
        </div>
        <div class="box content">

            <div class="wrap2">
                <div class="box2 grow">
                    <div>A</div>
                    <div>B</div>
                    <div>C</div>
                    <div>D</div>
                    <div>E</div>
                </div>
                <div class="box2 grow">
                    <div>A</div>
                    <div>B</div>
                    <div>C</div>
                    <div>D</div>
                    <div>E</div>
                </div>
                <div class="box2 grow">
                    <div>A</div>
                    <div>B</div>
                    <div>C</div>
                    <div>D</div>
                    <div>E</div>
                </div>
            </div>



        </div>
        <div class="box footer">Footer</div>
@endsection