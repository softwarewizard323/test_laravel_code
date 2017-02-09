<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="ExpressVisits">
    <meta name="description" content="Premium Traffic Provider">
    <meta name="keywords" content="@yield('keywords')">
    <title>ExpressVisits @yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>

    <link rel="shortcut icon" href="include/style/img/favicon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- main-css -->
    {{ Html::style('include/css/bootstrap.css') }}
    {{ Html::style('include/css/select2.css') }}
    {{ Html::style('include/css/main.css') }}
    {{ Html::style('include/css/flag-icon.css') }}
    {{ Html::style('include/css/font-awesome.min.css') }}
    {{ Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,700') }}
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    {{ Html::style('../include/css/datepicker.css') }}

    @yield('headers')
</head>
<body>
<div id="wrap">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <div class="logo">
                    {{ Html::image('include/img/logo.png', 'ExpressVisits') }}
                </div>
                <a class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="btn btn-navbar slide_menu_left visible-tablet">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="top-menu visible-desktop">
                    <ul class="pull-right">
                        @if ($user->username != 'piyushk61')
                            <li>
                                <a href="#"> <i class="icon-globe"></i>
                                    {{ $active_guests }}
                                    Guests
                                </a>
                            </li>
                            <li style="border-right: solid 1px #CCC;">
                                <a href="#"> <i class="icon-user"></i>
                                    {{ $active_users }}
                                    Members
                                </a>
                            </li>
                        @endif
                        <li>
                            <a data-notification="{{ $ticketsCount }}" href="{{ url('/admin/support') }}">
                                <i class="icon-ticket"></i>
                                Support Tickets
                            </a>
                        </li>
                        <li>
                            <a id="messages" data-notification="{{ $messagesCount }}" href="#">
                                <i class="icon-envelope"></i>
                                Messages</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="icon-off"></i>
                                Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="top-menu visible-phone visible-tablet">
                    <ul class="pull-right">
                        <li>
                            <a title="Messages" href="#">
                                <i class="icon-envelope"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-off"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Side menu -->
        <div class="sidebar-nav nav-collapse collapse">
            <div class="user_side clearfix">
                {{ Html::image($user->gravatar, $user->username) }}
                <span>Welcome back,</span>
                <h5>{{ $user->username }}</h5>
            </div>
            {{-- <div class="accordion" id="accordion2"> --}}
            @if ($user->username != 'piyushk61' && $user->username != 'ximplify')
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                            <span>
                                <i class="icon-shopping-cart"></i>
                                Orders
                            </span>
                        </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse @if(Request::is('admin/orders*')) in @endif">
                        <div class="accordion-inner">
                            <a class="accordion-toggle @if(Request::is('admin/orders/active*')) active @endif" href="{{ url('/admin/orders/active') }}">
                                <i class="icon-hand-right"></i>
                                Active Campaigns
                            </a>
                            <a class="accordion-toggle @if(Request::is('admin/orders/pending*')) active @endif" href="{{ url('/admin/orders/pending') }}">
                                <i class="icon-hand-down"></i>
                                Pending Campaigns
                            </a>
                            <a class="accordion-toggle @if(Request::is('admin/orders/hidden*')) active @endif" href="{{ url('/admin/orders/hidden') }}">
                                <i class="icon-hand-up"></i>
                                Hidden Pending Campaigns
                            </a>
                            <a class="accordion-toggle @if(Request::is('admin/orders/end*')) active @endif" href="{{ url('/admin/orders/end') }}">
                                <i class="icon-hand-up"></i>
                                End Pending
                            </a>
                            <a class="accordion-toggle @if(Request::is('admin/orders/completed*')) active @endif" href="{{ url('/admin/orders/completed') }}">
                                <i class="icon-hand-up"></i>
                                End Completed
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if($user->username != 'ximplify')
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                            <span>
                                <i class="icon-shopping-cart"></i>
                                Conversion Orders
                            </span>
                        </a>
                    </div>
                    <div id="collapseTwo" class="accordion-body collapse @if ($user->username == 'piyushk61' || Request::is('admin/conversion*')) in @endif">
                        <div class="accordion-inner">
                            <a class="accordion-toggle @if(Request::is('admin/conversion/active')) active @endif" href="{{ url('/admin/conversion/active') }}">
                                <i class="icon-hand-right"></i>
                                Active Campaigns
                            </a>
                            <a class="accordion-toggle @if(Request::is('admin/conversion/pending')) active @endif" href="{{ url('/admin/conversion/pending') }}">
                                <i class="icon-hand-down"></i>
                                Pending Campaigns
                            </a>
                            <a class="accordion-toggle @if(Request::is('admin/conversion/completed')) active @endif" href="{{ url('/admin/conversion/completed') }}">
                                <i class="icon-hand-up"></i>
                                End Completed
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if($user->username != 'piyushk61')
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('admin/sources*')) active @endif" href="{{ url('/admin/sources') }}">
                            <span><i class="icon-map-marker"></i>
                                Manage Sources
                            </span>
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('admin/news*')) active @endif" href="{{ url('/admin/news') }}">
                            <span><i class="icon-rss-sign"></i>
                                News
                            </span>
                        </a>
                    </div>
                </div>
                @if($user->username != 'ximplify')
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                <span><i class="icon-map-marker"></i>
                                    Balances
                                </span>
                            </a>
                        </div>
                        <div id="collapseFour" class="accordion-body collapse @if(Request::is('admin/balance*')) in @endif">
                            <div class="accordion-inner">
                                <a class="accordion-toggle @if(Request::is('admin/balance/manage')) active @endif" href="{{ url('/admin/balance/manage') }}">
                                    Manage Balance
                                </a>
                                <a class="accordion-toggle @if(Request::is('admin/balance/voucher')) active @endif" href="{{ url('/admin/balance/vouchers') }}">
                                    Voucher
                                </a>
                                <a class="accordion-toggle @if(Request::is('admin/balance/vip')) active @endif" href="{{ url('/admin/balance/vip') }}">
                                    VIP Users
                                </a>
                                <a class="accordion-toggle @if(Request::is('admin/balance/payments')) active @endif" href="{{ url('/admin/balance/payments') }}">
                                    View Payments
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('admin/faq*')) active @endif" href="{{ url('/admin/faq') }}">
                            <span><i class="icon-question-sign"></i>
                                Manage FAQs
                            </span>
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('admin/users*')) active @endif" href="{{ url('/admin/users') }}">
                            <span><i class="icon-user"></i>
                                Users
                            </span>
                        </a>
                    </div>
                </div>
            @endif
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('admin/support*')) active @endif" href="{{ url('/admin/support') }}">
                            <span><i class="icon-bullhorn"></i>
                                Support
                            </span>
                        </a>
                    </div>
                </div>
            @if($user->username != 'piyushk61')
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar" href="https://docs.google.com/document/d/1470FPM65qvvXP60gdmCZWHJ8cB7FMHe0qdYzFyddED0/edit" target="_blank">
                            <span><i class="icon-bullhorn"></i>
                                Support Answers
                            </span>
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('admin/signatures*')) active @endif" href="{{ url('/admin/signatures') }}">
                            <span><i class="icon-pushpin"></i>
                                Signatures
                            </span>
                        </a>
                    </div>
                </div>
            @endif
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle menubar @if(Request::is('admin/settings*')) active @endif" href="{{ url('/admin/settings') }}">
                        <span><i class="icon-cogs"></i>
                            Settings
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Side menu -->

    @yield('content');

