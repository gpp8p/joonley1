@extends('layouts.jheader')


@section('content')
    <div class="wrap1">
        <div class="box header">
            <div class="joonleyTitle">Joonley</div>
            <div class="menuicons">
                <div></div>
                <div>
                    @include('iconmenu')
                </div>
            </div>
        </div>
        <div class="bar"></div>
        <div class="box content">
            @include('feed')
        </div>
    </div>

@endsection