<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">
    <meta name="author" content="ExpressVisits">
    <meta name="description" content="Premium Traffic Provider">
    <meta name="keywords" content="@yield('keywords')">
    <title>ExpressVisits Client Panel @yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- main-css -->
    {{ Html::style('include/css/bootstrap.css') }}
    {{ Html::style('include/css/select2.css') }}
    {{ Html::style('include/css/main.css') }}
    {{ Html::style('include/css/flag-icon.css') }}

    <!-- Fonts -->
    {{ Html::style('include/css/font-awesome.min.css') }}
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') }}
    {{ Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,700') }}

    @if (Request::is('dashboard/campaign/*'))
    {{ Html::style('include/css/ticker-style.css') }}
    @endif

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    {{ Html::style('include/css/datepicker.css') }}

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
                        <li>
                            <a href="{{ url('/dashboard/balance') }}">
                                Account Balance: ${{ number_format($user_settings->account_balance, 2, ',', ' ') }}
                            </a>
                        </li>
                        <li>
                            <a data-notification="{{ $ticketsCount }}" href="{{ url('/dashboard/support') }}">
                                <i class="icon-ticket"></i> Support Tickets
                            </a>
                        </li>
                        <li>
                            <a id="messages" data-notification="{{ $messagesCount }}" href="#">
                                <i class="icon-envelope"></i> Messages
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="icon-off"></i> Logout
                            </a>
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
            <!-- END container-fluid -->
        </div>
        <!-- END navbar-inner -->
    </div>
    <!-- END navbar navbar-fixed-top -->

    <div class="container-fluid">
        <!-- Side menu -->
        <div class="sidebar-nav nav-collapse collapse">
            <div class="user_side clearfix">
                @if($query_vip && $query_vip->username == $user->username)
                {{ Html::image('images/vip-badge.png', 'Vip user') }}
                @else
                {{ Html::image($user->gravatar, $user->username) }}
                @endif
                <span>Welcome back,</span>
                <h5 style="float: left;">{{ $user->username }}</h5>
            </div>
            <div class="accordion" id="accordion2">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('dashboard/campaign/*')) active @endif" href="{{ url('/dashboard/campaign') }}">
                            <i class="icon-desktop"></i>
                            <span>Campaign</span>
                        </a>
                    </div>
                </div>
                <div class="accordion" id="accordion2" style="margin-bottom: 0px;">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                <span>
                                    <i class="icon-map-marker"></i>
                                    Cosmetic Traffic
                                </span>
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse @if (Request::is('dashboard/booster*')) in @endif">
                            <div class="accordion-inner">
                                <a class="accordion-toggle @if(Request::is('dashboard/booster/google*')) active @endif" href="{{ url('/dashboard/booster/google') }}">
                                    Google Booster
                                </a>
                            </div>
                            <div class="accordion-inner">
                                <a class="accordion-toggle @if(Request::is('dashboard/booster/direct*')) active @endif" href="{{ url('/dashboard/booster/direct') }}">
                                    Direct Booster
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordion2" style="margin-bottom: 0px;">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                                <span>
                                    <i class="icon-globe"></i>
                                    Monetization Traffic
                                </span>
                            </a>
                        </div>
                        <div id="collapseFive" class="accordion-body collapse @if (Request::is('dashboard/traffic*')) in @endif">
                            <div class="accordion-inner">
                                <a class="accordion-toggle @if(Request::is('dashboard/traffic/clicks*')) active @endif" href="{{ url('/dashboard/traffic/clicks') }}">
                                    High Clicks Booster
                                </a>
                            </div>
                            <div class="accordion-inner">
                                <a class="accordion-toggle @if(Request::is('dashboard/traffic/adsense*')) active @endif" href="{{ url('/dashboard/traffic/adsense') }}">
                                    Adsense Booster
                                    <span class="label badge-important" style="font-size:10px;margin-left:5px">NEW!</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordion2" style="margin-bottom: 0px;">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">
                                <span>
                                    <i class="icon-gift"></i>
                                    Programs
                                    <span class="label badge-important" style="font-size:10px;margin-left:5px">NEW!</span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseSeven" class="accordion-body collapse @if (Request::is('dashboard/programs*')) in @endif">
                            <div class="accordion-inner">
                                <a class="accordion-toggle @if(Request::is('dashboard/programs/achievements-sharing')) active @endif" href="{{ url('/dashboard/programs/achievements-sharing') }}">
                                    Achievements Sharing
                                </a>
                            </div>
                            <div class="accordion-inner">
                                <a class="accordion-toggle @if(Request::is('dashboard/programs/vip-rates')) active @endif" href="{{ url('/dashboard/programs/vip-rates') }}">
                                    VIP / Loyalty Program
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('dashboard/orders*')) active @endif" href="{{ url('/dashboard/orders') }}">
                            <span>
                                <i class="icon-time"></i>
                                Order History
                            </span>
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('dashboard/analytics*')) active @endif" href="{{ url('/dashboard/analytics') }}">
                            <span>
                                <i class="icon-bar-chart"></i>
                                Analytics
                                <span class="label badge-important" style="font-size:10px;margin-left:5px">IMPORTANT!</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('dashboard/support*')) active @endif" href="{{ url('/dashboard/support') }}">
                            <span>
                                <i class="icon-bullhorn"></i>
                                Support
                            </span>
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar @if(Request::is('dashboard/settings*')) active @endif" href="{{ url('/dashboard/settings') }}">
                            <span>
                                <i class="icon-cogs"></i>
                                Settings
                            </span>
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle menubar" href="{{ url('/faq') }}" target="_blank">
                            <span>
                                <i class="icon-question-sign"></i>
                                FAQs
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Side menu -->

        @yield('content')
        <!-- /Main window -->

    </div>
    <!--/.fluid-container-->
