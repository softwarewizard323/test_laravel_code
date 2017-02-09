@extends('dashboard.layouts.app')

@section('title', ' - My Settings')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="settings_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-user"></i>
                    <h5>
                        My Settings
                        <span class="badge badge-success">4</span>
                    </h5>
                </div>
                <div class="widget-body">
                    @if(session('status'))
                        <h3 style="text-align: center;">User Account Edit Success!</h3>
                        <p style="text-align: center;"><b>{{ $user->username }}</b>, your account has been successfully updated.
                            <a href="{{ url('/dashboard/settings') }}">Go back to Settings</a>.
                        </p>
                    @else
                    @if(count($errors->all()) > 0)
                        <font size="2" color="#ff0000">{{ count($errors->all()) }} error(s) found</font>
                    @endif
                        <form class="form-horizontal" action="{{ url('/dashboard/settings') }}" method="post">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Username</label>
                                <div class="controls">
                                    <input class="span4" disabled type="text" placeholder="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input class="span4" type="text" name="email" maxlength="50" placeholder="{{ $user->email }}" value="{{ $email }}">
                                    @if($errors->has('email'))
                                        <font color="#ff0000" size="2">{{ $errors->first('email') }}</font>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Current Password</label>
                                <div class="controls">
                                    <input class="span4" type="password" name="curpass" placeholder="***********" maxlength="30" value="">
                                    @if($errors->has('curpass'))
                                        @if($errors->first('curpass') != "* New Password not entered")
                                        <font color="#ff0000" size="2">{{ $errors->first('curpass') }}</font>
                                        @endif
                                    @endif
                                    @if($errors->has('newpass'))
                                        @if($errors->first('newpass') == "* Current Password not entered")
                                            <font color="#ff0000" size="2">{{ $errors->first('newpass') }}</font>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">New Password</label>
                                <div class="controls">
                                    <input class="span4" type="password" name="newpass" placeholder="***********" maxlength="30" value="">
                                    @if($errors->has('curpass'))
                                        @if($errors->first('curpass') == "* New Password not entered")
                                        <font color="#ff0000" size="2">{{ $errors->first('curpass') }}</font>
                                        @endif
                                    @endif
                                    @if($errors->has('newpass'))
                                        @if($errors->first('newpass') != "* Current Password not entered")
                                            <font color="#ff0000" size="2">{{ $errors->first('newpass') }}</font>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="hidden" name="subedit" value="1">
                                    <button class="btn btn-primary" value="Edit Account" type="submit">
                                        <i class="icon-ok-sign"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                <!-- /widget-body -->
            </div>
        </div>
    </div>

@stop
