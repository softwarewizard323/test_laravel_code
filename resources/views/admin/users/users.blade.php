@extends('admin.layouts.app')

@section('content')
<div class="main_container" id="booster_page">
    <br>
    <div class="row-fluid">
        <div class="widget widget-padding span12" id="wizard">
            <div class="widget-header">
                <ul class="nav nav-tabs">
                    <li><a href="#tab1" data-toggle="tab">All Users</a></li>
                    <li><a href="#tab2" data-toggle="tab">Update User</a></li>
                    <li><a href="#tab3" data-toggle="tab">Delete User</a></li>
                    <li><a href="#tab4" data-toggle="tab">Delete Inactive Users</a></li>
                    <li><a href="#tab5" data-toggle="tab">Ban User</a></li>
                    <li><a href="#tab6" data-toggle="tab">Delete Banned User</a></li>
                </ul>
            </div>
            <div class="widget-body" style="min-height:480px">
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        @if($message = Session::get('message'))
                            <div id="message" class="alert alert-success alert-sm"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {!! $message !!}
                            </div>
                        @endif
                        <table id="campaigns" class="table table-striped table-bordered dataTable\">
                            <thead>
                            <tr>
                                <th><b>Username</b></th>
                                <th><b>Level</b></th>
                                <th><b>Email</b></th>
                                <th><b>Last Active</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allUsers as $user)
                            <tr>
                                <td>{{  $user->username }}</td>
                                <td>{{ $user->userlevel }}</td>
                                <td>{{  $user->email }}</td>
                                <td>{{ gmdate("Y-m-d H:i:s", $user->timestamp) }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <h4>Update user level</h4>
                        <p>Use below form to assign admin level to any user or demote admin back to user level.</p>
                            @if ($errors->has('level_user'))
                                <font color="#ff0000" size="2">{{ $errors->first('level_user') }}</font><br>
                            @endif
                            @if ($errors->has('level'))
                                <font color="#ff0000" size="2">{{ $errors->first('level') }}</font><br>
                            @endif
                            <form action="{{ url('/admin/users/level') }}" method="POST">
                            {{ csrf_field() }}
                            <table>
                                <tr><td>
                                        Username:<br>
                                        <input type="text" name="level_user" maxlength="30" value="{{ old("level_user") }}" style="margin-top: 10px; margin-right: 5px;" >
                                    </td>
                                    <td>
                                        Level:<br>
                                        <select name="level" style="margin-top: 10px; margin-right: 5px;" >
                                            <option @if(old("level") == 1) selected @endif value="1">1</option>
                                            <option @if(old("level") == 9) selected @endif value="9">9</option>
                                        </select>
                                    </td>
                                    <td>
                                        <br>
                                        <input type="hidden" value="tab2" name="tab">
                                        <input type="submit" value="Update Level" class="btn btn-danger">
                                    </td></tr>
                            </table>
                        </form>
                        <br>
                        <div class="row-fluid">
                            <span class="label label-info" style="float: left;width:70px;text-align:center;">Level 1</span>
                            <p class="span10">Regular user who can make booster orders</p>
                        </div>
                        <div class="row-fluid">
                            <span class="label label-info" style="float: left;width:70px;text-align:center;">Level 9</span>
                            <p class="span10">Admin user who can manage booster orders created by Level 1 users. He can also create messages, reply to tickets and messages, etc...</p>
                        </div>

                        <hr />

                        <h4>Update user password</h4>
                        <p>Use below form to change password to any user.</p>
                        @if ($errors->has('password_user'))
                            <font color="#ff0000" size="2">{{ $errors->first('password_user') }}</font><br>
                        @endif
                        @if ($errors->has('new_password'))
                            <font color="#ff0000" size="2">{{ $errors->first('new_password') }}</font><br>
                        @endif
                        <form action="{{ url('/admin/users/password') }}" method="POST">
                            {{ csrf_field() }}
                            <table>
                                <tr>
                                    <td>
                                        Username:<br>
                                        <input type="text" name="password_user" maxlength="30" value="{{ old("password_user") }}" style="margin-top: 10px; margin-right: 5px;" >
                                    </td>
                                    <td>
                                        New Password:<br>
                                        <input type="password" class="passwordField" name="new_password" maxlength="30" value="" style="margin-top: 10px; margin-right: 5px;" autocomplete="off">
                                    </td>
                                    <td>
                                        <br>
                                        <button type="button" class="btn btn-default show-hide-pass"><i class="icon-eye-open show"></i><i class="icon-eye-close hide"></i></button>
                                    </td>
                                    <td>
                                        <br>
                                        &nbsp;<input type="submit" value="Update password" class="btn btn-danger">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <h4>Delete User</h4>
                        @if ($errors->has('del_user'))
                            <font color="#ff0000" size="2">{{ $errors->first('del_user') }}</font><br>
                        @endif
                        <form action="{{ url('/admin/users/delete') }}" method="POST">
                            {{ csrf_field() }}
                            Username:<br>
                            <input type="text" name="del_user" maxlength="30" value="{{ old("del_user") }}" class="span3" style="margin-top: 10px; margin-right: 5px;" >
                            <input type="submit" value="Delete User" class="btn btn-danger">
                        </form>
                    </div>
                    <div class="tab-pane" id="tab4">
                        <h4>Delete Inactive Users</h4>
                        <p>This will delete all users (not administrators), who have not logged in to the site within a certain time period. You specify the days spent inactive.</p>
                        <form action="{{ url('/admin/users/clear') }}" method="POST">
                            {{ csrf_field() }}
                            <table>
                                <tr>
                                    <td>
                                        Days:<br>
                                        <select name="inactive_days" style="margin-top: 10px; margin-right: 5px;" >
                                            <option value="3">3
                                            <option value="7">7
                                            <option value="14">14
                                            <option value="30">30
                                            <option value="100">100
                                            <option value="365">365
                                        </select>
                                    </td>
                                    <td>
                                        <br>
                                        <input type="hidden" name="subdelinact" value="1">
                                        <input type="submit" value="Delete All Inactive" class="btn btn-danger">
                                    </td>
                            </table>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab5">
                        <h4>Ban User</h4>
                        <p>Type in user username and click red button to ban him from ExpressVisits system and block his access.</p>
                        @if ($errors->has('ban_user'))
                            <font color="#ff0000" size="2">{{ $errors->first('ban_user') }}</font><br>
                        @endif
                        <form action="{{ url('/admin/users/ban') }}" method="POST">
                            {{ csrf_field() }}
                            Username:<br>
                            <input type="text" name="ban_user" maxlength="30" class="span3" style="margin-top: 10px" value="{{ old("ban_user") }}">
                            <input type="submit" value="Ban User" class="btn btn-danger">
                        </form>
                        <h4>Banned Users Table Contents:</h4>
                        <p>Below table shows the list of all banned users.</p>
                        @if ($bannedUsers->count() > 0)
                        <table  id="campaigns" class="table table-striped table-bordered dataTable" align="left" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                                <td><b>Username</b></td>
                                <td><b>Time Banned</b></td>
                            </tr>
                            @foreach($bannedUsers as $user)
                                <tr>
                                <td>{{  $user->username }}</td>
                                <td>{{ gmdate("Y-m-d H:i:s", $user->timestamp) }}</td>
                            @endforeach
                            </tr>
                        </table>
                        @else
                            Database table empty
                        @endif
                        <br>
                    </div>
                    <div class="tab-pane" id="tab6">
                        <h4>Delete Banned User</h4>
                        <p>Use below form to delete any user from ExpressVisits database. Simply type in his username which can be found from <a href="#tab5" data-toggle="tab">this list</a> and then click red button.</p>
                        @if ($errors->has('banned_user'))
                            <font color="#ff0000" size="2">{{ $errors->first('banned_user') }}</font><br>
                        @endif
                        <form action="{{ url('/admin/users/banned') }}" method="POST">
                            {{ csrf_field() }}
                            Username:<br>
                            <input type="text" name="banned_user" maxlength="30" class="span3" style="margin-top: 10px" value="{{ old("banned_user") }}">
                            <input type="submit" value="Delete Banned User" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>

            <div class="widget-footer">
                <ul class="wizard">
                    <li class="previous first" style="display:none;">
                        <a class="btn" href="javascript:void(0)"><i class="icon-chevron-sign-left"></i> First</a>
                    </li>
                    <li class="previous">
                        <a class="btn" href="javascript:void(0)"><i class="icon-chevron-sign-left"></i> Previous</a>
                    </li>
                    <li class="next last" style="display:none;">
                        <a class="btn" href="javascript:void(0)">Last <i class="icon-chevron-sign-right"></i></a>
                    </li>
                    <li class="next">
                        <a class="btn" href="javascript:void(0)">Next <i class="icon-chevron-sign-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_script')
    <script>
        $(function() {
            setTimeout(function () {
                $('#message').fadeOut(500);
            }, 2000);
        });
    </script>
@stop