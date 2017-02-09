@extends('auth.app')

@section('title', ' - Login')

@section('content')

    <div id="wrapper">
        <div id="formlogo-top"></div>
        <div id="client-title">Client Panel Login</div>
        <div id="registerform">

            {{--/**--}}
            {{--* User not logged in, display the login form.--}}
            {{--* If user has already tried to login, but errors were--}}
            {{--* found, display the total number of errors.--}}
            {{--* If errors occurred, they will be displayed.--}}
            {{--*/--}}

            @if(count($errors->all()) > 0)
                <span  style="color:#ff0000; font-size: small">{{count($errors->all())}} error(s) found</span>
            @endif

            <form method="post" action="{{ url('/login') }}" data-parsley-priority-enabled="false" novalidate="novalidate">
                {{ csrf_field() }}
                <ul>
                    <li>
                        Username:<br/><span  style="color:#ff0000; font-size: small">
                            @if($errors->first('username') != "* Invalid password") {{ $errors->first('username') }} @endif
                        </span>
                    </li>

                    <li>
                        <input type="text" name="username" maxlength="30" value="{{ old('username') }}" class="span3">
                    </li>

                    <li>Password:<br/><span  style="color:#ff0000; font-size: small">
                            @if($errors->first('username') == "* Invalid password") {{ $errors->first('username') }} @else {{ $errors->first('password') }} @endif
                        </span>
                        <input type="password" name="password" maxlength="30" value="" class="span3">
                    </li>

                    <li>
                        <input type="checkbox" name="remember" id="checkbox1" value="1" @if (old('remember')) checked @endif> Remember my login credentials.
                    </li>

                    <input type="hidden" name="sublogin" value="1">

                    <li style="margin-top: 20px!important;"><input type="submit" value="Login" class="btn btn-large"></li>
                </ul>
            </form>
        </div>
        <div id="user-options">Not registered? <a href="{{ url('/register') }}">Sign-Up!</a> / <a href="{{ url('/password/reset') }}">Forgot
                Password?</a></div>
    </div>


    <!-- Start of StatCounter Code for Default Guide -->
    <script type="text/javascript">
        var sc_project = 10371188;
        var sc_invisible = 1;
        var sc_security = "672f90e9";
        var scJsHost = (("https:" == document.location.protocol) ?
                "https://secure." : "http://www.");
        document.write("<sc" + "ript type='text/javascript' src='" +
                scJsHost +
                "statcounter.com/counter/counter.js'></" + "script>");
    </script>
    <noscript>
        <div class="statcounter"><a title="shopify stats"
                                    href="http://statcounter.com/shopify/" target="_blank"><img
                        class="statcounter"
                        src="http://c.statcounter.com/10371188/0/672f90e9/1/"
                        alt="shopify stats"></a></div>
    </noscript>
    <!-- End of StatCounter Code for Default Guide -->

@endsection