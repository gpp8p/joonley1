@extends('layouts.jheader')


@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email" class = "introbody3">E-Mail Address</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
    </form>




@endsection
