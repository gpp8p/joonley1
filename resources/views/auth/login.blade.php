@extends('layouts.jheader')


@section('content')
    <form method="POST" name="loginForm" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="pwentry">
            <div>
                <label for="email" class = "pwlabel">E-Mail Address:</label>
                <input id="email" type="email" class="pwinput" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div>
                <label for="password" class="pwlabel">Password:</label>
                <input id="password" type="password" class="pwinput"  name="password" required>
            </div>
            <div>

                <input type="submit" class="btn"  value="Log Me In !">
                <input type="button" class="btn" value="Cancel" onclick="window.location.href ='{{ route('intro') }}';return false;"/>
                <div class = "tm1">
                    <label class = "pwlabel">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
                <div class = "tm1">
                    <a class="pwlabel loglink1" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>

                </div>

            </div>

        </div>
    </form>





@endsection
