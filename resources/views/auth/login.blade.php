@extends('layouts.jheader')


@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="pwentry">
            <div>
                <label for="email" class = "pwlabel">E-Mail Address:</label>
                <input id="email" type="email" class="pwinput" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div>
                <label for="password" class="pwlabel">Password:</label>
                <input id="password" type="password" class="pwinput"  name="password" required>
            </div>

        </div>
    </form>




@endsection