</div>
<!-- wrap ends-->

{{ Html::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js') }}
{{ Html::script('http://code.jquery.com/jquery-latest.js') }}
{{ Html::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js') }}
{{ Html::script('include/js/bootstrap.js') }}
{{ Html::script('include/js/jquery.dataTables.min.js') }}
{{ Html::script('include/js/jquery.gritter.min.js') }}
{{ Html::script('include/js/main.js') }}
{{ Html::script('include/js/select2.min.js') }}
{{ Html::script('include/js/bootstrap-datepicker.js') }}
{{ Html::script('include/js/wysihtml5-0.3.0_rc2.min.js') }}
{{ Html::script('include/js/bootstrap-wysihtml5.js') }}
{{ Html::script('include/js/bootstrap-fileupload.js') }}
{{ Html::script('include/js/jquery.validate.min.js') }}
{{ Html::script('include/js/jquery.bootstrap.wizard.min.js') }}
{{ Html::script('include/js/jasny-bootstrap.min.js') }}
{{ Html::script('include/js/jquery.ticker.js') }}

<script type="text/javascript">
    $(function () {
        $('#js-news').ticker();
    });
</script>

<script type="text/javascript">
    // header menu message
    <?php
        $content = '<ul>';
        if ($messages->count() > 0) {
            foreach ($messages as $message) {
                $content .= '<li><a href="/dashboard/message/'.$message['messageID'].'">';
                $content .= '<img src="/include/images/icons/ev-admin-avatar.gif"><span>';
                $messageDate = date('d-m-Y', strtotime($message['statusUpdated']));
                $content .= ($messageDate == date('d-m-Y', time())) ? 'Today' : $messageDate;
                $content .= '</span><h4>Admin</h4>'.$message['messageTitle'].'</a></li>';
            }
        } else {
            $content .= '<div style="text-align: center; color: #CCC; margin: 20px 0;">No New Messages</div>';
        }
        $content .= '</ul><div class="popover_footer"><a href="/dashboard/messages">View all messages</a></div>';
    ?>

    $('.top-menu #messages').popover({
        html: true,
        placement: 'bottom',
        title: 'Messages',
        content: '{!! $content !!}'
    });
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter25642754 = new Ya.Metrika({id:25642754,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25642754" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

@yield('page_script')
<script>
    $('#example').tooltip();
</script>
</body>
</html>