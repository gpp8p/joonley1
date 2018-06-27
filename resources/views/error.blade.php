@extends('layouts.jheader')

@section('title', 'Welcome to Joonley!')

@section('content')
    <div class="bigTitleCentered">
        OMG! - There's been a problem with your submission
    </div>
    <div class="bigTitleCentered">
        {{$error_message}}
    </div>

@endsection