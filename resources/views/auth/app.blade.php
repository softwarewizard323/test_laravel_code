<!DOCTYPE html>
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

    {{ Html::style('include/css/bootstrap.css') }}
    {{ Html::style('include/css/main.css') }}
    {{ Html::style('include/css/font-awesome.min.css') }}
    {{ Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,700') }}
    {{ Html::style('include/css/member-front.css') }}

    <!-- as of IE9 cannot parse css files with more that 4K classes separating in two files -->
    <!--[if IE 9]>
    {{ Html::style('include/style/css/application-ie9-part2.css') }}
    <![endif]-->

    <link rel="shortcut icon" href="include/style/img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
         chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
         https://code.google.com/p/chromium/issues/detail?id=332189
         */
    </script>

    @yield('headers')
</head>
<body class="login-page">

<div class="container">

    @yield('content')

</div>
<!-- The Loader. Is shown when pjax happens -->
<div class="loader-wrap hiding hide">
    <i class="fa fa-circle-o-notch fa-spin-fast"></i>
</div>

<!-- common libraries. required for every page-->
{{ Html::script('include/style/vendor/jquery/dist/jquery.min.js') }}
{{ Html::script('include/style/vendor/jquery-pjax/jquery.pjax.js') }}
{{ Html::script('include/style/vendor/bootstrap-sass/assets/javascripts/bootstrap/transition.js') }}
{{ Html::script('include/style/vendor/bootstrap-sass/assets/javascripts/bootstrap/collapse.js') }}
{{ Html::script('include/style/vendor/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js') }}
{{ Html::script('include/style/vendor/bootstrap-sass/assets/javascripts/bootstrap/button.js') }}
{{ Html::script('include/style/vendor/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js') }}
{{ Html::script('include/style/vendor/bootstrap-sass/assets/javascripts/bootstrap/alert.js') }}
{{ Html::script('include/style/vendor/slimScroll/jquery.slimscroll.min.js') }}
{{ Html::script('include/style/vendor/widgster/widgster.js') }}

<!-- common app js -->
{{ Html::script('include/style/js/settings.js') }}
{{ Html::script('include/style/js/app.js') }}

<!-- page specific libs -->
{{ Html::script('include/style/vendor/parsleyjs/dist/parsley.min.js') }}

<!-- page specific js -->
{{ Html::script('include/style/js/form-validation.js') }}

</body>
</html>