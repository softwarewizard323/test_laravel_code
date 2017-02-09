@extends('dashboard.layouts.app')

@section('title', ' - Support')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="booster_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12" id="wizard">
                <div class="widget-header">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab1" data-toggle="tab">Introduction</a></li>
                        <li><a href="#tab2" data-toggle="tab">Login</a></li>
                        <li><a href="#tab3" data-toggle="tab">Click on User</a></li>
                        <li><a href="#tab4" data-toggle="tab">+New user</a></li>
                        <li><a href="#tab5" data-toggle="tab">Add Email</a></li>
                        <li><a href="#tab6" data-toggle="tab">Set the timing</a></li>
                        <li><a href="#tab7" data-toggle="tab">Finish!</a></li>
                    </ul>
                </div>
                <div class="widget-body" style="height:480px">
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <div class="row-fluid">
                                <div class="span8 offset2" style="text-align: center;">
                                    <div class="hidden-phone">
                                        <h1 style="text-align: center; color:#444; margin-top: 10%;">
                                            <span style="color: #3da8de">Google Analytics:</span>
                                            <br>How to Add a New User to a Google Analytics Account</h1>
                                        <p>Before making any orders, make sure your Google Analytics account is properly configured so we can both track that you have received the requested amount of visitors from our Boosters. Click "Next" button located in bottom right corner to find out how to add a new user to your Google Analytics account. You can give anyone access as long as they have a Google account. You can give them &ldquo;View reports only&rdquo; access or you can give them &ldquo;Account Administrator&rdquo; access. The latter allows the user to add and delete other account users, create filters and change other settings on the account.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h4>
                                <a href="http://www.google.com/analytics/" target="_blank">Login to Google Analytics</a>
                                <i class="icon-external-link"></i>
                            </h4>
                            <p>
                                and click the Admin button (upper right). Click on your account/domain name to see the next administration window.
                            </p>
                            <hr>
                            <div class="row-fluid" style="text-align: center">
                                {{ Html::image('include/img/google-analytics-add-new-user-profile1.gif', null, ['class' => 'span12']) }}
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <h4>Click on the <span style="color:#3da8de">Users</span> Tab</h4>
                            <hr>
                            <div class="row-fluid" style="text-align: center">
                                {{ Html::image('include/img/google-analytics-add-new-user-admin.gif', null, ['class' => 'span12']) }}
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <h4>Click on the <span style="color:#3da8de">+New User</span> button.</h4>
                            <hr>
                            <div class="row-fluid" style="text-align: center">
                                {{ Html::image('include/img/google-analytics-add-new-user-new.gif', null, ['class' => 'span12']) }}
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5">
                            <h4><span style="color:#3da8de">Add Email</span></h4>
                            <p>Insert our email address (<b>{{ $our_mail }}</b>) for the new user. Select User or Administrator. Administrators have full access to the account, including the ability to add and delete users. We will need only User access so we can track # of visitors we send towards your website.</p>
                            <hr>
                            <div class="row-fluid" style="text-align: center">
                                {{ Html::image('include/img/google-analytics-add-new-user-must-be-registered.gif', null, ['class' => 'span12']) }}
                            </div>
                        </div>
                        <div class="tab-pane" id="tab6">
                            <h4><span style="color:#3da8de">Set the timing</span></h4>
                            <p>You need to set the timing in Google Analytics to Barbados or any countries with (GMT-04:00), so that the traffic will be received properly. In order to do that go Admin > Profile settings > Change the country</p>
                            <hr>
                            <div class="row-fluid" style="text-align: center">
                                {{ Html::image('include/img/google-analytics-add-new-user-admin-set-the-timing.gif', null, ['class' => 'span12']) }}
                            </div>
                        </div>
                        <div class="tab-pane" id="tab7">
                            <div class="row-fluid">
                                <div class="span6 offset3" style="text-align: center;">
                                    <div class="hidden-phone">
                                        <h1 style="text-align: center; color:#444; margin-top: 15%;"><i style="color:#C4E587" class="icon-ok-sign"></i> Congratulations!</h1>
                                        <p>You have successfully set up Google Analytics account so we can track visitors that you receive from our Boosters. If you had any problems setting up these options, please contact our support and we will gladly help you out.</p>
                                    </div>
                                </div>
                            </div>
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

@stop
