@extends('auth.app')

@section('title', ' - Reset password')

@section('content')
    @if (session('status'))
        <h1 style="text-align: center; color: #333;">The password reset link has been sent to your email!</h1>
        <p style="text-align: center;"><a href="{{ url('/') }}">Main</a></p>
    @else
        <div id="wrapper">
            <div id="formlogo-top"></div>
            <div id="client-title">Request New Password</div>
            <p style="width: 350px; text-align: center; color: #333; margin: 0 auto 15px auto;">A new password will be
                generated for you and sent to the email address associated with your account, all you have to do is
                enter your username.</p>
            <div id="registerform">
                @if ($errors->has('username'))
                    <span class="help-block" size="2" style="color: #e73d4a; font-size: small">{{ $errors->first('username') }}</span>
                @endif
                <form method="post" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <ul>
                        <li>Username:</li>
                        <li>
                            <input type="text" class="span3" name="username" maxlength="30" value="{{ old('username') }}">
                        </li>
                        <li>
                            <input type="hidden" name="subforgot" value="1">
                            <input type="submit" value="Get New Password" class="btn btn-large">
                        </li>
                    </ul>
                </form>
            </div>
            <div id="user-options"><a href="{{ url('/login') }}">Back to Login page</a></div>
            @endif
        </div>

@endsection