</div>
<!-- wrap ends-->

{{ Html::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js') }}
{{ Html::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js') }}
{{ Html::script('include/js/bootstrap.js') }}
{{ Html::script('include/js/jquery.dataTables.min.js') }}
{{ Html::script('include/js/jquery.gritter.min.js') }}
{{ Html::script('include/js/main.js') }}
{{ Html::script('include/js/select2.min.js') }}
{{ Html::script('include/js/bootstrap-datepicker.js') }}
{{ Html::script('include/js/wysihtml5-0.3.0_rc2.min.js') }}
{{ Html::script('include/js/bootstrap-wysihtml5.js') }}
{{-- {{ Html::script('include/js/bootstrap-fileupload.js') }} --}}
{{ Html::script('include/js/jquery.validate.min.js') }}
{{ Html::script('include/js/jquery.bootstrap.wizard.min.js') }}

<script type="text/javascript">
    // header menu message
    <?php
        $content = '<ul>';
        if ($messages->count() > 0) {
            foreach ($messages as $message) {
                $content .= '<li><a href="/admin/message/'.$message['messageID'].'">';
                $content .= '<img src="/include/images/icons/ev-admin-avatar.gif"><span>';
                $messageDate = date('d-m-Y', strtotime($message['statusUpdated']));
                $content .= ($messageDate == date('d-m-Y', time())) ? 'Today' : $messageDate;
                $content .= '</span><h4>Admin</h4>'.$message['messageTitle'].'</a></li>';
            }
        } else {
            $content .= '<div style="text-align: center; color: #CCC; margin: 20px 0;">No New Messages</div>';
        }
        $content .= '</ul><div class="popover_footer"><a href="/admin/messages">View all messages</a></div>';
    ?>

    $('.top-menu #messages').popover({
        html: true,
        placement: 'bottom',
        title: 'Messages',
        content: '{!! $content !!}'
    });
</script>

{{--{{ Html::script('include/style/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js') }}--}}

@yield('page_script')

</body>
</html>