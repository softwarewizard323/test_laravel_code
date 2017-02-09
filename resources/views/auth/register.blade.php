@extends('auth.app')

@section('title', ' - Register')

@section('content')
    <div id="wrapper">
        <div id="formlogo-top"></div>
        <div id="client-title">New Client Registration</div>
        <div id="registerform">
            <form id="login-validate-form" method="post" action="{{ url('/register') }}" data-parsley-priority-enabled="false" novalidate="novalidate">
                {{ csrf_field() }}
                <ul>
                    <li>First Name:<br /><span  style="color:#ff0000; font-size: small">{{ $errors->first('fname') }}</span></li>
                    <li id="extend-form"><input type="text" name="fname" class="span3" maxlength="30" value="{{ old('fname') }}" /></li>
                    <li>Last Name:<br /><span  style="color:#ff0000; font-size: small ">{{ $errors->first('lname') }}</span></li>
                    <li id="extend-form"><input type="text" name="lname" class="span3" maxlength="30" value="{{ old('lname') }}" /></li>
                    <li>Username:<br /><span  style="color:#ff0000; font-size: small">{{ $errors->first('user') }}</span></li>
                    <li id="extend-form"><input type="text" name="user" class="span3" maxlength="30" value="{{ old('user') }}"></li>
                    <li>Password:<br /><span  style="color:#ff0000; font-size: small">{{ $errors->first('pass') }}</span></li>
                    <li id="extend-form"><input type="password" name="pass" class="span3" maxlength="30" value="{{ old('pass') }}"></li>
                    <li>Email:<br /><span  style="color:#ff0000; font-size: small">{{ $errors->first('email') }}</span></li>
                    <li id="extend-form"><input type="text" name="email" class="span3" maxlength="50" value="{{ old('email') }}"></li>
                    <li><input type="hidden" name="subjoin" value="1"><input type="submit" value="Register!" class="btn btn-large"></li>
                </ul>
            </form>
        </div>
        <div id="user-options"><a href="{{ url('/login') }}">Back to Login page</a> / <a href="{{ url('/password/reset') }}">Reset Password</a></div>
    </div>
@endsection
