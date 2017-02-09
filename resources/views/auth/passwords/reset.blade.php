@extends('auth.app')

@section('title', ' - Reset password')

@section('content')
    <div id="wrapper">
        <section class="widget widget-login animated fadeInUp">
            <div id="formlogo-top"></div>
            <div id="client-title">Reset Password</div>
            <div id="registerform">
                <form id="login-validate-form" method="post" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <ul>
                        <li>Username:<br/><span style="color:#ff0000; font-size: small">{{ $errors->first('username') }}</span></li>
                        <li id="extend-form"><input type="text" name="username" class="span3" maxlength="30" value="{{ old('fname') }}"/></li>
                        <li>Password:<br/><span style="color:#ff0000; font-size: small">{{ $errors->first('password') }}</span></li>
                        <li id="extend-form"><input type="password"  name="password" class="span3" maxlength="30" value="{{ old('lname') }}"/></li>
                        <li>Confirm Password:<br/><span style="color:#ff0000; font-size: small">{{ $errors->first('password_confirmation') }}</span></li>
                        <li id="extend-form"><input type="password"  name="password_confirmation" class="span3" maxlength="30" value="{{ old('user') }}"></li>
                        <li>
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="subjoin" value="1">
                            <input type="submit" value="Register!" class="btn btn-large">
                        </li>
                    </ul>
                </form>
            </div>
        </section>
    </div>
@endsection
