<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="ExpressVisits">
    <meta name="description" content="Premium Traffic Provider">
    <meta name="keywords" content="@yield('keywords')">
    <title>ExpressVisits @yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="robots" content="NOODP,NOYDIR" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ Html::style('http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic|Cutive') }}
    {{ Html::style('css/style.min.css') }}

    <!-- main-js -->
    {{ Html::script('js/jquery-1.12.4.min.js') }}
    {{ Html::script('js/jquery-migrate-1.4.1.min.js') }}
    {{ Html::script('js/general.js') }}
    {{ Html::script('js/jquery.easing.1.3.js') }}
    <!--/ main-js -->

    <!-- topSlider -->
    {{ Html::script('js/jquery.onebyone.js') }}
    {{ Html::script('js/jquery.touchwipe.min.js') }}
    {{ Html::style('css/jquery.onebyone.css', ['media' => 'screen']) }}
    {{ Html::style('css/animate.css', ['media' => 'screen']) }}
    <!--/ topSlider -->

    <!--/ Testimonials -->
    {{ Html::script('js/slides.min.jquery.js') }}

    <!-- custom CSS -->
{{--    {{ Html::style('css/custom.css', ['media' => 'screen']) }}--}}

    <!--[if IE 7]>
    {{ Html::style('css/ie.css', ['media' => 'screen']) }}
    <![endif]-->

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-41836881-1', 'expressvisits.com');
        ga('send', 'pageview');
    </script>

    {{ Html::script('include/js/contactform.popup.js') }}
    {{ Html::style('include/css/contactform.css') }}

    @yield('headers')
</head>
<body>
<div class="body_wrap">

    <div class="header header_top">
        <div class="container_12">

            <a href="./"><div class="logo">
                </div></a>

            <div class="topmenu">
                <ul class="dropdown">
                    <li class="menu-item-home @if (Request::is('/')) current-menu-item @endif"><a href="{{ url('/') }}"><span>Home</span></a></li>
                    <li @if (Request::is('features'))class="current-menu-item"@endif><a href="{{ url('/features') }}"><span>Features</span></a></li>
                    <li @if (Request::is('faq'))class="current-menu-item"@endif><a href="{{ url('/faq') }}"><span>FAQs</span></a></li>
                    <li @if (Request::is('/register'))class="current-menu-item"@endif><a href="{{ url('/register') }}"><span>Place An Order</span></a></li>
                    <li><a href="http://blog.expressvisits.com"><span>The Blog</span></a></li>
                    <li><a href="#" class="topopup">Contact Us</a></li>
                    @if (Auth::check())
                    <li><a href="{{ url('/logout') }}"><span>Logout</span></a></li>
                    @else
                    <li><a href="{{ url('/login') }}"><span>Login</span></a></li>
                    @endif
                </ul>
            </div>
            <!--/ topmenu -->

        </div>
    </div>

    @if (Request::is('/'))
        @include('layouts._header_slider')
    @endif

    @yield('breadcrumb')

    <!--/ header -->

    <div class="middle full_width">
        <div class="container_12">

            @yield('content')

            @include('layouts._contact_popup')

        </div>
    </div>
    <!--/ middle -->

    <div class="footer">
        <div class="container_12">
            <div class="copyright" style="float:right; width: 60%;">
                <p>&copy; Copyright <?php echo date('Y'); ?>  |  All rights reserved<br>
                    <small>made by <a href="{{ url('/') }}">ExpressVisits</a> - <span class="text-white">Premium Traffic Provider</span></small> / <a href="#" class="topopup">Contact Us</a> / <a href="{{ url('/tos') }}">Terms of Service</a></p>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</div>


@yield('page_script')

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
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
    var sc_project=10371188;
    var sc_invisible=1;
    var sc_security="672f90e9";
    var scJsHost = (("https:" == document.location.protocol) ? "https://secure." : "http://www.");
    document.write("<sc"+"ript type='text/javascript' src='" + scJsHost + "statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter">
    <a title="shopify stats" href="http://statcounter.com/shopify/" target="_blank">
        <img class="statcounter" src="http://c.statcounter.com/10371188/0/672f90e9/1/" alt="shopify stats">
    </a>
</div></noscript>
<!-- End of StatCounter Code for Default Guide -->
</body>
</html>
